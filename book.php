<?php include('partial-front/header.php'); ?>


<div class="search">
    <form action="<?php echo SITEURL; ?>book-search.php" method="POST">
        <input type="search" name="search" placeholder="Enter book name" id="">
        <button type="submit">Search</button>
    </form>
</div>

<h2>Available Books</h2>
<div class="bookview">
    
        <?php
        $sql = "SELECT book.*, tbl_category.title AS category_name FROM book 
                JOIN tbl_category ON book.category = tbl_category.id ";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image'];
                $category_name = $row['category_name'];
                $author = $row['author'];
                $publication= $row['publication'];
        ?>
        <div class="book">
                <div class="bookimg">
                    <?php
                    // Check if image is available
                    if ($image_name == '') {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL; ?>image/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" />
                    <?php
                    }
                    ?>
                </div>
                <div class="bookinfo">
                    <div class="bookname">
                        <h2><?php echo $title; ?></h2>
                    </div>
                    <div class="bookauthor">
                        <h3>Author: <?php echo $author; ?></h3>
                    </div>
                    <div class="bookauthor">
                        <h3>Publication: <?php echo $publication; ?></h3>
                    </div>
                    <div class="category">
                        <h3>Faculty: <?php echo $category_name; ?></h3>
                    </div>
                <?php include('partial-front/request-verify.php'); ?>
                </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'> Book Not available</div>";
        }
        ?>
 
</div>

<?php include('partial-front/footer.php'); ?>