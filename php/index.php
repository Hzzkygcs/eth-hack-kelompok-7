<?php
include_once 'db_util.php';
echo "test";

if(isset($_GET["a"]) && isset($_GET["b"])) {
    extract($_GET);
    if (substr($a, 0, 2) !== "CS" || substr($b, 0, 2) !== "UI")
        die("no CSUI no gain!");
    if (md5($a) != md5($b))
        die("Hasil md5-nya harus sama bang!");

    echo $flag_yang_kalian_inginkan;
} else {
    highlight_file("db_util.php");
    highlight_file(__FILE__);
}
?>