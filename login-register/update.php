<?php
    session_start();
    include("../login-register/database/db.php");
    $id = $_SESSION['user_id'];
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName =$_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $base=generateUniqueId() .'_'. basename($fileName);
        
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $base;
        move_uploaded_file($fileTmpPath, $dest_path);
        $uname = $base;        
    }
    if (isset($_FILES['photo'])){
        $query = "UPDATE users SET email='$email' ,username='$username' ,phone='$phone' ,photo='$uname'  WHERE user_id=$id";    
    }
    else{
        $query = "UPDATE users SET email='$email' ,username='$username' ,phone='$phone'  WHERE user_id=$id";    
    }
    mysqli_query($conn, $query);
    $_SESSION['message'] = "User Details Updated successfully";
    header("Location: ../admin/adminHome.php");
    exit();
?>