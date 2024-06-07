<?php
session_start();
include_once('include/dbcon.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student-info.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>PrimeLibrary</title>
</head>
<body>
    <div class="main">
        <header class="nav">
            <div class="title">
                <h1><a href="../index.php">PrimeLibrary</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../book.php">Book</a></li>
                    <?php if (!isset($_SESSION['username'])) {
            ?>
                <li><a href="studentlogin.php">Student Login</a></li>
            <?php
            }

            if (isset($_SESSION['username'])) {


            ?>
                <li><a href="<?php echo SITEURL; ?>student/index.php">Account</a></li>
            <?php }
            ?>
                   
                    <li><a href="<?php echo SITEURL;?>adminlogin.php">Admin Login</a></li>
                    
                </ul>
            </nav>
        </header>