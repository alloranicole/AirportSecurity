<?php include("class_lib.php"); ?>
<?php

   class clock {

      var $sTime;
      var $eTime;	
      
      function set_endTime($endTime){
      	 eTime=$endTime;
      }

      function initialize_startTime($startTime){
         $this->sTime = $startTime;
      }

      function set_totalWaitTime($totalWaitTime){
	 endTime-startTime=$totalWaitTime;
      }
      
      function get_totalWaitTime(){
	 return $this->totalWaitTime;
      }
   }

>? 
