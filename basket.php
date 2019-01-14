<?php

// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id']))
{
    header("Location: login.php");
}

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Search for orders made by the user and echo them - Also use data from the games table
    $stmt = $conn->prepare("SELECT orders.game_id, games.name FROM orders INNER JOIN games ON orders.id=games.id WHERE user_id = :user");
    $stmt->execute([
        ':user' => $_SESSION['user_id']]
    );
    $basket = $stmt->fetchall();  

    foreach ($basket as $key => $value) {
        echo "Game: ". $value['name']. " <br>";
    }
}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basket</title>
</head>
<body>
    <a href="index.php">Home</a>
</body>
</html>