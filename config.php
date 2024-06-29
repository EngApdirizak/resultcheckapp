<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$database ="result_project";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $database);
if(!$conn){
    die('error connecting to database');
}else{
    echo'';
}
