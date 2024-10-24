<?php 
session_start();
include("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // Username is available, proceed with registration
        $sql1 = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hash')";
        
        try {
            mysqli_query($conn, $sql1);
            $_SESSION['message'] = "You are now registered, Please Login";
            header("Location: ../login.php");
            exit();
        } catch (mysqli_sql_exception $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Name is already taken";
        header("Location: ../login.php");
        exit();
    }
}

mysqli_close($conn);
?>
