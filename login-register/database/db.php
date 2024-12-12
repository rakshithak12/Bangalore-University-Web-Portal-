<?php
    $db_server="localhost";
    $db_user= "root";
    $db_pass= "";
    $db_name1="university_db";
    $db_name2="student_db";
    $conn="";

    try{
    $conn1=mysqli_connect($db_server,
                        $db_user,
                        $db_pass,
                        $db_name1);
    $conn2=mysqli_connect($db_server,
                        $db_user,
                        $db_pass,
                        $db_name2);
    }

    catch(mysqli_sql_exception){
        echo "could not connect<br>";
    }
?>