<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION["message"]);

if(isset($_SESSION['login']) && $_SESSION["login"] === true) {
    $name = $_SESSION['username'];
    $photo = $_SESSION['image_path'];
    $path = !empty($photo) && file_exists("../login-register/uploads/{$photo}") ? "../login-register/uploads/{$photo}" : '../login-register/uploads/default.jpeg';
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/admin.css">
    <link rel="icon" href="../assets/kn_seal.png" type="image/x-icon">
    <title>Admin - Bangalore University</title>
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
        <img src="../assets/education (1).png" alt="Bangalore University" class="logo">
        <h2>Bangalore University Database</h2>
    </span>
    <div class="head">
        <button onclick="loadPage('home')">Home</button>
        <!--<button onclick="loadPage('insert')">Add User</button>-->
        <button onclick="loadPage('cards')">Registered Users</button>
        <button onclick="loadPage('results')">View Results</button>
        <button onclick="confirmLogout(this)" class="login">Logout</button>
    </div>
</header>
<div id="content">
    <?php
    include('home.php');
    ?>
</div>
<script>
    // if (<?php echo $_SESSION["login"] ? 'true' : 'false'; ?>) {
    //     const path = "<?php echo $path; ?>";
        // const btn = document.querySelector(".login");
        // btn.style.display = "none";

    //     const log = document.querySelector('.head');
    //     log.innerHTML += `
    //         <div class="profile-dropdown" id="bt">
    //             <div class="profile-dropdown-btn" onclick="toggle()">
    //                 <div class="profile-img">
    //                     <img src="${path}" style="cursor:pointer;">
    //                 </div>
    //                 <div class="second" style="cursor:pointer;">
    //                     <h4>Admin</h4>
    //                 </div>
    //             </div>
    //             <ul class="profile-dropdown-list" id="pdl">
    //                 <li class="profile-dropdown-list-item">
    //                     <a href="reset.html">Reset Password</a>
    //                 </li>
    //                 <li class="profile-dropdown-list-item">
    //                     <a href="" class="logout" onclick='confirmLogout(this)'>Log out</a>
    //                 </li>
    //             </ul>
    //         </div>`;
    // }

    // const profileDropdownList = document.querySelector("#pdl");
    // const dropdownBtn = document.querySelector(".profile-dropdown-btn");

    // const toggle = () => profileDropdownList.classList.toggle("active");

    // window.addEventListener("click", function (e) {
    //     if (!dropdownBtn.contains(e.target)) {
    //         profileDropdownList.classList.remove("active");
    //     }
    // });

    // if ("<?php echo addslashes($message); ?>" !== "") {
    //     const msg="<?php echo addslashes($message); ?>";
    //     if(msg=="You are now registered, Please Login"){
    //         alert("User Added");
    //     }
	// 	else{
    //         alert("<?php echo addslashes($message); ?>");
	// 	}
	// }

    function confirmLogout(a) {
        const val=confirm('Are you sure you want to log out?');
        if(val){
            window.location.href = "../index.php?logout=1";
        }
    }
</script>
</body>
</html>
