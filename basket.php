<?php
namespace Platform;
require 'vendor/autoload.php';
// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
}

//  Remove order on post - For now assuming that the user logged is the same as the one who made the order
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $deleted = new Order;
    $deleted->removeOrderFromBasket($_POST['remove']);  
}

try {
    $conn = new \PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $_SESSION['basket'] = [];
    $sum = 0;
    // Search for orders made by the user and echo them - Also use data from the games table
    $stmt = $conn->prepare("SELECT orders.game_id, orders.id, games.name, games.price FROM orders INNER JOIN games ON orders.game_id=games.id WHERE user_id = :user");
    $stmt->execute(['user' => $_SESSION['user_id']]);
    $basket = $stmt->fetchall();  
    $value = 0;
    foreach ($basket as $value) {
        echo $value['name']. " costs: " .$value['price'];
        echo "<form action='basket.php' method='post'><button name='remove' type=submit value=".$value['id'].">Remove from basket</button></form>";
        $sum += $value['price'];
        $_SESSION['basket'][] = $value['game_id'];
    }
    echo "Your order costs: " . $sum. "<br>";
}
catch(\PDOExeption $e) {
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
    <form action="purchase.php" method="post">
        <button type="submit">Pay</button>
    </form>
</body>
</html>