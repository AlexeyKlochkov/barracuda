<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
 * Employee  @Rewards JS validation
 *  - Ajax response method
 */
?>

<script xmlns="http://www.w3.org/1999/html">
    var programIndex = 0;

    $(document).ready(function() {
        // Program type selector
        $('#progType').change(function(){

            //remove old selection
            $('#prgTbl tbody').empty();
            //Get selected fld object
            var selected = $(this).val();

            if(selected == "Training"){
                $(tblHeading).text("Course");
                $('#moreButton').text("Add Another Course");
                $('#rewards_form').attr('action','add_rewards_program/addCourses')
                
                
            }else if(selected == "Sales"){

                $(tblHeading).text("Product");
                $('#moreButton').text("Add Another Product");
                $('#rewards_form').attr('action','add_rewards_program/addProducts')
            }else{

                addStarterTable();
            }

        });
        formValidate();

    });
    
    function formValidate() {
        //Form validation
        $('#rewards_form')
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    program_title: {
                        validators: {
                            notEmpty: {
                                message: 'Program is required'
                            }
                        }
                    },
                    program_type: {
                        validators: {
                            notEmpty: {
                                message: 'Please choose at least one checkbox'
                            }
                        }
                    },
                    program_desc: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter program description'
                            }
                        }
                    },
                    program_status: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a status'
                            }
                        }
                    },

                }
            })
            .on('click', '#moreButton', function(e) {

                var buttonPress = $('#moreButton');
                var  programRewards = {validators: {notEmpty: {message: 'Please select an amount'}, numeric: {
                    message: 'The price must be a number'}}};

                if(buttonPress.text() == "Add Another Course"){

                   var  programCourse = {validators: {notEmpty: {message: 'Please select a course'}}};
                    addCourses();
                    //set validation on new elements
                    $('#rewards_form')
                        .formValidation('addField','courseSel[' + programIndex + ']', programCourse )
                        .formValidation('addField','programReward[' + programIndex +']', programRewards);

                    programIndex++

                } else if(buttonPress.text() == "Add Another Product"){

                    var  programProduct = {validators: {notEmpty: {message: 'Please select a Product'}}};

                    addProducts();
                    //set validation on new elements
                    $('#rewards_form')
                        .formValidation('addField','prodSel[' + programIndex + ']', programProduct )
                        .formValidation('addField','date_completed[' + programIndex +']',programRewards);

                }

                //keep track of table rows
                programIndex =  $('#prgTbl tr').length -2;
            })
            .on('click', '#removeBtn', function(e) {
                var tr = $(this).closest('tr');
                var number = tr.attr('name')
                $(this).closest('tr').remove();

                //set index to missing number
                rewardsIndex = parseInt(number);

            })
            .on('success.form.fv', function (e) {
                // Prevent form submission
                e.preventDefault();
                var $form = $(e.target);
                $button = $form.data('formValidation').getSubmitButton();

                switch ($button.attr('id')) {
                    case 'subForm':
                        fv = $form.data('formValidation');
                        // Use Ajax to submit form data
                        $.ajax({
                            url: $form.attr('action'),
                            type: 'POST',
                            data: $form.serialize(),
                            success: function (result) {
                                if (result == 'true') {

                                    $('.rewardPrgNotification').text("Reward program saved");
                                    $('#rewards_form').trigger("reset").formValidation('destroy');
                                    $('#prgTbl tbody').empty();
                                    formValidate();
                                    addStarterTable();

                                } else {

                                    $('.rewardPrgNotification').text("Rewards program already entered");
                                    $('input').focus(function(){
                                        $('#rewardPrgNotification').text('');
                                    })
                                }
                            }
                        });
                    case 'moreButton':
                        console.log("more button pressed");
                    default:
                        console.log("default case")
                }
                $('button').removeAttr('disabled').removeClass('disabled');
            });
    }

    function addCourses() {

        var courseList = <?php echo $courses ?>;

        //Make a clone of template
        var template = document.querySelector('#rewards');
        var $clone = document.importNode(template.content, true);

        //Add attributes
        $($clone).find('select').attr('name','courseSel[' + programIndex + ']')
            .append($('<option>', {value:"", text:'Select a course'})).end()
            .find('input[name=programReward]')
            .attr('name','programReward[' + programIndex +']').end();

        //Populate select
        $(courseList).each(function() {
            $($clone).find('select')
                .append($("<option>")
                    .attr('value',this.course_id)
                    .text(this.course_title));
        });
        //Numbering rows
        $($clone).find('tr').attr('name', programIndex);

        //Adding template to DOM
        $('#prgTbl tbody').append($clone);
    }

    function addProducts() {

        var productList = <?php echo $products ?>;

        //Make a clone of template
        var template = document.querySelector('#rewards');
        var $clone = document.importNode(template.content, true);

        //Add attributes
        $($clone).find('select').attr('name','prodSel[' + programIndex + ']')
            .append($('<option>', {value:"", text:'Select a product'})).end()
            .find('input[name=programReward]')
            .attr('name','programReward[' + programIndex +']').end();

        //Populate select
        $(productList).each(function() {
            $($clone).find('select')
                .append($("<option>")
                    .attr('value',this.product_id)
                    .text(this.product_title));
        });
        //Numbering rows
        $($clone).find('tr').attr('name', programIndex);

        //Adding template to DOM
        $('#prgTbl tbody').append($clone);
    }

    function addStarterTable() {

        var row = '<tr>' +
            '<td style="height: 40px;"></td>'+
            '<td></td>' +
            '<td></td></tr>';
        $('#prgTbl').append(row);

    }
    addStarterTable();
</script>

