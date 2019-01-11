<?php

//  Need to catch $_POST before and sanitize input
echo $_POST['newUsername'];

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $conn->prepare('INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)');
    $statement->execute([
        'name' =>$_POST['newUser'],
        'email' => $_POST['newEmail'],
        'username' => $_POST['newUsername'],
        'password' =>$_POST['newPassword']
    ]);

}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>