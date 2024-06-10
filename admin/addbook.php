
<?php include('partials/sidebar.php'); ?>
<div class="ok">
    <h1>Add Book</h1>
    <br>
    <br>
    <div class="right">
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-head">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Name of the Book"></td>
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
                            // Create SQL to get all the categories
                            $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                            $res = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_array($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                // No categories found
                                echo "<option value='0'>No category Found!</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" name="author" placeholder="Author of the Book"></td>
                </tr>
                <tr>
                    <td>Publication:</td>
                    <td><input type="text" name="publication" placeholder="Publisher of the Book"></td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type="number" name="isbn" placeholder=""></td>
                </tr>
                <tr>
                    <td>Copies:</td>
                    <td><input type="number" min="0" name="copies" placeholder=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Book" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // 1. Get the data from the form
            $title = $_POST['title'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $publication= $_POST['publication'];
            $isbn = $_POST['isbn'];
            $copies = $_POST['copies'];

            // 2. Upload the selected image 
            if (isset($_FILES['image']['name'])) {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];
                // Check whether image is selected or not, upload only if selected
                if ($image_name != "") {
                    // Image selected
                    // a. Rename the selected image
                    $explodedArray = explode('.', $image_name);
                    $ext = end($explodedArray);
                    // Create a new name for the image
                    $image_name = "book" . rand(000, 999) . "." . $ext;

                    // b. Upload the selected image
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../image/" . $image_name;
                    $upload = move_uploaded_file($src, $dst);
                    // Check whether the image is uploaded successfully or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Upload Failed</div>";
                        header("Location:" . SITEURL . "admin/addbook.php");
                        die();
                    }
                }
            } else {
                // Setting default values as blank
                $image_name = "";
            }

            // 3. Insert into the database
            // Create SQL query
            $sql2 = "INSERT INTO book SET 
             title='$title',
             author='$author',
             publication='$publication',
             isbn='$isbn',
             copies='$copies',
             image='$image_name', 
             category='$category'
             ";
            // Execute the query
            $res2 = mysqli_query($con, $sql2);
            if ($res2) {
                // Data inserted into the database
                $_SESSION['add'] = "<div class='success'>Book added successfully</div>";
                header("Location:" . SITEURL . "admin/books.php");
            } else {
                // Failure
                $_SESSION['add'] = "<div class='error'>Failed to add book</div>";
                header("Location:" . SITEURL . "admin/books.php");
            }
        }
        ?>
    </div>
</div>
</section>

<?php include('partials/footer.php'); ?>
