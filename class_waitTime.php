<?php include("class_lib.php"); ?>
<?php 

   class waitTime{

      var $wTime;
     
      function set_waitTime($waitTime){
         $this->wTime = $waitTime; 
      }

      function connectToDB(){
         $this->dbconn = connectToDB();
      }

      function averageWaitTime(){

      }

      function disconnectDB(){
          disconnectDB($this->dbconn);
      }

   }

?>
