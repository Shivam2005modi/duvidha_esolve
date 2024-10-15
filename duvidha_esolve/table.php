<?php
include 'connection.php';
$sql = "SELECT username FROM admin";
$sqlex = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($sqlex)) {
    echo "
        <form action='displaytable.php' method='get'>
            <input type='hidden' name='user_table' value='" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "'>
            <input type='submit' value='" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "'>   
        </form>
    ";
}
?>
