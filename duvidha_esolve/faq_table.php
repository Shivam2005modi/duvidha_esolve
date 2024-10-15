<?php
session_start();
if (!isset($_SESSION['user_username'])) {
    header("location:index.php");
    exit;
}

if (!isset($_POST['que'])) {
    header("location:user_home.php");
    exit;
}

include 'connection.php';

// Get the selected question from the form submission
$selected_question = $_POST['que'];

// Query to get the answer corresponding to the selected question
$sql = "SELECT ans FROM faqs WHERE que = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 's', $selected_question);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $answer = htmlspecialchars($row['ans'], ENT_QUOTES, 'UTF-8');
} else {
    $answer = "No answer found for the selected question.";
}

if (isset($_POST['back'])) {
    session_destroy();
    header("location:user.php");
    exit; // Add exit after redirection to stop further execution
}   

mysqli_stmt_close($stmt);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Answer</title>
    <link rel="stylesheet" href="home.css">
    <style>
        body {
            font-family: poppins;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #204969;
            padding: 10px 20px;
            color: white;
            text-align: center;
        }

        .content {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 50%;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>FAQ Answer</h1>
</div>

<div class="content">
    <h2>Question:</h2>
    <p><?php echo htmlspecialchars($selected_question, ENT_QUOTES, 'UTF-8'); ?></p>

    <h2>Answer:</h2>
    <p><?php echo $answer; ?></p>

    <form  method="post" action="user.php" >
        <button type="submit" name="back">Back</button>
    </form>

</div>
</body>
</html>
