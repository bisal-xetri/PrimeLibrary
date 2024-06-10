<?php
include('include/header.php');

if (!isset($_SESSION['username'])) {
    header('location:../studentlogin.php');
    exit();
}

$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
$fullname=$_SESSION['fullname'];

if (isset($_GET['return_id'])) {
    $return_id = $_GET['return_id'];

    $fetch_query = "SELECT * FROM issuebook WHERE id = $return_id";
    $fetch_result = mysqli_query($con, $fetch_query);

    if (!$fetch_result) {
        die("Query failed: " . mysqli_error($con));
    }

    $book_details = mysqli_fetch_assoc($fetch_result);
    $book_id = $book_details['book_id'];
    $bookname = $book_details['bookname'];
    $issuedate = $book_details['issuedate'];
    date_default_timezone_set('Asia/Kathmandu');

    $returndate = date('Y-m-d H:i:s');

    $insert_query = "INSERT INTO returnbook (book_id,studentname, bookname, issuedate, returndate) VALUES ($book_id,'$fullname', '$bookname', '$issuedate', '$returndate')";
    $insert_result = mysqli_query($con, $insert_query);

    if (!$insert_result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Query to remove the book from issuebook table
    $return_query = "DELETE FROM issuebook WHERE id = $return_id";
    $run_return = mysqli_query($con, $return_query);

    if (!$run_return) {
        die("Query failed: " . mysqli_error($con));
    }

    // Redirect back to the same page to refresh the issued books list
    header('location:requests.php');
    exit(); // Add exit() after redirect to prevent further code execution
}

// Query to fetch issued books for the logged-in user
$order_query = "SELECT issuebook.*, book.title, book.image 
                FROM issuebook 
                JOIN book ON issuebook.book_id = book.id
                WHERE issuebook.userid = $user_id";

$run = mysqli_query($con, $order_query);

if (!$run) {
    die("Query failed: " . mysqli_error($con));
}
?>

<div class="account-info">
    Issue information
</div>

<div class="user-information">
    <?php include('include/sidebar.php'); ?>

    <div class="user-detail-info">
        <h1>Issued Books</h1>
        
        
        <?php
        if (mysqli_num_rows($run) > 0) {
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>
         
            <table class="order-table">
                <tr>
                    <th>Book Cover</th>
                    <th>Book Name</th>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Remaining Days</th>
                    <th>Fine</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $img1 = $row['image'];
                    $issuedate = $row['issuedate'];
                    $issuereturn = $row['issuereturn'];
                    $remaining_days = $row['remaining_days'];
                    $fine = $row['fine'];
                ?>
                    <tr>
                        <td>
                            <img class="order-img" src="../image/<?php echo $img1; ?>" alt="<?php echo $title; ?>">
                        </td>
                        <td>
                            <h4><?php echo $title; ?></h4>
                        </td>
                        <td>
                            <?php echo $issuedate; ?>
                        </td>
                        <td>
                            <?php echo $issuereturn; ?>
                        </td>
                        <td>
                            <?php echo $remaining_days; ?>
                        </td>
                        <td>
                            Rs.<?php echo $fine; ?>
                        </td>
                        <td>
                            <a class="btn-return" href="?return_id=<?php echo $id; ?>">Return</a>
                           
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        } else {
            echo "<h4>You haven't issued anything yet </h4>";
        }
        ?>
    </div>
</div>

<?php include('include/footer.php') ?>