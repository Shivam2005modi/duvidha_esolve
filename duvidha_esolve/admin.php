<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit; // Add exit after redirection to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_home</title>
    <link rel="stylesheet" href="home.css">
    <style>

        body{
            background-image: url("download.jpeg");
            background-size: cover;
            background-repeat: no-repeat; 
        }

        h1{
            color: #f0f0f0;
        }

        div.header {
            font-family: poppins;
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
    <h1>WELCOME - <?php echo $_SESSION['admin_username']; ?></h1>
    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
<div class="button">
<form  action="crud.php" method='POST'>
<input type="submit" class="btn" name="create" value="Create" />
<input type="submit" class="btn" name="client_biodata" value="client_biodata" />
<input type="submit" class="btn" name="client_balance" value="client_balance" />
<input type="submit" class="btn" name="update_admin" value="Update" />
<input type="submit" class="btn" name="query_sol" value="query_sol" />
<input type="submit" class="btn" name="delete" value="Delete" />
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
