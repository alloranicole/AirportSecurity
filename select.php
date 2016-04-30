<?php
 /*Name: Taylor, Joanna, Alex
   Date: 4/30/16
   Class: CSC-3710
   PHP Script to grab the terminals/concourses 
   from the database with the airport code */
     require("utility.php");
     if(isset($_REQUEST["code"])){ 
       $code = cleanInput($_REQUEST["code"]);
       $dbconn = connectToDB();
       $query = "SELECT Terminal FROM AirportTerminals where AirportCode = '$code';";
       $result = $dbconn->query($query);
       //Holds the terminal display info in $terminals
       $terminals = "Terminal/Concourse:<br><select name=\"Terminal\" id=\"Terminal\" style=\"width:150px;\"><option value=\"\"></option>"; 
       if($myrow = $result->fetch_array()){
          do{
            $terminals .= "<option value=\"".$myrow['Terminal']."\">".$myrow['Terminal']."</option>\n";
          }while($myrow = $result->fetch_array());
          $terminals .="</select><br><br>";
          //Sends the terminals back to the jQuery request
           logMsg(json_encode($terminals));
           echo json_encode($terminals);
       }else{
           echo json_encode("<br>");
       }
           disconnectDB($dbconn);
     }else{
       echo "Non post request."; 
     }
?>
