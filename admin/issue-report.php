<?php include('partials/sidebar.php'); ?>
<div class="ok">
    <h1>Issued Books</h1>
    <br/><br/>
   
    <a  href="<?php echo SITEURL; ?>admin/update-fines.php" class="btn-secondary">Update Fine</a>
    <br/><br/>
  
    <div class="right">
        <table class="tbl-head">
            <tr>
                <th>Student Name</th>
                <th>Book Name</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Remaining Days</th>
                <th>Fine</th>
                
            </tr>
            <?php
            // Create SQL query to get all requested books
            $sql = "SELECT * FROM issuebook";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // We have data in the database
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['username'];
                    $bookname = $row['bookname'];
                    $issuedate = $row['issuedate'];
                    $issuereturn=$row['issuereturn'];
                    $remaining_days=$row['remaining_days'];
                    $fine=$row['fine'];
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $bookname; ?></td>
                        <td><?php echo $issuedate; ?></td>
                        <td><?php echo $issuereturn; ?></td>
                        <td><?php echo $remaining_days; ?></td>
                        <td>Rs.<?php echo $fine; ?></td>
                        
                    </tr>
                    <?php
                }
            } else {
                // We do not have data in the database
                ?>
                <tr>
                    <td colspan="5"><div class="error">No Books Issued Yet.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</section>
