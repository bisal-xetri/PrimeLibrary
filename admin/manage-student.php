
<?php include('partials/sidebar.php'); ?>
        <div class="ok">
            <h1>Manage Student</h1>
            <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displayed session
            unset($_SESSION['add']); //remove the session
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']); //remove the session

        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']); //remove the session

        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']); //remove the session

        }
        if (isset($_SESSION['password-not-match'])) {
            echo $_SESSION['password-not-match'];
            unset($_SESSION['password-not-match']); //remove the session

        }
        if (isset($_SESSION['change-psw'])) {
            echo $_SESSION['change-psw'];
            unset($_SESSION['change-psw']); //remove the session

        }
        ?>
            
        <div class="right">
       
        <br>
        <a  class="add" href="<?php echo SITEURL; ?>admin/add-student.php">Add student </a>
       
        <table class="tbl-head">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Faculty</th>
                <th>Actions</th>
            </tr>
            <?php
            //query to get all admin users
            $sql = "SELECT * FROM student";
            $res = mysqli_query($con, $sql);
            if ($res) {
                //count rows of admin users
                $row = mysqli_num_rows($res); //function to get all rows of admin users
                $sn = 1; //create new 

                if ($row > 0) {
                    //we have admin users
                    while ($row = mysqli_fetch_assoc($res)) {
                        //using while loop to get all admin users
                        $id = $row['id'];
                        $full_name = $row['fullname'];
                        $username = $row['username'];
                        $faculty= $row['faculty'];
                        //display value in table
            ?>
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $faculty; ?></td>
                            <td colspan="">
                               
                                <a class="btn-danger" href="<?php echo SITEURL; ?>admin/delete-student.php?id=<?php echo $id ?>"> Delete Student</a>

                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //we have no admin users
                }
            }



            ?>

        </table>
    </div>
</div>
</section>
<?php include('partials/footer.php'); ?>