<?php include('partials/sidebar.php'); ?>
<div class="ok">
    <h1>Requested Books</h1>
    <br/><br/>
    <div class="right">
        <table class="tbl-head">
            <tr>
                <th>S.N.</th>
                <th>Student Name</th>
                <th>Book Name</th>
                <th>Request Date</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM requestbook";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $name = $row['username'];
                    $bookname = $row['bookname'];
                    $request_date = $row['request_date'];
                    ?>
                    <tr>
                     <td><?php echo $sn++;?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $bookname; ?></td>
                        <td><?php echo $request_date; ?></td>
                        <td>
                            <a class="btn-secondary" href="<?php echo SITEURL; ?>admin/approve-request.php?id=<?php echo $id; ?>">Approve</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
               
                ?>
                <tr>
                    <td colspan="4"><div class="error">No Books Requested Yet.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</section>
<?php include('partials/footer.php'); ?>
