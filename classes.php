<?php
         require("utility.php");
         class flight {
             private $Airport;
             private $Terminal;
             private $FlightTime;
             private $DayOfFlight;

             function __construct($airport, $terminal, $flightTime, $dayOfFlight){
                  $this->Airport = $airport;
                  $this->Terminal = $terminal;
                  $this->FlightTime = $flightTime;
                  $this->DayOfFlight = $dayOfFlight;
             }

             function get_Airport(){
                  return $this->Airport;
             }

             function get_Terminal(){
                  return $this->Terminal;
             }

             function get_FlightTime(){
                   return $this->FlightTime;
             }

             function get_DayOfFlight(){
                   return $this->DayOfFlight;
             }

         }
          class query{
                 var $flight;
                 var $query;
                 var $result;
                 var $dbconn;
                 function __construct(flight $flightInfo){
                          $this->flight = $flightInfo;
                 }
                 function connectToDB(){
                   $this->dbconn = connectToDB();
                 }
                 function makeQuery(){
                  $airport = $this->flight->get_Airport();
                  $terminal = $this->flight->get_Terminal();
                  $day = $this->flight->get_DayOfFlight();
                  $time = $this->flight->get_FlightTime();
                  $this->query = "Select AW.WaitTime from AverageWait as AW, AirportTerminals as AT, DateTime as DT where AW.AirTermID = AT.AirTermID and AW.DateTimeID = DT.DateTimeID and AT.AirportCode = '$airport' and AT.Terminal = '$terminal' and DT.Weekday = '$day' and DT.DayTime = '$time';";
                   $this->result = $this->dbconn->query($this->query);
                   $myrow = $this->result->fetch_array();
                   $wTime = $myrow['WaitTime'];
                   return $wTime;
                 }
                 function disconnectDB(){
                   disconnectDB($this->dbconn);
                 }
          }
   class clock {

      private $sTime;
      private $eTime;
      
      function set_endTime(){
         $time = date('H:i:s', time());
      	 $this->etime = strtotime($time);
      }

      function set_startTime(){
         $time = date('H:i:s',time());
         $this->sTime = strtotime($time);
      }

      function get_totalWaitTime($totalWaitTime){
         $diff = $this->eTime - $this->sTime;
         $totalWaitTime = date('i',$diff);
	 if($totalWaitTime > 120)
            return 0;
         else 
            return $totalWaitTime;
      }
    
   }
   class waitTime{

      private $wTime;
      private $flight; 
      private $query;
      private $result;
      private $dbconn;
       
      function __construct(flight $flightInfo){
         $this->flight = $flightInfo;
      }
      function set_waitTime($waitTime){
         $this->wTime = $waitTime; 
      }

      function connectToDB(){
         $this->dbconn = connectToDB();
      }

      function saveWaitTime(){
         $airport = $this->flight->get_Airport();
         $terminal = $this->flight->get_Terminal();
         $day = $this->flight->get_DayOfFlight();
         $time = $this->flight->get_FlightTime();
         $this->query = "insert into ObservedWait(AirportCode,Terminal,Weekday,Daytime,WaitTime) values('$airport','$terminal','$day','$time','$this->wTime');";
         logMsg($this->query);             
         $this->result = $this->dbconn->query($this->query);
      }
         
      function averageWaitTime(){
         $airport = $this->flight->get_Airport();
         $terminal = $this->flight->get_Terminal();
         $day = $this->flight->get_DayOfFlight();
         $time = $this->flight->get_FlightTime();
         $this->query = "Select AW.WaitTime from AverageWait as AW, AirportTerminals as AT, DateTime as DT where AW.AirTermID = AT.AirTermID and AW.DateTimeID = DT.DateTimeID and AT.AirportCode = '$airport' and AT.Terminal = '$terminal' and DT.Weekday = '$day' and DT.DayTime = '$time';";
          logMsg($this->query);             
          $this->result = $this->dbconn->query($this->query);
          $myrow = $this->result->fetch_array();
          logMsg($myrow['WaitTime']);
          $time = $myrow['WaitTime'];
          $time *= .75;
          $wTime *= .25;
          $time = ($time + $wTime)/2;
          logMsg($time);
          $this->query = "Update AverageWait as AW, AirportTerminals as AT, DateTime as DT set AW.WaitTime = '$time' where AW.AirTermID = AT.AirTermID and AW.DateTimeID = DT.DateTimeID and AT.AirportCode = '$airport' and AT.Terminal = '$terminal' and DT.Weekday = '$day' and DT.DayTime = '$time';";
          logMsg($this->query);             
          $this->result = $this->dbconn->query($this->query);
      }

      function disconnectDB(){
          disconnectDB($this->dbconn);
      }

   }
?>
