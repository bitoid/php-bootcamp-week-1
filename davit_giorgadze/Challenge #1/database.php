<?php

/*
 * before you run app
 * create users table in your database.
 *
 * CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  'first_name' varchar(255) NOT NULL,
  'last_name' varchar(255) NOT NULL,
  'image' varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
 *
 *
 *
 */



$host = "localhost"; // Host name
$database = ""; // Your database name
$user = "root"; // Your database user
$password = ""; // Your database password



$pdo = new PDO("mysql:host=$host;dbname=$database", "$user", "$password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;