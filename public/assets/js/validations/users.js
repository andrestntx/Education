/*
 *  Document   : formsValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

var FormsValidation = function() {

    return {
        init: function() {
            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Initialize Form Validation */
            $('#form-validation').validate({
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
                    'username': {
                        required: true,
                        minlength: 3
                    },
                    'name': {
                        required: true,
                        minlength: 3
                    },
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        minlength: 2
                    },
                    'password_confirmation': {
                        equalTo: '#password'
                    },
                    'roles[]': {
                        required: true,
                    },
                    'areas[]': {
                        required: true
                    }
                },
                messages: {
                    'username': {
                        required: 'El nombre de usuairo es requerido',
                    },
                    'name': {
                        required: 'El nombre es requerido',
                    },
                    'email': 'Ingrese un email válido',
                    'password': {
                        minlength: 'La contraseña es muy debil'
                    },
                    'password_confirmation': {
                        equalTo: 'La contraseña no coincide'
                    },
                    'roles[]': 'Los perfiles del usuario son requeridos',
                    'areas[]': 'Las áreas del usuario son requeridas',
                }
            });
        }
    };
}();