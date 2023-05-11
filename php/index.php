<?php
include_once 'db_util.php';

if(!isset($_GET["operation"])) {
    echo "db_util.php <br>";
    highlight_file("db_util.php");

    echo "<br><br><br>";
    echo "index.php <br>";
    highlight_file(__FILE__);
    return;
}

if ($_GET["operation"] == "login" && isset($_GET['username']) && isset($_GET['password'])){
    $user = validateLogin($_GET['username'], $_GET['password']);
    if ($user == null){
        echo "password failed!";
        return;
    }
    $session = createSession();
    setcookie('username', $user, time() + 3600);
    setcookie('session', $session, time() + 3600);
    echo "authentication success!";
}else if ($_GET["operation"] == "show-profile"){

}else {
    echo "operation prohibited!";
}

?>