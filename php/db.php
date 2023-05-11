<?php

// Open the database file
$db = new PDO('sqlite:mydatabase.db');



// Create the users table
$db->exec('DROP TABLE IF EXISTS users;');
$db->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)');


// Retrieve the data
$result = $db->query('SELECT * FROM users');

// Display the data
foreach ($result as $row) {
    echo $row['username'] . ': ' . $row['password'] . '<br />';
}
