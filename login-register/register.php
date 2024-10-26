<?php 
session_start();
include("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password =  filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    $uname='';
    function generateUniqueId() {
        return 'ID-' . time() . '-' . rand(1000, 9999);
    }
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName =$_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $base=generateUniqueId() .'_'. basename($fileName);
        
        // Specify the directory where the file will be uploaded
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $base;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $uname = $base;
        } else {
            $uname = "default.jpeg";
        }
    }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql1 = "INSERT INTO users (email, username, password, phone, photo) VALUES ('$email', '$username', '$hash','$phone','$uname')";
    
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
    
}

mysqli_close($conn);
?>
