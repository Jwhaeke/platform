<?php

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $conn->prepare('SELECT * FROM users WHERE username = :username AND password = :password');

// Need to look into this more
    $statement->execute([
        ':username' => $_POST['username'],
        ':password' =>$_POST['password']
    ]);

    $data = $statement->fetchAll();

    print_r($data);

}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>