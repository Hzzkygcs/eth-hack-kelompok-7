<?php

// Open the database file
$db = new PDO('sqlite:mydatabase.db');

function doesTableExist($tableName){
    global $db;
    $stmt = $db->prepare("SELECT name FROM main.sqlite_master WHERE type='table' AND name=?;");
    $stmt->execute([$tableName]);
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return count($tables) > 0;
}


if (!doesTableExist("sessions")){
    $db->exec('CREATE TABLE sessions (id INTEGER PRIMARY KEY, session TEXT unique)');
}


// Create the users table
$db->exec('DROP TABLE IF EXISTS users;');
$db->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT unique, password TEXT)');
registerUser("valen", "mypassword_hvqplvqn");
registerUser("user", "user");

$db->exec('DROP TABLE IF EXISTS notes;');
$db->exec('CREATE TABLE notes (id INTEGER PRIMARY KEY, username TEXT, note TEXT)');
addNewNote("user", "Hello world!");
addNewNote("user", "I do not have the flag, but I want one :(");
addNewNote("valen", "CSCE604258{sql__cookies__hash___is_fun}");




