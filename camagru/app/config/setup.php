<?php
// require_once 'database.php';

try{
        $db = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
// Create Database 
$sql = "CREATE DATABASE IF NOT EXISTS ". $DB_NAME;
$db->exec($sql);

// Use Database
$sql = 'USE ' . $DB_NAME ;
$db->exec($sql);
// Create a table of users
try{
    $sql = "CREATE TABLE IF NOT EXISTS `users` 
    ( 
        `id` INT AUTO_INCREMENT PRIMARY KEY, 
        `first_name` VARCHAR(30) NOT NULL , 
        `last_name` VARCHAR(30) NOT NULL , 
        `username` VARCHAR(30) NOT NULL , 
        `email` VARCHAR(60) NOT NULL , 
        `password` VARCHAR(255) NOT NULL 
        )";
     //var_dump($sql) ."<br>";
$db->exec($sql);
}catch(PDOException $e){
    echo $e->getMessage();
}







