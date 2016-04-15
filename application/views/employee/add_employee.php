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
                    <a href="employee">Emlpoyee Login</a>
                </li>
                <li>
                </li>
            </ul>
        </div>
</nav>
<div class ="container">
    <div class="jumbotron">
        <div class="text-center"><h4>Add Employee</h4></div>
        <div id="employee_error_message"></div>
        <form id="employeeForm" method="post" class="form-horizontal" action="add_employee/submit">
        <div class="form-group">
            <label class="col-xs-3 control-label">Email Address</label>
            <div class="col-xs-7">
                <input class="form-control" name="email"
                       type="email"
                       data-fv-emailaddress-message="The value is not a valid email address" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Password</label>
            <div class="col-xs-5">
                <input type="password" class="form-control" name="password" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">First Name</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="firstName"
                       required
                       data-fv-notempty-message="First Name is required" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Last Name</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="lastName"
                       required
                       data-fv-notempty-message="Last Name is required" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
     </div>
</div>
