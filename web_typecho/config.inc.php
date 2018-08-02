<?php
/**
 * Typecho Blog Platform
 *
 * @copyright  Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license    GNU General Public License 2.0
 * @version    $Id$
 */
/** 定义根目录 */

define('__TYPECHO_ROOT_DIR__', dirname(__FILE__));
/** 定义插件目录(相对路径) */
define('__TYPECHO_PLUGIN_DIR__', '/usr/plugins');
/** 定义模板目录(相对路径) */
define('__TYPECHO_THEME_DIR__', '/usr/themes');
/** 后台路径(相对路径) */
define('__TYPECHO_ADMIN_DIR__', '/admin/');
/** 设置包含路径 */
@set_include_path(get_include_path() . PATH_SEPARATOR .
__TYPECHO_ROOT_DIR__ . '/var' . PATH_SEPARATOR .
__TYPECHO_ROOT_DIR__ . __TYPECHO_PLUGIN_DIR__);
/** 载入API支持 */
require_once 'Typecho/Common.php';
/** 载入Response支持 */
require_once 'Typecho/Response.php';
/** 载入配置支持 */
require_once 'Typecho/Config.php';
/** 载入异常支持 */
require_once 'Typecho/Exception.php';
/** 载入插件支持 */
require_once 'Typecho/Plugin.php';
/** 载入国际化支持 */
require_once 'Typecho/I18n.php';
/** 载入数据库支持 */
require_once 'Typecho/Db.php';
/** 载入路由器支持 */
require_once 'Typecho/Router.php';
/** 程序初始化 */
Typecho_Common::init();
/** 定义数据库参数 */
$db = new Typecho_Db('Mysql', 'type_');
$db->addServer(array (
  'host' => 'localhost',
  'user' => 'root',
  'password' => 'root',
  'charset' => 'utf8',
  'port' => '3306',
  'database' => 'tcho',
), Typecho_Db::READ | Typecho_Db::WRITE);
Typecho_Db::set($db);
