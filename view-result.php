<?php
session_start();
require('config.php');
require('functions.php');
$msg1 = "";
$msg2 = "";

if (isset($_SESSION['username']) && isset($_SESSION['registerNO']) && isset($_GET['term']) && isset($_GET['year'])) {
    $username = $_SESSION['username'];
    $regno = $_SESSION['registerNO'];
    $exam_year = $_GET['year'];
    $exam_term = $_GET['term'];

    // Get user's information from the database
    $sql = "SELECT * FROM student WHERE username = ? AND registerNO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $regno);
    $stmt->execute();
    $query = $stmt->get_result();

    if ($query->num_rows > 0) {
        $result = $query->fetch_assoc();
        $name = $result['name'];

        // Proceed with querying the terminal_report table to fetch result information for the user
        $result_sql = "SELECT * FROM terminal_report WHERE student_name = ? AND exam_year = ? AND exam_term = ?";
        $stmt2 = $conn->prepare($result_sql);
        $stmt2->bind_param("sss", $name, $exam_year, $exam_term);
        $stmt2->execute();
        $result_query = $stmt2->get_result();
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
    <title>View Terminal Result</title>
    <style>
        .text-center {
            text-decoration: underline;
        }
        .text-cente {
           background-color: #337ab7;
        }
        .text-cent {
            background-color: #337ab7;
        }
        .jumbotron {
            padding: 60px;
            box-shadow: 0 4px 8px rgba(30,144,255, 0.9);
            border-radius: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="jumbotron">
            <a href="dashboard.php" class="text-cente btn btn-info pull-right">Back to Dashboard</a>
            <h1 class="text-center" style="margin-top: 50px !important;">View Terminal Report</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="table-dark" style="color: #000; font-weight: bold;">
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Exam Class</th>
                            <th>Exam Term</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_query->num_rows > 0) {
                            while ($result_show = $result_query->fetch_assoc()) {
                                $user_id = $result_show['id'];
                                $studentName = $result_show['student_name'];
                                $terminal_result = $result_show['report_card'];
                                $year = $result_show['exam_year'];
                                $term = $result_show['exam_term'];
                        ?>
                                <tr>
                                    <td><?= $user_id; ?></td>
                                    <td><?= $studentName; ?></td>
                                    <td><?= $year; ?></td>
                                    <td><?= $term; ?></td>
                                    <td>
                                        <a href="./images/results/<?= $terminal_result; ?>" target="_blank"><button class="text-cente btn btn-info">View</button></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="5" class="text-center">No result found for user <?= $name; ?>. Please check back later.</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?= $msg2; ?>
        </div>
    </div>
</div>
<p class="text-cent agile-copyright navbar-fixed-bottom btn-dan text-light">&copy; <?= date('Y'); ?> | Design by <a href="https://www.facebook.com/KudunSon757?mibextid=LQQJ4d" target="_blank">Apdirizak Apdikadir Hassen</a></p>
</body>
</html>
<?php
    } else {
        $msg1 = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
?>
<meta http-equiv="refresh" content="2; index.php">
<?php
    }
} else {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not Authorised</title>
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1 class="alert alert-danger">You are not authorized to view this page.</h1>
    </div>
    <p class="text-center" style="font-size: 20px;">You will be redirected to the login page in 4s.</p>
    <meta http-equiv="refresh" content="4; index.php">
</div>
</body>
</html>
<?php
}
?>
