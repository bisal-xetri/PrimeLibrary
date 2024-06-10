<?php
include('../config/constant.php'); 

date_default_timezone_set('UTC'); 


function updateFinesAndRemainingDays($con) {
    
    $utc_time = time();

    $nepal_time = $utc_time + (5 * 3600) + (45 * 60);

    // Fetch all issued books
    $sql_fetch_issued_books = "SELECT * FROM issuebook";
    $result_fetch_issued_books = mysqli_query($con, $sql_fetch_issued_books);

    if ($result_fetch_issued_books && mysqli_num_rows($result_fetch_issued_books) > 0) {
        while ($row = mysqli_fetch_assoc($result_fetch_issued_books)) {
            $id = $row['id'];
            $issuereturn = $row['issuereturn'];
            $fine = 0;

   
            $remaining_days = (strtotime($issuereturn) - $nepal_time) / (60 * 60 * 24);
            $remaining_days = floor($remaining_days);

     
            if ($nepal_time > strtotime($issuereturn)) {
           
                $days_overdue = ($nepal_time - strtotime($issuereturn)) / (60 * 60 * 24);

               
                if ($days_overdue <= 5) {
              
                    $fine = 10; 
                } else {
                    // After 5 days
                    $fine = 10 + (2 * ($days_overdue - 5)); // Flat fine of ₹10 + ₹2 for each day overdue after 5 days
                }
            }


            $sql_update_fine_and_days = "UPDATE issuebook SET fine = $fine, remaining_days = $remaining_days WHERE id = $id";
            mysqli_query($con, $sql_update_fine_and_days);
        }
    }
}


updateFinesAndRemainingDays($con);


$_SESSION['fine_update'] = "<div class='success'>Fines and remaining days updated successfully.</div>";
header("Location:" . SITEURL . "admin/issue-report.php");
?>
