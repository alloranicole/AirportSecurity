<?php
 /*Name: Taylor, Joanna, Alex
   Date: 4/30/16
   Class: CSC-3710
   PHP script to grab the start time
   and set the check session varible to true */
     include("classes.php");
     session_start();
     if(isset($_SESSION["airport"])){
       $start = new clock();
       $time = $start->get_startTime(); 
       $_SESSION["start"] = $time;
       $_SESSION["check"] = true; 
       logMsg($time);
       echo json_encode("0");
    }
?>
