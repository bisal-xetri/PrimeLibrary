<?php

include('partials/sidebar.php');
?>
<div class="ok">
    <h1>Add Student</h1>
    <br>
    <br>
    <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    ?>
    <div class="right">
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-head">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="enter your name" id=""></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Your username" id=""></td>
            </tr>
            <tr>
                <td>Faculty:</td>
                <td><input type="text" name="faculty" placeholder="Your faculty" id=""></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder=" Your email" id=""></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><input type="text" name="phone" placeholder=" Your phone number" id=""></td>
            </tr>
            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder=" Your password" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Student" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $faculty = $_POST['faculty'];
    $password = sha1($_POST['password']);

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $explodedArray = explode('.', $image_name);
            $ext = end($explodedArray);
            $image_name = "book" . rand(000, 999) . "." . $ext;
            $src = $_FILES['image']['tmp_name'];
            $dst = "../image/" . $image_name;

            $upload = move_uploaded_file($src, $dst);
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Upload Failed</div>";
                header("Location:" . SITEURL . "admin/add-student.php");
                die();
            } else {
                echo "Image uploaded successfully: " . $image_name; // Debugging statement
            }
        }
    } else {
        $image_name = "";
    }

    $sql = "INSERT INTO student SET 
        fullname = '$full_name',
        username = '$username',
        password = '$password',
        email = '$email',
        phone = '$phone',
        faculty = '$faculty',
        image = '$image_name'
    ";

    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    if ($res) {
        $_SESSION['add'] = "<div class='success'>Student added successfully</div>";
        header('location:' . SITEURL . 'admin/manage-student.php');
    } else {
        $_SESSION['add'] = 'Failed to add student';
        header('location:' . SITEURL . 'admin/manage-student.php');
    }

    echo "SQL Query: " . $sql; // Debugging statement
}
?>
