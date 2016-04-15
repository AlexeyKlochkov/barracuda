<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {
        $('#loginForm').formValidation({
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
                fields: {
                    firstName: {
                        validators: {
                            notEmpty: {
                                message: 'First name is required'
                            }
                        }
                    },
                    lastName: {
                        validators: {
                            notEmpty: {
                                message: 'Last name is required'
                            }
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
                        window.location = 'partner_page';
                    }else{
                        $('#errorMsg').text(result);
                    }
                }
            });
        });
    });
</script>
</body>
</html>