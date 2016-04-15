<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
 * Partner Page  
 */
?>

<script>
    //add json data from php
    var courseList = <?php echo $reward_courses ?>;
    var reward_programs = <?php echo $rewards_programs ?> ;
    var productList = <?php echo $reward_products ?>;
    var rewardsIndex = 0;
    getPartnerRewards(2);

    //create validation objects
    var programValidator = {
            validators: {
                notEmpty: {
                    message: 'Program is required'
                }
            }
        },
        courseValidators = {
            validators: {
                notEmpty: {
                    message: 'Course is required'
                }
            }
        },
        productValidators = {
            validators: {
                notEmpty: {
                    message: 'Product is required'
                }
            }
        },
        programRewardValidators = {
            validators: {
                notEmpty: {
                    message: 'Program is required'
                }
            }
        },
        dateValidators = {
            validators: {
                notEmpty: {
                    message: 'Date is required'
                }
            }
        };

    $(document).ready(function() {
        //empty rewards table on load
        $('#prgTbl tbody').empty();

        buildRewardPlans(reward_programs);
        addRequestDate();

    });

    function formValidate() {

        //Form validation
        $('#partner_rewards_form')
            .on('init.form.fv', function(e, data) {

                //Add click events to request rewards buttons
                $('.req_rewards li button').click(function(){
                    $('#partner-tab-menu a[href="#panel2"]').tab('show');

                    $('#prgTbl tbody').empty();

                    var reward = $(this).next().next().text();
                    $('#programSelector').val(reward);
                    $('#partner_rewards_form').formValidation('revalidateField', 'programSelector');

                    var rewardType = $(this).data().program_type;

                    if(rewardType == 'Training'){
                        setCourseHeading();

                    } else {
                        setProductHeading();

                    }
                });
                autoCompleteRewards();
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                }
            })
            .on('click', '#moreButton', function(e) {
                rewardsIndex++
                var buttonPress = $('#moreButton');

                   if(buttonPress.text() == "Add Another Course"){

                       addCourses();

                   } else if(buttonPress.text() == "Add Another Product"){

                       addProducts();
                   }

            })
            .on('click', '#removeBtn', function(e) {
                var tr = $(this).closest('tr');

                $(this).closest('tr').remove();

                calculateReward();
            })
            .on('success.field.fv', function(e, data) {
                if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
                    data.fv.disableSubmitButtons(true);
                }
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

                                    $('#partner-tab-menu a[href="#panel3"]').tab('show');
                                    $('#partner_rewards_form').trigger("reset").formValidation('destroy');
                                    formValidate();

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

    //Build rewards plans
    function buildRewardPlans(reward_programs){
        var sel = $('.req_rewards');

        reward_programs.forEach(function(ele, i) {
            sel.append( "<li>" +
                "<button type='button' data-program_id="+ ele.program_id +"  data-program_type="+ ele.program_type +" class='btn btn-sm btn-warning pull-right'>Request Reward</button>" +
                "<span class='pull-xs-left'>" + ele.program_type + " -  " + ele.title +
                " <br>" + ele.program_desc + "</span><div class='hide_program'>" + ele.program_title +" <div</li>");
        });

        formValidate();
    }

    function addRequestDate(){
        //get today's date in text
        var fullName = $.datepicker.formatDate('MM dd yy', new Date());
        // insert today's date into request_date form
        $('#request_date').val(fullName );

        //insert today's date in numeric format with text "Pending as of :"
        var date_form = $.datepicker.formatDate('mm/dd/yy', new Date());
        $('.partner_page_status p:first-of-type').text("Status: Pending as of: " + date_form );
    }


    function autoCompleteRewards(){

        var reward_array = [];

        for( var x in reward_programs ){
            reward_array.push({label: reward_programs[x].program_title,
                value: reward_programs[x].program_title,
                type: reward_programs[x].program_type
            });
        }

        $('#programSelector').autocomplete({
            source:reward_array,
            autoFocus: true,
        }).on( "autocompleteselect", function( event, ui ) {
            changeTable(ui)
        });
    }

    function addCourses() {
        //Make a clone of template
        var template = document.querySelector('#tableRow');
        var $clone = document.importNode(template.content, true);

        //Add attributes
        $($clone).find('select').attr('name','courseSel[rewards' + rewardsIndex + ']')
                    .append($('<option>', {value:"", text:'Select a course'})).end()
                    .find('input[name=date_completed]')
                    .attr('name','date_completed[rewards' + rewardsIndex +']').end()
                    .find('input[name=programReward]')
                    .attr('name','programReward[rewards' + rewardsIndex +']').end();

        //Populate select
        $(courseList).each(function() {
            $($clone).find('select')
                    .append($("<option>")
                    .attr('value',this.course_id)
                    .text(this.course_title));
        });
        //Numbering rows
        $($clone).find('tr').attr('name', rewardsIndex);

        //Adding template to DOM
        $('#prgTbl tbody').append($clone);

        $('#partner_rewards_form')
            .formValidation('addField','courseSel[rewards' + rewardsIndex + ']', courseValidators )
            .formValidation('addField','date_completed[rewards' + rewardsIndex +']',dateValidators);

        calculateReward();
    }

    function addProducts() {
        //Make a clone of template
        var template = document.querySelector('#tableRow');
        var $clone = document.importNode(template.content, true);

        //Add attributes
        $($clone).find('select').attr('name','prodSel[rewards' + rewardsIndex + ']')
            .append($('<option>', {value:"", text:'Select a product'})).end()
            .find('input[name=date_completed]')
            .attr('name','date_completed[rewards' + rewardsIndex +']').end()
            .find('input[name=programReward]')
            .attr('name','programReward[rewards' + rewardsIndex +']').end();

        //Populate select
        $(productList).each(function() {
            $($clone).find('select')
                .append($("<option>")
                    .attr('value',this.product_id)
                    .text(this.product_title));
        });
        //Numbering rows
        $($clone).find('tr').attr('name', rewardsIndex);

        //Adding template to DOM
        $('#prgTbl tbody').append($clone);

        //set validation on new elements
        $('#partner_rewards_form')
            .formValidation('addField','prodSel[rewards' + rewardsIndex + ']', productValidators )
            .formValidation('addField','date_completed[rewards' + rewardsIndex +']',dateValidators);

        calculateReward();
    }

    function addPartnerRewardsRequest(rewards){
        var template, td, tr

        $(rewards).each(function(i, rew) {

            template = document.querySelector('#partnerRewardTbl');
            var clone  = document.importNode(template.content, true);
            $(clone).find('td')[0].innerText = rew.timestamp;
            $(clone).find('td')[1].innerText = rew.program_title;
            $(clone).find('td')[2].innerText = rew.rewards;
            $(clone).find('td')[3].innerText = rew.status;
            $('#partnerTbl tbody').append( $(clone));
        })

    }

    function changeTable(selected){

        $('#programSelector').autocomplete( "option", "source" );

        $('#prgTbl tbody').empty();

        if(selected.item.type == "Training"){
            setCourseHeading();

        } else if(selected.item.type == "Sales"){
            setProductHeading();

        } else{


        }
    }

    function setProductHeading() {

        $('#tblHeading').text("Product");
        $('#moreButton').text("Add Another Product");
        $('#partner_rewards_form').attr('action','partner_page/addRewardsProduct')
        addProducts();

    }

    function setCourseHeading() {

        //changing the text
        $('#tblHeading').text("Course");
        $('#moreButton').text("Add Another Course");
        //set the post action
        $('#partner_rewards_form').attr('action','partner_page/addRewardsCourse')
        addCourses();

    }


    function calculateReward(){
    var fifty   =  $("tr").find('td input[value=50]').length * 50;
    var hundred =     $("tr").find('td input[value=100]').length * 100;
    var rewardAmount = fifty + hundred;
     $('#amount_reward').text("Reward Amount: " + rewardAmount );

    }

    function getRewardProgramCourses(program){
        var rewards  = [];

        $.ajax({
            url: '/partner_page/getCoursesByRewardProgram/' + program,
            type: 'GET',
            success: function (result) {
                if (result == 'false') {
                    return false;

                } else {

                    return rewards.push(result);
                }
            }
        });
    }

    function getRewardProgramProducts(program){
        var rewards  = [];

        $.ajax({
            url: '/partner_page/getProductsByReward/' + program,
            type: 'GET',
            success: function (result) {
                if (result == 'false') {
                    return false;

                } else {

                     rewards.push(result);
                }
            }
        });
    }

    function getPartnerRewards(partner_id) {
        var rewards  = [];
        $.ajax({
            url: '/partner_page/getPartnerRewardRequest/' + partner_id,
            type: 'GET',
            success: function (result) {
                if (result == 'false') {
                    return false;

                } else {

                    addPartnerRewardsRequest(JSON.parse(result))
                }
            }
        });
    }


    function resetPartnerForm( ){

        $('#partner_rewards_form').data('formValidation')
            .resetField('#programSelector')
            .updateStatus('#programSelector', 'NOT_VALIDATED')
            .validateField('#programSelector');


    }


</script>