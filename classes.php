<!--Classes File-->

<?php
         require("utility.php");

	//Flight Class
	//Holds the values that the user inputs about the flight
         class flight {
             private $Airport;
             private $Terminal;
             private $FlightTime;
             private $DayOfFlight;
		
	     //Constructor
             function __construct($airport, $terminal, $flightTime, $dayOfFlight){
                  $this->Airport = $airport;
                  $this->Terminal = $terminal;
                  $this->FlightTime = $flightTime;
                  $this->DayOfFlight = $dayOfFlight;
             }
	    
	     //Get functions
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
	  
	//Query Class
	//Recieves information from the flight class and querys the database for the wait time
	//that corresponds with the information from the flight class. 
	//That wait time is then sent back to the user
          class query{
                 var $flight;
                 var $query;
                 var $result;
                 var $dbconn;
                 var $lastModified;

		//Constructor
                 function __construct(flight $flightInfo){
                          $this->flight = $flightInfo;
                 }
		
		//connectToDB()
		//Pre-condition: $dbconn does not hold the connection to the database
		//Post-condition: $dbconn holds the connection to the database
                 function connectToDB(){
                   $this->dbconn = connectToDB();
                 }

		//int makeQuery()
		//Pre-condition: $dbconn is connected to the database
		//Post-condition: $query holds the query message that was sent to the database
		//This message includes variables from within the Instance Variable of the flight
		//class $flight, $result holds the result from the query. The wait time from the 
		//result is returned
                 function makeQuery(){
                  $airport = $this->flight->get_Airport();
                  $terminal = $this->flight->get_Terminal();
                  $day = $this->flight->get_DayOfFlight();
                  $time = $this->flight->get_FlightTime();
                  $this->query = "Select AW.WaitTime,AW.LastModified from AverageWait as AW, AirportTerminals as AT, DateTime as DT where AW.AirTermID = AT.AirTermID and AW.DateTimeID = DT.DateTimeID and AT.AirportCode = '$airport' and AT.Terminal = '$terminal' and DT.Weekday = '$day' and DT.DayTime = '$time';";
                   $this->result = $this->dbconn->query($this->query);
                   $myrow = $this->result->fetch_array();
                   $wTime = $myrow['WaitTime'];
                   $date = strtotime($myrow['LastModified']);
                   $this->lastModified = date("m.d.Y",$date);
                   return $wTime;
                 }

		//modifiedLast()
		//Post-condition: returns the date the database was last modified
                 function modifiedLast(){
                   return $this->lastModified; 
                 }

		//disconnectDB()
		//Pre-condition: $dbconn is connected to the databse
		//Post-condition: $dbconn is no longer connected to the database
                 function disconnectDB(){
                   disconnectDB($this->dbconn);
                 }
          }

   //Clock Class
   //Holds a specific start and end time, then subtracts the two to get a total wait time,
   //then sends it over to the wait time class, where it will be average into the database	
   class clock {

      private $sTime;
      private $eTime;
      
	//set_endTime()
	//Pre-condition: $eTime is not initialized
	//Post-condition: $eTime is initialized with the current time
      function set_endTime(){
        $this->eTime = time();
      }
	
	//set_startTime($start)
	//Precondition: $sTime is not initialized
	//Postcondition: $sTime is initialized from parameters, $start
      function set_startTime($start){
      	 $this->sTime = $start;
      }

	//get_startTime()
	//Precondition: $sTime is not initialized
	//Postcondition: $sTime is initialized to the current time and is returned
      function get_startTime(){
         $this->sTime = time();
         return $this->sTime;
      }

	//get_totalWaitTime()
	//Precondition: $totalWaitTime is not initialized
	//Postcondition: $totalWaitTime holds $eTime - $sTime. $totalWaitTime is returned if
	//the value is less than 120 minutes, otherwise, the function returns 0
      function get_totalWaitTime(){
         $diff = $this->eTime - $this->sTime;
         $totalWaitTime = $diff / 60;
         if($totalWaitTime > 120)
            return 0;
         else 
            return $totalWaitTime;
      }
    
   }

   //Wait Time Class
   //Recieves a specified time from the clock class that the user inputs. That time is averaged
   //into the MySQL database according to the flight info from the user. It will work 
   //hand-in-hand with the clock class
   class waitTime{

      private $wTime;
      private $flight; 
      private $query;
      private $result;
      private $dbconn;
  
	//Constructor     
      function __construct(flight $flightInfo){
         $this->flight = $flightInfo;
      }

	//set_waitTime($waitTime)
	//Precondition: $wTime is unititialized
	//Postcondition: $wTime is initialized with the parameter, $waitTime
      function set_waitTime($waitTime){
         $this->wTime = $waitTime; 
      }

	//connectToDB()
	//Precondition: $dbconn is not connected to the database
	//Postcondition: $dbconn is connected to the database
      function connectToDB(){
         $this->dbconn = connectToDB();
      }

	//saveWaitTime()
	//Precondition: $dbconn is connected to the database
	//Postcondition: $query holds the query message that was sent to the databse. This message
	//includes variables from within the Instance Variable of the Flight Class $flight, and
	//the current wait time $wTime. $result holds the result from the query.
      function saveWaitTime(){
         $airport = $this->flight->get_Airport();
         $terminal = $this->flight->get_Terminal();
         $day = $this->flight->get_DayOfFlight();
         $time = $this->flight->get_FlightTime();
         $this->query = "insert into ObservedWait(AirportCode,Terminal,Weekday,Daytime,WaitTime,LastModified) values('$airport','$terminal','$day','$time','$this->wTime',now());";
         logMsg($this->query);             
         $this->result = $this->dbconn->query($this->query);
      }
       
	//averageWaitTime()
	//Precondition: $dbconn is connected to the database
	//Postcondition: $query holds the query message that was sent to the database. This message
	//includes variables from within the Instance Variable of the flight class $flight.
	//$result holds the result from the query. The wait time from the user is averaged into
	//the wait time in the database  
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
          $currentTime = $myrow['WaitTime'];
          $currentTime *= .75;
          $this->wTime *= .25;
          $currentTime = ($currentTime + $this->wTime);
          logMsg($currentTime);
          $this->query = "Update AverageWait as AW, AirportTerminals as AT, DateTime as DT set AW.WaitTime = '$currentTime', AW.LastModified =now() where AW.AirTermID = AT.AirTermID and AW.DateTimeID = DT.DateTimeID and AT.AirportCode = '$airport' and AT.Terminal = '$terminal' and DT.Weekday = '$day' and DT.DayTime = '$time';";
          logMsg($this->query);             
          $this->result = $this->dbconn->query($this->query);
      }
	
	//disconnectDB()
	//Precondition: $dbconn is connected to the database
	//Postcondition: $dbconn is no longer connected to the MySQL database
      function disconnectDB(){
          disconnectDB($this->dbconn);
      }

   }
?>
