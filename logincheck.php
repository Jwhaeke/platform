<?php

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $conn->prepare('SELECT FROM login (user, password) VALUES (:user, :password)');

// Need to look into this more


}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>