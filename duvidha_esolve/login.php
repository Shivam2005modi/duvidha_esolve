<?php
session_start();
require('connection.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = $_POST['password'];

    // Prepared statement for security
    $stmt = mysqli_prepare($link, "SELECT * FROM `admin` WHERE `username`=? AND `password`=?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['usertype'] == 'admin') {
            $_SESSION['admin_username'] = $row['username'];
            header('Location: admin.php');
            exit;
        } elseif ($row['usertype'] === 'user') {
            $_SESSION['user_username'] = $row['username'];
            header('Location: user.php');
            exit;
        } 
    } else {
        $error_message = 'Incorrect username or password!';
    }

    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>
    <div class="main_box">
        <div class="head">
            <div class="logo inside_head"><img src="Duvidha_esolve_transparent.png" height="130px" alt="Logo"></div>
            <div class="name inside_head">Duvidha_esolve</div>
            <div class="login inside_head"><a href="index.php" class="login_anchor">Home</a></div>
        </div>
        <main>
            <div class="box">
                <div class="login_box">
                    <pre>
                        <div class="welcome">
Welcome,Enter Your Details
                        </div>
                    </pre>
                    <?php if (isset($error_message)) { ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <form method="POST">
                        <div class="font">
                            <label for="username"><b class="uname">Username:</b></label>
                            <input type="text" id="username" name="username" placeholder="Enter your username" required><br><br>
                            <label for="password"><b class="pass">Password:</b></label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
                            <button class="btn" type="submit" name="login">login</button><br><br>
                            <p>&nbsp;&nbsp;Don't have an account yet? <a href="Register.php">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>