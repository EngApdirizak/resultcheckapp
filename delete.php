<?php
session_start();
include('../config.php');
include ('../functions.php');

if(isset($_GET['name']) && isset($_GET['year'])){
    $studentName = $_GET['name'];
    $exam_year = $_GET['year'];
    //query
    $sql = "DELETE FROM terminal_report WHERE student_name = '$studentName' && exam_year ='$exam_year' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    if($query){
        ?>
        <script>
            alert('Result deleted Successfully.');
        </script>
            <meta http-equiv="refresh" content="2; view-uploaded-results.php">
        <?php
    }

}else{
    ?>
    <script>
        alert('Error pls try again.')
    </script>
    <meta http-equiv="refresh" content="3; view-uploaded-results.php">
    <?php
}
