<?php
     include("classes.php");
     session_start();
     if(isset($_SESSION["airport"])){
       $start = new clock();
       $time = $start->get_startTime(); 
       $_SESSION["start"] = $time;
    }
?>
