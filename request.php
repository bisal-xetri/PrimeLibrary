<?php include('config/constant.php'); ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if (isset($_SESSION['id'])&&($_SESSION['fullname'])&&( $_SESSION['number'])) {
        $student_id = $_SESSION['id'];
        $fullname = $_SESSION['fullname'];
        $number= $_SESSION['number'];
    }
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $sql = "SELECT * FROM book WHERE id=$book_id";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $title = $row['title'];
            $image_name = $row['image'];
            $category_name = $row['category'];
            $author = $row['author'];
            $publication = $row['publication'];
        }
    } else {
        header('location:index.php');
    }
}

date_default_timezone_set('UTC'); // Set timezone to UTC

// Get current UTC time
$utc_time = time();

// Add 5 hours and 45 minutes to convert to Nepal Standard Time
$nepal_time = $utc_time + (5 * 3600) + (45 * 60);

// Format the Nepal Standard Time
$request_date = date("Y-m-d H:i:s", $nepal_time);

// Uncomment the code if needed for return date and fine calculation
/*
$return_date = date("Y-m-d H:i:s", strtotime("+30 days", $nepal_time));
$current_date = $nepal_time;

$fine = 0;
$days_overdue = (strtotime($current_date) - strtotime($return_date)) / (60 * 60 * 24);

if ($days_overdue > 0) {
    if ($days_overdue <= 5) {
        $fine = 10 * $days_overdue;
    } else {
        $fine = (10 * 5) + (50 * ($days_overdue - 5));
    }
}
*/

$sql2 = "INSERT INTO requestbook SET
    userid='$student_id',
    book_id='$book_id',
    username='$fullname',
    phone='$number',
    bookname='$title',
    request_date='$request_date'";

$res2 = mysqli_query($con, $sql2);
if ($res2) {
    $_SESSION['request'] = "<div class='success text-center' style='text-align:center;color:green;'>Book Request Success.</div>";
    header("location:" . SITEURL . 'index.php');
} else {
    $_SESSION['order'] = "<div class='error' style='text-align:center;color:red;'>Failed to request book. " . mysqli_error($con) . "</div>";
    header("location:" . SITEURL);
}
?>
