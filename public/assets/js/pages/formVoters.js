/*
 *  Document   : formsValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

var FormVoters = function() {

    return {
        init: function() {

            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Initialize Form Validation */
            
            $('#form-voters').validate({
                errorClass: 'help-block animation-pullUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    // You can use the following if you would like to highlight with green color the input after successful validation!
                    e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'name': {
                        required: true,
                        minlength: 5
                    },
                    'sex': {
                        required: true
                    },
                    'location_id': {
                        required: true
                    },
                    'email': {
                        email: true
                    },
                    'address': {
                        required: true
                    },
                    'telephone': {
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    }

                },
                messages: {
                    'name': {
                        required: 'Ingrese el nombre',
                        minlength: 'El nombre debe tener más de 5 letras'
                    },
                    'sex': 'Seleccione un género',
                    'location_id': 'Seleccione la ubicación',
                    'address': 'Ingrese la direcciónnnnnn',
                    'email': 'Ingrese un correo eléctronico correcto',
                    'telephone': 'Número de móvil incorrecto'
                }
            });
        },

        findNameAndPollingStation: function()
        {
            var doc = $('#form-voters input:text[name=doc]').val();
            var name = $('#form-voters input:text[name=name]').val();

            if( name.length === 0 )
            {
                $("#loading-gif").css("display", "inline");
                $.ajax({
                    url: "/database/voters/find-name/" + doc,
                    dataType: 'json'
                }).done(function(data) {
                    
                    if(data.name != 'Error')
                    {
                        $('input:text[name=name]').val(data.name); 
                    }
                    else
                    {
                        alert( "Por favor verifique el número de cédula" );
                    }  

                }).fail(function() {
                    alert( "Por favor verifique el número de cédula" );
                }).always(function() {
                    $("#loading-gif").css("display", "none");
                });    
            }

            $("#loading-polling-station-gif").css("display", "inline");
            $.ajax({
                url: "/database/voters/find-polling-station/" + doc,
                dataType: 'json'
            }).done(function(data) {
                if(data.result.status)
                {
                    $("#polling_station_location_name").html(data.result.polling_station.location.name);
                    $("#polling_station_name_and_table").html(data.result.polling_station.name + ' - Mesa ' + data.result.table_number);
                    $("#polling_station_address").html(data.result.polling_station.address);
                    $('input[name=polling_station_id]').val(data.result.polling_station.id); 
                    $('input[name=table_number]').val(data.result.table_number); 
                }
                else
                {
                    $("#polling_station_message").html('<strong>¡Atención!</strong> </br> ' + data.result.message);
                }
            }).fail(function() {
                console.log( "La registraduria no responde" );
            }).always(function() {
                $("#loading-polling-station-gif").css("display", "none");
            });  
        }
    };
}();