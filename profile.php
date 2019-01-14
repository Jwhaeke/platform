<?php

// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
}

$msg = "";
$msgClass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["change_name"] == "changed_name"){
        $newName = htmlspecialchars($_POST['name']);
        $user = $_SESSION['user_id'];
        try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Search for orders made by the user and echo them - Also use data from the games table
            $stmt = $conn->prepare("UPDATE users SET name=:name WHERE id=:user");
            $stmt->execute([
                'name' => $newName,
                'user' => $user
                ]);
        }
        catch(PDOExeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }        
        $conn = NULL;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["change_email"] == "changed_email"){
        $newEmail = htmlspecialchars($_POST['email']);
        $user = $_SESSION['user_id'];
        try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Search for orders made by the user and echo them - Also use data from the games table
            $stmt = $conn->prepare("UPDATE users SET email=:email WHERE id=:user");
            $stmt->execute([
                'email' => $newEmail,
                'user' => $user
                ]);
        }
        catch(PDOExeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }   
        $conn = NULL;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["change_username"] == "changed_username"){
        $newUserName = htmlspecialchars($_POST['user_name']);
        $user = $_SESSION['user_id'];
        try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Search for orders made by the user and echo them - Also use data from the games table
            $stmt = $conn->prepare("UPDATE users SET username=:username WHERE id=:user");
            $stmt->execute([
                'username' => $newUserName,
                'user' => $user
                ]);
        }
        catch(PDOExeption $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = NULL;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["change_password"] == "changed_password"){
    if (count($_POST['password']) > 4){
        $newPassword = $_POST['password'];
        $newPassword2 = $_POST['password_check'];
    
        $user = $_SESSION['user_id'];
        if (isset($_POST['password']) && $newPassword == $newPassword2){
            
            $hashedNewPass = password_hash($newPassword, PASSWORD_DEFAULT);

            try {
            $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Search for orders made by the user and echo them - Also use data from the games table
            $stmt = $conn->prepare("UPDATE users SET password=:password WHERE id=:user");
            $stmt->execute([
                'password' => $hashedNewPass,
                'user' => $user
                ]);
            }
            catch(PDOExeption $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        $conn = NULL;
    } else {
        $msg = 'Please fill in a password';
        $msgClass = 'alert-danger';       
    }
}


try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Search for orders made by the user and echo them - Also use data from the games table
    $stmt = $conn->prepare("SELECT name, email, username FROM users WHERE id = :user");
    $stmt->execute([
        'user' => $_SESSION['user_id']
        ]);
    $basket = $stmt->fetchall();  
    $value = 0;
    foreach ($basket as $key => $value) {
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
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

</head>
<body>
<h1 class="text-center">Profile page</h1>
    <hr>
<div class="container">
    
    <h2>Change settings</h2>
    <hr>
    <form action="profile.php" method="post">
        <h2>Your name</h2>
        <input class="form-control" type="hidden" name="change_name" value="changed_name">
        <input class="form-control" type="text" minlength=5 name="name" id="" value=<?php echo $value['name']; ?>>
        <button type="submit">Change name</button>
    </form>
    <hr>
    <form action="profile.php" method="post">
        <h2>Email</h2>
        <input class="form-control" type="hidden" name="change_email" value="changed_email">
        <input minlength=5 class="form-control" type="email" name="email" id="" value=<?php echo $value['email']; ?>>
        <button type="submit">Change E-mail</button>
    </form>
    <hr>
    <form action="profile.php" method="post">
        <h2>username</h2>
        <input class="form-control" type="hidden" name="change_username" value="changed_username">
        <input class="form-control" type="text" minlength=3 name="user_name" id="" value=<?php echo $value['username']; ?>> 
        <button type="submit">Change username</button>
    </form>
    <hr>
    <form action="profile.php" method="post">
        <input class="form-control" type="hidden" name="change_password" value="changed_password">
        <h2>Change password</h2>
        <input class="form-control" type="password" minlength=5 name="password" id="" value="">
        <h4>Repeat password</h4>
        <input class="form-control" type="password" minlength=5 name="password_check" id="" value="">  
        <?php if ($msg != ''): ?>
                <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>
        <button type="submit">Change password</button>
    </form>
    <hr>
    <a href="index.php">Home</a>
</div>    

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>