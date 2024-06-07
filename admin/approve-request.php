<?php
include('partials/sidebar.php');

// Include necessary files and setup database connection
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    $sql_select_request = "SELECT * FROM requestbook WHERE id = $request_id";
    $result_select_request = mysqli_query($con, $sql_select_request);

    if ($result_select_request && mysqli_num_rows($result_select_request) > 0) {
        $row = mysqli_fetch_assoc($result_select_request);

        $userid = $row['userid'];
        $book_id = $row['book_id'];
        $username = $row['username'];
        $bookname = $row['bookname'];
        $request_date = $row['request_date'];

        $sql_delete_request = "DELETE FROM requestbook WHERE id = $request_id";
        $result_delete_request = mysqli_query($con, $sql_delete_request);

        date_default_timezone_set('Asia/Kathmandu'); // Set timezone to Nepal Time

        $issue_date = date("Y-m-d H:i:s"); // Current date and time in Nepal

        $return_date = date("Y-m-d H:i:s", strtotime("+30 days")); // Return date 30 days from now

        // Calculate remaining days
        $remaining_days = (strtotime($return_date) - strtotime($issue_date)) / (60 * 60 * 24);

        $fine = 0;

        // Only calculate fine if current date is past the return date
        if (time() > strtotime($return_date)) {
            $days_overdue = (time() - strtotime($return_date)) / (60 * 60 * 24);

            if ($days_overdue <= 5) {
                $fine = 10 * $days_overdue;
            } else {
                $fine = (10 * 5) + (50 * ($days_overdue - 5));
            }
        }

        if ($result_delete_request) {
            // Insert the data into issuebook table
            $sql_insert_issue = "INSERT INTO issuebook (userid, book_id, username, bookname, issuedate, issuereturn, remaining_days, fine) 
                                 VALUES ($userid, $book_id, '$username', '$bookname', '$issue_date', '$return_date', $remaining_days, $fine)";
            $result_insert_issue = mysqli_query($con, $sql_insert_issue);

            if ($result_insert_issue) {
                // Issue approved successfully
                header("Location:" . SITEURL . "admin/book-request.php");
            } else {
                // Error inserting into issuebook table
                echo "Error: " . mysqli_error($con);
            }
        } else {
            // Error deleting request data
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Request ID not found
        echo "Request ID not found.";
    }
} else {
    // Request ID not provided
    echo "Request ID not provided.";
}
?>
