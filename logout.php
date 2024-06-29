<?php
session_start();

if(isset($_GET['logout'])){
   ?>
    <div class="jumbotron">
        <p style="color: lightseagreen;">Logout Successful.</p>
        <p>You will be redirected to the login page in 1s.</p>
        <meta http-equiv="refresh" content="1; index.php">
    </div>
    <?php
    session_destroy();
}else{
    header('location:index.php');
}
