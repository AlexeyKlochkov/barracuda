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
                    <a href="employee_page">Main Menu</a>
                </li>
            </ul>
        </div>
</nav>

<div class="container">
    <div class="row">
        <h3> Review Partner Rquest</h3>
    </div>
    <div class="row">
        <div class="row parnter_add_request_button"><select><option>Choose Partner</option></select></div>
        <table id="partnerTbl" class="table table-bordered table-hover partnerTbl">
            <tr class="add_rewards_tbl_heading">
                <th id="tblHeading">Request Time</th>
                <th style="width:20%;">Reward Program</th>
                <th style="width:20%;" >Partner</th>
                <th style="width:5%;">Reward Amount</th>
                <th >Status</th>
                <th style="width:25%;"></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<template id="partnerRewardTbl">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button id="removeBtn" class=" approveBtn btn btn-primary">approve</button><button id="removeBtn" class="btn btn-warning">Deny</button></td>
    </tr>
</template>