<?php
    include "../login-register/database/db.php";
    if ($conn1->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
    }
    
    $sql1 = "SELECT count(*) as total FROM users where role='user'";
    $result1 = $conn1->query($sql);

    $sql2 = "SELECT count(*) as total FROM results";
    $result2 = $conn2->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/adminhome.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="section1">
        <br><br><br><br><br><br><br><br><br><br>
        <div class="cards">
            <div class="card1">
                <div class="s1 card">
                    <h2>Total Registered Users</h2>
                </div>
                <hr>
                <div class="r2 card">
                    <h3><?php echo "$user_total" ?></h3>
                </div>
            </div>
            <div class="card2">
                <div class="s2 card">
                    <h2>Total Results</h2>
                </div>
                <hr>
                <div class="r2 card">
                    <h3><?php echo "$res_total" ?></h3>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
