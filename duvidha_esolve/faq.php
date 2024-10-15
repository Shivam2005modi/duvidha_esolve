<?php
session_start();
if (!isset($_SESSION['user_username'])) {
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="home.css">
    <style>

        body{
            background-image: url("download.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        div.header {
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: #204969;
        }

        div.header button {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }

        .button {
            margin: 20px auto;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>WELCOME - <?php echo htmlspecialchars($_SESSION['user_username']); ?></h1>
    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
<br><br>
<?php
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit;
}

include 'connection.php';

$sql = "SELECT que FROM faqs";
$sqlex = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($sqlex)) {
    $question = htmlspecialchars($row['que'], ENT_QUOTES, 'UTF-8');
    echo "
        <form action='faq_table.php' method='post'>
            <input type='hidden' name='que' value='{$question}'>
            <input type='submit' value='{$question}'>
        </form>
    ";
}


if (isset($_POST['back'])) {
    session_destroy();
    header("location:user.php");
    exit; // Add exit after redirection to stop further execution
}

// Close connection

mysqli_close($link);
?>

<form  method="post" action="user.php" >
    <button type="submit" name="back">Back</button>
</form>

</body>
</html>
