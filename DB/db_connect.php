<?php
function connectToDatabase() {

    //Database connection details
    $host     = 'localhost';
    $username = 'root'; 
    $password = ''; 
    $database = 'event_management';

    try {
        
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo ;

    } catch(PDOException $e) {

        die("Error: " . $e->getMessage());
    } 

}