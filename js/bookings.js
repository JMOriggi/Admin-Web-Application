
$(document).ready(function() {
        var currentBookingId = null;
        var currentAction = null;
        var currentStatus = null;
        initializeDatatable();


        //create an ajax request to populate table booking
        function initializeDatatable(){
                //Add Spinner and hide components
                if($(".spinner-div").hasClass("hidden")){
                        $(".spinner-div").removeClass('hidden');
                }
                if(!$(".panel-table").hasClass("hidden")){
                        $(".panel-table").addClass('hidden');
                }
                if(!$(".editor_create").hasClass("hidden")){
                        $(".editor_create").addClass('hidden');
                }
                $('#tableBooking').DataTable();
                $('#tableBooking').DataTable().fnClearTable();
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
                                        if(response[i].canale == "booking"){
                                                var buttonsRender="";
                                                if(response[i].status == "NEW"){
                                                        buttonsRender = "<button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-success btn-sm btn-sm-v2 editor_new'>"
                                                                +"<i class='glyphicon glyphicon-ok'></i> Accetta </button>"
                                                                +"  <button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-danger btn-sm btn-sm-v2 editor_new'>"
                                                                +"<i class='glyphicon glyphicon-remove'></i> Rifiuta </button>";
                                                }else if(response[i].status == "ACCEPTED"){
                                                        buttonsRender = "<button type='button' data-toggle='modal' data-target='#driverModal' name='"+ response[i].id +"' class='btn btn-success btn-sm btn-sm-v2 editor_accepted'>"
                                                                +"<i class='glyphicon glyphicon-pencil'></i> Aggiungi Driver</button>"
                                                                +"  <button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-danger btn-sm btn-sm-v2 editor_accepted'>"
                                                                +"<i class='glyphicon glyphicon-trash'></i> Cancella</button>";
                                                }else if(response[i].status == "PENDING_AMENDMENT"){
                                                        buttonsRender = "<button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-success btn-sm btn-sm-v2 editor_p_amm '>"
                                                                +"<i class='glyphicon glyphicon-ok'></i> Accetta Modifiche </button>"
                                                                +"  <button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-danger btn-sm btn-sm-v2 editor_p_amm'>"
                                                                +"<i class='glyphicon glyphicon-remove'></i> Rifiuta Modifiche</button>";
                                                }else if(response[i].status == "PENDING_CANCELLATION"){
                                                        buttonsRender = "<button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-default btn-sm btn-sm-v2 editor_p_canc'>"
                                                                +"<i class='glyphicon glyphicon-ok'></i> Accetta Cancellazione</button>";
                                                }else if(response[i].status == "CANCELED"){
                                                }else if(response[i].status == "DRIVER_ASSIGNED"){
                                                        buttonsRender = "<button type='button' data-toggle='modal' data-target='#alertModal' name='"+ response[i].id +"' class='btn btn-danger btn-sm btn-sm-v2 editor_driver_ass'>"
                                                                +"<i class='glyphicon glyphicon-trash'></i> Cancella</button>";
                                                }
                                                $('#tableBooking').DataTable().fnAddData( [
                                                        response[i].start,
                                                        response[i].id,
                                                        response[i].status,
                                                        response[i].title,
                                                        response[i].canale,
                                                        buttonsRender
                                                ] );
                                        }else{
                                                $('#tableBooking').DataTable().fnAddData( [
                                                        response[i].start,
                                                        response[i].id,
                                                        response[i].status,
                                                        response[i].title,
                                                        response[i].canale,
                                                        "<button type='button' data-toggle='modal' data-target='#editModal' name='"+ response[i].id 
                                                        +"' class='btn btn-default btn-sm btn-sm-v2 editor_manual'><i class='glyphicon glyphicon-pencil '></i> Modifica</button>"
                                                        +"  <button type='button' data-toggle='modal' data-target='#alertModal' name='"
                                                        + response[i].id 
                                                        +"' class='btn btn-danger btn-sm btn-sm-v2 editor_manual'><i class='glyphicon glyphicon-trash'></i> Cancella</button>"
                                                ] );
                                        }
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
                if($(".panel-table").hasClass("hidden")){
                        $(".panel-table").removeClass('hidden');
                }
                if($(".editor_create").hasClass("hidden")){
                        $(".editor_create").removeClass('hidden');
                }
        }

        
        // Button Accept/Reject [NEW booking]
        $('#tableBooking').on('click', ".editor_new", function () {
                currentBookingId = $(this).attr('name');
                currentStatus = "NEW";
                if($(this).hasClass("btn-success") ){
                        currentAction = "accept";
                        $('.message').html("Vuoi accettare questa prenotazione da cliente booking?");
                }else if($(this).hasClass("btn-danger") ){
                        currentAction = "reject";
                        $('.idBookingIndex').html($(this).attr('name'));
                        $('.message').html("Vuoi rifiutare questa prenotazione da cliente booking?");
                }
        });
        // Button Add Driver [ACCEPTED booking]
        $('#tableBooking').on('click', ".editor_accepted", function () {
                currentBookingId = $(this).attr('name');
                currentStatus = "ACCEPTED";
                if($(this).hasClass("btn-success") ){
                        currentAction = "driver";
                        $('.message').html($(this).attr('name'));
                        $('.message').html("Aggiungi Driver");
                }else if($(this).hasClass("btn-danger") ){
                        currentAction = "driver";
                        $('.message').html($(this).attr('name'));
                        $('.message').html("Cancella");
                }
        });
        // Button Accept/Reject [PENDING_AMMENDEMENT booking]
        $('#tableBooking').on('click', ".editor_p_amm", function () {
                currentBookingId = $(this).attr('name');
                currentStatus = "PENDING_AMMENDEMENT";
                if($(this).hasClass("btn-success") ){
                        currentAction = "accept";
                        $('.message').html('Vuoi accettare la richiesta di modifica di questa prenotazione da cliente booking?');
                }else if($(this).hasClass("btn-danger") ){
                        currentAction = "reject";
                        $('.message').html('Vuoi rifiutare la richiesta di modifica di questa prenotazione da cliente booking?');
                }
        });
        // Button Accept [PENDING_CANCELLATION booking]
        $('#tableBooking').on('click', ".editor_p_canc", function () {
                currentBookingId = $(this).attr('name');
                currentStatus = "PENDING_CANCELLATION";
                if($(this).hasClass("btn-success") ){
                        currentAction = "accept";
                        $('.message').html($(this).attr('name'));
                        $('.message').html('Vuoi accettare la richiesta di cancellazione di questa prenotazione da cliente booking?');
                }
        });

        // Button Edit/Delete [manual]
        $('#tableBooking').on('click', ".editor_manual", function () {
                currentBookingId = $(this).attr('name');
                if($(this).hasClass("btn-default") ){
                        currentAction = "edit";
                        $('.message').html($(this).attr('name'));
                }else if($(this).hasClass("btn-danger") ){
                        currentAction = "reject";
                        $('.message').html($(this).attr('name'));
                        $('.message').html('Vuoi cancellare questa prenotazione ?');
                }
        } );
        // Button Add new [manual]
        $(".editor_create").click(function () {
                currentBookingId = $(this).attr('name');
                if($(this).hasClass("btn-primary") ){
                        currentAction = "add";
                        $('.message').html($(this).attr('name'));
                        $('#tableBooking').dataTable().fnAddData( [
                                '.1',
                                '.2',
                                '.3',
                                '.4',
                                '.5',
                                '.5'
                        ] );
                }
        } );

        // Modal alert confirmation action
        $("#alertModal").on('click', ".save", function () {
                //alert("vado per la chiamata ajax per booking id: "+currentBookingId);
                if(currentAction == "accept"){
                        functionExe = "APIpostSinc";
                        statusUpdate = "ACCEPTED";
                        //currentStatus;
                }else if(currentAction == "reject"){
                        functionExe = "APIpostSinc";
                        statusUpdate = "REJECTED";
                        //currentStatus;
                }
                $.ajax({    
                        type: "post",
                        url: "AJAXcall.php",    
                        data: { action: functionExe,
                                id_booking: currentBookingId, 
                                statusUpdate: statusUpdate
                        },             
                        dataType: "html",                
                        success: function(response){ 
                                console.log('SUCCESS AJAX');
                                console.log(response);
                        },
                        fail: function(xhr, textStatus, errorThrown){
                                console.log('ERROR AJAX');
                                console.log(xhr);
                                console.log(textStatus);
                                console.log(errorThrown);
                        }
                });
                $('#alertModal').modal('toggle');
                initializeDatatable();
        });
        // Modal submit new manual
        $("#submitDriver").click(function(e) {
                e.preventDefault();
                var nome = $("#nome").val(); 
                var cognome = $("#cognome").val();
                var dataString = 'name='+nome+'&last_name='+cognome;
                /*$.ajax({    
                        type: "post",
                        url: "AJAXcall.php",    
                        data: { action: "APIputSinc",
                                id_booking: currentBookingId, 
                                driverInfo: nome
                        },             
                        dataType: "html",                
                        success: function(response){ 
                                console.log('SUCCESS AJAX');
                                console.log(response);
                        },
                        fail: function(xhr, textStatus, errorThrown){
                                console.log('ERROR AJAX');
                                console.log(xhr);
                                console.log(textStatus);
                                console.log(errorThrown);
                        }
                });*/
                $('#driverModal').modal('toggle');
                alert(dataString);
                initializeDatatable();
        });
        // Modal submit driver
        $("#submitDriver").click(function(e) {
                e.preventDefault();
                var nome = $("#nome").val(); 
                var cognome = $("#cognome").val();
                var dataString = 'name='+nome+'&last_name='+cognome;
                /*$.ajax({    
                        type: "post",
                        url: "AJAXcall.php",    
                        data: { action: "APIputSinc",
                                id_booking: currentBookingId, 
                                driverInfo: nome
                        },             
                        dataType: "html",                
                        success: function(response){ 
                                console.log('SUCCESS AJAX');
                                console.log(response);
                        },
                        fail: function(xhr, textStatus, errorThrown){
                                console.log('ERROR AJAX');
                                console.log(xhr);
                                console.log(textStatus);
                                console.log(errorThrown);
                        }
                });*/
                $('#driverModal').modal('toggle');
                alert(dataString);
                initializeDatatable();
        });
        // Modal choose action select new or existing driver
        $('.selectDriverCheck').change(function(){
                var data = $('option:selected', this).attr('name');
                alert(data);
                var elNew = $(".driverModalForm").find('.formNewDriver');
                var elExist = $(".driverModalForm").find('.formExistingDriver');
                if(data == "new"){
                        if(elNew.hasClass("hidden")){
                                elNew.removeClass('hidden');
                        }
                        if(!elExist.hasClass("hidden")){
                                elExist.addClass('hidden');
                        }
                }else if(data == "existing"){
                        if(elExist.hasClass("hidden")){
                                elExist.removeClass('hidden');
                        }
                        if(!elNew.hasClass("hidden")){
                                elNew.addClass('hidden');
                        }
                }else{
                        if(!elNew.hasClass("hidden")){
                                elNew.addClass('hidden');
                        }
                        if(!elExist.hasClass("hidden")){
                                elExist.addClass('hidden');
                        }
                }           
        });
} );

