<?php
include_once 'db.php';

function registerUser($username, $password) {
    global $db;
    $hashedpassword = md5($password);
    $db->exec("INSERT INTO users (username, password) VALUES ('$a', '$hashedpassword')");
}

