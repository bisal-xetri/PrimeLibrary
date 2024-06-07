
<?php include('partials/sidebar.php'); ?>

<div class="ok">
    <h1>Update Category</h1>
    <div class="right">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Create SQL query to get category details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $title = $row['title'];
                $current_image = $row['image'];
                $featured = $row['feature'];
                $active = $row['active'];
            } else {
                // Redirect to manage category with error message
                $_SESSION['no-category-found'] = "<div class='error'>No category found</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        } else {
            // Redirect to manage category page
            header('Location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-head">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display the current image
                            ?>
                            <img src="<?php echo SITEURL; ?>image/<?php echo $current_image; ?>" width="100px" alt="">
                            <?php
                        } else {
                            // Display the message
                            echo "<div class='error'>Image not found</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // Get the data from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check whether the selected image is clicked or not
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    // Get the extension of the image
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    // Rename the image
                    $image_name = "book_category" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../image/" . $image_name;
                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header("Location:" . SITEURL . "admin/manage-category.php");
                        die();
                    }
                    // Remove the current image if available
                    if ($current_image != '') {
                        $remove_path = "../image/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            header("Location:" . SITEURL . "admin/manage-category.php");
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                title='$title', 
                image='$image_name', 
                feature='$featured', 
                active='$active' 
                WHERE id=$id";
            $res2 = mysqli_query($con, $sql2);
            if ($res2) {
                $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        }
        ?>
    </div>
</div>
</section>
