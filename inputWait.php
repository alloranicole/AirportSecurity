<?php
     if(isset($_REQUEST["airport"])){ 
       $airport = cleanInput($_REQUEST["airport"]);
       $terminal = cleanInput($_REQUEST["terminal"]);
       $day = cleanInput($_REQUEST["day"]);
       $time = cleanInput($_REQUEST["time"]);
       session_start();
       $_SESSION["airport"] = $airport;
       $_SESSION["terminal"] = $terminal;
       $_SESSION["day"] = $day;
       $_SESSION["time"] = $time;
    }
?>
