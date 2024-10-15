<?php

include 'connection.php';

$error = ""; // Initialize error variable

if(isset($_POST['submit']))
{

    // Check if the user already exists
    $query_1 = "SELECT * FROM `admin` WHERE `username` = '". $_POST['username'].  "'";
    $query_2= "SELECT * FROM `admin` WHERE `contact_number` = '". $_POST['contact_number'].  "'";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
</head>
<body><center>
    <div>
        <form action="" method="post">
            <h3>register now</h3>
            <?php if(!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <label for="que"></label>
            <input type="" name="que" required placeholder="enter new faq's"><br>
            <label for="ans">password:</label>
            <input type="password" name="password" required placeholder="enter your password"><br>
            <label for="cpassword">confirm_password:</label>
            <input type="password" name="cpassword" required placeholder="confirm your password"><br>
            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" required placeholder="contact_number"><br>
            <label for="email">Email:</label>
            <input type="text" name="email" required placeholder="enter your email"><br>
            <label for="address">Address:</label>
            <input type="text" name="address" required placeholder="enter your address"><br>
            <label for="usertype">user_type :</label>
            <select name="usertype">
                <option value="user">user</option>
            </select><br>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
    </center>
</body>
</html>
