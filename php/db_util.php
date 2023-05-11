<?php
include_once 'db.php';
include_once 'util.php';

function registerUser($username, $password) {
    global $db;
    $notNullPswd = assertNotNull($password);
    return $db->exec("INSERT INTO users (username, password) VALUES ('$username', '$notNullPswd')");
}
function addNewNote($username, $note) {
    global $db;
    return $db->exec("INSERT INTO notes (username, note) VALUES ('$username', '$note')");
}
function createSession(){
    global $db;
    $random_session = generateRandomString(25);
    $db->exec("INSERT INTO sessions (session) VALUES ('$random_session')");
    return $random_session;
}
function validateSession($session){
    global $db;
    $stmt = $db->prepare("SELECT * FROM sessions WHERE session=:user_session");
    $stmt->bindParam(':user_session', $session);
    $stmt->execute();
    return count($stmt->fetchAll(PDO::FETCH_ASSOC)) > 0;
}
function assertNotNull($password){
    return md5($password);
}
function validateLogin($username, $password){
    global $db;
    $givenValidPwd = assertNotNull($password);
    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $logged_in_username = null;
    $storedPswd = null;
    foreach ($result as $row) {
        $logged_in_username = $row['username'];
        $storedPswd = $row['password'];
    }
    if ($givenValidPwd != $storedPswd){
        return null;
    }
    return $logged_in_username;
}
function showMyUsernameInformation($myUsername){
    global $db;
    $result = $db->query("SELECT * FROM users WHERE username='$myUsername'");
    foreach ($result as $row){
        var_dump($row);
    }
}
function showNotes($username){
    global $db;
    $stmt = $db->prepare("SELECT * FROM notes WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        var_dump($row);
    }
}

