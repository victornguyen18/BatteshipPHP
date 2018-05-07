<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Battleships Online</title>

    <link rel="stylesheet" href="<?php echo URL; ?>bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/battleshipstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="<?php echo URL; ?>js/jquery.min.js"></script>
    <script src="<?php echo URL; ?>bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/default.js"></script>
    <script src="<?php echo URL; ?>js/jquery-ui.min.js"></script>
</head>
<body>
<div class="wrapper">
<!--    <header>-->
<!--        <nav id="myNavBar" class="navbar" role="navigation">-->
<!--            <div class="container-fluid">-->
<!--                <div class="navbar-header">-->
<!--                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavBar-collapse">-->
<!--                        <span class="sr-only">Toggle navigation</span>-->
<!--                        <span class="icon-bar">Link 1</span>-->
<!--                        <span class="icon-bar">Link 2</span>-->
<!--                        <span class="icon-bar">Link 3</span>-->
<!--                    </button>-->
<!--                </div>-->
<!--                <div class="collapse navbar-collapse" id="myNavBar-collapse">-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        <li class="active"></li>-->
<!--                        <li></li>-->
<!--                        <li style="margin-top: 20px"><a class="logo-border" href="#">-->
<!--                                <img class="logo" src="--><?php //echo URL; ?><!--img/ship/logo.png" alt="Battleship Online">-->
<!--                            </a></li>-->
<!--                        <li></li>-->
<!--                        <li></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </nav>-->
<!--    </header>-->
    <section id="pheader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="ptopnav">
                        <div class="pull-right login-box">
                            <a href="/dang-ky.html">SIGN UP</a>
                            <a href="/dang-nhap.html">SIGN IN</a>
                            <a href="/lang/vi" class="lang"><img src="<?php echo URL; ?>img/vi.png"/></a>
                            <a href="/lang/en" class="lang"><img src="<?php echo URL; ?>img/en.png"/></a>
                        </div>
                    </div>
                </div>
            </div>
            <nav id="pmainmenu">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left-menu">
                            <ul>
                                <li class="active"><a href="/">GO BATTLE</a></li>
                                <li><a href="#">HOME</a></li>
                                <li><a href="#">How to play</a></li>
                                <li><a href="#">More games</a></li>
                            </ul>
                        </div>
                        <div class="center-menu">
                            <a href="/"><img src="<?php echo URL; ?>img/ship/logo.png"
                                             style="width: 250px; height: 200px; -webkit-transform: scaleX(-1); transform: scaleX(-1); z-index: 1;"/></a>
                        </div>
                        <div class="right-menu">
                            <ul>
                                <li><a href="#">SHOP</a></li>
                                <li><a href="#">BATTLE EVENTS</a></li>
                                <li><a href="/tuyen-dung.html">Help</a></li>
                                <li><a href="/lien-he">ABOUT US</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
