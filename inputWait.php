<?php
     require("utility.php");
     logMsg("here");
     if(isset($_REQUEST["airport"])){ 
       $airport = cleanInput($_REQUEST["airport"]);
       logMsg($airport);
       $terminal = cleanInput($_REQUEST["terminal"]);
       logMsg($terminal);
       $day = cleanInput($_REQUEST["day"]);
       logMsg($day);
       $time = cleanInput($_REQUEST["time"]);
       logMsg($time);

       session_start();
       $_SESSION["airport"] = $airport;
       $_SESSION["terminal"] = $terminal;
       $_SESSION["day"] = $day;
       $_SESSION["time"] = $time;
       logMsg("Made it to after the session");

    }
?>
