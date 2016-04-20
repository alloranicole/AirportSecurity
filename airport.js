function getTerminals(form){
         $.getJSON(
           'select.php',
           {"code":form.value},
           function(data){
              $('#terminals').html(data);
           }
         )
}

function waitTime(form){
        $.post(
          'inputWait.php',
          {"airport":form.Airport.value,
           "terminal":form.Terminal.value,
           "day":form.DayOfFlight.value,
           "time":form.FlightTime.value}
          )
} 
