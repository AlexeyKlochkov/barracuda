<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
 * Review request footer
 */
?>

<script>

    getPartnerRewards()


    function addPartnerRewardsRequest(rewards){
        var template;

        $(rewards).each(function(i, rew) {

            template = document.querySelector('#partnerRewardTbl');
            var clone  = document.importNode(template.content, true);
            $(clone).find('td')[0].innerText = rew.timestamp;
            $(clone).find('td')[1].innerText = rew.program_title;
            $(clone).find('td')[2].innerText = rew.company;
            $(clone).find('td')[3].innerText = rew.reward;
            $(clone).find('td')[4].innerText = rew.status;
            $('#partnerTbl tbody').append( $(clone));
        })
    }

    function getPartnerRewards() {
        var rewards  = [];
        $.ajax({
            url: '/review_request/getPartnerRquest',
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


</script>