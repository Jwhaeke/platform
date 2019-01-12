<?php
session_start();



try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([
        ':email' => $_POST['email']]
    );

    $user = $stmt->fetch();  
    $checkPass = htmlspecialchars($_POST['password']);
    if ($user && password_verify($checkPass, $user['password']))
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $user['name'];
        header("Location: index.php");
    } else {
        echo "invalid";
    }

}
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = NULL;

?>