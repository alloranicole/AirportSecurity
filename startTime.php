<?php
     include("classes.php");
     session_start();
     logMsg("Before start");
     if(isset($_SESSION["airport"])){
       logMsg("inside start");
       $start = new clock();
       $time = $start->get_startTime(); 
       $_SESSION["start"] = $time;
       $_SESSION["check"] = true; 
       logMsg($time);
       echo json_encode("0");
    }
?>
