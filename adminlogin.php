<?php include('config/constant.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css" />
</head>
<body>
    <div class="loginhora">
        <div class="wrapper">
            <form action="" method="post">
                <h1>Admin Login</h1>
                <?php
              
                if (isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                ?>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" />
                    <i class="bx bxs-user"></i>
                </div>
               
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" />
                    <i class="bx bxs-lock-alt"></i>
                </div>
            
                <button type="submit" name="submit" class="btn">LogIn</button>
                <div class="signup-link">
                    <p><a href="index.html">Home</a></p>
                </div>
            </form>
        </div>
        
    </div> 
</body>
</html>
<?php
//check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    //process for login form
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = sha1($_POST['password']);
    //check aql to whether user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $_SESSION['login'] = "<div class='success'>Admin successfully logged in</div>";
            $_SESSION['user'] = $username; //to check if user is logged in or not an logout will unset the
            header("Location:" . SITEURL . "admin/");
        } else {
            //session message
            $_SESSION['login'] = "<div class='error'>Please enter the correct username and password.</div>";
            header("Location:" . SITEURL . "adminlogin.php");
        }
    }
}

?>