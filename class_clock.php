<?php include("class_lib.php"); ?>
<?php

   class clock {

      var $sTime;
      var $eTime;
      
      $cutOff=true;
      
      function set_endTime($endTime){
      	 $this->etime = $endTime;
      }

      function set_startTime($startTime){
         $this->sTime = $startTime;
      }

      function set_totalWaitTime($totalWaitTime){
	 $totalWaitTime=endTime-startTime;
      }
      
      if($totalWaitTime > 200)
      	 $cutOff=false;
      
      function get_totalWaitTime(){
      	 if($cutOff==true)
	    return $this->totalWaitTime;
      }
   }

>? 
