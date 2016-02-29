/*
 *  Document   : videoValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

var videoValidation = function() {
    
    var rules = 
    {
        'name': {
            required: true,
            minlength: 3
        },
        'description': {
            required: true,
            minlength: 3
        }
    };

    return {
        init: function(videoRequired) {
            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

             if(videoRequired){
                rules.video = {
                    required: true
                };
             }

            /* Initialize Form Validation */
            $('#saveVideo').validate({
                errorClass: 'help-block animation-pullUp col-md-offset-4 col-md-6', // You can change the animation class for a different entrance animation - check animations page
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
                        minlength: 3
                    },
                    'description': {
                        required: true,
                        minlength: 3
                    },
                    'video': {
                        required: true
                    }
                },
                messages: {
                    'name': {
                        required: 'El nombre es requerido',
                    },
                    'description': {
                        required: 'La descripción es requerida',
                    },
                    'video': {
                        required: 'El archivo video es requerido',
                    }
                },
                rules: rules
            });
        }
    };
}();