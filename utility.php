<?php
/*Name: Taylor, Joanna, Alex
  Date: 4/30/16
  Class: CSC3710
*/
function cleanInput($data) 
{ 
      $data = trim($data); 
      $data = stripslashes($data); 
      $data = htmlspecialchars($data); 
      return $data; 
}
function connectToDB()
{
      $dbPath="localhost";
      $dbUser="tandersonweb";
      $dbPass=")&%#*($";
      $dbName="csc2210_tanderson_db";

      //The object oriented way
      $dbconn = new mysqli($dbPath,$dbUser,$dbPass);
 
      logMsg("Connecting to $dbPath with user $dbUser");
      if(!$dbconn){
        logMsg('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
        error_log("Error connecting to $dbPath with user $dbUser");
      }
      if(!$dbconn->select_db($dbName)){
        logMsgAndDie("Could not select $dbName database", $dbconn);
      }
      return $dbconn;
}
function disconnectDB($dbconn)
{
     if($result = $dbconn->query("select database()")){
        $dbName = $result->fetch_row();
        logMsg("Disconnect from database: ".$dbName[0]);
        $dbconn->close();
      }
}

//the log file is in /home/students/tanderson/log/PHP_errors.log
//this is designated in the .htaccess file in the root directory of a project
//Use tail command to view 
function logMsg($message)
{
      error_log($message);
}
function logMsgAndDie($message,$dbconn)
{
      error_log("$message--$dbconn->errno: $dbconn->error");
      die("See error log for details");
}
?>
