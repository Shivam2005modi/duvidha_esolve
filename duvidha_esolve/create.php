<?php
include('connection.php');

// Initialize error variable
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user already exists

    $query_1 = "SELECT * FROM `admin` WHERE `username` = '". $_POST['username'].  "'";
    $query_2 = "SELECT * FROM `admin` WHERE `contact_number` = '". $_POST['contact_number'].  "'";
    $query_3 = "SELECT * FROM `admin` WHERE `email` = '". $_POST['email'].  "'";


    $result_1 = mysqli_query($link, $query_1);
    $result_2 = mysqli_query($link, $query_2);
    $result_3 = mysqli_query($link, $query_3);


if (mysqli_num_rows($result_1) > 0) {
    $error = 'User already exists!'; // Set error message if user already exists
} else {
        // Check if passwords match
        if ($_POST['password'] !== $_POST['cpassword']) {
        $error = 'Passwords do not match!';
        } else {
                if (mysqli_num_rows($result_2) > 0) {
                $error = 'contact_number already exists!'; // Set error message if user already exists
                } else {
                        if (mysqli_num_rows($result_3) > 0) {
                        $error = 'email already exists!'; // Set error message if user already exists
                        } else  {
                                // Insert new user into the database
                                $query = "INSERT INTO `admin` (`username`, `password`, `usertype`,`contact_number`,`email`,`address`) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', '" . $_POST['usertype'] . "','" . $_POST['contact_number'] . "','" . $_POST['email'] . "','" . $_POST['address'] . "')";
                                mysqli_query($link, $query);
                                header('Location: index.php');
                                exit;
                                }
                        }
                }
    
        }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create</title>
    <style>

body{
    background-image: url("download.jpeg");
    background-size: cover;
    background-repeat: no-repeat; 
}

.ad {
    margin-top: 15px;
}

.main_div{
    margin-top: 70px;
    height: 480px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.inside_div {
    height: 480px;
    width: 400px;
    text-align: center;
    border: 2px solid black; 
    border-radius: 5px;
    background-color: #808abd;
    box-shadow: 3px 3px rgb(91, 88, 88);
    opacity: 0.7;
}


</style>
</head>
<body>
    <div class="main_div">
        <div class="inside_div">

    
    <h1>Create</h1>
    <h3>*create a new admin to help you*</h3>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <label for="username">Name:</label>
            <input type="text" class="ad" name="username" required placeholder="enter your username"><br>
            <label for="password">password:</label>
            <input type="password" class="ad" name="password" required placeholder="enter your password"><br>
            <label for="cpassword">confirm_password:</label>
            <input type="password" class="ad" name="cpassword" required placeholder="confirm your password"><br>
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="ad" name="contact_number" required placeholder="contact_number"><br>
            <label for="email">Email:</label>
            <input type="text" class="ad" name="email" required placeholder="enter your email"><br>
            <label for="address">Address:</label>
            <input type="text" class="ad" name="address" required placeholder="enter your address"><br>
            <label for="usertype">user_type :</label>   

        <select class="ad" name="usertype">

                <option value="admin">admin</option>

            </select><br><br>

        <button type="submit">Create</button>
    </form>

        <form method="post">
            <button type="submit" class="ad" name="back">back</button>
        </form>
        </div>
    </div>

        <?php
    if (isset($_POST['back'])) {
        session_destroy();
        header("location:admin.php");
        exit; // Add exit after redirection to stop further execution
    }
    ?>


</body>
</html>
