<?php
ob_start();
session_start();
$msg1 = ""; $msg2 = ""; $msg3 = ""; $username=''; $password='';
require ('../config.php');
require('../functions.php');

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username'], ENT_QUOTES, 'utf-8'));
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($username)) {
        $msg1 = "<div class='alert alert-danger'>Username is required.</div>";
    } elseif(empty($password)) {
        $msg2 = "<div class='alert alert-danger'>Password can't be empty.</div>";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check login credentials
        if(loginCheck($conn, $username, $password)) {
            // Login successful
            $_SESSION['name'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            // Login failed
            $msg3 = "<div class='alert alert-danger'>Incorrect username or password.</div>";
        }
    }
}

?>

<?php
  if(isset($_SESSION['name'])){
      header('location: dashboard.php');
  }else{
      
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin login | Result Checking Portal</title>
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
        
     .container {
           
            
           padding: 20px;
           color: black;
           border-color: #46b8da;
       }
       .welcomemsg {
           text-transform: uppercase;
           font-size: 20px;
           text-decoration: underline;
           font-weight: bolder;
           color: black;
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
<!-- body starts -->
<body style="height: 100vh; font-family: Ubuntu;">
<img src="images/logo.png" class="larea" alt="">
  <div class="container">
      <div class="row">
          <div class="col-md-6 col-md-offset-3 welcome">
           
              <?php echo $msg3; ?>
              
              <div class="jumbotron">
                  <form action="" method="post">
                  <p class="welcomemsg" style="font-weight: bolder;">Admin Login form</p>
                      <div class="form-group">
                          <label for="username">Enter Username</label>
                          <input type="text"  id="username" name="username" class="form-control" value="<?php echo $username?>">
                          <?php echo $msg1; ?>
                      </div>

                      <div class="form-group">
                          <label for="password">Enter Password</label>
                          <input type="password"  id="password" name="password" class="form-control" value="<?php echo $password ?>">
                          <?php echo $msg2; ?>
                      </div>

                      <input type="submit" value="Login" name="submit" class="btn btn-info btn-lg">

                  </form>
              </div>
          </div>


      </div>
  </div>

















<!-- copyright -->
<p class="agile-copyright navbar-fixed-bottom btn-danger text-light" >&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
<!-- //copyright -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>	
<!-- //body ends -->
</html>
<?php }?>
