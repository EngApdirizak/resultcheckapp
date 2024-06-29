<?php
include ('../config.php');
include ('../functions.php');
if(!empty($_POST['classID']) AND !empty($_POST['student']) AND !empty($_POST['examyear'])
   AND !empty($_POST['examterm']) AND !empty($_FILES['result_file']['name'])){

    $student_class = mysqli_real_escape_string($conn, htmlspecialchars($_POST['classID'], ENT_QUOTES, 'utf-8'));
    $student_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['student'], ENT_QUOTES, 'utf-8'));
    $exam_year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['examyear'], ENT_QUOTES, 'utf-8'));
    $exam_term = mysqli_real_escape_string($conn, htmlspecialchars($_POST['examterm'], ENT_QUOTES, 'utf-8'));

    //run image upload information here
    $result_file = $_FILES['result_file']['name'];
    $result_file_temp = $_FILES['result_file']['tmp_name'];
    $file_size = $_FILES['result_file']['size'];
    $filenameArray = explode('.', $result_file);
    $extension = end($filenameArray);
    $ext = strtolower($extension);
    $uniqueName = rand(1, 1000).rand(1,1000).time().".".$ext;
    $storagePath = "../images/results/".$uniqueName;

    // if($ext === 'pdf'){

        if($result_file == ""){
            echo "<script>
              toastr['error']('Please select the PDF file of the student result.');
        </script>";
        }elseif(checkForYear($conn, $student_name, $exam_year, $exam_term)){
            //check if result has already been uploaded for the student
            echo "<script>
              toastr['error']('Result has already been uploaded for term $exam_term and year $exam_year.');
        </script>";
        }else{
            $upload_file = move_uploaded_file($result_file_temp, $storagePath);
            if($upload_file){
                // we run the upload file and continue with the rest.
                //all tests passed insert result into database.
                $sql = "INSERT INTO terminal_report (classID, report_card, student_name, exam_year, exam_term) 
                        VALUES ('$student_class', '$uniqueName', '$student_name', '$exam_year', '$exam_term')";
                $query = mysqli_query($conn, $sql);
                if($query){
                    echo "<script>
                          toastr['success']('Result uploaded successfully for student $student_name');
                        </script>";
                    echo "<meta http-equiv='refresh' content='3; dashboard.php'>";

                }else{
                    $msg6= "<div class='alert alert-danger'>An error occurred while uploading result.</div>";
                }
            }else{
                echo "<script>
                          toastr['error']('An error occurred while uploading result.');
                        </script>";
            }
        }
    // }else{
        // echo "<script>
        //          toastr['error']('Only PDF Files are allowed.');
        //        </script>";
    }

else{
    echo "<script>
              toastr['error']('All fields are required.');
        </script>";
}