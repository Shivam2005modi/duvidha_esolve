

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

h1 {
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

.back{
    margin-top: 20px;
}

</style>
</head>
<body>
    <h1>Client Data</h1>

    <?php
include("connection.php");


    $sql = "SELECT * FROM admin";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Id</th>";
        echo "<th>Name</th>";
        echo "<th>balance</th>";
        echo "<th>Email</th>";

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
        
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

    // Close connection
    mysqli_close($link);

if(isset($_POST['home'])){
    header('location:admin.php');
}
?>


<form method="post">
        <button type="submit" name="back">back</button>
    </form>

    <?php
if (isset($_POST['back'])) {
    session_destroy();
    header("location:admin.php");
    exit; // Add exit after redirection to stop further execution
}
?>
    
</body>
</html>