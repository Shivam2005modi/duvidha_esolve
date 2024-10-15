<?php
include("connection.php");

session_start();
if (!isset($_SESSION['user_username'])) {
    header("location:index.php");
    exit; // Add exit after redirection to stop further execution
}

// Ensure the session variable is correctly used in the SQL query
$user_username = $_SESSION['user_username'];
$sql = "SELECT * FROM " .$user_username;
$result = mysqli_query($link, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['text'])) {
        $typer = mysqli_real_escape_string($link, $_SESSION['user_username']);
        $text = mysqli_real_escape_string($link, $_POST['text']);
        // $sql = "INSERT INTO `$typer` (`username`, `Typer`, `word`) VALUES ('$typer', '$typer', '$text')";
        $sql = "INSERT INTO `$typer` ( `Typer`, `word`) VALUES ('$typer', '$text')";
        mysqli_query($link, $sql);
        // Redirect to the same page to prevent form resubmission
        header("location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_POST['back'])) {
    session_destroy();
    header("location:user.php");
    exit; // Add exit after redirection to stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Client Data</h2>
    
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        // echo "<th>Username</th>";
        echo "<th>Typername</th>";
        echo "<th>Text</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            // echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Typer']) . "</td>";
            echo "<td>" . htmlspecialchars($row['word']) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<p>No records were found.</p>';
    }

    // Close connection
    mysqli_close($link);
    ?>
    
    <form method="post" action="">
        <textarea name="text" id="Text" placeholder="Enter text here ... "></textarea>
        <input type="submit" value="submit">
    </form>
    <form method="post" action="user.php">
        <button type="submit" name="back">Back</button>
    </form>
</body>
</html>
