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
                <li>
                </li>
            </ul>
        </div>
</nav>
<div class ="container">
    <div class="jumbotron">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <h2 class="course_heading">Add Courses</h2>
                <div id="add_course_notify"></div>
                <form id="course_form" method="post" class="form-horizontal" action="add_course/add">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Course</label>
                        <div class="col-xs-7">
                            <input class="form-control" name="course_title"
                                   type="text"
                                   data-fv-emailaddress-message="Please enter a course" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Status</label>
                        <div class="col-xs-5 ">
                            <label class="radio-inline">
                                <input type="radio" value="pending" name="course_status">Pending
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="active" name="course_status">Active
                            </label>
                        </div>
                        <div id="alertDayMessage"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>
