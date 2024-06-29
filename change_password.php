<?php
session_start();
$msg1 = ""; $msg2 = ""; $msg3 = "";
require ('../config.php');
require('../functions.php');

if(!isset($_SESSION['name'])){
    header('Location: index.php');
    exit;
}

$username = $_SESSION['name'];

if(isset($_POST['submit'])){
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if(empty($new_password)){
        $msg1 = "<div class='alert alert-danger'>New password is required.</div>";
    } elseif(empty($confirm_password)){
        $msg2 = "<div class='alert alert-danger'>Confirm password is required.</div>";
    } elseif($new_password !== $confirm_password){
        $msg3 = "<div class='alert alert-danger'>Passwords do not match.</div>";
    } else {
        // Update password in the database without hashing
        $sql = "UPDATE admin SET password = '$new_password' WHERE username = '$username'";
        if(mysqli_query($conn, $sql)){
            $msg3 = "<div class='alert alert-success'>Password changed successfully.<meta http-equiv='refresh' content='2; dashboard.php'></div>";
        } else {
            $msg3 = "<div class='alert alert-danger'>Error updating password.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="best school in Olodi Apapa, Prince Charles International School." />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <style>
        body{
            background-image: linear-gradient(-45deg, black, #337ab7);
        }
        .container { padding: 20px; color: black; border-color: #46b8da; }
        .welcomemsg { text-transform: uppercase; font-size: 20px; text-decoration: underline; font-weight: bolder; color: black; }
        .form-group label { font-weight: bolder; }
        .form-group input { border-radius: 10px; }
        .form-group .alert { margin-top: 5px; }
        .btn-info { background-color: #5bc0de; border-color: #46b8da; }
        .btn-info:hover { background-color: #31b0d5; border-color: #269abc; }
        .jumbotron { padding: 60px; box-shadow: 0 4px 8px rgba(255,0,0, 0.9); border-radius: 50px; }
        .larea {
            display: block;
            margin: 0 auto;
            width: 100px;
        }
    </style>
</head>
<body style="height: 100vh; font-family: Ubuntu;">
<img src="images/logo.png" class="larea" alt="">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 welcome">
            <?php echo $msg3; ?>
            <div class="jumbotron">
                <form action="" method="post">
                    <p class="welcomemsg" style="font-weight: bolder;">Change Password</p>
                    <div class="form-group">
                        <label for="new_password">Enter New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control">
                        <?php echo $msg1; ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        <?php echo $msg2; ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
                    
                    <a href="dashboard.php"  class="text-cente btn btn-danger ">Back to Dashboard</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
