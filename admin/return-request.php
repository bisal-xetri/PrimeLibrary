<?php
include('partials/sidebar.php');

// Check if the approve button is clicked and the book ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to remove the book from returnbook table
    $delete_query = "DELETE FROM returnbook WHERE id = $id";
    $delete_result = mysqli_query($con, $delete_query);

    if (!$delete_result) {
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
