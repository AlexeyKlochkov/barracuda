<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
* Employee add @Courses JS validation
*  - Ajax response method
 */
?>


<script>
    $(document).ready(function() {
        formValidate();
    });

    function formValidate(){
        $('#course_form')
            .on('init.field.fv', function(e, data) {
                // data.field   --> The field name
                // data.element --> The field element
                if (data.field === 'alertDay') {
                    var $icon = data.element.data('fv.icon');
                    $icon.appendTo('#alertDayIcon');
                }
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    course_title: {
                        validators: {
                            notEmpty: {
                                message: 'course is required'
                            }
                        }
                    },
                    course_status: {
                        icon: 'false',
                        err: '#alertDayMessage',
                        validators: {
                            notEmpty: {
                                message: 'Please choose at least one checkbox'
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
                    console.log('this is  ' +result);
                    if(result == 'true'){

                        $('#course_form').trigger("reset").formValidation('destroy');
                        formValidate();
                        $('#add_course_notify').text("Course has been saved");

                    }else{

                        $('#add_course_notify').text("Course has already been entered");

                    }
                    $('input').focus(function(){
                        $('#add_course_notify').text('');
                    })
                }
            });
            $('button').removeAttr('disabled').removeClass('disabled');
        });
    }
</script>

