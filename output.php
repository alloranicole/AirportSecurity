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
<body style="background-color: lightgrey;">
    <div style="background-color: rgb(0, 80, 116); color:white; padding:5px; margin:30px">
     <h1 style="text-align:center; font-family:Arial;"> Security Checkpoint Wait Time </h1>
    <div style="padding: 5px;">
     <a class="buttons" href="template.html" style="background-color: white; color:rgb(0,80,116); border:4px solid white">HOME</a>
   </div>
   </div>
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
  
            
  	?>
            <h2 style="margin:30px; border:1px solid black; padding:5px; text-align:center;">The wait time will be around <?=$wait?> minutes.<br>		
	   <div style="font-size:50%;">
		Last Updated: DATE   <?=$wait?> 
		</div>
		  </h2>
	<?php
        }else{
            echo "<h2 style='margin:30px; text-align:center;'>A non Post request</h2>";
        }
        ?>
</body>
</html>
