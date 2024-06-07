<?php include('../config/constant.php');?>
<?php include('login-check.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeLibrary Admin panel</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <section class="main">
        <div class="left">
            <h1>Admin panel</h1>
           
            <nav>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="manage-category.php">Categories</a></li>
                    <li><a href="books.php">Books</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-student.php">Student</a></li>
                    <li><a href="book-request.php">Book Request</a></li>
                    <li><a href="issue-report.php">Issue Report</a></li>
                    <li><a href="return-request.php">Return Request</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>