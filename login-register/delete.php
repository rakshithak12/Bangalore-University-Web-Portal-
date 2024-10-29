<?php
    include("database/db.php");
    $user_id=$_POST['user_id'];
    $query="DELETE FROM users WHERE user_id={$user_id}";
    try {
        mysqli_query($conn, $query);
        $_SESSION['message'] = "User Record Deleted Successfully";
        header("Location: ../admin/adminHome.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header("Location: ../admin/adminHome.php");
        exit();
    }
?>