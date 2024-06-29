<?php
session_start();
$msg1 = ''; $msg2 = ''; $msg3 = ''; $msg4 = ''; $username = ''; $regno = '';
require('config.php');
require('functions.php');

// Check for form status
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username'], ENT_QUOTES, 'utf-8'));
    $regno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['regno'], ENT_QUOTES, 'utf-8'));
    
    if (empty($username)) {
        $msg1 = "<div class='alert alert-danger'>Username is required.</div>";
    } elseif (!usernameCheck($conn, $username, $regno )) {
        $msg1 = "<div class='alert alert-danger'>Incorrect username or password.</div>";
    } elseif (empty($regno)) {
        $msg2 = "<div class='alert alert-danger'>Registration number is required.</div>";
    } elseif (empty($_POST['checkbox'])) {
        $msg3 = "<div class='alert alert-danger'>Accept school terms</div>";
    } else {
        // Check for user password matching database password first
        $sql = "SELECT * FROM student WHERE username = '$username' AND registerNO = '$regno'";
        $query = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($query) > 0) {
            $result = mysqli_fetch_array($query);
            $dbregno = $result['registerNO'];
            $dbusername = $result['username'];
            
            if ($dbusername == $username && $dbregno == $regno) {
                $_SESSION['username'] = $username;
                $_SESSION['registerNO'] = $regno ;
                $msg4 = "<div class='alert alert-success'>Login Successful.. <span style='color: #4b7f80;'>redirecting.</span>
                <meta http-equiv='refresh' content='4; dashboard.php'></div>";
            } else {
                $msg4 = "<div class='alert alert-danger'>Please double check your details</div>";
            }
        }
    }
}

// Redirect user back to dashboard if username session is set
if (isset($_SESSION['username']) && isset($_SESSION['registerNO'])) {
    header('location:dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>student login | Result Checking Portal</title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="best school in Olodi Apapa, Prince Charles International School." />
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <style>
       
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
        .form-group label{
            font-weight: bolder;
        }
        .form-group input {
            border-radius: 10px;
        }
        .form-group .alert {
            margin-top: 5px;
        }
        .checkbox label {
            color: black;
            font-weight: bolder;
        }
        .btn-info {
            background-color: #5bc0de;
            border-color: #46b8da;
        }
        .btn-info:hover {
            background-color: #31b0d5;
            border-color: #269abc;
        }
        .larea {
            display: block;
            margin: 0 auto;
            width: 100px;
        }
        .jumbotron {
            
            padding: 60px;
             box-shadow: 0 4px 8px rgba(255,0,0, 0.9);
            border-radius: 50px;
            
        }
    </style>
</head>
<body style="height: 100vh; font-family: Ubuntu;">
<img src="images/logo copy.png" class="larea" alt="">

    <div class="container">
    
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                
                <?php echo $msg4; ?>
                <div class="jumbotron">
                    <form action="index.php" method="post">
                    <p class="welcomemsg" style="font-weight: bolder;">Student Login form</p>
                        <div class="form-group">
                            <label for="regno">Enter Username</label>
                            <input type="text" id="regno" name="regno" class="form-control" value="<?php echo $regno; ?>">
                            <?php echo $msg1; ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Enter password</label>
                            <input type="Password" id="username" name="username" class="form-control" value="<?php echo $username; ?>">
                            <?php echo $msg2; ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="checkbox"> I agree to the <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d">Academy's Terms and Conditions</a>
                            </label>
                            <?php echo $msg3; ?>
                        </div>
                        <input type="submit" value="Login" name="submit" class="btn btn-info btn-lg">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright -->
    <p class="agile-copyright navbar-fixed-bottom btn-danger text-light">&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5d98f82d6c1dde20ed0532f8/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
