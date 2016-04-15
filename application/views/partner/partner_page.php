<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <div id="logo" ></div>
            </a>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav pull-right">
                <li class="active">
                    <a href="logout_partner">Logout</a>
                </li>
                <li>
                </li>
            </ul>
        </div>
</nav>
<div class="container stretch">
    <h1>Partner Portal</h1>
    <div class="row clearfix">
        <div class="col-md-12 column ">
            <div class="tabbable">
                <ul id="partner-tab-menu" class="nav nav-tabs ">
                    <li class="active">
                        <a href="#panel1" data-toggle="tab">Welcome</a>
                    </li>
                    <li >
                        <a href="#panel2" data-toggle="tab">Request a Reward </a>
                    </li>
                    <li>
                        <a href="#panel3" data-toggle="tab">My Rewards Request</a>
                    </li>
                </ul>
            <!-- Tab1 --->
                <div class="tab-content">
                    <div class="tab-pane active" id="panel1">
                        <div class="col-md-12 column">
                            <h3>Welcome, <?php echo $fullName ?></h3>
                            <div class="col-md-12 column">
                                You have <?php echo $pending_request ?> pending rewards request <br>
                                Last activity on <?php echo $last_activity ?>
                            </div>
                            <div class="col-md-12 column">
                                <h3>Available Reward Programs</h3>
                                <div>
                                    <p>
                                        Earn cash for selling Barracuda products and completing training courses. The
                                        cash rewards are paid as preapid debit card and are in addition to your regular
                                        reseller margins. To claim your reward, simply click the Request a Reward button.
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <ul id="rewardsGrp" class="list-group req_rewards">
                                    <!-- dynamically added -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
             <!-- Tab2 --->
                    <div class="tab-pane" id="panel2">
                        <div class="container-fluid">
                            <h3 class="">Submit Request</h3>
                            <form id="partner_rewards_form" method="post" class="form-horizontal"  >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-xs-6" for="request_date">Request Date</label>
                                            <input type="text" id="request_date" name="request_date" class="form-control" readonly>
                                        </div>
                                        <div  class="form-group">
                                            <label class="col-xs-6" for="programSelector">Program Reward</label>
                                            <input id="programSelector" class="form-control" name="programSelector" data-fv-notempty >
                                            <div class="parnter_page_info_text"> Earn $50 for completing our digital signature training</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="partner_page_status">
                                        <p> Status: </p>
                                        <p id="amount_reward">Reward Amount:</p>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                <h3>Proof of Performance </h3>
                                <div  class="form-group">
                                    <table id="prgTbl" class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="add_rewards_tbl_heading">
                                                <th id="tblHeading">Training Course</th>
                                                <th >Date completed</th>
                                                <th >Reward Amount</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <tfoot class="add_rewards_tbl_heading">
                                            <tr>
                                                <td colspan="4">
                                                    <button type="submit" id="moreButton" class="btn btn-primary">Add Another Course</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="comments">Comments</label>
                                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-9 col-xs-offset-3">
                                        <button id="subForm" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
               <!-- Tab3 --->
                    <div class="tab-pane" id="panel3">
                        <div class="container">
                            <div class="row">
                                <h3> My Reward Rquest</h3>
                            </div>
                            <div class="row">
                                <div class="row parnter_add_request_button"><button class="btn btn-primary">Add a request</button></div>
                                <table id="partnerTbl" class="table table-bordered table-hover partnerTbl">
                                    <tr class="add_rewards_tbl_heading">
                                        <th id="tblHeading">Request Time</th>
                                        <th >Reward Program</th>
                                        <th >Reward Amount</th>
                                        <th >Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<template id="tableRow">
    <tr>
        <td><select  name="select" class="form-control"></select></td>
        <td><input type="date" name="date_completed" class="form-control" required></td>
        <td><input name="programReward" value="50" class="form-control" readonly size="3"></td>
        <td><button id="removeBtn" class="btn btn-warning">Remove</button></td>
    </tr>
</template>
<template id="partnerRewardTbl">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button id="removeBtn" class="btn btn-primary">edit</button><button id="removeBtn" class="btn btn-warning">Remove</button></td>
    </tr>
</template>