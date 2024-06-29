<?php
session_start();
$msg1 = $msg2 = $msg3 = $msg4 = $msg5 = $msg6 = $msg7 = $msg8 = '';
require('./config.php');
require('./functions.php');

if (isset($_SESSION['username']) && isset($_SESSION['registerNO'])) {
    $dt1 = new DateTime();
    $current_date = $dt1->format('Y-m-d');

    $username = $_SESSION['username'];
    $regno = $_SESSION['registerNO'];

    // Fetch user's information including registerNo
    $sql = "SELECT * FROM student WHERE username = '$username' AND registerNO = '$regno'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $result = mysqli_fetch_assoc($query);
        if ($result) {
            $name = $result['name'];
            $regno = $result['registerNO'];

            // Proceed with displaying user's information or processing form
            if (isset($_POST['submit'])) {
                // Perform form validations
                $exam_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['examyear'], ENT_QUOTES, 'utf-8'));
                $exam_term = mysqli_real_escape_string($conn, htmlspecialchars($_POST['examterm'], ENT_QUOTES, 'utf-8'));

                if (empty($exam_year)) {
                    $msg2 = "<div class='alert alert-danger'>Please select examination year.</div>";
                } elseif (empty($exam_term)) {
                    $msg3 = "<div class='alert alert-danger'>Please select examination term.</div>";
                } else {
                    // Process form submission
                    // Perform necessary queries and actions
                    // Example: updating database, redirecting to result page
                    $msg6 = "<div style='text-align: center;'>
                                <p style='text-align: center;'>We are fetching Result.... Please wait.</p>
                                <img src='images/loader.gif' alt='loading image'>
                                <meta http-equiv='refresh' content='4; view-result.php?name=$name&term=$exam_term&year=$exam_year'>
                             </div>";
                }
            }
        } else {
            // No user found with the session username and registration number
            $msg4 = "<div class='alert alert-danger'>No user found with the provided credentials.</div>";
        }
    } else {
        // Handle query failure
        die('Query Failed: ' . mysqli_error($conn));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Result Checking Portal</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="best school in Olodi Apapa, Prince Charles International School." />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    
    <!-- //custom-theme -->
    <!-- css files -->
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <!-- //css files -->
    <style>
        .container{
            background: #fff;
            border-radius: 10px;
            margin-bottom: 90px;
        }
        .welcomemsg{
            text-transform: uppercase;
            color: #9a2448;
            font-size: 20px;
        }
        .welcome2{
            color: #337ab7;
            font-size: 20px;
            text-transform: uppercase;
            font-weight: bolder;
            text-decoration: underline;
        }
        .header{
            font-weight: 700;
            font-size: 19px;
            color: #337ab7;
            text-decoration: underline;
        }
        select{
            border-radius: 5px;
            outline: none;
        }
        .btn-info{
            background: #337ab7 !important;
        }
        .jumbotron {
            padding: 60px;
            box-shadow: 0 4px 8px rgba(30,144,255, 0.9);
            border-radius: 50px;
        }
        .text-cent{
            background-color:#337ab7 ;
        }
    </style>
</head>
<!-- body starts -->
<body style="height: 100vh; font-family: Ubuntu;">
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <p class="welcome2">Student Dashboard</p>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="change_pass.php">Change password</a></li>
                <li><a href="https://wa.link/nq2ezg" target="_blank">Contact</a></li>
                <li><a href="logout.php?logout=true">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-8 welcome">
            <p class="text-center header">Welcome <?php echo $name; ?></p>
            <?php echo $msg6; ?>
            <div class="jumbotron">
                <?php echo $msg4; ?>
                <form action="dashboard.php" method="post">
                    <div class="form-group">
                        <label for="examyear" style="font-weight:bolder;">Examination Class</label>
                        <select name="examyear" id="examyear">
                            <option value="">Select Class</option>
                            <option value="Freshman">Freshman</option>
                            <option value="Sophomore">Sophomore</option>
                            <option value="Junior">Junior</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <?php echo $msg2; ?>
                    </div>
                    <div class="form-group">
                        <label for="examterm" style="font-weight:bolder;">Examination Term</label>
                        <select name="examterm" id="examterm">
                            <option value="">Select term</option>
                            <option value="1st_term">First semester</option>
                            <option value="2nd_term">Second semester</option>
                        </select>
                        <?php echo $msg3; ?>
                    </div>
                    <input type="submit" value="Check Result" name="submit" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- copyright -->
<p class="text-cent agile-copyright navbar-fixed-bottom btn-dan text-light">&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
<!-- //copyright -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5d98f82d6c1dde20ed0532f8/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>
<!-- //body ends -->
</html>
<?php 
} else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <title>Login first</title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1 class="alert alert-danger">You must login to Access this Page.</h1>
    </div>
    <p class="text-center" style="font-size: 20px;">You will be redirected to the login page in 1s.</p>
    <meta http-equiv="refresh" content="1; index.php">
</div>
</body>
</html>
<?php
}
?>
