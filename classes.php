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
                   logMsg($this->query);
                   $this->result = $this->dbconn->query($this->query);
                   $myrow = $this->result->fetch_array();
                   logMsg($myrow['WaitTime']);
                   return $myrow['WaitTime'];
                 }
                 function disconnectDB(){
                   disconnectDB($this->dbconn);
                 }
          }
          
?>
