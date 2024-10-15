<?php
session_start();
if (!isset($_SESSION['user_username'])) {
    header("location:index.php");
    exit; // Add exit after redirection to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_home</title>
    <link rel="stylesheet" href="home.css">
    <style>

        body {
            background-image: url("download.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        h1{
            color: #f0f0f0;
        }

        div.header {
            font-family: cursive;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: #204974;
        }
 
        div.header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }

        .btn {
            font-size: 22px;
            margin-top: 20px;
            margin-left: 10px;
            font-weight: 700;
            border-radius: 8px;
        }

    </style>
</head>
<body>
<div class="header">
    <h1>WELCOME - <?php echo $_SESSION['user_username']; ?></h1>
    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
<div class="button">
<form  action="crud_2.php" method='POST'>
<input type="submit" class="btn" name="bank_balance" value="bank_blalance" />
<input type="submit" class="btn" name="faq" value="faq" />
<input type="submit" class="btn" name="ask_user" value="ask_user" />
<input type="submit" class="btn" name="profile" value="profile" />

</form>
</div>


<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit; // Add exit after redirection to stop further execution
}
?>


</body>
</html>
