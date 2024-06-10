
<?php include('partials/sidebar.php'); ?>
<div class="ok">
    <h1>Manage Books</h1>
    
    <a class="add" href="addbook.php">Add Book</a>
  
    <div class="right">
        <table class="tbl-head">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Author</th>
                <th>Publication</th>
                <th>ISBN</th>
                <th>Copies</th>
                <th >Actions</th>
            </tr>
            <?php
            // Create SQL query to get all books
            $sql = "SELECT b.*, c.title AS category_title FROM book b
                    LEFT JOIN tbl_category c ON b.category = c.id";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                $sn=1;
                // We have data in the database
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image'];
                    $category_title = $row['category_title'];
                    $author = $row['author'];
                    $publication= $row['publication'];
                    $isbn = $row['isbn'];
                    $copies = $row['copies'];
                    ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                            // Check whether image is available or not
                            if ($image_name != "") {
                                // Display the image
                                ?>
                                <img src="../image/<?php echo $image_name; ?>" width="100px">
                                <?php
                            } else {
                                // Display a message
                                echo "<div class='error'>Image not added.</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $category_title; ?></td>
                        <td><?php echo $author; ?></td>
                        <td><?php echo $publication; ?></td>
                        <td><?php echo $isbn; ?></td>
                        <td><?php echo $copies; ?></td>
                        <td>
                    
                        <a class="btn-secondary book-update" href="<?php echo SITEURL; ?>admin/update-book.php?id=<?php echo $id; ?>">Edit Book</a>
                        
                            <a class="btn-danger book-update" href="<?php echo SITEURL; ?>admin/delete-book.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Del Book</a>
                            </td>
                            
                    </tr>
                    <?php
                }
            } else {
                // We do not have data in the database
                ?>
                <tr>
                    <td colspan="7"><div class="error">No Books Added Yet.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</section>
<?php include('partials/footer.php'); ?>
