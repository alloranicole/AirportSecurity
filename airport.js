/* Name: Taylor, Joanna, Alex
 * Date: 4/30/16
 * Class: CSC-3710
 */

//When the input page is brought up the validate
//div is cleared out
$(document).on(
    "pagebeforeshow",
    "#input",
    function(){
     $("#validate").html("");
     $("#Airport").val("");
     $("#Terminal").val("");
     $("#DayOfFlight").val("");
     $("#FlightTime").val("");
    }
)


//When the wait time page is brought up 
//the tracking buttons are shown again 
//and the text div is cleared again
$(document).on(
    "pagebeforeshow",
    "#waitTime",
    function(){
     $("#track").show();
     $("#text").html("");
    }
)


//Function calls select.php to grab the 
//terminals/concourses that go along with
//airport code sent to the function
//then they are displayed in the
//terminals div
function getTerminals(form){
         $.getJSON(
           'select.php',
           {"code":form.value},
           function(data){
              $('#terminals').html(data);
           }
         )
}

//Function validates the form 
//makes sure all of the options have 
//been selected
function validate(){
         if(document.getElementById('Airport').value == ""){
             $('#validate').html("<b>Choose an Airport</b><br><br>");
             return false;
         }if(document.getElementById('Terminal').value == ""){
             $('#validate').html("<b>Choose a Terminal/Concourse</b><br><br>");
             return false;
         }if(document.getElementById('DayOfFlight').value == ""){
             $('#validate').html("<b>Choose a Day</b><br><br>");
             return false;
         }if(document.getElementById('FlightTime').value == ""){
             $('#validate').html("<b>Choose a Time</b><br><br>");
             return false;
         }
         return true;
}

//Function first validates the form
//then calls the inputWait.php to 
//hold all of the information from 
//the form and finally changes
//to the wait time page
function waitTime(){
      if(validate()){  
        $.getJSON(
          'inputWait.php',
          {"airport":document.getElementById('Airport').value,
           "terminal":document.getElementById('Terminal').value,
           "day":document.getElementById('DayOfFlight').value,
           "time":document.getElementById('FlightTime').value}
          );
         // clearForm();
          $.mobile.pageContainer.pagecontainer("change",
                                              "#waitTime",
                                              {transition: "flow"}
                                             );
     }
}

//Function calls the startTime.php and 
//saves the time that the user clicked 
//the button, then tells the user
function track(){
         $.getJSON('startTime.php',
                   function(data){
                     if(data == 0)
                        $("#text").html("<h3 style= 'text-align:center;'> Began tracking security wait time.</h3>"); 
                   }
                  );
}

//Function calls the totalTime.php
//and grabs the time the user clicked
//the button and saves the wait time
//then hides the buttons and displays
//a message 
function stopTrack(){
         $.getJSON('totalTime.php',
                   function(data){
                    if(data == 0){
                      $("#track").hide();
                      $("#text").html("<h3 style='text-align:center;'>Thank you for contributing!</h3>");
                    }    
                  }
          );
} 
