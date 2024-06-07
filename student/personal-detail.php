<?php
include('include/header.php');

if (!isset($_SESSION['username'])) {
  header('location:../user-login.php');
}

if (isset($_SESSION['username'])) {

  $user_id    = $_SESSION['id'];

  $query = "SELECT * FROM student WHERE id=$user_id";
  $run   = mysqli_query($con, $query);

  if (!$run) {
    die('Error in SQL query: ' . mysqli_error($con));
  }

  $row = mysqli_fetch_assoc($run);

  $cust_name = $row['fullname'];
  $cust_email = $row['email'];
  // $cust_add = $row['address'];
  $faculty= $row['faculty'];
  $cust_number = $row['phone'];

  if (isset($_POST['update'])) {

    $fullname = $_POST['fullname'];
    echo $email    = $_POST['email'];
    // $address  = $_POST['address'];
    $faculty=$_POST['$faculty'];
    $number   = $_POST['phone'];

    $up_query = "UPDATE `student` SET `fullname`='$fullname',
      `phone`='$number'
       WHERE id=$user_id ";
    $update_run = mysqli_query($con, $up_query);

    if (!$update_run) {
      die('Error in UPDATE query: ' . mysqli_error($con));
    }

    $_SESSION['msg'] = "<div style='color:green; text-align:center'>Update Successfully</div>";

    header('location:personal-detail.php');
  }
}
?>








<div class="account-info">

  Personal information

</div>
<!-- <?php
      if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
      }
      ?> -->
<div class="user-information">
  <?php include('include/sidebar.php'); ?>


  <div class="user-detail-info">
    <h2>CHANGE PERSONAL DETAILS</h2></hr>
    <p>You can access and modify your personal details (name, billing address, telephone number, etc.)
      in order to facilitate your future
      purchases and to notify us of any change in your contact details.</p>

    <?php

    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
    }
    ?>

    <form action="" class="personal-detail-form" method="post">
      <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $cust_name; ?>" class="form-control"><br><br>
      <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $cust_email; ?>" disabled><br><br>
      <input type="text" name="faculty" placeholder="Faculty" value="<?php echo $faculty; ?>" class="form-control"><br><br>
      <input type="number" name="phone_number" placeholder="Phone Number" value="<?php echo $cust_number; ?>" class="form-control"><br><br>
      <input type="submit" name="update" class="btn-update" value="Update">
    </form>
  </div>
</div>

<?php include('include/footer.php'); ?>