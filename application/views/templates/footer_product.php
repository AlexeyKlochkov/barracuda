<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>

    $(document).ready(function() {
        formValidate();
    });

    function formValidate() {
        $('#product_form')
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
                    product_title: {
                        validators: {
                            notEmpty: {
                                message: 'Product is required'
                            }
                        }
                    },
                    product_status: {
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
                fv = $form.data('formValidation');
            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    console.log('this is  ' + result);
                    if (result == 'true') {

                        $('#add_products_notify').text("Product saved");
                        $('#product_form').trigger("reset").formValidation('destroy');
                        formValidate();

                    } else {

                        $('#add_products_notify').text('Product has already been entered');
                        $('input').focus(function(){
                            $('#add_products_notify').text('');
                        })

                    }
                }
            });
        });
    }
</script>

