<?php
$host = "localhost"; 
$dbname = "iot_monitor";
$username = "root";
$password = ""; 

// Create a PDO instance to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>