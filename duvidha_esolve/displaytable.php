<?php
include("connection.php");

session_start();
if (!isset($_SESSION['admin_username'])) {
    header("location:index.php");
    exit; // Add exit after redirection to stop further execution
}

// Ensure the session variable is correctly used in the SQL query
$admin_username = mysqli_real_escape_string($link, $_SESSION['admin_username']);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['text']) && isset($_POST['user_table'])) {
        $typer = mysqli_real_escape_string($link, $_SESSION['admin_username']);
        $text = mysqli_real_escape_string($link, $_POST['text']);
        $user_table = mysqli_real_escape_string($link, $_POST['user_table']);
        
        $sql = "INSERT INTO `$user_table` (`Typer`, `word`) VALUES ('$typer', '$text')";
        mysqli_query($link, $sql);
        // Redirect to the same page to prevent form resubmission
        header("location: " . $_SERVER['PHP_SELF'] . "?user_table=" . urlencode($user_table));
        exit;
    } 
} elseif (isset($_GET['user_table'])) {
    $user_table = mysqli_real_escape_string($link, $_GET['user_table']);
} else {
    die("User table not specified.");
}

// Query to select all data from the specified user's table
$sql = "SELECT * FROM `$user_table`";
$result = mysqli_query($link, $sql);
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
    <h2>Client Data for Table: <?php echo htmlspecialchars($user_table); ?></h2>
    
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Typername</th>";
        echo "<th>Text</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
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
        <input type="hidden" name="user_table" value="<?php echo htmlspecialchars($user_table); ?>">
        <input type="submit" value="submit">
    </form>
   
    <form method="GET" action="admin.php">
        <button type="submit">Back</button>
    </form>
</body>
</html>
