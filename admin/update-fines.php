<?php
include('../config/constant.php'); // Include your database configuration file

date_default_timezone_set('UTC'); // Set timezone to UTC

// Function to update fines and remaining days
function updateFinesAndRemainingDays($con) {
    // Get current UTC time
    $utc_time = time();
    // Add 5 hours and 45 minutes to convert to Nepal Standard Time
    $nepal_time = $utc_time + (5 * 3600) + (45 * 60);

    // Fetch all issued books
    $sql_fetch_issued_books = "SELECT * FROM issuebook";
    $result_fetch_issued_books = mysqli_query($con, $sql_fetch_issued_books);

    if ($result_fetch_issued_books && mysqli_num_rows($result_fetch_issued_books) > 0) {
        while ($row = mysqli_fetch_assoc($result_fetch_issued_books)) {
            $id = $row['id'];
            $issuereturn = $row['issuereturn'];
            $fine = 0;

            // Calculate remaining days
            $remaining_days = (strtotime($issuereturn) - $nepal_time) / (60 * 60 * 24);
            $remaining_days = floor($remaining_days);

            // Check if the current time is past the return date
            if ($nepal_time > strtotime($issuereturn)) {
                $days_overdue = ($nepal_time - strtotime($issuereturn)) / (60 * 60 * 24);

                if ($days_overdue <= 5) {
                    $fine = 10 * $days_overdue;
                } else {
                    $fine = (10 * 5) + (50 * ($days_overdue - 5));
                }
            }

            // Update the fine and remaining days in the database
            $sql_update_fine_and_days = "UPDATE issuebook SET fine = $fine, remaining_days = $remaining_days WHERE id = $id";
            mysqli_query($con, $sql_update_fine_and_days);
        }
    }
}

// Update fines and remaining days
updateFinesAndRemainingDays($con);

// Redirect back to the issue report page with a success message
$_SESSION['fine_update'] = "<div class='success'>Fines and remaining days updated successfully.</div>";
header("Location:" . SITEURL . "admin/issue-report.php");
?>
