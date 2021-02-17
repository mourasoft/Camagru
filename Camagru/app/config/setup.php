<?php
// require_once 'database.php';

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	]);
} catch (PDOException $e) {
	echo $e->getMessage();
}
// Create Database 
$sql = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME;
$db->exec($sql);

// Use Database
$sql = 'USE ' . $DB_NAME;
$db->exec($sql);
// Create a table of users
try {
	$sql = "CREATE TABLE IF NOT EXISTS `users` 
    ( 
        `id` INT(11) AUTO_INCREMENT PRIMARY KEY, 
        `username` VARCHAR(25) NOT NULL , 
        `email` VARCHAR(60) NOT NULL , 
        `password` VARCHAR(255) NOT NULL ,
		`confirmation_token` VARCHAR(255) NULL ,
		`confirmed_at` DATETIME NULL ,
		`reset_token` VARCHAR(40) NULL ,
		`reset_at` DATETIME NULL
        )";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `images`
	(
		`id` INT(11) AUTO_INCREMENT PRIMARY KEY ,
		`id_user` INT(11) NOT NULL ,
		`path` VARCHAR(255) NOT NULL 
	)";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `likes` (
	 	`image_id` VARCHAR(255) NOT NULL,
	 	`user_id` int not null
	 	-- CONSTRAINT img_fk FOREIGN KEY (image_id) REFERENCES images(id_user),
	 	-- CONSTRAINT user_fk FOREIGN KEY (user_id) REFERENCES users(id)
	   )";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `posts`
	(
		`id_comment` INT(11) AUTO_INCREMENT PRIMARY KEY ,
		`image_pat`	VARCHAR(255) NOT NULL,
		`id_user` INT(11) NOT NULL ,
		`content` VARCHAR(255) NOT NULL
	)";
	$db->exec($sql);
} catch (PDOException $e) {
	echo $e->getMessage();
}
