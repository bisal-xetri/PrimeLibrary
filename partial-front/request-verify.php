<?php
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $student_id = $_SESSION['id'];

    $book_id = isset($id) ? $id : null; 
    $request_exists = false;
    $issued = false;

    if ($book_id) {
        // Check if the book is requested
        $sql_check_request = "SELECT * FROM requestbook WHERE userid='$student_id' AND book_id='$book_id'";
        $res_check_request = mysqli_query($con, $sql_check_request);

        if ($res_check_request && mysqli_num_rows($res_check_request) > 0) {
            $request_exists = true;
        }

        // Check if the book is issued
        $sql_check_issued = "SELECT * FROM issuebook WHERE userid='$student_id' AND book_id='$book_id'";
        $res_check_issued = mysqli_query($con, $sql_check_issued);

        if ($res_check_issued && mysqli_num_rows($res_check_issued) > 0) {
            $issued = true;
        }

    
        $sql_count_requests = "SELECT COUNT(*) AS total_requests FROM requestbook WHERE userid='$student_id'";
        $res_count_requests = mysqli_query($con, $sql_count_requests);
        $row_count_requests = mysqli_fetch_assoc($res_count_requests);
        $total_requests = $row_count_requests['total_requests'];

     
        $sql_count_issued = "SELECT COUNT(*) AS total_issued FROM issuebook WHERE userid='$student_id'";
        $res_count_issued = mysqli_query($con, $sql_count_issued);
        $row_count_issued = mysqli_fetch_assoc($res_count_issued);
        $total_issued = $row_count_issued['total_issued'];

     
        $request_limit_reached = ($total_requests >= 3);

        
        $issue_limit_reached = ($total_issued >= 3);
   $sql_get_copies = "SELECT copies FROM book WHERE id='$book_id'";
        $res_get_copies = mysqli_query($con, $sql_get_copies);
        $row_copies = mysqli_fetch_assoc($res_get_copies);
        $copies_available = $row_copies['copies'];

       
        $book_available = ($copies_available > 0 && !$request_exists && !$issued && $total_requests + $total_issued < 3);
    }
?>

<div class="borrow">
    <?php if ($issued) { ?>
        <span class="btn-success">Issued</span>
    <?php } elseif ($request_exists) { ?>
        <span class="btn-success">Requested</span>
    <?php } elseif ($request_limit_reached || $issue_limit_reached || !$book_available) { ?>
        <span class="error">Request Limit Reached</span>
    <?php } else { ?>
        <a href="<?php echo SITEURL; ?>request.php?book_id=<?php echo $book_id; ?>">Book Request</a>
    <?php } ?>
</div>

<?php
}
?>
