<?php

// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id']))
{
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_SESSION['user_id'];
    $GamesPurchased = $_SESSION['basket'];
    
    try {
        //  Connect to db server
        $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare insert statement for games in basket
        $statement1 = $conn->prepare('INSERT INTO my_games (user_id, game_id) VALUES (:user_id, :game_id)');
        
        // Delete the games from the orders table
        $statement2 = $conn->prepare('DELETE FROM orders WHERE (user_id = :user_id)');
        
        //  For each item in the basket add it to my_games with the user id 
        foreach ($GamesPurchased as $purchase) {   
        $statement1->execute([
            'user_id' => $user,
            'game_id' => $purchase           
        ]);
        }

        $statement2->execute(['user_id' => $user]);

    }
        //  Catch errors that may occur
    catch(PDOExeption $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    //  Close the connection
    $conn = NULL;

    header("Location: index.php");
}

?>