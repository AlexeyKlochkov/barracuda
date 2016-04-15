<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('#employee_loginForm').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');
            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    console.log(result);
                    if(result == 'correct'){
                        window.location = 'employee_page';
                    }else{
                        $('#employee_loginform_errorMsg').text(result);
                    }
                }
            });
        });
    });
</script>
</body>
</html>