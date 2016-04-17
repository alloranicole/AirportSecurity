<?php
          require("utility.php");
         class flight {
             private $Airport;
             private $Terminal;
             private $FlightTime;
             private $DayOfFlight;

             function flight($airport, $terminal, $flightTime, $dayOfFlight) {
                  $this->Airport = $airport;
                  $this->Terminal = $terminal;
                  $this->FlightTime = $flightTime;
                  $this->DayOfFlight = $dayOfFlight;
             }

             function get_Airport() {
                  return $this->Airport;
             }

             function get_Terminal() {
                  return $this->Terminal;
             }

             function get_FlightTime() {
                   return $this->FlightTime;
             }

             function get_DayOfFlight() {
                   return $this->DayOfFlight;
             }

         }
          class query{
                 var $flight;
                 var $query;
                 var $result;
                 var $dbconn;
                 function query($flightInfo){
                          $this->flight = $flightInfo;
                 }
                 function connectToDB(){
                   $this->dbconn = connectToDB();
                 }
                 function makeQuery(){
                  $this->query = "Select WaitTime from AverageWait as AW, AirportTerminals as AT, DateTime as DT where AW.AirTermID = AT.AirTermID, AW.DateTimeID = DT.DateTimeID, AT.AirportCode = $this->flight->get_Airport(), AT.Terminal = $this->flight->get_Terminal(), DT.Weekday = $this->flight->get_DayofFlight(), DT.DayTime = $this->flight->get_FlightTime();";
                   logMsg($query);
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
