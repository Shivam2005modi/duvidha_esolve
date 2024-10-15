<?php
include('connection.php');

// Initialize error variable
$error = '';

// Check if the form is submitted and the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted name
    $name = $_POST['username'];

    // Check if the user exists
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($link, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $name);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                // User found, delete the record
                $query_delete = "DELETE FROM admin WHERE username = ?";
                $stmt_delete = mysqli_prepare($link, $query_delete);
                if ($stmt_delete) {
                    mysqli_stmt_bind_param($stmt_delete, "s", $name);
                    if (mysqli_stmt_execute($stmt_delete)) {
                        // Record deleted successfully
                        $success = "User '$name' deleted successfully.";
                    } else {
                        $error = "Failed to delete record: " . mysqli_error($link);
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

// Remove this section if you don't want to automatically drop a table

if(isset($_POST['username'])) {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $sql = "DROP TABLE IF EXISTS $username";
    if(mysqli_query($link, $sql)){
        $success = "Table '$username' dropped successfully.";
    } else {
        $error = "Error dropping table: " . mysqli_error($link);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
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

    <h1>Delete</h1>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required><br><br>
        <button type="submit">Delete</button><br><br>

        <form method="post">
            <button type="submit" name="back">back</button>
        </form>
        </div>
    </div>

        <?php
    if (isset($_POST['back'])) {
        session_destroy();
        header("location:admin.php");
        exit; // Add exit after redirection to stop further execution
    }
    ?>

</body>
</html>
