
<?php include('partials/sidebar.php'); ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM book WHERE id=$id";
    $res2 = mysqli_query($con, $sql2);
    $row = mysqli_fetch_assoc($res2);

    // Get individual values of selected book
    $id = $row['id'];
    $title = $row['title'];
    $current_image = $row['image'];
    $current_category = $row['category'];
    $author = $row['author'];
    $publication= $row['publication'];
    $isbn = $row['isbn'];
    $copies = $row['copies'];
} else {
    header('Location:' . SITEURL . 'admin/books.php');
}
?>

<div class="ok">
    <h1>Update Book</h1>
    <br>
    <br>
  
    <div class="right">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-head">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" placeholder="Name of the Book"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == '') {
                            echo "<div class='error'>Image not found</div>";
                        } else {
                            // Image available
                        ?>
                            <img src="<?php echo SITEURL; ?>image/<?php echo $current_image; ?>"  width="100px" alt="">
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo 'selected';
                                            } ?> value='<?php echo $category_id; ?>'> <?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value='0'>Category not available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" name="author" value="<?php echo $author; ?>" placeholder="Author of the Book"></td>
                </tr>
                <tr>
                    <td>Publication:</td>
                    <td><input type="text" name="publication" value="<?php echo $publication; ?>" placeholder="Publisher of the Book"></td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type="number" name="isbn" value="<?php echo $isbn; ?>" placeholder=""></td>
                </tr>
                <tr>
                    <td>Copies:</td>
                    <td><input type="number" value="<?php echo $copies; ?>" name="copies" placeholder=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Book" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // 1. Get the data from the form
            $id = $_POST['id'];
            $current_image = $_POST['current_image'];
            $title = $_POST['title'];
            $category = $_POST['category'];
            $publication = $_POST['publication'];
            $isbn = $_POST['isbn'];
            $copies = $_POST['copies'];

            // 2. Upload the selected image 
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != '') {
                    // Rename the image
                    $explodedArray = explode('.', $image_name);
                    $ext = end($explodedArray);
                    $image_name = "Book-Name" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../image/" . $image_name;
                    $upload = move_uploaded_file($source_path, $dest_path);
                    if ($upload == false) {
                        // Failed to upload
                        $_SESSION['upload'] = "<div class='error'>Upload failed</div>";
                        header("Location:" . SITEURL . "admin/books.php");
                        die();
                    }
                    // Remove current image if it exists
                    if ($current_image != '') {
                        // Current image is available
                        $remove_path = "../image/" . $current_image;
                        $remove = unlink($remove_path);
                        // Check if image is removed or not
                        if ($remove == false) {
                            $_SESSION['remove-failed'] = "<div class='error'>Failed removing current image</div>";
                            header("Location:" . SITEURL . "admin/books.php");
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // 3. Update the database
            $sql2 = "UPDATE book SET 
                title='$title',
                author='$author',
                publication='$publication',
                isbn='$isbn',
                copies='$copies',
                image='$image_name', 
                category='$category'
                WHERE id=$id";
            // Execute the query
            $res2 = mysqli_query($con, $sql2);
            if ($res2) {
                // Data updated in the database
                $_SESSION['update'] = "<div class='success'>Book updated successfully</div>";
                header("Location:" . SITEURL . "admin/books.php");
            } else {
                // Failure
                $_SESSION['update'] = "<div class='error'>Failed to update book</div>";
                header("Location:" . SITEURL . "admin/books.php");
            }
        }
        ?>
    </div>
</div>
</section>
