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
                                    }
                            }
                    }
            }
            $username = $_POST['username'];
      $sql = "
      CREATE TABLE ".$username." (
        
        Typer VARCHAR(1000) DEFAULT NULL,
        word VARCHAR(1000) DEFAULT NULL
    );
      ";
      mysqli_query($link, $sql);
      header('Location: index.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
    <style>
         body {
                background-image: url("download.jpeg");
                background-size: cover;
                background-repeat: no-repeat;    
             }

             .form{
                height: 400px;
                width: 400px;
                border: 2px solid white;
                margin-top: 100px;
                border: 2px solid black; 
                border-radius: 5px;
                background-color: #808abd;
                box-shadow: 3px 3px rgb(91, 88, 88);
                opacity: 0.8;
             }

             .reg{
                margin-top: 10px;
             }

    </style>
</head>
<body><center>
    <div class="form">
        <form action="" method="post">
            <h3>register now</h3>
            <?php if(!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <label for="username">Name:</label>
            <input type="text" class="reg" name="username" required placeholder="enter your username"><br>
            <label for="password">password:</label>
            <input type="password" class="reg" name="password" required placeholder="enter your password"><br>
            <label for="cpassword">confirm_password:</label>
            <input type="password" class="reg" name="cpassword" required placeholder="confirm your password"><br>
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="reg" name="contact_number" required placeholder="contact_number"><br>
            <label for="email">Email:</label>
            <input type="text" class="reg" name="email" required placeholder="enter your email"><br>
            <label for="address">Address:</label>
            <input type="text" class="reg" name="address" required placeholder="enter your address"><br>
            <label for="usertype">user_type :</label>
            <select class="reg" name="usertype">
                <option value="user">user</option>
            </select><br>
            <input type="submit" class="reg" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
    </center>
</body>
</html>
