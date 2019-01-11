<?php

//  Need to catch $_POST before and sanitize input

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $conn->prepare('INSERT INTO users (name, email, credits) VALUES (:name, :email, :credits)');

    $statement->execute([
        'name' =>$_POST['newUser'],
        'email' => $_POST['newEmail'],
        'credits' => $_POST['newCredits']
    ]);

}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>