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
            <ul class="nav navbar-nav pull-right ">
                <li class="active">
                    <a href="logout_employee">Logout</a>
                </li>
                <li>
                </li>
            </ul>
        </div>
</nav>
<div class="container stretch">
    <h1>Partner Portal - Main Menu</h1>
    <div>
        <h3>Welcome, <?php echo $fullName;?></h3>
    </div>
    <div>
        <div class="row clearfix">
            <div class="col-md-10 column ">
                <div class="container-fluid">
                    <div class="row employeeMain">
                        <div class="col-md-6">
                            <a href="review_request"<button type="button" class="btn btn-default list-inline pull-left" style="padding-right: 20px;">Review Request</button></a>
                        </div>
                        <div class="col-md-6">
                            <div class="employeeMainText">View, approve or deny partner request.</div>
                        </div>
                    </div>
                    <div class="row employeeMain">
                        <div class="col-md-6">
                            <a href="add_rewards_program"><button type="button" class="btn btn-default list-inline pull-left">Reward Programs</button></a></div>
                        <div class="col-md-6">
                            <div class="employeeMainText">Set up reward programs.</div>
                        </div>
                    </div>
                    <div class="row employeeMain">
                        <div class="col-md-6">
                            <a href="add_course"><button type="button" class="btn btn-default list-inline pull-left" style="padding-right: 40px;padding-left: 40px;">Courses</button></a>
                        </div>
                        <div class="col-md-6">
                            <div class="employeeMainText">
                                Define the list of courses that can be linked to rewards program.
                            </div>
                        </div>
                    </div>
                    <div class="row employeeMain">
                        <div class="col-md-6"> <a href="add_product">
                                <button type="button" class="btn btn-default list-inline pull-left" style="padding-right: 40px;padding-left: 40px;">products</button></a>
                        </div>
                        <div class="col-md-6">
                            <div class="employeeMainText">
                                Define the list products that can be linked to rewards programs.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
