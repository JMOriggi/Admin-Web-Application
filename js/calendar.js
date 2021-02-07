$('#calendar').fullCalendar({
  header: {
    left: 'prev,next',
    center: 'title',
    right: 'month,basicWeek,basicDay'
  },
  theme: true,
  selectable: true,
  selectHelper: true
});

$(document).ready(function() {
  //Add Spinner and hide components
  if($(".spinner-div").hasClass("hidden")){
    $(".spinner-div").removeClass('hidden');
  }
  if(!$(".panel-calendar").hasClass("invisible")){
      $(".panel-calendar").addClass('invisible');
  } 
  //create an ajax request
  $.ajax({    
    type: "post",
    url: "AJAXcall.php",    
    data: { action: "getBookings"
    },             
    dataType: "html",                
    success: function(response){ 
        console.log('SUCCESS AJAX');
        console.log(response);
        var response = JSON.parse(response);
        console.log(response);
        for (var i = 0; i < response.length; i++){
            $('#calendar').fullCalendar( 'renderEvent', {
              title: response[i].title,
              start: response[i].start
            }, true);
        }
    },
    fail: function(xhr, textStatus, errorThrown){
            console.log('ERROR AJAX');
            console.log(xhr);
            console.log(textStatus);
            console.log(errorThrown);
    }
  });
  //Remove Spinner and show components
  if(!$(".spinner-div").hasClass("hidden")){
    $(".spinner-div").addClass('hidden');
  }
  if($(".panel-calendar").hasClass("invisible")){
      $(".panel-calendar").removeClass('invisible');
  }
});



