<?php
  /*Name:
    Date:
    Class:
    Input Wait Time php to save values from form when input 
    wait time button is clicked */
     require("utility.php");
     if(isset($_REQUEST["airport"])){ 
       $airport = cleanInput($_REQUEST["airport"]);
       $terminal = cleanInput($_REQUEST["terminal"]);
       $day = cleanInput($_REQUEST["day"]);
       $time = cleanInput($_REQUEST["time"]);
       //Session variables created to hold airport values from form
       session_start();
       $_SESSION["airport"] = $airport;
       $_SESSION["terminal"] = $terminal;
       $_SESSION["day"] = $day;
       $_SESSION["time"] = $time;
       //Varible created so user cannot click the stop tracking button
       //without clicking start tracking
       $_SESSION["check"] = false; 
    }
?>
