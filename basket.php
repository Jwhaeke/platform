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

    //  Use email to search for password instead of user - since more users can have same password
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