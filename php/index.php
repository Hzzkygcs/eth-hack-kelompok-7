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
    $password = $_GET['password'];
    $user = validateLogin($_GET['username'], $password);
    if ($user == null){
        echo "username or password is invalid!";
        return;
    }
    $session = createSession();
    setcookie('username', $user, time() + 3600);
    setcookie('session', $session, time() + 3600);
    setcookie('password', $password, time() + 3600);
    echo "authentication success!";

}else if ($_GET["operation"] == "show-profile" && isset($_COOKIE['session']) && isset($_COOKIE['username']) ){
    $username = $_COOKIE['username'];
    $session = $_COOKIE['session'];

    if (!validateSession($session)) {
        echo "Invalid session! Please re-login.";
        return;
    }
    showMyUsernameInformation($username);

}else if ($_GET["operation"] == "my-notes" && isset($_COOKIE['username']) && isset($_COOKIE['password']) ){
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    if (!validateLogin($username, $password)) {
        echo "Invalid credentials! Please re-login.";
        return;
    }
    showNotes($username);

}else {
    echo "operation prohibited!";
}

?>