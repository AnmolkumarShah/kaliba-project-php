<?php

// error variables
$email = $password = $dbError = '';
$errors = ['email' => '', 'password' => ''];

// When form is submitted
if (isset($_POST['Submit'])) {

    // email check
    if (!empty($_POST['email'])) {
        // XSS Attack Protection
        $email =
            htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter valid email";
        }
    } else {
        $errors['email'] = "Email cannot be empty!";
    }


    // password check
    if (!empty($_POST['password'])) {
        $password =
            htmlspecialchars($_POST['password']);
        if (strlen($password) < 4) {
            $errors['password'] = "password cannot be less than 4 characters.";
        }
    } else {
        $errors['password'] = "Password cannot be empty!";
    }

    // ----------------------------------------------------------------------------------------------------------

    include('./db_common.php');


    if (!array_filter($errors)) {
        // escape character for sql
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // write query for all menu items

        $sql = "select user_id, name from users_table where email = '$email' and password = '$password' ";

        // execute query

        $result = mysqli_query($conn, $sql);

        // success
        if ($result) {
            // formatting result    
            $items = mysqli_fetch_assoc($result);
            if (isset($items['user_id'])) {
                session_start();
                $_SESSION['name'] = $items['name'];
                $_SESSION['user_id'] = $items['user_id'];

                header('Location: homepage.php');
            } else {
                $dbError =  'Account with this credentials was not found!!';
            }
        } else {
            $dbError = 'Query error ' . mysqli_error($conn);
        }

        // releasing memory
        mysqli_free_result($result);
        // close connection
        mysqli_close($conn);
    }
} // end

?>



<?php include('./templates/header.php') ?>
<style>
    body {
        background-image: url('https://cdn.pixabay.com/photo/2016/11/08/06/45/couple-1807617_960_720.jpg');
        background-size: cover;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 90vh;
        width: 100vw;
        flex-direction: column;
    }

    .container>form {
        width: 50%;
    }
</style>

<!-- Navbar -->
<?php include('./templates/navbar.php') ?>

<!-- Container -->
<div class="container">

    <!-- Error in login -->
    <?php if (strlen($dbError) > 0) { ?>
        <div class="alert alert-warning" role="alert">
            <p><?php echo $dbError ?></p>
        </div>
    <?php } else { ?>
        <div class="display-4 text-light">Login</div>
    <?php } ?>

    <!-- Login Form -->
    <form method="POST" action="index.php">

        <div class="form-group">
            <label class="h2 text-light" for="Email">Email address</label>
            <input type="email" class="form-control" id="Email" name="email" value="<?php echo $email ?>" placeholder="Enter email">
            <!-- Error -->
            <p class="text-light">
                <?php echo $errors['email']  ?>
            </p>
        </div>


        <div class="form-group">
            <label class="h2 text-light" for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="password" value="<?php echo $password ?>" placeholder="Password">
            <!-- Error -->
            <p class="text-light">
                <?php echo $errors['password'] ?>
            </p>
        </div>

        <button type="submit" name="Submit" value="Submit" class="btn btn-primary">Login</button>
    </form>


</div>
</body>

</html>