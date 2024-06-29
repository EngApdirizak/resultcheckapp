<?php
session_start();
$msg1=''; $msg2=''; $msg3='';
require ('../config.php');
require('../functions.php');

if(isset($_SESSION['name'])){
    $username = $_SESSION['name'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin | View Uploaded Results</title>
        <!-- custom-theme -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="best school in Olodi Apapa, Prince Charles International School." />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <script src="js/jquery.js"></script>
        <!-- css files -->
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
        <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
        <style>
            body{
                background-image: linear-gradient(-45deg, black, #337ab7);
            }
            .text-cent{
                background-color: #337ab7 ;
            }
            .pagination>li>a{
                left: 45% !important;
            }
            .table-responsive{
                clear: both;
            }
            .form-control{
                display: inline;
                width: 70% !important;
                height: 36px;
            }
            div.dataTables_wrapper div.dataTables_paginate{
                text-align: center !important;
            }
            @media only screen and (max-width: 768px) {
           .pagination>li>a{
               left: 45% !important;
           }
        }
        </style>
    </head>
    <!-- body starts -->
    <body style="height: 100vh; font-family: Ubuntu;">
    <div class="container">
        <!-- Page Heading -->
        <br>
        
        <div class="row">
        <form method="GET" action="" class="pull-right" style="margin-right: 1px;">
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Enter student name">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            <div class="col-md-12" style="background: #fbf4f4; margin-bottom: 90px;">
                <div id="result"></div>
                
                <p class="pull-right" style="margin-right: 15px;">
                    <a href="dashboard.php" class="text-cent btn btn-info">Back to dashboard</a>
                </p>
               

                <!-- Search Form -->
               

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="basic">
                        <tr class="table-dark" style="color: #000; font-weight: bold;">
                            <th>S.n</th>
                            <th style="text-align: center;">ClassID</th>
                            <th style="text-align: center;">Student Name</th>
                            <th style="text-align: center;">Exam Class</th>
                            <th style="text-align: center;">Exam Term</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $sql = "SELECT * FROM terminal_report";
                        if ($search != '') {
                            $sql .= " WHERE student_name LIKE '%$search%'";
                        }
                        $sql .= " ORDER BY id DESC";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                                $classID = $row['ClassID'];
                                $student_name = $row['student_name'];
                                $exam_year = $row['exam_year'];
                                $exam_term = $row['exam_term'];
                                $reportCard = $row['report_card'];
                                if($classID == 1){
                                    $class  = 'Computer Science';
                                }elseif($classID == 2){
                                    $class  = 'Telecom';
                                }elseif($classID == 3){
                                    $class  = 'Engineering';
                                }elseif($classID == 4){
                                    $class  = 'Public Health';
                                }elseif($classID == 5){
                                    $class  = 'BIT';
                                }else{
                                    $class  = 'Diploma';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: center;"><?php echo $class; ?></td>
                                    <td style="text-align: center;"><?php echo $student_name; ?></td>
                                    <td style="text-align: center;"><?php echo $exam_year; ?></td>
                                    <td style="text-align: center;"><?php echo $exam_term; ?></td>
                                    <td style="text-align: center;">
                                        <a href="delete.php?name=<?php echo $student_name;?>&year=<?php echo $exam_year?>" class="btn btn-danger">Delete</a>
                                        <a href="../images/results/<?php echo $reportCard;?>" class="btn btn-success" target='_blank'>View</a>
                                        <a href="../download.php?result=<?php echo $reportCard; ?>" class="btn btn-info">Download</a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" align="center"><?php echo "No results found."; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright -->
    <footer>
        <p class="text-cent agile-copyright navbar-fixed-bottom btn-dan text-light">&copy; <?php echo date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
    </footer>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
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
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
