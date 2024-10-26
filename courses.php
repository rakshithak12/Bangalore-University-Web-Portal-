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
    <link rel="stylesheet" href="styles/courses.css">
    <title>Courses - Bangalore University</title>
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
<h1>Courses Offered <br> by <br><span style="color:#8F1717">Bangalore University</span><img src="..\assets\logo.png" alt=""></h1>
    <div class="join">
        <hr>
        <div class="eligible">
            <h2>UG Courses</h2>
            <ul>
                <li>Bachelor of Arts (BA)</li>
                <li>Bachelor of Commerce (B.Com)</li>
                <li>Bachelor of Science (B.Sc)</li>
                <li>Bachelor of Education (B.Ed)</li>
                <li>Bachelor of Computer Applications</li>
                <li>Bachelor of Engineering</li>
                <li>Bachelor Of Technology</li>
                <li>Bachelor of Business Administration</li>
                <li>Bachelor of Library and Information Science (BLIS)</li>

            </ul>
        </div>
        <hr>
        <div class="selection">
            <h2>PG Courses</h2>
            <ul>
                <li>Master of Arts (M.A)</li>
                <li>Master of Commerce (M.Com)</li>
                <li>Master of Science (M.Sc)</li>
                <li>Master of Education (M.Ed)</li>
                <li>Master of Library and Information Science (MLIS)</li>
                <li>Master of Business Administration</li>
                <li>Master of Computer Applications</li>
                <li>Master of Engineering</li>
                <li>Master of Technology</li>
            </ul>
        </div>
        <hr>
        <div class="std">
            <h2>Other Courses</h2>
            <ul>
                <li>Diploma courses in various Fields</li>
                <li>Integrated Courses (UG+PG)</li>
                <li>Doctoral Programs (Ph.D)</li>
                <li>Cardiovascular Technology (admission based on merit)</li>
            </ul>
        </div>
        <hr>
        <div class="docs">
            <h2>Popular Courses</h2>
            <ul>
                <li>Bachelor of Arts (BA) Criminology</li>
                <li>Master of Computer Applications (MCA)</li>
                <li>Master of Science (M.Sc) Environment Science</li>
                <li>MBA/PGDM</li>
            </ul>
        </div>
    </div>
</body>
</html>
<?php
    include("headfoot/Footer.html")
?>