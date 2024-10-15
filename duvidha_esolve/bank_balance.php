<?php
include("connection.php");

session_start();
// if (!isset($_SESSION['user_username'])) {
//     header("location:index.php");
//     exit; // Add exit after redirection to stop further execution
// }

// Ensure the session variable is correctly used in the SQL query
$sql = "SELECT * FROM admin WHERE username = '" . $_SESSION['user_username'] . "';";
$result = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data</title>
    <style>

body{
    background-image: url("download.jpeg");
    background-size: cover;
    background-repeat: no-repeat;
    color: white;
}

h1{
    text-align: center;
}

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
    color: black;
}
</style>
</head>
<body>
    <h1>Client Data</h1>
    
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        // echo "<th>Id</th>";
        echo "<th>Name</th>";
        echo "<th>Balance</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            // echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "<br>";
        echo "<br>";

        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<p>No records were found.</p>';
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
