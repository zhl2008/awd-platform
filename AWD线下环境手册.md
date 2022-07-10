# AWD线下环境启动说明

by Hence Zhang @Lancet



###比赛的环境介绍：ws



服务器全部以docker形式部署在同一台虚拟机上。

Check_server:

服务检查服务器，用于判定选手维护的服务是否可用，如果不可用，则会扣除相应的分数。不开启任何端口。需要与flag服务器通信。

Flag_server:

选手提交flag的服务器，并存储选手的分数。开启80端口。

Web_server:

选手连接的服务器，选手需要对其进行维护，并尝试攻击其他队伍的机器。通常开启80端口，22端口，并将端口映射到主机。

**比赛逻辑拓扑：**

![比赛入口服务器](/Users/haozigege/Desktop/ctf/awd-platform/比赛入口服务器.png)







### 比赛启动

1.根据当前队伍数量copy所有的队伍的比赛文件夹:   python batch.py   web_dir team_number

​	for example: python batch.py  web_server 5

2.启动比赛：python start.py ./  team_number

​	for example: python start.py ./ 5

3.启动check脚本：

​	docker attach check_server 

​	python check.py



### 比赛参数

Flag 提交： 172.17.0.6:80/flag_file.php?token=teamx&flag=xxxx (x为你们的队伍号)





### 比赛规则(新）：

1.每个队伍分配到一个docker主机，给定ctf用户权限，通过制定的端口和密码进行连接；

2.每台docker主机上运行一个web服务或者其他的服务，需要选手保证其可用性，并尝试审计代码，攻击其他队伍；

3.比赛开始后，**前30分钟**，选手维护各自的主机，在这个阶段，所有的攻击和服务不可用不影响分数；

4.选手可以通过使用漏洞获取其他队伍的服务器的权限，读取他人服务器上的flag并提交到指定的flag服务器：

http://flag服务器IP:端口/fflag_file.php?token=队伍token&flag=获取到的flag   来获得相应的分数。

例如：flag server地址为8.8.8.8，端口为8080，队伍token为team1，flag为40ed892b93997142e46124516d0f5ac0，则请求http://8.8.8.8:8080/fflag_file.php?token=team1&flag=40ed892b93997142e46124516d0f5ac0来获得相应分数。

每次成功攻击可获得**2**分，<u>被攻击者扣除2分</u>；**有效攻击两分钟一轮**；

5.选手需要保证己方服务的可用性，每次服务不可用，扣除1分,<u>服务可用，加1分</u>；**服务检测两分钟一轮**；

6.选手可以从flag服务器上获取所有的攻击情况以及当前的分数：

攻击情况url地址：http://flag服务器IP:端口/result.txt

得分情况地址：http://flag服务器IP:端口/score.txt

7.**不允许使用任何形式的DOS攻击**





### 比赛规则(旧）：

1.每个队伍分配到一个docker主机，给定ctf用户权限，通过制定的端口和密码进行连接；

2.每台docker主机上运行一个web服务或者其他的服务，需要选手保证其可用性，并尝试审计代码，攻击其他队伍；

3.比赛开始后，**前30分钟**，选手维护各自的主机，在这个阶段，所有的攻击和服务不可用不影响分数；

4.选手可以通过使用漏洞获取其他队伍的服务器的权限，并在**他人服务器**上请求如下地址：

http://flag服务器IP:端口/flag.php?token=队伍token来获得相应的分数。

例如：flag server地址为8.8.8.8，端口为8080，队伍token为team1，则请求http://8.8.8.8:8080/flag.php?token=team1来获得相应分数。

每次成功攻击可获得**2**分，<u>被攻击者扣除2分</u>；**有效攻击两分钟一轮**；

5.选手需要保证己方服务的可用性，每次服务不可用，扣除1分,<u>服务可用，加1分</u>；**服务检测两分钟一轮**；

6.选手可以从flag服务器上获取所有的攻击情况以及当前的分数：

攻击情况url地址：http://flag服务器IP:端口/result.txt

得分情况地址：http://flag服务器IP:端口/score.txt

7.**不允许使用任何形式的DOS攻击**

















