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
<div class ="container">
    <div class=" clearfix rewards_program_container">
        <div class="col-md-12 column">
            <h2>Rewards Program</h2>
            <div class="rewardPrgNotification"></div>
            <form id="rewards_form"  method="post" class="form-horizontal" >
                <div class="form-group">
                    <label class="col-xs-3 control-label">Program Title</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="program_title"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Program Type</label>
                    <div class="col-xs-5">
                        <select class="form-control" id="progType" name="program_type" data-fv-emailaddress-message="Please a program type" />
                            <option value="">Choose program type</option>
                            <option>Training</option>
                            <option>Sales</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Program Description</label>
                    <div class="col-xs-5 ">
                        <textarea class="form-control" name="program_desc" rows="5" id="comment"></textarea>
                    </div>
                    <div id="alertDayMessage"></div>
                </div>
                <div class="form-group">
                    <label class="col-xs-3 control-label">Active</label>
                    <div class="col-xs-5">
                        <select class="form-control" id="sel1" name="program_status" data-fv-emailaddress-message="Please a program type" />
                        <option>Yes</option>
                        <option>No</option>
                        </select>
                    </div>
                </div>
                <div  class="form-group">
                    <table id="prgTbl" class="table table-bordered">
                    <thead>
                    <tr class="add_rewards_tbl_heading">
                        <th id="tblHeading">Course</th>
                        <th colspan="2">Reward Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tfoot class="add_rewards_tbl_heading">
                            <tr><td colspan="3"><button type="submit" id="moreButton"  class="btn btn-primary"  >Add Another Course</button></td></tr>
                    </tfoot>
                    </tbody>
                </table>
                </div>
                <div class="form-group">
                    <div class="col-xs-9 col-xs-offset-3">
                        <button id="subForm" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<template id="rewards">
    <tr>
        <td><select  name="select" class="form-control"></select></td>
        <td><input name="programReward" class="form-control"></td>
        <td><button id="removeBtn" class="btn btn-warning">Remove</button></td>
    </tr>
</template>