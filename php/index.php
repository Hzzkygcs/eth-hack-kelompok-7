<?php
echo "hello";

// Open the database file
$db = new PDO('sqlite:mydatabase.db');
highlight_file(__FILE__);



// Create the users table
$db->exec('DROP TABLE IF EXISTS users;');
$db->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)');

// Insert some data
$db->exec("INSERT INTO users (name, email) VALUES ('John Smith', 'john@example.com')");

// Retrieve the data
$result = $db->query('SELECT * FROM users');

// Display the data
foreach ($result as $row) {
    echo $row['name'] . ': ' . $row['email'] . '<br />';
}
