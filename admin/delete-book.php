<?php

 include('partials/sidebar.php'); 
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //echo "process to delete";
    //1.get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //check image name AVAILAVLE DELETING if available
    if ($image_name != '') {
        $path = "../image/" . $image_name;
        //remove image from folder
        $remove = unlink($path);
        if ($remove == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
            header("Location:" . SITEURL . "admin/books.php");
            die();
        }
    }
    $sql = "DELETE FROM book WHERE id=$id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Book deleted successfully.</div>";
        header("Location:" . SITEURL . "admin/books.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Book.</div>";
        header("Location:" . SITEURL . "admin/books.php");
    }
} else {
    echo "redirect to";
    $_SESSION['unauthorize'] = "<div class='error'> Unauthorized Access!</div>";
    header("Location:" . SITEURL . "admin/books.php");
}
