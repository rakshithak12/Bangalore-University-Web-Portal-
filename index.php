<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION["login"] === true) {
    $name = $_SESSION['username'];
    $photo = $_SESSION['image_path'];
    $path = !empty($photo) && file_exists("login-register/uploads/{$photo}") ? "login-register/uploads/{$photo}" : 'login-register/uploads/default.jpeg';
    $_SESSION['path'] = $path;
} else {
    $_SESSION["login"] = false;
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/headfoot.css">
    <link rel="icon" href="assets/kn_seal.png" type="image/x-icon">
    <script>
        function loadPage(page) {
            const contentDiv = document.getElementById('content');
            fetch(page + '.php')
                .then(response => {
                    if (!response.ok) throw new Error('Page not found');
                    return response.text();
                })
                .then(html => {
                    contentDiv.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading page:', error);
                    window.location.href = 'login.php';
                });
        }
    </script>
</head>
<body>
<header>
    <span id="main">
        <img src="assets/education (1).png" alt="Bangalore University" class="logo">
        <h2>Bangalore University</h2>
    </span>
    <div class="head">
        <button onclick="loadPage('Home')">Home</button>
        <button onclick="loadPage('about')">About</button>
        <button onclick="loadPage('join')">Join</button>
        <button onclick="loadPage('courses')">Courses</button>
        <button onclick="loadPage('contact')">Contact</button>
        <button onclick="window.location.href='login.php'" class="login">Login</button>
    </div>
</header>
<div id="content">
    <?php
    include('Home.php');
    ?>
</div>
<script>
    if (<?php echo $_SESSION["login"] ? 'true' : 'false'; ?>) {
        const path = "<?php echo $path; ?>";
        const btn = document.querySelector(".login");
        btn.style.display = "none";

        const log = document.querySelector('.head');
        log.innerHTML += `
            <div class="profile-dropdown" id="bt">
                <div class="profile-dropdown-btn">
                    <div class="profile-img">
                        <img onclick="toggle()" src="${path}" style="cursor:pointer;">
                    </div>
                </div>
                <ul class="profile-dropdown-list" id="pdl">
                    <li class="profile-dropdown-list-item">
                        <a href="#">Edit Profile</a>
                    </li>
                    <li class="profile-dropdown-list-item">
                        <a href="reset.php">Reset Password</a>
                    </li>
                    <li class="profile-dropdown-list-item">
                        <a href="index.php?logout=1" class="logout">Log out</a>
                    </li>
                </ul>
            </div>`;
    }

    const profileDropdownList = document.querySelector("#pdl");
    const dropdownBtn = document.querySelector(".profile-dropdown-btn");

    const toggle = () => profileDropdownList.classList.toggle("active");

    window.addEventListener("click", function (e) {
        if (!dropdownBtn.contains(e.target)) {
            profileDropdownList.classList.remove("active");
        }
    });

    function confirmLogout() {
        return confirm('Are you sure you want to log out?');
    }
</script>
<footer>
    <div class="foot">
        <div class="name">
            <h3>Bangalore <span class="Uni">University</span></h3>
            <div class="item">
                <div class="itemw">
                    <div class="row1">
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">Home</a>
                        <a href="#">Terms of Use</a>
                    </div>
                    <div class="row2">
                        <a href="https://www.google.com/maps/dir//Bengaluru+University" target="_blank">Directions</a>
                        <a href="#">Privacy</a>
                    </div>
                    <div class="row3">
                        <a href="#">Search</a>
                        <a href="#">Copyright</a>
                    </div>
                    <div class="row4">
                        <a href="#">Trademarks</a>
                        <a href="#">Accessibility</a>
                    </div>
                </div>
            </div>
            <div class="contact">
                <h4>Contact Us</h4>
                <div class="cont">
                    <div class="r1"><img src="assets/mail.png" alt="mail"><a href="mailto:bangaloreuniversity.edu@gmail.com">bangaloreuniversity.edu@gmail.com</a></div>
                    <div class="r2"><img src="assets/call.png" alt="call"><a href="#">1800 3996 4123</a></div>
                    <div class="r3"><img src="assets/pin.png" alt=""><a href="#">Bangalore</a></div>
                </div>
            </div>
        </div>
    </div>
    <p>&copy; Bangalore University, Govt of Karnataka @ 2024</p>
</footer>
</body>
</html>
