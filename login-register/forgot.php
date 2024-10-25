<?php
session_start();
include("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email=filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        // Query to find the user
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        echo"$email";
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the new password
            $update_sql = "UPDATE users SET password=? WHERE email=?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $hashed_password, $email);
            if ($update_stmt->execute()) {
                $_SESSION["valid"] = "valid";
                $_SESSION['message'] = "Password updated successfully, Please Login";
                header("Location: ../login.php");
                exit();
            } 
        } else {
            $_SESSION['message'] = "No user found with given Email";
            header("Location: ../login.php");
            exit();
        }
    } 

mysqli_close($conn);
?>
