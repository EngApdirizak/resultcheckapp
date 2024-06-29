<?php
include ('../config.php');
if(!empty($_POST['name']) AND !empty($_POST['sex']) AND !empty($_POST['class'])
   AND !empty($_POST['reg_no']) AND !empty($_POST['username'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $class = $_POST['class'];
    $sex = $_POST['sex'];
    $reg_no = $_POST['reg_no'];

    //check if username already exists
    $sql = "SELECT registerNo FROM student WHERE registerNo ='$reg_no'";
    
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        echo "<script>
              toastr['error']('Username Already Exists.');
        </script>";
        return false;
    }

    //check if name already exists
    $sql = "SELECT name FROM student WHERE name ='$name'";
    $query = mysqli_query($conn, $sql);
  

    //check if reg no already exists
    
    $query = mysqli_query($conn, $sql);
 
//all checks passed, insert data into database
    $sql = "INSERT INTO student (name, sex, classesID, registerNO, username)
             VALUES ('$name', '$sex', '$class', '$reg_no', '$username')";
             
    $query = mysqli_query($conn, $sql);

    if($query){
        echo "<script>
              toastr['success']('Student $name has been successfully registered');
        </script>";
        echo "<meta http-equiv='refresh' content='4; add_student.php'>";
    }else{
        echo "<script>
              toastr['error']('Error registering student');
        </script>";
    }

}else{
    echo "<script>
              toastr['error']('Fields marked (*) are required.');
        </script>";
}