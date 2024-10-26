<?php
    include("headfoot/Header.html");
    session_start();
    if($_SESSION['login']){
        $name=$_SESSION['username'];
        $photo=$_SESSION['image_path'];
        $role=$_SESSION['role'];
        $photo=$_SESSION['path'];
        if(isset($_POST["logout"])){
            session_destroy();
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/contact.css">
    <title>Contact - Bangalore University</title>
    <script>
        if(<?php echo $_SESSION['login']?>){
            var b=document.getElementById('home');
            b.href="<?php echo $_SESSION['role']?>Home.php";
            var a=document.getElementById('login');
            a.innerHTML=`
                <div class="profile-dropdown">
                    <div class="profile-dropdown-btn">
                        <div class="profile-img">
                            <img onclick="toggle()" src="<?php echo $photo ?>">
                        </div>
                    </div>
                    <ul class="profile-dropdown-list">
                        <li class="profile-dropdown-list-item">
                            <a href="#">Edit Profile</a>
                        </li>
                        <li class="profile-dropdown-list-item">
                            <a href="reset.php">Reset Password</a>
                        </li>
                        <li class="profile-dropdown-list-item">
                            <form action="userHome.php" method="post">
                                <button type="submit" value="logout" name="logout">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>`;
            a.onclick=" ";
            a.style.border="none";
            a.style.margin="";
            a.style.padding="0";
            a.style.width="40px";
        }
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
            let btn = document.querySelector(".profile-dropdown-btn");

            let classList = profileDropdownList.classList;

            const toggle = () => classList.toggle("active");

            window.addEventListener("click", function (e) {
                if (!btn.contains(e.target)) classList.remove("active");
            });
    </script>
</head>
<body>
    <div class="section1">
        <h1>Contact Us</h1>
        <h3>General Contact Information</h3>
        <div class="cards">
            <div class="card1">
                <div class="s1 card">
                    <img src="assets/call-black.png" alt="call">
                    <h3>TELEPHONE</h3>
                </div>
                <hr>
                <div class="r2 card">
                    <h3>Campus Operator</h3>
                    <p>1800-3996-4123</p>
                </div>
            </div>
            <div class="card2">
                <div class="s2 card">
                    <img src="assets/email-black.png" alt="mail">
                    <h3>E-MAIL</h3>
                </div>
                <hr>
                <div class="r2 card">
                    <h3>Mail To</h3>
                    <p>bangaloreuniversity.edu@gmail.com</p>
                </div>
            </div>
            <div class="card3">
                <div class="s3 card">
                    <img src="assets/pin-black.png" alt="location">
                    <h3>LOCATION</h3>
                </div>
                <hr>
                <div class="r3 card">
                    <h3>Primary Address</h3>
                    <p>Bangalore University, Jnana Bharathi Campus, Mysore Road, Bengaluru, Karnataka 560056</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    include("headfoot/Footer.html")
?>