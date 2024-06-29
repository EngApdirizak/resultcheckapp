<?php
session_start();
include('../config.php');
include ('../functions.php');

if(isset($_GET['delete'])){
    $studentUsername = $_GET['delete'];

    //query
    $sql = "DELETE FROM student WHERE username = '$studentUsername'";
    $query = mysqli_query($conn, $sql);
    if($query){
        ?>
        <script>
            alert('Student Data was deleted Successfully.');
        </script>
            <meta http-equiv="refresh" content="2; view-all-students.php">
        <?php
    }

}else{
    ?>
    <script>
        alert('Error pls try again.')
    </script>
    <meta http-equiv="refresh" content="3; view-all-students.php">
    <?php
}
