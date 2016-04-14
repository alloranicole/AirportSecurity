<?php
   class flight {
        public $Airport;
        public $Terminal;
        public $FlightTime;
        public $DayOfFlight;

        function flight($airport, $terminal, $flightTime, $dayOfFlight) {
           $Airport = $airport;
           $Terminal = $terminal;
           $FlightTime = $flightTime;
           $DayOfFlight = $dayOfFlight;
        }

        function get_Airport() {
           return $Airport;
        }

        function get_Terminal() {
           return $Terminal;
        }

        function get_FlightTime() {
           return $FlightTime;
        }

        function get_DayOfFlight() {
           return $DayOfFlight;
        }

   }


?>
