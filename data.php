<?php
include ('../config.php');
if(!empty($_POST['classesID'])){
   //fetch student's data based on the specific class
    $sql = "SELECT * FROM student WHERE classesID = ".$_POST['classesID']." ORDER BY name";
    $query = mysqli_query($conn, $sql);
    //generate HTML of student option
    if(mysqli_num_rows($query) > 0){
        echo "<option value=''>Select student's name</option>";
        while($row = mysqli_fetch_array($query)){
             echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
    }else{
        echo "<option value=''>Names not found.</option>";
    }
}else{
    echo "<option value=''>error occurred.</option>";
}