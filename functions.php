<?php
ob_start();
function usernameCheck($conn, $username, $regno) {
    // Query to check if the username and registration number match
    $sql = "SELECT * FROM student WHERE username = '$username' AND registerNO = '$regno'";
    $query = mysqli_query($conn, $sql);

    // Return true if there is a match, otherwise false
    return mysqli_num_rows($query) > 0;
}
function loginCheck($conn, $username, $password){
    // Query database
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    if($query){
        $result = mysqli_fetch_array($query);
        $dbusername = $result['username'];
        if($username == $dbusername){
            // Check if password matches
            $dbpass = $result['password'];
            if($password == $dbpass){
                return true; // Login successful
            } else {
                return false; // Incorrect password
            }
        }
    }
    return false; // Username not found
}
function updatePassword($conn, $username, $new_password, $confirm_password) {
    if(empty($new_password)) {
        return "<div class='alert alert-danger'>New password is required.</div>";
    } elseif(empty($confirm_password)) {
        return "<div class='alert alert-danger'>Confirm password is required.</div>";
    } elseif($new_password !== $confirm_password) {
        return "<div class='alert alert-danger'>Passwords do not match.</div>";
    } else {
        // Update password in the database without hashing
        $sql = "UPDATE admin SET password = '$new_password' WHERE username = '$username'";
        if(mysqli_query($conn, $sql)) {
            return "<div class='alert alert-success'>Password changed successfully.</div>";
        } else {
            return "<div class='alert alert-danger'>Error updating password.</div>";
        }
    }
}






function checkForYear($conn, $name, $exam_year, $exam_term){
    $sql = "SELECT * FROM student WHERE name = '$name' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        //set a result value to be used to query the terminal result table
        $result = mysqli_fetch_array($query);
        $name = $result['name'];
        //second query
        $sql2 = "SELECT * FROM terminal_report WHERE 
                exam_year = '$exam_year'&& student_name = '$name' && exam_term = '$exam_term'";
        $query2 = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($query2) > 0){
            $result2 = mysqli_fetch_array($query2);
            $year  = $result2['exam_year'];
            $term = $result2['exam_term'];
//                $year = $result2['exam_year'];
            if($year == $exam_year && $term == $exam_term){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }else{
        return false;
    }
}


// Function to update username securely
function updatePasswordAndUsername($conn, $currentUsername, $newPassword) {
    // Hash the new password securely
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare the SQL statement to update both password and username
    $sql = "UPDATE student SET password = ?, username = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind the parameters: hashed_password, newPassword, currentUsername
    $stmt->bind_param("sss", $hashed_password, $newPassword, $currentUsername);

    // Execute the statement
    $result = $stmt->execute();

    // Close the statement
    $stmt->close();

    return $result;
}

// Add other functions for checking username, login, card serial, etc.
?>


