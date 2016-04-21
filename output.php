<!DOCTYPE html>
<html>
<head>
       <title>Airport Security Wait Time</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css" />
       <script type="text/javascript" 
         src="jquery-2.2.0.min.js"></script>
        <script type="text/javascript"
         src="jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
  <?php 
          include("classes.php");
          if($_SERVER["REQUEST_METHOD"]=="POST"){
             $airport = cleanInput($_POST["Airport"]);
             $terminal = cleanInput($_POST["Terminal"]);
             $flightDay = cleanInput($_POST["DayOfFlight"]);
             $flightTime = cleanInput($_POST["FlightTime"]);

             //Create a flight class variable and input all this data in the 
             //Constructor

             $flightInfo = new flight($airport, $terminal, $flightTime, $flightDay);


             //Then call the query class and send it the flight variable
             $query = new query($flightInfo);

            //Then follow this order of the query class : connectToDB, 
            //makeQuery (this one returns the wait time), and disconnectDB

             $query->connectToDB();
             $wait = $query->makeQuery();
             $query->disconnectDB();

            //Say for instance you saved the wait time in $wait, to display it:
 
            //You can also echo html so it is displayed a certain way, like:

            echo "<h1>The wait time will be around ".$wait." minutes</h1>";
        }else{
            echo "A non Post request";
        }             
        ?>
</body>
</html>
