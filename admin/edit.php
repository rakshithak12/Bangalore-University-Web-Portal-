<?php
    session_start();
    include("../login-register/database/db.php");
    $id=$_POST['user_id'];
    $_SESSION['user_id']=$id;
    $sql = "SELECT * FROM users where user_id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['img_id']=$row['photo'];
?>
<html>
<head>
    <title>Edit</title>
</head>
<style>
    *{
        font-size: 1.1rem;
        font-family: Arial, Helvetica, sans-serif;
    }
    h1{
        font-size: 40px;
    }
    table{
        border-collapse: collapse;
    }
    th, td {
        padding: 15px;
        text-align: left;
    }
    .btns input{
        border: none;
        padding: 10px;
        border-radius: 50px;
        margin: 10px;
        cursor: pointer;
    }
    #cancel{
        background-color: red;
        color: white;
    }
    #update{
        border: 1px solid #8F1717;
    }
</style>
<body>
    <br><br>
    <center>
        <h1>EDIT</h1>
        <form action="../login-register/update.php" method="post" enctype="multipart/form-data">
            <table border="1">
            <td><label>Email:</label></td>
            <td><input type="text" name="email" value="<?php echo $row['email']?>"></td>
            <tr>
            <td><label>Username:</label></td>
            <td><input type="text" name="username" value="<?php echo $row['username']?>"></td>
            </tr>
            <tr>
            <td><label>Phone:</label></td>
            <td><input type="number" name="phone" value="<?php echo $row['phone']?>"></td>
            </tr>
            <tr>
                <td><label>Profile Image:</label></td>
                <td><input type="file" name="photo" accept="image/jpg,image/jpeg,image/png" id="pp"></td>
            </tr>
            <tr>
                <td colspan="2" class="btns">
                    <center><input type="button" onclick="window.location.href='adminHome.php'" value="Cancel" id="cancel"><input type="submit" value="Update" id="update"></center>
                </td>
            </tr>
        </table>
        </form>
    </center>
</body>
</html>
