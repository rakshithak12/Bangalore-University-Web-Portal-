<?php
session_start();
include("../login-register/database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the username from the form (passed as a hidden value)
    $username = $_POST['username'];

    // Loop through the submitted data arrays and update the respective records
    $subjects = $_POST['subject'];
    $max = $_POST['max'];
    $min = $_POST['min'];
    $scored = $_POST['scored'];
    $internal = $_POST['internal'];
    $total = $_POST['total'];
    $status = $_POST['status'];
    $credits = $_POST['credits'];
    $grade = $_POST['grade'];

    $update_success = true; // Track overall success

    // Loop through each record to update
    for ($i = 0; $i < count($subjects); $i++) {
        // Prepare the SQL query to update the record
        $sql = "UPDATE `$username` SET 
                subject = ?, 
                max = ?, 
                min = ?, 
                scored = ?, 
                internal = ?, 
                total = ?, 
                status = ?, 
                credits = ?, 
                grade = ? 
                WHERE sno = ?";

        // Prepare the statement
        $stmt = $conn2->prepare($sql);
        $sno = $i + 1;
        // Bind parameters to the prepared statement
        $stmt->bind_param("siiiiisiii", 
            $subjects[$i], 
            $max[$i], 
            $min[$i], 
            $scored[$i], 
            $internal[$i], 
            $total[$i], 
            $status[$i], 
            $credits[$i], 
            $grade[$i],
            $sno
        );

        // Execute the query
        if (!$stmt->execute()) {
            // If there is an error during the update, set the success flag to false
            $_SESSION['error_message'] = "Error updating record for S.No " . ($i + 1) . ": " . $conn2->error;
            $update_success = false;
            break; // Exit the loop if one update fails
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn2->close();

    // Set a success message if all updates are successful
    if ($update_success) {
        $_SESSION['success_message'] = "Records updated successfully!";
    }

    // Redirect back to the results page with a success or error message
    header("Location: ../admin/results.php?username=$username");
    exit();
}
?>
