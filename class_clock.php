<?php include("class_lib.php"); ?>
<?php

   class clock {

      var $sTime;
      var $eTime;	
      
      function set_endTime($endTime){
      	 $endTime=eTime;
      }

      function initialize_startTime($startTime){
         $this->sTime = $startTime;
      }

      function set_totalWaitTime($totalWaitTime){
	 $totalWaitTime=endTime-startTime;
      }
      
      function get_totalWaitTime(){
	 return $this->totalWaitTime;
      }
   }

>? 
