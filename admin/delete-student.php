<?php
include('../config/constant.php');
//1getthe id of the admin
$id = $_GET['id'];

//2. create  sql statement
$sql = "DELETE FROM student WHERE id=$id";
//execute sql statement
$res = mysqli_query($con, $sql);
if ($res) {
    //echo "Successfully deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Student deleted successfully.</div>";
    //redirect back to manage admin
    header('Location:' . SITEURL . 'admin/manage-student.php');
} else {
    //echo "Failed to delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete Student. Try again</div>";
    header('Location:' . SITEURL . 'admin/manage-student.php');
}
//3. redirect to admin manage page with message (sucessfully/error)
