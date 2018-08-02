<?php

$url = $_GET['url'];
$parts = parse_url($url);
if(empty($parts['host']) || $parts['host'] != 'localhost') {
    exit('error');
}
readfile($url);
?>
<?php if(!defined('__TYPECHO_ADMIN__')) exit; ?>
    </body>
</html>
<?php
/** 注册一个结束插件 */
Typecho_Plugin::factory('admin/footer.php')->end();
