<?php
session_start();
$msg1 = ""; $msg2 = ""; $msg3 = ""; $username=''; $password='';
require ('../config.php');
require('../functions.php');

?>

<?php
  if(isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add a student</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Kelseywebsolutions Academy Online Result Checker Application, WAEC Result Checking,
      Best Result Checker app, Result checking app in Nigeria" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<!-- css files -->
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
<link rel="stylesheet" href="css/select2.min.css">
<link rel="stylesheet" href="css/toastr.min.css">
    <!-- //css files -->
    <style>
        body{
            background-image: linear-gradient(-45deg, black, #337ab7);
        }
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
        .header{
            font-weight: 700;
            font-size: 19px;
        }
        select{
            border-radius: 20px;
            outline: none;
        }
        .text-cent{
            background-color:#337ab7;
        }

        .parsley-required, .parsley-pattern{color: #f00 !important;}
        .parsley-error{background: #f0b2b2;}
        .parsley-success{background: #b8eeb8;}
        .fa-trash{
            background:  #ff5b57;
            padding: 5px;
            border-radius: 2px;
            color: white;
            font-size: 11px;
        }
    </style>
</head>
<!-- body starts -->
<body style="height: 100vh; font-family: Ubuntu;">
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2 welcome">
             <p class="welcomemsg">Add a student </p>
              <?php echo $msg3; ?>
              <h3 class="text-center header" style="margin-bottom: 20px;">Complete student details below </h3>
              <div class="jumbotron">
                  <form class="form-horizontal" id="student-add" method="POST" action="process-add-student.php">
                      <div class="card-body">

                          <div class="form-group row">
                              <label for="name" class="col-sm-3 col-form-label">Student Name <span
                                          style="color: #f00;">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="name" required="true"
                                         name="name">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="sex" class="col-sm-3 col-form-label">Sex <span
                                          style="color: #f00;">*</span></label>
                              <div class="col-sm-9">
                                  <select name="sex" id="sex" class="form-control" required="true">
                                      <option value="">Select sex</option>
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="class" class="col-sm-3 col-form-label">Class <span
                                          style="color: #f00;">*</span></label>
                              <div class="col-sm-9">
                                  <?php
                                  //fetch all classes
                                  $sql = "SELECT * FROM classes";
                                  $query = mysqli_query($conn, $sql);
                                  ?>

                                  <select name="class"  class="form-control select2" required="true">
                                      <option value="">Select Department</option>
                                      <?php
                                      if (mysqli_num_rows($query) > 0) {

                                          while($class = mysqli_fetch_array($query)){
                                              ?>
                                              <option value="<?php echo $class['classesID']; ?>">
                                                  <?php echo $class['classes']; ?></option>
                                              <?php
                                          }
                                      } else {
                                          ?>
                                          <option value="">No classes found</option><?php
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="reg_no" class="col-sm-3 col-form-label">Username <span
                                          style="color: #f00;">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="reg_no" required name="reg_no">
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="ID" class="col-sm-3 col-form-label">password<span
                                          style="color: #f00;">*</span></label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" id="username" required
                                         name="username">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="state" class="col-sm-3 col-form-label"></label>
                              <div class="col-sm-9">
                                  <input type="submit" name="add_student" value="Add student"
                                         class="btn btn-info" id="submit">
                                  <a href="view-all-students.php" class="btn btn-success">Back to All Students</a>
                              </div>
                          </div>

                      </div>
                      <div id="success-msg"></div>
                      <!-- /.card-body -->

                      <!-- /.card-footer -->
                  </form>
              </div>
          </div>


      </div>
  </div>

<!-- copyright -->
<p class="text-cent agile-copyright navbar-fixed-bottom btn-dan text-light">&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
<!-- //copyright -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  <script src="js/jquery.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="js/parsley.min.js"></script>
  <script src="js/toastr.min.js"></script>

  <script>
      $(document).ready(function () {
        $('.select2').select2();
      })
  </script>

  <script>
      $('#student-add').parsley();
      $('#student-add').on('submit', function (event) {
          event.preventDefault();
          if ($('#student-add').parsley().isValid()) {
              $.ajax({
                  url: 'process-add-student.php',
                  method: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function () {
                      $('#submit').attr('disabled', 'disabled');
                      $('#submit').val('Saving student details, pls wait.....');
                  },
                  success: function (data) {
                      $('#student-add').parsley().reset();
                      $('#submit').attr('disabled', false);
                      $('#submit').val('Submit');
                      $('#success-msg').html(data);
                  }
              });
          }

      });
  </script>

</body>	
<!-- //body ends -->
</html>
<?php }else{

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
          <p class="text-center" style="font-size: 20px;">You will redirected to the login page in 4s.</p>
          <meta http-equiv="refresh" content="1; index.php">
      </div>

      </body>
      </html>
      <?php


  } ?>
