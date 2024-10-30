<?php 
session_start();
include("database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password1 =  filter_input(INPUT_POST, "password1", FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 =  filter_input(INPUT_POST, "password2", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    $uname='';
    if($_GET['value']==1){
        $path="Location: ../admin/adminHome.php";
    }
    else{
        $path="Location: ../login.php";
    }
    function generateUniqueId() {
        return 'ID-' . time() . '-' . rand(1000, 9999);
    }
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName =$_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $base=generateUniqueId() .'_'. basename($fileName);
        
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $base;
        $uname = move_uploaded_file($fileTmpPath, $dest_path)?$base:$uname = "default.jpeg";;
    }
    else{
        $uname = "default.jpeg";
    }
    if($password1==$password2){
        $hash=password_hash($password1,PASSWORD_DEFAULT);
        $sql1 = "INSERT INTO users (email, username, password, phone, photo) VALUES ('$email', '$username', '$hash','$phone','$uname')";
    
        try {
            mysqli_query($conn, $sql1);
            $_SESSION['message'] = "You are now registered, Please Login";
            header($path);
            exit();
        } catch (mysqli_sql_exception $e) {
            $_SESSION['message'] = "Error: " . $e->getMessage();
            header($path);
            exit();
        }
    }
    else{
        $_SESSION['message'] = "Password Don't Match";
        header($path);
        exit();
    }
}

mysqli_close($conn);
?>
