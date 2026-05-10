项目结构
  这是一个 Python2 + Docker 驱动的 AWD Web 线下赛平台。核心不是一个传统 Web 应用，而是一组脚本把多个靶机目录复制成队伍容器，并用 checker/
  flag_server 完成可用性检测、flag 轮换和计分。

  主要目录：

  - batch.py: 比赛初始化，复制靶机目录为 team1..teamN，生成密码、run.sh、docker.sh、flag.py。
  - start.py: 启动所有队伍容器、checker 容器、flag_server 容器。
  - stop_clean.py: 停止并删除所有 Docker 容器，删除 team* 目录。
  - check_server: checker 和 flag 轮换逻辑。
  - flag_server: flag 提交、攻击判定、分数写入。
  - web_*: 不同 Web 靶机题目源码，例如 PHP、FlaskBB、Beego、NodeCMS、ThinkPHP/TPShop、Typecho、phpMyAdmin 等。
  - writes_up: 各靶机题目的 writeup PDF。

  靶机目录大致如下：

  - web_server: PHP CMS 类靶机。
  - web_phpmyadmin: phpMyAdmin 4.0.4。
  - web_flaskbb: FlaskBB，Python2 环境。
  - web_beego: Go/Beego 靶机。
  - web_nodecms: NodeCMS。
  - web_qwb, web_tpshop, web_cliphp: PHP 框架/CMS 类题。
  - web_yunnan_1, web_yunnan_2, web_yunnan_simple, web_yunsi_week2: 旧式 PHP 站点类题。

  启动流程
  典型流程：

  python batch.py web_server 5
  python start.py ./ 5
  docker attach check_server
  python check.py

  实际逻辑：

  1. batch.py:87 读取靶机目录和队伍数。
  2. batch.py:100 清空 check_server/pass.txt 和根目录 pass.txt。
  3. batch.py:103 生成 flag_server/run.sh。
  4. batch.py:105 生成 flag_server/config.php，包括队伍数、token、IP 映射、计分 key。
  5. batch.py:107 生成 check_server/host.lists。
  6. batch.py:109 遍历每支队伍，复制靶机目录为 teamX。
  7. batch.py:120 生成每队容器内启动脚本。
  8. batch.py:123 生成每队 Docker 启动脚本。
  9. batch.py:126 生成队伍专属 flag.py，把默认 key 替换为该队密码。
  10. start.py:30 依次启动 team1..teamN，然后启动 checker 和 flag_server。

  队伍容器端口映射由 batch.py:37 生成：

  - Web 服务：宿主机 8800 + teamno -> 容器 my_port，默认 80。
  - SSH：宿主机 2200 + teamno -> 容器 22。
  - 容器名：teamX。
  - 默认镜像：web_14.04。

  核心 AWD 逻辑
  平台核心是三个闭环：

  1. 靶机初始化。
  2. flag 定时下发。
  3. flag 提交与计分。
  4. 服务可用性检测与计分。

  1. 靶机初始化
  batch.py:18 生成每队 run.sh：

  cd /var/www/html
  service ssh start
  a2enmod rewrite
  service apache2 start
  service mysql start
  python flag.py &
  useradd ctf
  echo ctf:<password> | chpasswd
  sleep 2
  mysql -uroot -proot < *.sql
  if [ -x "extra.sh" ]; then
  ./extra.sh
  fi
  /bin/bash

  关键点：

  - 每队都会启动 SSH、Apache、MySQL。
  - 每队启动一个本地 flag.py，监听 9999，用于接收 checker 下发的新 flag。
  - 自动创建 ctf 用户，密码写入根目录 pass.txt，并复制到 check_server/pass.txt。
  - 如果靶机目录有 SQL 文件，会执行 mysql -uroot -proot < *.sql。
  - 如果有 extra.sh，则执行额外启动逻辑，例如 FlaskBB、Beego、NodeCMS、Django 类服务。

  2. flag 下发
  flag 下发由 check_server/gen_flag.py 完成。

  核心位置：

  - check_server/gen_flag.py:7 使用端口 9999。
  - check_server/gen_flag.py:8 每 120 秒一轮。
  - check_server/gen_flag.py:12 读取 host.lists。
  - check_server/gen_flag.py:13 读取 pass.txt。
  - check_server/gen_flag.py:31 生成 flag。
  - check_server/gen_flag.py:33 请求队伍容器的 flag.py。
  - check_server/gen_flag.py:38 写入 flag_server/xxxxxxxx_flag。

  flag 生成公式：

  md5(password + host_ip + str(int(time.time()) / 120))

  这意味着每队每 120 秒有一个唯一 flag。

  checker 发给靶机的 URL 形如：

  http://172.17.0.X:9999/<team_password>/<flag>

  靶机侧 flag.py:20 监听 GET 请求：

  - flag.py:26 校验路径格式、key 和 32 位 flag。
  - flag.py:28 把 flag 写入容器内 /flag。
  - 攻击者拿到别人容器权限后，目标通常就是读取 /flag 并提交。

  3. flag 提交与攻击计分
  新规则入口是 flag_server/flag_file.php。

  提交格式：

  http://flag_server:8080/flag_file.php?token=team1&flag=<stolen_flag>

  核心逻辑：

  - flag_server/flag_file.php:47 检查 token 和 flag 参数。
  - flag_server/flag_file.php:51 校验 token 是否存在。
  - flag_server/flag_file.php:54 通过 flag 反查受害者 IP。
  - flag_server/flag_file.php:58 得到攻击者队伍 ID。
  - flag_server/flag_file.php:59 得到受害者队伍 ID。
  - flag_server/flag_file.php:60 禁止攻击自己。
  - flag_server/flag_file.php:66 攻击者 +2。
  - flag_server/flag_file.php:67 受害者 -2。
  - flag_server/flag_file.php:68 检查攻击频率。
  - flag_server/flag_file.php:70 记录攻击结果到 result.txt。
  - flag_server/flag_file.php:71 通过本地 curl 调用 score.php 写分。
  - flag_server/flag_file.php:73 更新时间戳。

  反查 flag 的逻辑在 flag_server/flag_file.php:33：

  $flags = explode("\n", file_get_contents($flag_file));
  foreach ($flags as $real_flag) {
      $tmp = explode(":", $real_flag);
      $host = $tmp[0];
      $real_flag = $tmp[1];
      if ($flag == $real_flag) {
          return $host;
      }
  }

  也就是说，xxxxxxxx_flag 是当前轮所有有效 flag 的数据库，格式是：

  172.17.0.2:<flag>
  172.17.0.3:<flag>
  ...

  频率限制：

  - flag_server/flag_file.php:14 使用二维矩阵下标 attack_uid * team_number + victim_uid。
  - flag_server/flag_file.php:15 同一攻击者对同一受害者 120 秒内只能有效提交一次。
  - 初始矩阵由 flag_server/new.py 生成，长度是 team_number * team_number。

  旧规则入口是 flag_server/flag.php，区别是它不提交具体 flag，而是根据请求来源 IP 判断受害者。新规则更合理，因为攻击者需要拿到对方当前 /
  flag。

  4. 分数写入
  分数统一由 flag_server/score.php 写入。

  逻辑：

  - 必须携带 $key。
  - 如果有 write=1&score=a|b|c，则把增量分数加到当前 score.txt。
  - 没有 write 时返回当前分数。

  初始化由 flag_server/new.py 完成：

  - flag_server/new.py:5 初始化 score.txt 为 0|0|...。
  - flag_server/new.py:6 初始化 time.txt 为攻击频率矩阵。
  - flag_server/new.py:7 清空 result.txt。

  5. 服务可用性检测
  默认 checker 在 check_server/check.py。

  核心位置：

  - check_server/check.py:9 检测周期 120 秒。
  - check_server/check.py:20 flag_server 地址写死为 172.17.0.1。
  - check_server/check.py:22 读取 host.lists。
  - check_server/check.py:53 读取当前分数。
  - check_server/check.py:67 写入一轮服务检测分数。
  - check_server/check.py:131 执行单台主机检查。
  - check_server/check.py:147 进入无限轮询。
  - check_server/check.py:155 服务正常 +1。
  - check_server/check.py:160 服务异常 -1。
  - check_server/check.py:162 写入 flag_server。

  默认 checker 检测点明显是针对某个特定题目的：

  - check_server/check.py:80 检查 /web/ 包含 网校课程。
  - check_server/check.py:89 检查 /web/teacher 包含 teacher。
  - check_server/check.py:98 检查 /web/register?goto=/web/teacher 包含 邮箱地址。

  其他题目的 checker 模板放在 check_server/check_scripts，例如 1.py、a.py、check_game_1.py 等，需要根据实际靶机替换主 checker。

  比赛数据流
  简化链路：

  batch.py
    -> team1..teamN
    -> teamX/run.sh
    -> teamX/docker.sh
    -> teamX/flag.py
    -> check_server/host.lists
    -> check_server/pass.txt
    -> flag_server/config.php

  start.py
    -> 启动 team 容器
    -> 启动 check_server
    -> 启动 flag_server

  check_server/gen_flag.py
    -> 每 120 秒生成 flag
    -> GET teamX:9999/<password>/<flag>
    -> teamX/flag.py 写入 /flag
    -> flag_server/xxxxxxxx_flag 记录 IP:flag

  攻击者
    -> 读到其他队 /flag
    -> GET flag_server/flag_file.php?token=teamX&flag=...

  flag_server/flag_file.php
    -> 校验 token
    -> 通过 flag 匹配受害者 IP
    -> 攻击者 +2，受害者 -2
    -> 写 result.txt
    -> 调 score.php 更新 score.txt

  check_server/check.py
    -> 每 120 秒访问每队服务
    -> 正常 +1，异常 -1
    -> 调 score.php 更新 score.txt

  关键问题
  这个项目能跑通 AWD 基本流程，但实现比较老，风险和维护点很多：

  - Python2 代码为主，print、httplib、SimpleHTTPServer 都是 Python2 时代写法。
  - 大量 os.system 拼接命令，例如 batch.py:10、batch.py:117、start.py:27，参数没有转义。
  - stop_clean.py 会停止并删除所有 Docker 容器，不只删除本项目创建的容器，风险很高。
  - flag_server 的 $key 写死在生成的配置里，checker 和 flag_server 都依赖同一个硬编码 key。
  - Docker 网络 IP 假设固定为 172.17.0.2..，如果 Docker 默认网桥上已有其他容器，映射会错。
  - check_server/check.py:20 的 flag_server = '172.17.0.1' 与文档/部分脚本里的 172.17.0.6、172.17.0.3 不统一，实际部署容易踩坑。
  - checker 默认没有自动运行服务检测，当前 check_server/run.sh 只启动 gen_flag.py，check.py 被注释，需要手动 docker attach check_server 后
    执行。
  - flag_server/flag_file.php:36 对空行没有健壮处理，explode(':', '') 后直接访问 $tmp[1] 可能触发 notice。
  - 分数写入没有文件锁，checker 和 flag 提交并发写 score.txt 时可能丢分。
  - 所有题目源码、依赖、虚拟环境混在仓库里，体积大，检索和维护成本高。

  最核心文件
  如果后续要改造或调试，优先看这些：

  - batch.py: 初始化和队伍容器生成。
  - start.py: 启动顺序。
  - flag.py: 队伍容器内 flag 接收器。
  - check_server/gen_flag.py: flag 轮换。
  - check_server/check.py: 服务可用性检测。
  - flag_server/flag_file.php: 新规则 flag 提交。
  - flag_server/flag.php: 旧规则提交。
  - flag_server/score.php: 分数读写。
  - flag_server/config.php: 队伍、token、IP、key、时间间隔配置。
