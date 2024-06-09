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

        date_default_timezone_set('Asia/Kathmandu');

        $issue_date = date("Y-m-d H:i:s"); 

        $return_date = date("Y-m-d H:i:s", strtotime("+30 days")); 

        $remaining_days = (strtotime($return_date) - strtotime($issue_date)) / (60 * 60 * 24);

        $fine = 0;

        if ($result_delete_request) {
            // Decrease copies value in the book table
            $sql_update_book = "UPDATE book SET copies = copies - 1 WHERE id = $book_id";
            $result_update_book = mysqli_query($con, $sql_update_book);

            if ($result_update_book) {
                $sql_insert_issue = "INSERT INTO issuebook (userid, book_id, username, bookname, issuedate, issuereturn, remaining_days, fine) 
                                     VALUES ($userid, $book_id, '$username', '$bookname', '$issue_date', '$return_date', $remaining_days, $fine)";
                $result_insert_issue = mysqli_query($con, $sql_insert_issue);

                if ($result_insert_issue) {
                    header("Location:" . SITEURL . "admin/book-request.php");
                    exit; // Add exit to prevent further execution
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Error updating book copies: " . mysqli_error($con);
            }
        } else {
            echo "Error deleting request: " . mysqli_error($con);
        }
    } else {
        echo "Request ID not found.";
    }
} else {
    echo "Request ID not provided.";
}
?>
