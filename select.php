<?php
     require("utility.php");
     logMsg('Here');
     if(isset($_REQUEST["code"])){ 
       $code = cleanInput($_REQUEST["code"]);
       $dbconn = connectToDB();
       $query = "SELECT Terminal FROM AirportTerminals where AirportCode = '$code';";
       $result = $dbconn->query($query);
       $terminals = "Terminal/Concourse:<br><select name=\"Terminal\" style=\"width:150px;\">"; 
       if($myrow = $result->fetch_array()){
          do{
            $terminals .= "<option value=\"".$myrow['Terminal']."\">".$myrow['Terminal']."</option>\n";
          }while($myrow = $result->fetch_array());
          $terminals .="</select><br><br>";
          //Sends the customers back to the jQuery request
           logMsg(json_encode($terminals));
           echo json_encode($terminals);
       }else{
           echo json_encode("Sorry, no records were found.");
       }
           disconnectDB($dbconn);
     }else{
       echo "Non post request."; 
     }
?>
