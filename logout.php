<?php

// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id']))
{
    header("Location: login.php");
}

session_unset();
session_destroy();
session_write_close();

if(empty($_SESSION['user_id']))
{
    echo "You are logged out <br>";
    echo "If you want to return to login page click <a href='login.php'>here</a>";
}