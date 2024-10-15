<?php
include("connection.php");

session_start();


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
         
         h1{
            text-align: center;
         }

        body{
            background-image: url("download.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            color:#f2f2f2;
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
            /* background-color:aqua */
            /* color: black; */
        }
    </style>
</head>
<body>
    <h1>Client Data</h1>
    
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";

    
        // while ($row = mysqli_fetch_assoc($result)) {
            // echo "<tr>";
            // // echo "<td>" . $row['id'] . "</td>";
            // echo "<td>" . $row['username'] . "</td>";
            // echo "<td>" . $row['balance'] . "</td>";
            // echo "</tr>";
        // }
        $row = mysqli_fetch_assoc($result);
echo"<tr>";
echo"<th>id</th>";
echo "<td>" . $row['id'] . "</td>";
echo "</tr>";
echo"<tr>";
echo"<th>name</th>";
echo "<td>" . $row['username'] . "</td>";
echo "</tr>";
echo"<tr>";
echo"<th>contact number</th>";
echo "<td>" . $row['contact_number'] . "</td>";
echo "</tr>";
echo"<tr>";
echo"<th>email</th>";
echo "<td>" . $row['email'] . "</td>";
echo "</tr>";
echo"<tr>";
echo"<th>address</th>";
echo "<td>" . $row['address'] . "</td>";
echo "</tr>";



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
