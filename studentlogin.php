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
        <?php
               
                if (isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                ?>
            <form action=" " method="post">
                <h1>Student Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="usename" />
                    <i class="bx bxs-user"></i>
                </div>
               
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" />
                    <i class="bx bxs-lock-alt"></i>
                </div>
            
                <button type="submit" name="submit" class="btn">Signup</button>
                <div class="signup-link">
                    <p><a href="index.php">Home</a></p>
                </div>
            </form>
        </div>
        
    </div> 
</body>
</html>
<?php
// Check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login form
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = sha1($_POST['password']);

    // Check SQL to see whether a user with the username and password exists or not
    $sql = "SELECT * FROM student WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($res);
            $user_id = $row['id'];
            $fullname=$row['fullname'];
            $customer_email=$row['email'] ;
            $customer_add=$row['address'];
            $customer_number=$row['phone'];// Assuming 'id' is the column name for the user ID in your table

            // Set session variables
            $_SESSION['login'] = "<div class='success'>Login Successfully</div>";
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['id'] = $user_id; 
              $_SESSION['email']=$customer_email; 
             $_SESSION['add']=$customer_add;
           
             $_SESSION['number']= $customer_number;

            // Redirect to the appropriate page
            header("Location:" . SITEURL . "index.php");
            exit(); // Exit after redirection
        } else {
            // Session message
            $_SESSION['login'] = "<div class='error'>Username or password didn't match.</div>";
            header("Location:" . SITEURL . "studentlogin.php");
            exit(); // Exit after redirection
        }
    } else {
        // Handle query execution failure
        echo "Error executing query: " . mysqli_error($con);
    }
}

?>