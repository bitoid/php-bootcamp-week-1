<?php

$pdo = require 'database.php';

$id = $_POST['id'] ?? null;

$statement = $pdo->prepare('SELECT image FROM USERS WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
unlink($user['image']);

$statement = $pdo->prepare('DELETE FROM USERS WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();



header('Location: index.php');