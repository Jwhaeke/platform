<?php

//  Need to catch $_POST before and sanitize input
$registered = false;

try {
    //  Connect to db server
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //  Hash the password from the POST form
    $hashPass = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

    // Prepare statement to insert data into the db
    $statement = $conn->prepare('INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)');
    
    // Add parameters
    $statement->execute([
        'name' =>$_POST['newUser'],
        'email' => $_POST['newEmail'],
        'username' => $_POST['newUsername'],
        'password' => $hashPass
    ]);
    // Set registered to true - Will need to build in a check if registration has completed successfully
    // Although if this part of the code is triggered it may have already worked out correctly
    $registered = true;
}

    //  Catch errors that may occur
catch(PDOExeption $e) {
    echo "Connection failed: " . $e->getMessage();
}

    //  Close the connection
$conn = NULL;

    //  If the user has completed the registration process redirect to the login page
if  ($registered) {
    header("Location: login.php");
}
?>