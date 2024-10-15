<?php
include('connection.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $balance = $_POST['balance'];

    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($link, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $query_update = "UPDATE admin SET balance = ? WHERE username=?";
                $stmt_update = mysqli_prepare($link, $query_update);
                if ($stmt_update) {
                    mysqli_stmt_bind_param($stmt_update, "ss", $balance, $username);
                    if (mysqli_stmt_execute($stmt_update)) {
                        $success = "Record updated successfully";
                    } else {
                        $error = "Failed to update record: " . mysqli_error($link);
                    }
                } else {
                    $error = "Database error: " . mysqli_error($link);
                }
            } else {
                $error = "User not found.";
            }
        } else {
            $error = "Execution failed: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = "Database error: " . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <style>
        
        body{
            background-image: url("download.jpeg");
            background-size: cover;
            background-repeat: no-repeat; 
        }

        .main_div{
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .inside_div{
            height: 250px;
            width: 300px;
            text-align: center;
            margin-top: 200px;
            border: 2px solid black; 
            border-radius: 5px;
            background-color: #808abd;
            box-shadow: 3px 3px rgb(91, 88, 88);
            opacity: 0.7;
        }

        .error {
            color: red;
        }
        .success {
            color: green;
        }

    </style>
</head>
<body>

<div class="main_div">
    <div class="inside_div">

    <h1>Update</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="balance">Balance:</label>
        <input type="text" id="balance" name="balance" required><br><br>
        <button type="submit">Update</button><br><br>
    </form>

    <!-- Changed form action for the "Back" button -->
    <form method="post" action="admin.php">
        <button type="submit" name="back">Back</button>
    </form>

    </div>
</div>
</body>
</html>
