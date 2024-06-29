<?php
session_start();
$msg = '';
require('config.php');
require('functions.php');

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$currentUsername = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $newPassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['newPassword'], ENT_QUOTES, 'utf-8'));
    $confirmPassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['confirmPassword'], ENT_QUOTES, 'utf-8'));
    
    if (empty($newPassword) || empty($confirmPassword)) {
        $msg = "<div class='alert alert-danger'>New Password and Confirm Password are required.</div>";
    } elseif ($newPassword !== $confirmPassword) {
        $msg = "<div class='alert alert-danger'>Passwords do not match.</div>";
    } else {
        // Update password and username
        if (updatePasswordAndUsername($conn, $currentUsername, $newPassword)) {
            $_SESSION['username'] = $newPassword; // Update the session with new username
            $msg = "<div class='alert alert-success'>Password and Username updated successfully. Redirecting...
            <meta http-equiv='refresh' content='4; dashboard.php'></div>";
        } else {
            $msg = "<div class='alert alert-danger'>Failed to update Password and Username.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <style>
        body{
            background-image: linear-gradient(-45deg, black, #337ab7);
        }
        .container {
            padding: 20px;
            color: black;
            border-color: #46b8da;
        }
        .welcomemsg {
            text-transform: uppercase;
            font-size: 20px;
            text-decoration: underline;
        }
        .form-group label {
            font-weight: bolder;
        }
        .form-group input {
            border-radius: 10px;
        }
        .form-group .alert {
            margin-top: 5px;
        }
        .btn-info {
            background-color: #5bc0de;
            border-color: #46b8da;
        }
        .btn-info:hover {
            background-color: #31b0d5;
            border-color: #269abc;
        }
        .jumbotron {
            padding: 60px;
            box-shadow: 0 4px 8px rgba(255,0,0, 0.9);
            border-radius: 50px;
        }
        .larea {
            display: block;
            margin: 0 auto;
            width: 100px;
        }
    </style>
</head>

<body style="height: 100vh; font-family: Ubuntu;">
<img src="images/logo copy.png" class="larea" alt="">

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php echo $msg; ?>
            <div class="jumbotron">
                <form method="post" action="change_pass.php">
                    <p class="welcomemsg" style="font-weight: bolder;">Change Password</p>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                    <a href="dashboard.php"  class="text-cente btn btn-danger ">Back to Dashboard</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
