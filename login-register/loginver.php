<?php
session_start();
include("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        // Query to find the user
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password,$row['password'])) {
                $_SESSION["username"] = $username;
                $role = $row['role'];
                // Redirect based on user role
                switch ($role) {
                    case 'user':
                        header("Location: ../userHome.php");
                        exit();
                    case 'admin':
                        header("Location: ../adminHome.php");
                        exit();
                }
            } else {
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $_SESSION['message'] = "Invalid password";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "No user found with that username";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields";
        header("Location: ../login.php");
        exit();
    }
}

mysqli_close($conn);
?>
