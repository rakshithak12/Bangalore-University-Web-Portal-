<?php
session_start();
$username=$_SESSION['username'];
include("login-register\database\db.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $username";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/cards.css">
    <title>Results - Bangalore University</title>
</head>
<body>
    <div class="cards">
        <div class="card1">
            <div class="s1 card">
                <h1>RESULTS</h1>
            </div>
            <center>
                <hr>
            </center>
            <div class="r2 card">
                <?php
                    if ($result->num_rows > 0) {
                        echo "<table border='1'>";
    echo "<tr>
            <th>S.No</th>
            <th>Subject</th>
            <th>Max</th>
            <th>Min</th>
            <th>Scored</th>
            <th>Internal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Credits</th>
            <th>Grade</th>
          </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='row-" . $row['sno'] . "'>";
        echo "<td>" . $row['sno'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['max'] . "</td>";
        echo "<td>" . $row['min'] . "</td>";
        echo "<td>" . $row['scored'] . "</td>";
        echo "<td>" . $row['internal'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['credits'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
                        }
                        echo "</table><br>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <script>
        function confirmDelete(a) {
            const val=confirm('Are you sure you want to Delete this User?');
            if(val){
                const elem = a.closest('form');
                elem.action='../login-register/delete.php';
            }
        }
    </script>
</body>
</html>