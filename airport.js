function getTerminals(form){
         $.getJSON(
           'select.php',
           {"code":form.value},
           function(data){
              $('#terminals').html(data);
           }
         )
}

function waitTime(){
        $.getJSON(
          'inputWait.php',
          {"airport":document.getElementById('Airport').value,
           "terminal":document.getElementById('terminals').value,
           "day":document.getElementById('DayOfFlight').value,
           "time":document.getElementById('FlightTime').value}
          );
          $.mobile.pageContainer.pagecontainer("change",
                                              "#waitTime",
                                              {transition: "flow"}
                                             );
}

function track(){
         $.getJSON('startTime.php');
}

function stopTrack(){
         $.getJSON('totalTime.php');
} 
