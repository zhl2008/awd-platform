<?php
spl_autoload_register();
$filenames = isset($_COOKIE["filenames"]) ? unserialize($_COOKIE["filenames"]) : [];
?>