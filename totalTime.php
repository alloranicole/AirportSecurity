<?php
  /*Name: Taylor, Joanna, Alex
    Date: 4/30/16
    Class: CSC-3710
    PHP Script to calculate the total wait time
    and insert it into the database */
     include("classes.php");
     session_start();
     //If the startTime.php has been called
     if($_SESSION["check"]==true){
       $_SESSION["check"]=false; 
       $end = new clock();
       $end->set_startTime($_SESSION["start"]);
       $end->set_endTime();
       $totalTime = $end->get_totalWaitTime();
       logMsg($totalTime);
       //If the totalTime returned is greater than 0, average it
       //into the database
       if($totalTime > 0){
          $flight = new flight($_SESSION["airport"],$_SESSION["terminal"],$_SESSION["time"],$_SESSION["day"]);
          $wTime = new waitTime($flight);
          $wTime->set_waitTime($totalTime);
          $wTime->connectToDB();
          $wTime->saveWaitTime();
          $wTime->averageWaitTime();
          $wTime->disconnectDB();
      }
      //return to jQuery function
      echo json_encode("0");
    }
?>
