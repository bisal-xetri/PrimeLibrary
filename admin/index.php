<?php include('partials/sidebar.php'); ?>
<div class="ok">
    <h1>DASHBOARD</h1>
    </br>
    </br>
    <div class="right">

        <div class="books">
            <?php
            $sql="SELECT * FROM book";
            $res=mysqli_query($con,$sql);
            $count=mysqli_num_rows($res);
            if ($res) {
                $count = mysqli_num_rows($res);
            ?>
                <h1><?php echo $count; ?></h1>
                <br>
                <span>Books</span>
            <?php
            } else {
                // Handle the query error
                echo "Error: " . mysqli_error($con);
            }
            ?>
           
           
        </div>
        <div class="books">
        <?php
            $sql2="SELECT * FROM tbl_category ";
            $res2=mysqli_query($con,$sql2);
            $count2=mysqli_num_rows($res2);
            if ($res2) {
                $count2 = mysqli_num_rows($res2);
            ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                <span>Category</span>
            <?php
            } else {
                // Handle the query error
                echo "Error: " . mysqli_error($con);
            }
            ?>
        </div>
        <div class="books">
        <?php
            $sql3="SELECT * FROM requestbook ";
            $res3=mysqli_query($con,$sql3);
            $count3=mysqli_num_rows($res3);
            if ($res3) {
                $count3 = mysqli_num_rows($res3);
            ?>
                <h1><?php echo $count3; ?></h1>
                <br>
                <span>Book Request</span>
            <?php
            } else {
                // Handle the query error
                echo "Error: " . mysqli_error($con);
            }
            ?>
        </div>
        <div class="books">
        <?php
            $sql4="SELECT * FROM student ";
            $res4=mysqli_query($con,$sql4);
            $count4=mysqli_num_rows($res4);
            if ($res4) {
                $count4 = mysqli_num_rows($res4);
            ?>
                <h1><?php echo $count4; ?></h1>
                <br>
                <span>Students</span>
            <?php
            } else {
                // Handle the query error
                echo "Error: " . mysqli_error($con);
            }
            ?>
        </div>
        <div class="books">
        <?php
            $sql5 = "SELECT SUM(fine) as Total FROM issuebook ";
            $res5 = mysqli_query($con, $sql5);
            $row5 = mysqli_fetch_assoc($res5);
            $total_revenue = $row5['Total'];

            // Format the total revenue without decimal places
            $formatted_revenue = number_format($total_revenue, 0);

            ?>
            <h1>रू.<?php echo $formatted_revenue; ?></h1>
            <br>
            <span> Total Fine</span>
        </div>
        <div class="books">
        <?php
            $sql6="SELECT * FROM issuebook ";
            $res6=mysqli_query($con,$sql6);
            $count6=mysqli_num_rows($res6);
            if ($res6) {
                $count6 = mysqli_num_rows($res6);
            ?>
                <h1><?php echo $count6; ?></h1>
                <br>
                <span>Issued Books</span>
            <?php
            } else {
                // Handle the query error
                echo "Error: " . mysqli_error($con);
            }
            ?>
        </div>
        </div>
    </div>
</div>
</section>
</body>

</html>