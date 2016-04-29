//When the input page is brought up the validate
//div is cleared out
$(document).on(
    "pagebeforeshow",
    "#input",
    function(){
     $("#validate").html("");
    // $("#Airport").val("");
    }
)

/*$(document).on(
    "pagechange",
    "#input",
    function(){
     alert("Create");
     $("#Airport").val("");
     $("#Airport").selectmenu('refresh');
     alert("After Create");
    }
)*/

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

function clearForm(){ 
    //$('select option:first-child').attr('selected','selected');
 //   document.getElementById('DayOfFlight').selectedIndex = 0;
  //  document.getElementById('FlightTime').selectedIndex = 0;
}

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
                        $("#text").html("<b>Began tracking security wait time.</b>"); 
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
                      $("#text").html("Thank you for contributing!");
                    }    
                  }
          );
} 
