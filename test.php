<?php

     $dt1 = new DateTime();
    $current_date = $dt1->format('Y-m-d');

     $dt2 = new DateTime("2020-01-17");
    $expire_date = $dt2->format("Y-m-d");

    //declare date 2 

    // echo "current date is: ". $current_date . "<br>";

    // echo "expire date is: ". $expire_date. "<br>";

    if($expire_date > $current_date){
          echo " Yes ". $current_date. " is greater than " . $expire_date;
    }else{

    	  echo "NO ". $expire_date. " is not greater than " . $current_date;
    }

   
 ?>
