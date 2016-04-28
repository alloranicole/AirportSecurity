<?php
     include("classes.php");
     session_start();
     if($_SESSION["check"]==true){
       $_SESSION["check"]=false; 
       logMsg("inside of session in total");
       $end = new clock();
       $end->set_startTime($_SESSION["start"]);
       $end->set_endTime();
       $totalTime = $end->get_totalWaitTime();
       logMsg($totalTime);
       if($totalTime > 0){
          $flight = new flight($_SESSION["airport"],$_SESSION["terminal"],$_SESSION["time"],$_SESSION["day"]);
          $wTime = new waitTime($flight);
          $wTime->set_waitTime($totalTime);
          $wTime->connectToDB();
          $wTime->saveWaitTime();
          $wTime->averageWaitTime();
          $wTime->disconnectDB();
      }
      echo json_encode("0");
    }
?>
