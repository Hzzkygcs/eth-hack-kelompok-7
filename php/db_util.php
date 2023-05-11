<?php
include_once 'db.php';
include_once 'util.php';

function registerUser($username, $password) {
    global $db;
    $hashedpassword = getHashedPassword($password);
    $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$hashedpassword')");
}

function getHashedPassword($password){
    return md5($password);
}

function createSession(){
    global $db;
    $random_session = generateRandomString(25);
    $db->exec("INSERT INTO sessions (session) VALUES ('$random_session')");
    return $random_session;
}
function checkSession($session){
    global $db;
    $random_session = generateRandomString(25);
    $stmt = $db->prepare("SELECT * FROM sessions WHERE session=:session");
    $stmt->bindParam(':session', $session);
    return count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0;
}
function validateLogin($username, $password){
    global $db;
    $hashedpassword = getHashedPassword($password);
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:hashedPass");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':hashedPass', $hashedpassword);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo var_dump($result);

    $logged_in_username = null;
    foreach ($result as $row) {
        $logged_in_username = $row['username'];
    }
    return $logged_in_username;
}


function showMyUsernameInformation($myUsername){
    global $db;
    return $db->query("SELECT * FROM users WHERE username='$myUsername'");
}

