<?php
$servername = "localhost"; // or "127.0.0.1" if localhost doesn't work
$username = "skateshop";
$password = "Skateshop79@+";
$database = "bochi_skates";

try {
    // Connect using UNIX socket
    $myPDO = new PDO("mysql:host=$servername;dbname=$database;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock", $username, $password);
    // Set the PDO error mode to exception
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();


    
}

$skates = $myPDO->query("SELECT name, brand, price FROM skates");

?>
