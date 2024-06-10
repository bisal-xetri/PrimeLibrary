<?php
include('partials/sidebar.php');

// Check if the approve button is clicked and the book ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve book information from returnbook table before deleting the entry
    $return_book_query = "SELECT book_id FROM returnbook WHERE id = $id";
    $return_book_result = mysqli_query($con, $return_book_query);

    if (!$return_book_result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($return_book_result);
    $book_id = $row['book_id'];

    // Query to remove the book from returnbook table
    $delete_query = "DELETE FROM returnbook WHERE id = $id";
    $delete_result = mysqli_query($con, $delete_query);

    if (!$delete_result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Update the copies value in the book table
    $update_copies_query = "UPDATE book SET copies = copies + 1 WHERE id = $book_id";
    $update_copies_result = mysqli_query($con, $update_copies_query);

    if (!$update_copies_result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Redirect back to the same page to refresh the returned books list
    header('location:' . SITEURL . 'admin/return-request.php');
    exit(); // Add exit() after redirect to prevent further code execution
}
?>

<div class="ok">
    <h1>Returned Books</h1>
    <br/><br/>
    <div class="right">
        <table class="tbl-head">
            <tr>
                <th>S.N.</th>
                <th>Student Name</th>
                <th>Book Name</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM returnbook";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                $sn=1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['studentname'];
                    $bookname = $row['bookname'];
                    $return_date = $row['returndate'];
                    ?>
                    <tr>
                    <td><?php echo $sn++; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $bookname; ?></td>
                        <td><?php echo $return_date; ?></td>
                        <td>
                            <a class="btn-secondary" href="?id=<?php echo $id; ?>">Approve</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5"><div class="error">No Books Returned Yet.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</section>
<?php include('partials/footer.php'); ?>