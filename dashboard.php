<?php
ob_start();
session_start();
$msg1 = ""; $msg2 = ""; $msg3 = ""; $msg4 = ""; $msg5=''; $msg6=''; $result_file='';
require ('../config.php');
require('../functions.php');

if(isset($_SESSION['name'])){
    $username = $_SESSION['name'];

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
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function () {
                $('#classID').on('change', function () {
                    let classID = $(this).val();
                    if(classID){
                        $.ajax({
                            type: 'POST',
                            url: 'data.php',
                            data: 'classesID=' +classID,
                           success: function (html) {
                               $('#student').html(html);
                           }

                        });
                    }else{
                        $('#student').html('<option value="">select class first.</option>');
                    }
                })
            })
        </script>
        <!-- //custom-theme -->
        <!-- css files -->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
        <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="css/select2.min.css">
        <link rel="stylesheet" href="css/toastr.min.css">
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
                color: #337ab7 ;
                font-size: 20px;
                text-transform: uppercase;
                font-weight: bolder;
                text-decoration: underline;
            }
            .header{
                font-weight: 700;
                font-size: 19px;
                color: #337ab7 ;
                text-decoration: underline;
                

            
            }
            select{
                border-radius: 20px;
                outline: none;
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
            .text-cent{
                background-color:#337ab7 ;
            }
            .jumbotron {
            
            padding: 60px;
             box-shadow: 0 4px 8px rgba(30,144,255, 0.9);
            border-radius: 50px;
            
        }
        </style>
    </head>
    <!-- body starts -->
    <body style="height: 100vh; font-family: Ubuntu;">
    <div class="container">
        <div class="row">
           
            <div class="col-md-4" style="margin-top: 23px;">
                <p class="welcome2">Admin Dashboard</p>
                     <ul class="nav nav-pills nav-stacked">
                     <li class="active"><a href="dashboard.php">Dashboard</a></li>
                     <li><a href="view-uploaded-results.php">View Uploaded Results</a></li>
                     <li><a href="view-all-students.php">View All Students</a></li>
                     <li><a href="add_student.php">Add a Student</a></li>
                     <li><a href="change_password.php">Change Password</a></li>
                     <li><a href="logout.php?logout=true">Logout</a></li>
                      </ul>
                <p>Need Assistance?</p>
                <h2 class="text-center" style="margin-bottom: 20px;"><a href="tel:+252907804086"> Call: +252907804086</a></h2>
            </div>
            <div class="col-md-8 welcome">
                <p class="text-center header">Welcome <?php echo $username;  ?></p>
                
                <div class="jumbotron">
                    <form action="" method="post" enctype="multipart/form-data" id="upload-result-form">
                                <?php
                                   $sql = "SELECT * FROM classes ORDER BY classesID";
                                   $query = mysqli_query($conn, $sql);
                                   ?>
                                    <!-- Classes Dropdown-->

                                   <div class="form-group row">
                                    <label for="classID" class="col-sm-3 col-form-label"style="font-weight:bolder;">Student's_Fuculty</label>
                                       <div class="col-sm-9">
                                           <select name="classID" id="classID" class="select2 form-control" required data-parsley-trigger="keyup">
                                               <option value="">Select Department</option>
                                               <?php
                                               if(mysqli_num_rows($query) > 0){
                                                   while($row = mysqli_fetch_array($query)){
                                                       echo '<option value="'.$row['classesID'].'">'.$row['classes'].'</option>';
                                                   }
                                               }else{
                                                   echo "<option value=''>No Classes Found.</option>";
                                               }
                                               ?>
                                           </select>
                                       </div>
                                       <?php echo $msg1; ?>
                                   </div>


                        <div class="form-group row">
                            <label for="student" class="col-sm-3 col-form-label"style="font-weight:bolder;">Student's Name</label>
                            <div class="col-sm-9">
                                <select name="student" id="student" class="form-control select2" required data-parsley-trigger="keyup">
                                    <option value="">Select class first</option>

                                </select>
                            </div>
                            <?php echo $msg2; ?>
                        </div>

                        <div class="form-group row">
                            <label for="examyear" class="col-sm-3 col-form-label"style="font-weight:bolder;">Examination_Class</label>
                           <div class="col-sm-9">
                               <select name="examyear" id="examyear" class="form-control select2" required data-parsley-trigger="keyup">
                                   <option value="">Select class</option>
                                   <?php
                                  
                                   ?><?php
                                   ?>
                                   <option value="Freshman">Freshman</option>
                                   <option value="Sophomore">Sophomore</option>
                                   <option value="Junior">Junior</option>
                                   <option value="Senior">Senior</option>
                                   
                               </select>
                           </div>
                        </div>

                        <div class="form-group row">
                            <label for="examterm" class="col-sm-3 col-form-label"style="font-weight:bolder;">Examination_Term</label>
                          <div class="col-sm-9">
                              <select name="examterm" id="exam term" class="form-control select2" required data-parsley-trigger="keyup">
                                  <option value="">Select term</option>
                                  <option value="1st_term">First Semestar</option>
                                  <option value="2nd_term">Second Semestar</option>
                              </select>
                          </div>
                            <?php echo $msg3; ?>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-sm-3 col-form-label"style="font-weight:bolder;">Select Result</label>
                            <div class="col-sm-9">
                                <input type="file" name="result_file" class="form-control" required data-parsley-trigger="keyup">
                            </div>
                            <?php echo $msg4; ?>
                        </div>
                        <input type="submit" value="Upload Result" name="submit" class="btn btn-primary" id="submit">
                           <?php echo $msg5; ?>
                           <?php echo $msg6; ?>

                        <div id="success-msg"></div>

                    </form>
                </div>
            </div>

        </div>
    </div>


     
















    <!-- copyright -->
    <footer>
    <p class="text-cent agile-copyright navbar-fixed-bottom btn-dan text-light">&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
        <!-- //copyright -->
    </footer>
    <script src="js/select2.min.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        })
    </script>


    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <script>
        $('#upload-result-form').parsley();
        $('#upload-result-form').on('submit', function (event) {
            event.preventDefault();
            if ($('#upload-result-form').parsley().isValid()) {
                $.ajax({
                    url: 'process-upload-result.php',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').val('Uploading Result, pls wait.....');
                    },
                    success: function (data) {
                        $('#upload-result-form').parsley().reset();
                        $('#submit').attr('disabled', false);
                        $('#submit').val('Upload Result');
                        $('#success-msg').html(data);
                    }
                });
            }

        });
    </script>

    </body>
    <!-- //body ends -->
    </html>
<?php } else {

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

}?>