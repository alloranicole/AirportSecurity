<?php
   class flight {
        public $Airport;
        public $Terminal;
        public $FlightTime;
        public $DayOfFlight;

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


?>
