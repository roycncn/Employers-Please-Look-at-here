<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hong Kong Baptist University Facility Booking System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/reset.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
        <!-- in case you wonder: That's the cool-kids-protocol-free way to load jQuery -->
        <script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/application.js"></script>
    </head>
    <body>

        <div class="debug-helper-box">
            DEBUG HELPER: you are in the view: <?php echo $filename; ?>
        </div>

        <div class='title-box'>
            <a href="<?php echo URL; ?>">Hong Kong Baptist University Facility Booking System</a>
        </div>

        <div class="header">
            <div class="header_left_box">
                <ul id="menu">
                    <?php if (Session::get('user_logged_in') == false && Session::get('admin_logged_in') == false): ?>
                        <li <?php
                        if ($this->checkForActiveController($filename, "index")) {
                            echo ' class="active" ';
                        }
                        ?> >
                            <a href="<?php echo URL; ?>index/index">Log on</a>
                        </li>
                    <?php endif; ?>
                    <li <?php
                    if ($this->checkForActiveController($filename, "help")) {
                        echo ' class="active" ';
                    }
                    ?> >
                        <a href="<?php echo URL; ?>help/index">Help</a>
                    </li>
                    <li <?php
                    if ($this->checkForActiveController($filename, "overview")) {
                        echo ' class="active" ';
                    }
                    ?> >
                        <a href="<?php echo URL; ?>overview/index">Overview</a>
                    </li>

                    <?php if (Session::get('user_logged_in') == true || Session::get('admin_logged_in') == true): ?>
                        <li <?php
                        if ($this->checkForActiveController($filename, "dashboard")) {
                            echo ' class="active" ';
                        }
                        ?> >

                            <a href="<?php echo URL; ?>dashboard/index">Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <?php if (Session::get('user_logged_in') == true): ?>
                        <li <?php
                        if ($this->checkForActiveController($filename, "user")) {
                            echo ' class="active" ';
                        }
                        ?> >
                            <a href="<?php echo URL; ?>user/showprofile">My Account</a>
                        </li>

                        <li>
                            <a href="<?php echo URL; ?>facility/index">Booking Now!</a>
                        </li>

                        <li<?php
                        ?> >
                            <a href="<?php echo URL; ?>user/logout">Logout</a>
                        </li>
                    <?php endif; ?>

                    <?php if (Session::get('admin_logged_in') == true): ?>

                        
                        
                        <li <?php
                        if ($this->checkForActiveController($filename, "facility")) {
                            echo ' class="active" ';
                        }
                        ?> >
                            <a href="<?php echo URL; ?>admin/manageFacility">Facility manage</a>
                            
                        </li>

                        
                        
                        
                        <li <?php
                        if ($this->checkForActiveController($filename, "admin")) {
                            echo ' class="active" ';
                        }
                        ?> >
                            <a href="<?php echo URL; ?>admin/showprofile">My Account</a>
                            <ul class="sub-menu">

                                <li <?php
                                if ($this->checkForActiveController($filename, "admin")) {
                                    echo ' class="active" ';
                                }
                                ?> >
                                    <a href="<?php echo URL; ?>admin/logout">Logout</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if (Session::get('user_logged_in') == true): ?>
                <div class="header_right_box">
                    <div class="namebox">
                        Hello <?php echo Session::get('sname'); ?> !
                    </div>

                </div>
            <?php endif; ?>

            <?php if (Session::get('admin_logged_in') == true): ?>
                <div class="header_right_box">
                    <div class="namebox">
                        Hello Admin!
                    </div>

                </div>
            <?php endif; ?>

            <div class="clear-both"></div>
        </div>
