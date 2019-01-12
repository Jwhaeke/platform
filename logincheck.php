<?php
session_start();

//  Login check
try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //  Use email to search for password instead of user - since more users can have same password
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([
        ':email' => $_POST['email']]
    );
    $user = $stmt->fetch();  

    //  Avoid harmful user data
    $checkPass = htmlspecialchars($_POST['password']);

    //  Check if the e-mail has been found and compare password
    if ($user && password_verify($checkPass, $user['password']))
    {
    //  Set sessions with user id and user name
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = $user['name'];

    //  Redirect to the main page
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