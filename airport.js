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

function getTerminals(form){
         $.getJSON(
           'select.php',
           {"code":form.value},
           function(data){
              $('#terminals').html(data);
           }
         )
}

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

function waitTime(){
      if(validate()){  
        $.getJSON(
          'inputWait.php',
          {"airport":document.getElementById('Airport').value,
           "terminal":document.getElementById('Terminal').value,
           "day":document.getElementById('DayOfFlight').value,
           "time":document.getElementById('FlightTime').value}
          );
          clearForm();
          $.mobile.pageContainer.pagecontainer("change",
                                              "#waitTime",
                                              {transition: "flow"}
                                             );
     }
}

function track(){
         $.getJSON('startTime.php',
                   function(data){
                     if(data == 0)
                        $("#text").html("Began tracking security wait time."); 
                   }
                  );
}

function stopTrack(){
         $.getJSON('totalTime.php',
                   function(data){
                    if(data == 0){
                    //  document.getElementById('#track').style.display = "none";
                      $("#track").hide();
                      $("#text").html("Thank you for contributing!");
                    }    
                  }
          );
} 
