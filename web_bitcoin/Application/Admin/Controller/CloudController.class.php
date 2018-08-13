<?php
namespace Admin\Controller;

class CloudController extends AdminController
{
    public function index()
    {
        redirect("/Admin/Cloud/theme.html");
        exit;
        //$this->checkUpdata();
        $this->display();
    }

    public function update()
    {
        $versionModel = D('Version');
        //$versionModel->refreshVersions();
        $version = $versionModel->order('number desc')->select();
        $currentVersion = $versionModel->getCurrentVersion();

        foreach ($version as $key => $vo) {
            $versionCompare = version_compare($currentVersion['name'], $vo['name']);

            if (-1 < $versionCompare) {
                if ($versionCompare == 0) {
                    $version[$key]['class'] = 'active';
                    $version[$key]['word'] = '当前版本';
                }
                else {
                    $version[$key]['class'] = 'default';
                    $version[$key]['word'] = '历史版本';
                }
            }
            else {
                $version[$key]['class'] = 'success';
                $version[$key]['word'] = '未来版本';
            }
        }

        $this->assign('currentVersion', $currentVersion['name']);
        $this->assign('version', $version);
        $this->display();
    }

    public function game()
    {
        
 		//D('Version')->getGame();
        $where = array();
        $count = M('VersionGame')->where($where)->count();
		
		$Page = new \Think\Page($count, 15);
        $show = $Page->show();
        $list = M('VersionGame')->where($where)->order('id asc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
       
		$this->assign('list', $list);
        $this->assign('page', $show); 

        $this->display();
    }

    public function gameInstall($id = NULL)
    {
        die();
		if (APP_DEMO) {
            $this->error('测试站暂时不能修改！');
        }

        if (empty($id)) {
            $this->error('参数错误');
        }

        $game = M('VersionGame')->where(array('id' => $id))->find();

        if (!$game) {
            $this->error('应用不存在');
        }

        $name = ucwords($game['name']);

        if (!$name) {
            $this->error('安装错误1');
        }

        if (!file_exists(APP_PATH . '/Home/Controller/' . $name . 'Controller.class.php')) {
            $this->error('安装失败，没有应用');
        }

        $AA = A('Home/' . $name);
        $rs = $AA->install();

        if (is_array($rs)) {
            $this->error($rs[1]);
        }

        if ($rs) {
            if (M('VersionGame')->where(array('id' => $id))->save(array('status' => 1))) {
                $this->success('安装成功');
            }
            else {
                $this->error('安装失败');
            }
        }
        else {
            $this->error('安装失败，没有授权');
        }
    }

    public function gameUninstall($id = NULL)
    {
        if (APP_DEMO) {
            $this->error('测试站暂时不能修改！');
        }

        if (session('admin_id') != 1) {
            $this->error('您不是超级管理员,不能操作');
        }

        if (empty($id)) {
            $this->error('参数错误');
        }

        $game = M('VersionGame')->where(array('id' => $id))->find();

        if (!$game) {
            $this->error('应用不存在');
        }

        $name = ucwords($game['name']);

        if (!$name) {
            $this->error('卸载错误1');
        }

        $AA = A('Home/' . $name);
        $rs = $AA->uninstall();

        if ($rs) {
            if (M('VersionGame')->where(array('id' => $id))->save(array('status' => 0))) {
                $this->success('卸载成功');
            }
            else {
                $this->error('卸载失败1');
            }
        }
        else {
            $this->error('卸载失败');
        }
    }

    public function kefu()
    {
        $dir = APP_PATH . 'Home/View/Kefu/';
        $fileArr = array();

        if (is_readable($dir)) {
            $file = scandir($dir);

            if ($file) {
                foreach ($file as $k => $v) {
                    if (($v != '.') && ($v != '..')) {
                        $fileArr[$v] = 1;
                    }

                    if (file_get_contents($dir . '/' . $v . '/index.ini')) {
                        $mianfei[$v] = file_get_contents($dir . '/' . $v . '/index.ini');
                    }
                    else {
                        $mianfei[$v] = '';
                    }
                }
            }
        }

        $DbFields = M('Config')->getDbFields();

        if (!in_array('kefu', $DbFields)) {
            M()->execute('ALTER TABLE `movesay_config` ADD COLUMN `kefu` VARCHAR(200)  NOT NULL   COMMENT \'\' AFTER `id`;');
        }

        $this->assign('fileArr', $fileArr);
        $this->assign('mianfei', $mianfei);
        $this->display();
    }

    public function kefuUp($kefu = NULL)
    {
        if (APP_DEMO) {
            $this->error('测试站暂时不能修改！');
        }

        if (session('admin_id') != 1) {
            $this->error('您不是超级管理员,不能操作');
        }

        if (empty($kefu)) {
            $this->error('参数错误');
        }

        if (!check($kefu, 'w')) {
            $this->error('参数格式错误');
        }

        if (M('Config')->where(array('id' => 1))->save(array('kefu' => $kefu))) {
            $this->success('操作成功');
        }
        else {
            $this->error('操作失败');
        }
    }

    public function theme()
    {
        $dir = APP_PATH . 'Home/View/Index/';
        $fileArr = array();

        if (is_readable($dir)) {
            $file = scandir($dir);

            if ($file) {
                foreach ($file as $k => $v) {
                    if (($v != '.') && ($v != '..')) {
                        $fileArr[$v] = 1;

                        if (file_get_contents($dir . '/' . $v . '/index.ini')) {
                            $mianfei[$v] = file_get_contents($dir . '/' . $v . '/index.ini');
                        }
                        else {
                            $mianfei[$v] = '';
                        }
                    }
                }
            }
        }

        $DbFields = M('Config')->getDbFields();

        if (!in_array('index_html', $DbFields)) {
            M()->execute('ALTER TABLE `movesay_config` ADD COLUMN `index_html` VARCHAR(200)  NOT NULL   COMMENT \'\' AFTER `id`;');
        }

        $this->assign('fileArr', $fileArr);
        $this->assign('mianfei', $mianfei);
        $this->display();
    }

    public function themeUp($theme = NULL)
    {
        if (APP_DEMO) {
            $this->error('测试站暂时不能修改！');
        }

        if (session('admin_id') != 1) {
            $this->error('您不是超级管理员,不能操作');
        }

        if (empty($theme)) {
            $this->error('参数错误');
        }

        if (!check($theme, 'w')) {
            $this->error('参数格式错误');
        }

        if (M('Config')->where(array('id' => 1))->save(array('index_html' => $theme))) {
            $this->success('操作成功');
        }
        else {
            $this->error('操作失败');
        }
    }

    public function addons()
    {
    }

    private function disableCheckUpdate()
    {
        $this->assign('update', false);
    }

    public function getFileList()
    {
        if (session('admin_id') != 1) {
            $this->error('您不是超级管理员,不能操作');
        }

        $aVersion = I('get.version');

        if ($aVersion == '') {
            $this->error('升级失败，请确认版本。');
        }

        $cloudUrl = C('__CLOUD__');

        foreach ($cloudUrl as $k => $v) {
            if (getUrl($v . '/Auth/text') == 1) {
                $authUrl = $v;
                break;
            }
        }

        $daoqi = getUrl($authUrl . '/Auth/shouhou?mscode=' . MSCODE);

        if ($daoqi) {
            if (false) {
                $this->error('升级失败，你的售后已经到期请联系续费。');
                exit();
            }
        }

        $versionModel = D('Version');
        $nextVersion = $versionModel->getNextVersion();

        if ($aVersion != $nextVersion['name']) {
            $this->error('此版本不允许直接跳过当前版本升级，请不要跳过中间版本。', U('Cloud/update'));
        }

        $this->assign('path', C('UPDATE_PATH') . $nextVersion['name']);
        $currentVersion = $versionModel->getCurrentVersion();
        $this->assign('currentVersion', $currentVersion);
        $this->assign('nextVersion', $nextVersion);
        $this->disableCheckUpdate();
        $this->display();
        set_time_limit(0);
        $old_file_path = C('UPDATE_PATH') . $nextVersion['name'] . '/old';
        $new_file_path = C('UPDATE_PATH') . $nextVersion['name'] . '/new';

        if (!$this->createFolder($old_file_path)) {
            $this->write('创建目录失败' . $old_file_path . '请检查权限。', 'danger');
            return NULL;
        }

        if (!$this->createFolder($new_file_path)) {
            $this->write('创建目录失败' . $new_file_path . '请检查权限。', 'danger');
            return NULL;
        }

        $this->writeMessage('开始下载升级文件包。<br/>');
        $this->downloadFile($nextVersion['url'], C('UPDATE_PATH') . $nextVersion['name'] . '/new.zip');
        $this->unzipFile(C('UPDATE_PATH') . $nextVersion['name'] . '/new.zip', $new_file_path);
        $files = $this->treeDirectory($new_file_path, $new_file_path);

        foreach ($files as $v) {
            $this->writeFile($v);
        }

        $this->writeScript('enable()');
        $_SESSION['nextVersion'] = $nextVersion;
        $_SESSION['currentVersion'] = $currentVersion;
    }

    public function compare()
    {
        $this->assignVersionInfo();
        $old_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'] . '/old';
        $new_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'] . '/new';
        $compared_with_old = $this->diff($old_file_path);
        $compared_with_new = $this->diff($new_file_path);
        $compared = $compared_with_old + $compared_with_new;
        $this->assign('path', C('UPDATE_PATH') . $_SESSION['currentVersion']['name']);
        $this->assign('compared', $compared);
        $this->disableCheckUpdate();
        $this->display();
        $this->enable = 1;

        foreach ($compared as $key => $v) {
            $this->writeFile('            ' . $this->convert($key, $v));
        }

        if ($this->enable) {
            $this->writeScript('enable()');
        }
    }

    public function cover()
    {
        $this->assignVersionInfo();
        $old_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'] . '/old';
        $new_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'] . '/new';
        $sub = date('Ymd-His');
        $backup_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'] . '/backup/' . $sub;
        $this->assign('backup_path', $backup_path);
        $need_back = $this->treeDirectory($new_file_path, $new_file_path);
        $this->disableCheckUpdate();
        $this->display();
        $this->createFolder($backup_path);

        if (!file_exists($backup_path)) {
            $this->write(L('_BACKUP_CREATE_FAIL_PARAM_', array('file' => $backup_path, 'file_cloud' => C('CLOUD_PATH'))) . L('_PERIOD_'), 'danger');
            exit();
        }
        else {
            $this->write('创建备份文件夹' . $backup_path . '成功', 'success');
        }

        foreach ($need_back as $v) {
            $current_file = text($v);

            if ($current_file == '/update.sql') {
                continue;
            }

            $from = realpath('.' . $current_file);
            $des = realpath(str_replace('./', '', $backup_path)) . str_replace('/', DIRECTORY_SEPARATOR, $current_file);
            $des_dir = substr($des, 0, strrpos($des, DIRECTORY_SEPARATOR));
            $this->createFolder($des_dir);

            if (copy($from, $des)) {
                chmod($des, 511);
                $this->write(str_replace('\\', '\\\\', '备份文件' . $current_file . '<br>到目录/' . str_replace('./', '', $backup_path) . $current_file . '……成功'), 'success');
            }
            else {
                $this->write(str_replace('\\', '\\\\', '备份文件' . $current_file . '<br>到目录/' . str_replace('./', '', $backup_path) . $current_file . '……失败，自动更新终止'), 'danger');
            }
        }

        $this->write('文件全部备份完成。');

        foreach ($need_back as $v) {
            $from = realpath($new_file_path . text($v));
            $des = realpath('.' . str_replace('/', DIRECTORY_SEPARATOR, text($v)));

            if (!$des) {
                $des = str_replace('/', DIRECTORY_SEPARATOR, dirname(realpath('./index.php')) . text($v));
            }

            $des_dir = substr($des, 0, strrpos($des, DIRECTORY_SEPARATOR));

            if (!is_dir($des_dir)) {
                $this->createFolder($des_dir);
            }

            if (file_exists($des)) {
                unlink($des);
            }

            if (copy($from, $des)) {
                chmod($des, 511);
                $this->writeFile(str_replace('\\', '\\\\', '覆盖文件' . $des) . '……成功');
            }
            else {
                $this->writeFile(str_replace('\\', '\\\\', '覆盖文件' . $des) . '……失败');
            }
        }

        $this->write('文件全部覆盖完成。');
        $this->writeScript('enable()');
    }

    public function updb()
    {
        $new_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'];
        $sql_path = $new_file_path . '/new/update.sql';
        $sql = file_get_contents($sql_path);

        if (IS_POST) {
            if (!file_exists($sql_path)) {
                $this->error(L('_DATABASE_UPGRADE_SCRIPT_DOES_NOT_EXIST_'));
            }
            else {
                $result = D('')->executeSqlFile($sql_path);

                if ($result) {
                    $this->success(L('_SCRIPT_UPGRADE_SUCCESS_'));
                }
                else {
                    $this->error(L('_SCRIPT_UPGRADE_FAILED_'));
                }
            }
        }
        else {
            $this->assignVersionInfo();
            $this->assign('path', $new_file_path);

            if (file_exists($sql_path)) {
                $this->assign('sql', $sql);
            }

            $this->disableCheckUpdate();
            $this->display();
        }
    }

    public function finish()
    {
        $nextVersion = $_SESSION['nextVersion'];
        $currentVersion = $_SESSION['currentVersion'];
        $versionModel = D('Version');
        $versionModel->where(array('name' => $nextVersion['name']))->setField('update_time', time());
        $versionModel->setCurrentVersion($nextVersion['name']);
        $this->assign('currentVersion', $versionModel->getCurrentVersion());
        $new_file_path = C('UPDATE_PATH') . $_SESSION['nextVersion']['name'];
        $this->assign('path', $new_file_path);
        $this->disableCheckUpdate();
        $versionModel->cleanCheckUpdateCache();
        clean_cache();
        $this->display();
    }

    private function createFolder($dir, $mode = 511)
    {
        if (is_dir($dir) || @(mkdir($dir, $mode))) {
            return true;
        }

        if (!$this->createFolder(dirname($dir), $mode)) {
            return false;
        }

        return @(mkdir($dir, $mode));
    }

    private function convert($file, $v)
    {
        $html = '<tr><td>' . $file . '</td><td>';

        switch ($v[0]) {
            case 'add':
                $html .= '<span class="text-warning"> <i class="icon-plus"></i> ' . '新增，新版本新增的文件' . '</span>';
                break;

            case 'modified':
                $html .= '<span class="text-danger" ><i class="icon-warning-sign"></i> ' . '修改，二次开发修改！' . '</span>';
                break;

            case 'ok':
                $html .= '<span class="text-success"><i class="icon-check"></i> ' . 'OK，和原版一样，通过' . '</span>';
                break;

            case 'db':
                $html .= '<span class="text-info"><i class="icon-cube"></i> ' . '数据库引导文件，通过' . '</span>';
                break;

            case 'guide':
                $html .= '<span class="text-info"><i class="icon-cube"></i>' . '引导脚本，通过' . '</span>';
                break;

            case 'info':
                $html .= '<span class="text-info"><i class="icon-cube"></i> ' . '版本信息文件，通过' . '</span>';
        }

        $html .= '</td><td>';

        if ($v[1]) {
            $html .= '<span class="text-success"><i class="icon-check"></i> ' . '文件写入权限检测通过' . '</span>';
        }
        else {
            $html .= '<span class="text-danger"><i class="icon-warning-sign"></i>' . '文件不具备写入权限，请在赋予该文件写入权限！' . '</span>';
            $this->enable = 0;
        }

        $html .= '</td></tr>';
        return $html;
    }

    private function diff($path, $root = './', $ext_file = array(
        '/update.sql' => array('db', 1),
        '/update.php' => array('guide', 1)
    ))
    {
        $files = $this->treeDirectory($path, $path);
        $result = array();

        foreach ($files as $v) {
            $local_path = str_replace('//', '/', $root . text($v));
            $is_ext = false;

            foreach ($ext_file as $key => $ext) {
                if ($local_path == str_replace('//', '/', $root . $key)) {
                    $result[$v] = $ext;
                    $is_ext = true;
                    continue;
                }
            }

            chmod($path . text($v), 511);
            chmod($local_path, 511);

            if ($is_ext) {
                continue;
            }

            $md5_source = md5_file($path . text($v));
            $md5_local = md5_file($local_path);

            if (!$md5_local) {
                $result[$v] = array('add', 1);
            }
            else if ($md5_source != $md5_local) {
                $result[$v] = array('modified', is_writable($local_path));
            }
            else {
                $result[$v] = array('ok', is_writable($local_path));
            }
        }

        return $result;
    }

    private function getChmod($filepath)
    {
        return substr(base_convert(@(fileperms($filepath)), 10, 8), -4);
    }

    private function treeDirectory($dir, $root)
    {
        $files = array();
        $dirpath = $dir;
        $filenames = scandir($dir);

        foreach ($filenames as $filename) {
            if (($filename == '.') || ($filename == '..')) {
                continue;
            }

            $file = $dirpath . DIRECTORY_SEPARATOR . $filename;

            if (is_dir($file)) {
                $files = array_merge($files, $this->treeDirectory($file, $root));
            }
            else {
                $files[] = str_replace($root, '', str_replace('\\', '/', $dir . DIRECTORY_SEPARATOR . '<span class=text-success>' . $filename . '</span>'));
            }
        }

        return $files;
    }

    public function version($ajax = 'json')
    {
        $aName = I('get.name');
        $versionModel = D('Version');
        $version = $versionModel->where(array('name' => $aName))->find();
        $data = nl2br($version['log']);

        if ($ajax) {
            exit(json_encode($data));
        }
        else {
            return $data;
        }
    }

    private function assignUpdatingGoods($goods)
    {
        $cloudModel = D('Admin/Cloud');

        switch ($goods['entity']) {
            case 1:
                break;

            case 2:
                $goodsInfo = D('Common/Module')->getModule($goods['etitle']);
                $goodsInfo = $cloudModel->getVersionInfo($goodsInfo);
                break;

            case 3:
                $goodsInfo = D('Common/Theme')->getTheme($goods['etitle']);
                $goodsInfo = $cloudModel->getVersionInfo($goodsInfo);
        }

        $this->assign('goodsInfo', $goodsInfo);
        return $goodsInfo;
    }

    public function updateGoods()
    {
        $aToken = I('get.token', '', 'text');
        $cloudModel = D('Admin/Cloud');
        $version = $cloudModel->getVersion($aToken);

        if (!$version) {
            $this->error(L('_EXPAND_NOT_EXIST_') . L('_PERIOD_'));
        }

        $versionList = D('Admin/Cloud')->getUpdateList($aToken);
        $this->assign('versionList', $versionList);
        $this->assign('token', $aToken);
        $this->assign('version', $version);
        $_SESSION['version'] = $version;
        $_SESSION['versionList'] = $versionList;
        $_SESSION['token'] = $aToken;
        $this->assignUpdatingGoods($version['goods']);
        $this->meta_title = L('_EXTENDED_AUTO_UPGRADE_');
        $this->display();
    }

    public function updating1()
    {
        $version = $_SESSION['version'];
        $versionList = array_reverse($_SESSION['versionList']);
        $token = $_SESSION['token'];
        $this->assign('version', $version);
        $this->assign('versionList', $versionList);

        if (empty($version)) {
            $this->error(L('_THE_CURRENT_VERSION_OF_THE_INFORMATION_ACQUISITION_FAILS_'));
        }

        if (empty($versionList)) {
            $this->error(L('_NO_NEW_VERSION_IS_DETECTED_'));
        }

        $this->assignUpdatingGoods($version['goods']);
        $path = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/' . $version['goods']['etitle'] . '/' . $versionList[0]['title'];
        $pathOld = $path . '/old';
        $pathNew = $path . '/new';
        $this->assign('path', $path);
        $this->meta_title = L('_UPDATE_FILE_EXPAND_');
        $this->display();
        set_time_limit(0);

        if (!$this->createFolder($pathOld)) {
            $this->write(L('_FAIL_CREATE_ORIGIN_FOLD_') . $pathOld, 'danger');
            return NULL;
        }

        if (!$this->createFolder($pathNew)) {
            $this->write(L('_FAIL_CREATE_ORIGIN_FOLD_') . $pathNew, 'danger');
            return NULL;
        }

        $this->write(L('_START_TO_DOWNLOAD_THE_ORIGINAL_') . $version['title'] . L('_FILE_'), 'info');
        $this->downloadFile(appstoreU('Appstore/Install/download', array('token' => $_SESSION['token'], 'type' => 'current')), $path . '/old.zip');
        $this->write(L('_START_DOWNLOADING_THE_NEW_VERSION_') . $versionList[0]['title'] . L('_FILE_'), 'info');
        $this->downloadFile(appstoreU('Appstore/Install/download', array('token' => $_SESSION['token'], 'type' => 'next')), $path . '/new.zip');
        $this->unzipFile($path . '/old.zip', $pathOld);
        $this->unzipFile($path . '/new.zip', $pathNew);
        $files = $this->treeDirectory($pathNew, $pathNew);

        foreach ($files as $v) {
            $this->writeFile($v);
        }

        $this->writeScript('enable()');
    }

    public function updating2()
    {
        $version = $_SESSION['version'];
        $versionList = array_reverse($_SESSION['versionList']);
        $token = $_SESSION['token'];
        $this->assign('version', $version);
        $this->assign('versionList', $versionList);

        if (empty($version)) {
            $this->error(L('_THE_CURRENT_VERSION_OF_THE_INFORMATION_ACQUISITION_FAILS_'));
        }

        if (empty($versionList)) {
            $this->error(L('_NO_NEW_VERSION_IS_DETECTED_'));
        }

        $this->assignUpdatingGoods($version['goods']);
        $this->meta_title = L('_UPDATE_LOCAL_EXPAND_');
        $path = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/' . $version['goods']['etitle'] . '/' . $versionList[0]['title'];
        $pathOld = $path . '/old';
        $pathNew = $path . '/new';
        $old_file_path = $pathOld;
        $new_file_path = $pathNew;
        $compared_with_old = $this->diff($old_file_path, $this->switchDir($version['goods']['entity']), array(
            $version['goods']['etitle'] . '/update.sql' => array('db', 1)
        ));
        $compared_with_new = $this->diff($new_file_path, $this->switchDir($version['goods']['entity']), array(
            $version['goods']['etitle'] . '/update.sql' => array('db', 1)
        ));
        $compared = $compared_with_old + $compared_with_new;
        $this->assign('path', $path);
        $this->assign('compared', $compared);
        $this->disableCheckUpdate();
        $this->display();
        $this->enable = 1;

        foreach ($compared as $key => $v) {
            $this->writeFile('            ' . $this->convert($key, $v));
        }

        if ($this->enable) {
            $this->writeScript('enable()');
        }
    }

    public function updating3()
    {
        $version = $_SESSION['version'];
        $versionList = array_reverse($_SESSION['versionList']);
        $token = $_SESSION['token'];
        $this->assign('version', $version);
        $this->assign('versionList', $versionList);

        if (empty($version)) {
            $this->error('当前版本信息获取失败，请从扩展更新列表进入本页面。');
        }

        if (empty($versionList)) {
            $this->error('当前没有检测到新版本，请稍后重试。');
        }

        $this->assignUpdatingGoods($version['goods']);
        $this->meta_title = '扩展自动升级-升级代码';
        $path = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/' . $version['goods']['etitle'] . '/' . $versionList[0]['title'];
        $pathOld = $path . '/old';
        $pathNew = $path . '/new';
        $old_file_path = $pathOld;
        $new_file_path = $pathNew;
        $sub = date('Ymd-His');
        $backup_path = $path . '/backup/' . $sub;
        $this->assign('backup_path', $path);
        $need_back = $this->treeDirectory($new_file_path, $new_file_path);
        $this->disableCheckUpdate();
        $this->display();
        @(mkdir($path . '/backup'));
        @(mkdir($backup_path));

        if (!file_exists($backup_path)) {
            $this->write('备份文件夹' . $backup_path . '创建失败，请检查文件夹权限。请确保文件夹' . C('CLOUD_PATH') . '具备写入权限。升级暂时中止，请赋予权限后再次刷新本页面', 'danger');
            exit();
        }
        else {
            $this->write('创建备份文件夹' . $backup_path . '成功', 'success');
        }

        foreach ($need_back as $v) {
            if (text($v) == '') {
                continue;
            }

            $from = realpath($this->switchDir($version['goods']['entity']) . '/' . text($v));
            $des = realpath(str_replace('./', '', $backup_path)) . str_replace('/', DIRECTORY_SEPARATOR, text($v));
            $des_dir = substr($des, 0, strrpos($des, DIRECTORY_SEPARATOR));
            $this->createFolder($des_dir);
            copy($from, $des);

            if (file_exists($des) === false) {
                $this->write('备份文件到文件' . str_replace('./', '', $backup_path) . text($v) . '失败，请检查文件夹权限。', 'danger');
            }
            else {
                $this->write(str_replace(array('\\', '//'), array('\\\\', '/'), '备份文件' . $this->switchDir($version['goods']['entity']) . text($v) . '到' . str_replace('./', '', $backup_path) . text($v) . '……成功'), 'success');
            }
        }

        $this->write('文件全部备份完成。');

        foreach ($need_back as $v) {
            $from = realpath($new_file_path . text($v));
            $des = str_replace(array('/', '.' . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR), array(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), dirname(realpath('./index.php')) . $this->switchDir($version['goods']['entity']) . text($v));
            $des_dir = substr($des, 0, strrpos($des, DIRECTORY_SEPARATOR));

            if (!is_dir($des_dir)) {
                $this->createFolder($des_dir);
            }

            if (file_exists($des)) {
                unlink($des);
            }

            if (copy($from, $des)) {
                chmod($des, 511);
                $this->writeFile(str_replace('\\', '\\\\', '覆盖文件' . $des) . '……成功');
            }
            else {
                $this->writeFile(str_replace('\\', '\\\\', '覆盖文件' . $des) . '……失败');
            }
        }

        $this->write(L('_FILE_FULL_COVERAGE_'));
        $this->writeScript('enable()');
    }

    public function updating4()
    {
        $version = $_SESSION['version'];
        $versionList = array_reverse($_SESSION['versionList']);
        $token = $_SESSION['token'];
        $this->assignUpdatingGoods($version['goods']);
        $path = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/' . $version['goods']['etitle'] . '/' . $versionList[0]['title'];
        $pathOld = $path . '/old';
        $pathNew = $path . '/new' . '/' . $version['goods']['etitle'] . '/';
        $sql_path = $pathNew . '/update.sql';

        if (IS_POST) {
            if (!file_exists($sql_path)) {
                $this->error(L('_DATABASE_UPGRADE_SCRIPT_DOES_NOT_EXIST_'));
            }
            else {
                $result = D('')->executeSqlFile($sql_path);

                if ($result === true) {
                    $this->success(L('_SCRIPT_UPGRADE_SUCCESS_'));
                }
                else {
                    $this->error(L('_SCRIPT_UPGRADE_FAILED_'));
                }
            }
        }

        $this->assign('version', $version);
        $this->assign('versionList', $versionList);

        if (empty($version)) {
            $this->error(L('_THE_CURRENT_VERSION_OF_THE_INFORMATION_ACQUISITION_FAILS_'));
        }

        if (empty($versionList)) {
            $this->error(L('_NO_NEW_VERSION_IS_DETECTED_'));
        }

        $this->assign('path', $pathNew);

        if (file_exists($sql_path)) {
            $this->assign('sql', file_get_contents($pathNew . '/update.sql'));
        }

        $this->display();
    }

    public function updating5()
    {
        $version = $_SESSION['version'];
        $versionList = array_reverse($_SESSION['versionList']);
        $this->assign('version', $version);
        $this->assign('versionList', $versionList);
        $newToken = $versionList[0]['token']['token'];

        switch ($version['goods']['entity']) {
            case 1:
                break;

            case 2:
                $moduleModel = D('Common/Module');
                $moduleModel->setToken($version['goods']['etitle'], $newToken);
                $moduleModel->reloadModule($version['goods']['etitle']);
                $_SESSION['version'] = $versionList[0];
                $this->cleanModuleListCache();
                break;

            case 3:
                $themeModel = D('Common/Theme');
                $themeModel->setToken($version['goods']['etitle'], $newToken);
                $_SESSION['version'] = $versionList[0];
                $this->cleanThemeListCache();
        }

        $this->assignUpdatingGoods($version['goods']);
        $path = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/' . $version['goods']['etitle'] . '/' . $versionList[0]['title'];
        $this->assign('token', $newToken);
        $this->assign('path', $path);
        $this->display();
    }

    private function cleanModuleListCache()
    {
        S('admin_modules', null);
    }

    private function cleanThemeListCache()
    {
        S('admin_themes', null);
    }

    public function install()
    {
        $aToken = I('post.token', '', 'text');
        $aCookie = I('post.cookie', '', 'text');
        $_SESSION['cloud_cookie'] = $aCookie;
        $this->display();
        set_time_limit(0);
        $this->write(L('_INSTALL_AUTO_START_'), 'info');
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_LINK_REMOTE_SERVER_'), 'info');
        $data = $this->curl(appstoreU('Appstore/Install/getVersion', array('token' => $aToken)));

        if ($data === 'false') {
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_LOGIN_SERVER_VERIFY_EXIT_'), 'danger');
            return NULL;
        }

        $data = json_decode($data, true);

        if (!$data['status']) {
            $this->write(L('_RETURN_RESULT_FROM_SERER_FAIL_') . $data['info'], 'danger');
        }

        $version = $data['version'];

        switch ($version['goods']['entity']) {
            case 1:
                $this->installPlugin($version, $aToken);
                break;

            case 2:
                $this->installModule($version, $aToken);
                break;

            case 3:
                $this->installTheme($version, $aToken);
        }
    }

    private function installPlugin($version, $token)
    {
        $plugin['name'] = $version['goods']['etitle'];
        $plugin['alias'] = $version['goods']['title'];
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_INSTALLING_PARAM_', array('object' => '插件')) . '【' . $plugin['alias'] . '】【' . $plugin['name'] . '】');

        if (file_exists(ONETHINK_ADDON_PATH . '/' . $plugin['name'])) {
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_OBJECT_SAME_EXIST_PARAM_', array('object' => '插件')), 'danger');
            $this->goBack();
            return NULL;
        }

        $localPath = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/';
        $this->createFolder($localPath);
        $localFile = $localPath . $plugin['name'] . '.zip';
        $this->downloadFile(appstoreU('Appstore/Index/download', array('token' => $token)), $localFile);
        chmod($localFile, 511);
        $this->write('开始安装插件......');
        $this->unzipFile($localFile, ONETHINK_ADDON_PATH);
        $rs = D('Addons')->install($plugin['name']);

        if ($rs === true) {
            $tokenFile = ONETHINK_ADDON_PATH . $plugin['name'] . '/token.ini';

            if (file_put_contents($tokenFile, $token)) {
                $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_THEME_HAPPY_ENDING_PARAM_', array('object' => '插件')) . L('_PERIOD_'), 'success');
                $jump = U('Addons/index');
                sleep(2);
                $this->writeScript('        location.href="' . $jump . '";');
                return true;
            }
            else {
                $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_MODULE_INSTALL_BUT_PARAM_', array('object' => '插件', 'tokenFile' => $tokenFile)) . $token, 'warning');
                return true;
            }
        }
        else {
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_FAIL_INSTALL_ADDON_') . L('_PERIOD_'), 'danger');
        }
    }

    private function installTheme($version, $token)
    {
        $theme['name'] = $version['goods']['etitle'];
        $theme['alias'] = $version['goods']['title'];
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_INSTALLING_PARAM_', array('object' => '主题')) . '【' . $theme['alias'] . '】【' . $theme['name'] . '】');

        if (file_exists(OS_THEME_PATH . $version['goods']['etitle'])) {
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_OBJECT_SAME_EXIST_PARAM_', array('object' => '主题')), 'danger');
            $this->goBack();
            return false;
        }

        $localPath = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/';
        $this->createFolder($localPath);
        $localFile = $localPath . $version['goods']['etitle'] . '.zip';
        $this->downloadFile(appstoreU('Appstore/Index/download', array('token' => $token)), $localPath . $version['goods']['etitle'] . '.zip');
        chmod($localFile, 511);
        $this->unzipFile($localFile, OS_THEME_PATH);
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_UNZIP_'), 'success');
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_INSTALL_THEME_') . L('_PERIOD_'), 'success');
        $themeModel = D('Common/Theme');
        $res = $themeModel->setTheme($theme['name']);

        if ($res === true) {
            $tokenFile = OS_THEME_PATH . $theme['name'] . '/token.ini';

            if (file_put_contents($tokenFile, $token)) {
                $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_THEME_HAPPY_ENDING_PARAM_', array('object' => '主题')) . L('_PERIOD_'), 'success');
                $jump = U('Theme/tpls', array('cleanCookie' => 1));
                sleep(2);
                $this->writeScript('        location.href="' . $jump . '";');
                return true;
            }
            else {
                $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_MODULE_INSTALL_BUT_PARAM_', array('object' => '主题', 'tokenFile' => $tokenFile)) . $token, 'warning');
                return true;
            }
        }
        else {
            $this->write('&nbsp;&nbsp;&nbsp;>，' . L('_THEME_USE_FAIL_') . $themeModel->getError(), 'danger');
            return false;
        }
    }

    private function installModule($version, $token)
    {
        $module['name'] = $version['goods']['etitle'];
        $module['alias'] = $version['goods']['title'];
        $this->write('&nbsp;&nbsp;&nbsp;>' . L('_INSTALLING_PARAM_', array('object' => '模块')) . '【' . $module['alias'] . '】【' . $module['name'] . '】');

        if (file_exists(APP_PATH . $version['goods']['etitle'])) {
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_OBJECT_SAME_EXIST_PARAM_', array('object' => '模块')), 'danger');
            $this->goBack();
            return false;
        }

        $localPath = C('CLOUD_PATH') . $this->switchEntity($version['goods']['entity']) . '/';
        $this->createFolder($localPath);
        $localFile = $localPath . $version['goods']['etitle'] . '.zip';
        $this->downloadFile(appstoreU('Appstore/Index/download', array('token' => $token)), $localFile);
        $this->unzipFile($localFile, APP_PATH);

        if (!file_exists(APP_PATH . $version['goods']['etitle'] . '/' . 'Info/info.php')) {
            $this->write(L('_FILE_VERIFY_FAIL_PLEASE_'));
            exit();
        }

        $moduleModel = D('Common/Module');
        $moduleModel->reload();
        $module = $moduleModel->getModule($module['name']);
        $res = $moduleModel->install($module['id']);

        if ($res === true) {
            $this->write($moduleModel->getError());
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_MODULE_INSTALL_') . L('_PERIOD_'), 'success');
            M('Channel')->where(array('url' => $module['entry']))->delete();
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_NAV_CLEAR_') . L('_PERIOD_'), 'success');
            $channel['title'] = $module['alias'];
            $channel['url'] = $module['entry'];
            $channel['sort'] = 100;
            $channel['status'] = 1;
            $channel['icon'] = $module['icon'];
            M('Channel')->add($channel);
            S('common_nav', null);
            $this->write('&nbsp;&nbsp;&nbsp;>' . L('_SUCCESS_NAV_ADD_') . L('_PERIOD_'), 'success');
            $tokenFile = APP_PATH . $module['name'] . '/Info/token.ini';
            $this->cleanModuleListCache();

            if ($moduleModel->setToken($module['name'], $token)) {
                $this->write(L('_MODULE_INSTALLATION_SUCCESS_'), 'success');
                $jump = U('Module/lists');
                sleep(2);
                $this->writeScript('        location.href="' . $jump . '";');
            }
            else {
                $this->write(L('_SUCCESS_MODULE_INSTALL_BUT_PARAM_', array('object' => '模块', 'tokenFile' => $tokenFile)) . $token, 'warning');
                return true;
            }
        }
        else {
            $this->write(L('_FAIL_MODULE_INSTALL_') . $moduleModel->getError(), 'warning');
        }

        return true;
    }

    private function downloadFile($url, $local)
    {
        $url = $url . '/mscode/' . MSCODE;
        $file = fopen($url, 'rb');

        if ($file) {
            $filesize = -1;
            $headers = get_headers($url, 1);

            if (!array_key_exists('Content-Length', $headers)) {
                $filesize = 0;
            }

            $filesize = $headers['Content-Length'];

            if (file_exists($local)) {
                unlink($local);
            }

            if (isset($headers['Location'])) {
                $url = $headers['Location'];
            }

            if (is_array($filesize)) {
                $filesize = $filesize[1];
            }

            $filesize = intval($filesize);

            if ($filesize != -1) {
                $this->write('&nbsp;&nbsp;&nbsp;' . '>文件总大小—' . number_format($filesize / 1024, 2) . 'KB');
                $this->write('&nbsp;&nbsp;&nbsp;' . '>开始下载文件...');
            }

            $this->getFile($url, $local);
            @(chmod($local, 511));

            if (filesize($local) == 0) {
                $this->replace('&nbsp;&nbsp;&nbsp;' . '文件大小异常，下载失败。', 'danger');
                exit();
            }

            $this->replace('&nbsp;&nbsp;&nbsp;' . '文件下载完成......', 'success');
            $this->hideProgress();
        }
        else {
            $this->write('&nbsp;&nbsp;&nbsp;' . '>文件下载失败，请检查php配置[allow_url_open]是否为on', 'danger');
            exit();
        }
    }

    private function getFile($url, $path, $type = 0)
    {
        if (trim($url) == '') {
            return false;
        }

        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $content = curl_exec($ch);
            curl_close($ch);
        }
        else {
            ob_start();
            readfile($url);
            $content = ob_get_contents();
            ob_end_clean();
        }

        $size = strlen($content);
        $fp2 = @(fopen($path, 'a'));
        fwrite($fp2, $content);
        fclose($fp2);
        unset($content);
        unset($url);
        return $path;
    }

    private function setValue($val)
    {
        $js = 'progress.setValue(' . $val . ')';
        $this->writeScript($js);
    }

    private function showProgress()
    {
        $js = '        progress.show();';
        $this->writeScript($js);
    }

    private function hideProgress()
    {
        $js = '        progress.hide();';
        $this->writeScript($js);
    }

    private function url($url)
    {
        return C('__CLOUD__') . $url;
    }

    private function writeMessage($str)
    {
        $js = 'writeMessage(\'' . $str . '\')';
        $this->writeScript($js);
    }

    private function writeFile($str)
    {
        $js = 'writeFile(\'' . $str . '\')';
        $this->writeScript($js);
    }

    private function replaceMessage($str)
    {
        $js = 'replaceMessage(\'' . $str . '\')';
        $this->writeScript($js);
    }

    private function goBack()
    {
        $this->writeScript('  setTimeout(function(){' . "\r\n" . '            history.go(-1);' . "\r\n" . '        },3000);');
    }

    private function writeScript($str)
    {
        echo '<script>' . $str . '</script>';
        ob_flush();
        flush();
    }

    private function replace($str, $type = 'info', $br = '<br>')
    {
        $this->replaceMessage('<span class="text-' . $type . '">' . $str . '</span>' . $br);
    }

    private function write($str, $type = 'info', $br = '<br>')
    {
        $this->writeMessage('<span class="text-' . $type . '">' . $str . '</span>' . $br);
    }

    private function curl($url)
    {
        return D('Admin/Curl')->curl($url);
    }

    private function unzipFile($localFile, $localPath)
    {
        require_once './ThinkPHP/Library/OT/PclZip.class.php';
        $archive = new PclZip($localFile);
        $this->write('&nbsp;&nbsp;&nbsp;' . '>开始解压文件......');
        $list = $archive->extract(PCLZIP_OPT_PATH, $localPath, PCLZIP_OPT_SET_CHMOD, 511);

        if ($list === 0) {
            $this->write('&nbsp;&nbsp;&nbsp;' . '>解压失败。' . $archive->errorInfo(true));
            exit();
        }

        unlink($localFile);
        $this->write('&nbsp;&nbsp;&nbsp;' . '>解压成功。', 'success');
    }

    private function assignVersionInfo()
    {
        $currentVersion = $_SESSION['currentVersion'];
        $nextVersion = $_SESSION['nextVersion'];
        $this->assign('nextVersion', $nextVersion);
        $this->assign('currentVersion', $currentVersion);
    }

    private function switchEntity($entity)
    {
        switch ($entity) {
            case 1:
                return 'Addons';
            case 2:
                return 'Module';
            case 3:
                return 'Theme';
        }
    }

    private function switchDir($entity)
    {
        switch ($entity) {
            case 1:
                return ONETHINK_ADDON_PATH;
            case 2:
                return APP_PATH;
            case 3:
                return OS_THEME_PATH;
        }
    }

    public function checkAuth()
    {
        if ((S('CLOUDTIME') + (60 * 60)) < time()) {
            S('CLOUD', null);
            S('CLOUD_IP', null);
            S('CLOUD_HOME', null);
            S('CLOUD_DAOQI', null);
            S('CLOUD_GAME', null);
            S('CLOUDTIME', time());
        }

        $CLOUD = S('CLOUD');
        $CLOUD_IP = S('CLOUD_IP');
        $CLOUD_HOME = S('CLOUD_HOME');
        $CLOUD_DAOQI = S('CLOUD_DAOQI');

        if (!$CLOUD) {
            foreach (C('__CLOUD__') as $k => $v) {
                if (getUrl($v . '/Auth/text') == 1) {
                    $CLOUD = $v;
                    break;
                }
            }

            if (!$CLOUD) {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="授权服务器连失败"></a>';
                exit();
            }
            else {
                S('CLOUD', $CLOUD);
            }
        }

        if (!$CLOUD_DAOQI) {
            $CLOUD_DAOQI = getUrl($CLOUD . '/Auth/daoqi?mscode=' . MSCODE);

            if ($CLOUD_DAOQI) {
                S('CLOUD_DAOQI', $CLOUD_DAOQI);
            }
            else {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="获取授权到期时间失败"></a>';
                exit();
            }
        }

        if (strtotime($CLOUD_DAOQI) < time()) {
            S('CLOUDTIME', time() - (60 * 60 * 24));
            echo '<a title="授权已到期"></a>';
            exit();
        }

        if (!$CLOUD_IP) {
            $CLOUD_IP = getUrl($CLOUD . '/Auth/ip?mscode=' . MSCODE);

            if (!$CLOUD_IP) {
                S('CLOUD_IP', 1);
            }
            else {
                S('CLOUD_IP', $CLOUD_IP);
            }
        }

        if ($CLOUD_IP && ($CLOUD_IP != 1)) {
            $ip_arr = explode('|', $CLOUD_IP);

            if ('/' == DIRECTORY_SEPARATOR) {
                $ip_a = $_SERVER['SERVER_ADDR'];
            }
            else {
                $ip_a = @(gethostbyname($_SERVER['SERVER_NAME']));
            }

            if (!$ip_a) {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="获取本地ip失败"></a>';
                exit();
            }

            if (!in_array($ip_a, $ip_arr)) {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="匹配授权ip失败"></a>';
                exit();
            }
        }

        if (!$CLOUD_HOME) {
            $CLOUD_HOME = getUrl($CLOUD . '/Auth/home?mscode=' . MSCODE);

            if (!$CLOUD_HOME) {
                S('CLOUD_HOME', 1);
            }
            else {
                S('CLOUD_HOME', $CLOUD_HOME);
            }
        }

        if ($CLOUD_HOME && ($CLOUD_HOME != 1)) {
            $home_arr = explode('|', $CLOUD_HOME);
            $home_a = $_SERVER['SERVER_NAME'];

            if (!$home_a) {
                $home_a = $_SERVER['HTTP_HOST'];
            }

            if (!$home_a) {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="获取本地域名失败"></a>';
                exit();
            }

            if (!in_array($home_a, $home_arr)) {
                S('CLOUDTIME', time() - (60 * 60 * 24));
                echo '<a title="匹配授权域名失败"></a>';
                exit();
            }
        }
    }

    public function checkUpdata()
    {
        //die();
		if (!S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata')) {
            $DbFields = M('VersionGame')->getDbFields();

            if (!in_array('class', $DbFields)) {
                M()->execute('ALTER TABLE `movesay_version_game` ADD COLUMN `class` VARCHAR(200)  NOT NULL   COMMENT \'名称\' AFTER `id`;');
            }

            if (!in_array('shuoming', $DbFields)) {
                M()->execute('ALTER TABLE `movesay_version_game` ADD COLUMN `shuoming` VARCHAR(200)  NOT NULL   COMMENT \'名称\' AFTER `id`;');
            }

            if (!in_array('gongsi', $DbFields)) {
                M()->execute('ALTER TABLE `movesay_version_game` ADD COLUMN `gongsi` VARCHAR(200)  NOT NULL   COMMENT  \'名称\' AFTER `id`;');
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/index',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Cloud/index', 'title' => '云市场', 'pid' => 10, 'sort' => 1, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }
            else {
                M('Menu')->where(array(
                    'url' => 'Cloud/index',
                    'pid' => array('neq', 0)
                ))->save(array('title' => '云市场', 'pid' => 10, 'sort' => 1, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/update',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Cloud/update', 'title' => '自动升级', 'pid' => 10, 'sort' => 2, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }
            else {
                M('Menu')->where(array(
                    'url' => 'Cloud/update',
                    'pid' => array('neq', 0)
                ))->save(array('title' => '自动升级', 'pid' => 10, 'sort' => 2, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/game',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Cloud/game', 'title' => '应用管理', 'pid' => 10, 'sort' => 3, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }
            else {
                M('Menu')->where(array(
                    'url' => 'Cloud/game',
                    'pid' => array('neq', 0)
                ))->save(array('title' => '应用管理', 'pid' => 10, 'sort' => 3, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/kefu',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Cloud/kefu', 'title' => '客服代码', 'pid' => 10, 'sort' => 5, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }
            else {
                M('Menu')->where(array(
                    'url' => 'Cloud/kefu',
                    'pid' => array('neq', 0)
                ))->save(array('title' => '客服代码', 'pid' => 10, 'sort' => 5, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/kefuUp',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else {
                $pid = M('Menu')->where(array(
                    'url' => 'Cloud/kefu',
                    'pid' => array('neq', 0)
                ))->getField('id');

                if (!$list) {
                    M('Menu')->add(array('url' => 'Cloud/kefuUp', 'title' => '使用', 'pid' => $pid, 'sort' => 5, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
                }
                else {
                    M('Menu')->where(array(
                        'url' => 'Cloud/kefuUp',
                        'pid' => array('neq', 0)
                    ))->save(array('title' => '使用', 'pid' => $pid, 'sort' => 5, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
                }
            }

            $list = M('Menu')->where(array(
                'url' => 'Cloud/theme',
                'pid' => array('neq', 0)
            ))->select();

            if ($list[1]) {
                M('Menu')->where(array('id' => $list[1]['id']))->delete();
            }
            else if (!$list) {
                M('Menu')->add(array('url' => 'Cloud/theme', 'title' => '主题模板', 'pid' => 10, 'sort' => 4, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }
            else {
                M('Menu')->where(array(
                    'url' => 'Cloud/theme',
                    'pid' => array('neq', 0)
                ))->save(array('title' => '主题模板', 'pid' => 10, 'sort' => 4, 'hide' => 0, 'group' => '扩展', 'ico_name' => 'tasks'));
            }

            if (M('Menu')->where(array('url' => 'ExtA/index'))->delete()) {
                M('AuthRule')->where(array('status' => 1))->delete();
            }

            S(MODULE_NAME . CONTROLLER_NAME . 'checkUpdata', 1);
        }
    }
}

?>