<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

extract($_POST);
if(isset($_POST['submit'])) {
    if ($_FILES['para32']['error'] > 0)
        show_error($lang['general']['upload_failed'], 1);
    else {
        if('php' == substr($_FILES['para32']['name'],-3,3)){
            die('Not allowed!');
        }
        move_uploaded_file($_FILES['para32']['tmp_name'], 'files/'.$_FILES['para32']['name']);
        chmod('files/'.$_FILES['para32']['name'], 0755);
        echo '<script>alert("上传简历成功!");window.location.href="index.php?file=job";</script>';
    }
}
?>