<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URL; ?>bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/productDetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <script src="<?php echo URL; ?>js/jquery.min.js"></script>

    <script src="<?php echo URL; ?>bootstrap-3.3.7-dist/js/jquery.min.js"></script>
    <script src="<?php echo URL; ?>bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/countdown.min.js"></script>
    <script src="<?php echo URL; ?>js/magnific.js"></script>
    <script src="<?php echo URL; ?>js/nicescroll.js"></script>
    <script src="<?php echo URL; ?>js/masonry.js"></script>
    <script src="<?php echo URL; ?>js/owl-carousel.js"></script>
    <script src="<?php echo URL; ?>js/tweet.min.js"></script>
    <script src="<?php echo URL; ?>js/default.js"></script>
    <script src="<?php echo URL; ?>js/pagination.js"></script>
    <?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script type="text/javascript" src="' . URL . $js . '"></script>';
        }
    }
    ?>
</head>
<body>
<div class="global-wrap">

    <!--*********************
            HEADER
    *********************-->

    <!--LOGO-->
    <div class="top-main-area">
        <a href="<?php echo URL; ?>">
            <div class="header-content">
                <img src="<?php echo URL; ?>img/couponia-logo.png" alt="couponia logo"/>
            </div>
        </a>
    </div>
    <!--END LOGO-->

    <!--HEADER NAVBAR-->
    <div class="header-navbar">
        <!--                <div class="container">-->
        <!--NAVIGATION BAR-->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-collapse-right">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Menu</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo URL; ?>">Home</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo URL . 'product'; ?>">All Product</a></li>
                                    <li><a href="<?php echo URL . 'product/deal'; ?>">All Deal</a></li>
                                    <li><a href="#">Page 1-3</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (Session::get('role') == 'admin'): ?>
                            <li><a href="<?php echo URL; ?>manager" style="width:auto;">
                                    <span class="glyphicon glyphicon-dashboard"></span> Manager</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                                            class="glyphicon glyphicon-shopping-cart"></span> MY CART</a>
                                <ul class="dropdown-menu myCart" id="myCart">
                                    <div id="myCartDiv">
                                    <?php
                                    if(Session::get('cart') != null){
                                        foreach (Session::get('cart') as $id => $item) {
                                            echo '<a href="/product/detail/' . $item['id'] . '">';
                                            echo '   <li>';
                                            echo '       <div class="cart-item">';
                                            echo '           <img src="' . URL . $item['image'] . '" height="70" width="70"/>';
                                            echo '           <div class="cart-info">';
                                            echo '               <p class="cart-info-name">' . $item['name'] . '</p>';
                                            echo '               <p class="cart-info-price" id="' . $item['id']. '">$' . ((date(time()) < date($item['expired_time'])) ? ($item['price'] * $item['quantity'] * (100 - $item['discount']) / 100) : $item['price']) . '</p>';
                                            echo '           </div>';
                                            echo '       </div>';
                                            echo '   </li>';
                                            echo '</a>';
                                        }
                                    }
                                    ?>
                                    </div>
                                    <!--OPTION IN CART-->
                                    <li class="cartOption">
                                        <span>
                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                            <a href="<?php echo URL; ?>cart"
                                               style="padding: 0; background-color: #1a1a1a;" class="viewCart">View Cart</a>
                                        </span>
                                        <span>
                                            <span class="glyphicon glyphicon-check"></span>
                                            <a href="<?php echo URL; ?>cart/checkout"
                                               style="padding: 0; background-color: #1a1a1a;" class="checkOut">Checkout</a>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if (Session::get('loggedIn') == true): ?>
                            <li><a href="#" style="width:auto;">
                                    <span class="glyphicon glyphicon-user"></span> <?php echo strtoupper(Session::get('user')['username']); ?>
                                </a></li>
                            <li><a href="<?php echo URL; ?>login/logout" style="width:auto;">
                                    <span class="glyphicon glyphicon-log-in"></span> SIGN OUT</a></li>
                        <?php else: ?>
                            <li><a href="#" onclick="document.getElementById('signinPanel').style.display='block'"
                                   style="width:auto;">
                                    <span class="glyphicon glyphicon-log-in"></span> SIGN IN</a></li>
                            <li><a href="#" onclick="document.getElementById('signupPanel').style.display='block'"
                                   style="width:auto;">
                                    <span class="glyphicon glyphicon-edit"></span> SIGN UP</a></li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!--END NAVIGATION BAR-->
    </div>
    <!--END HEADER NAVBAR-->

    <!--SIGNIN PANEL-->
    <div id="signinPanel" class="modal">
        <div class="panel panel-default signinPanel">
            <div class="closebtn">
                <button onclick="document.getElementById('signinPanel').style.display='none'"
                        title="Close (Esc)" type="button" class="mfp-close">×
                </button>
            </div>
            <div class="panel panel-body">
                <h3>Member Login</h3>
                <p>Welcome back, friend. Login to get started</p>
                <hr>
                <form method="post" action="<?php echo URL; ?>login/run">
                    <div class="form-group">
                        <label for="username"><b>Username</b></label>
                        <input class="form-control" type="text" placeholder="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input class="form-control" type="password" placeholder="My secret password" name="password"
                               required>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Sign in</button>
                    <span id="notRemember"><a href="#">Not member yet</a></span>
                    <span id="forgotPassword"><a href="#">Forgot password</a></span>
                </form>
            </div>
        </div>
    </div>

    <!--END SIGNIN PANEL-->

    <!--SIGNUP PANEL-->
    <div id="signupPanel" class="modal">
        <div class="panel panel-default signupPanel">
            <div class="closebtn">
                <button onclick="document.getElementById('signupPanel').style.display='none'"
                        title="Close (Esc)" type="button" class="mfp-close">×
                </button>
            </div>
            <div class="panel panel-body">
                <h3>Member Register</h3>
                <p>Ready to get best offers? Let's get started!</p>
                <hr>
                <form method="post" action="<?php echo URL; ?>login/signup">
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input class="form-control" type="mail" placeholder="email@domain.com" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username"><b>Username</b></label>
                        <input class="form-control" type="text" placeholder="My username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input class="form-control" type="password" placeholder="My secret password" name="password"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="repassword"><b>Repeat Password</b></label>
                        <input class="form-control" type="password" placeholder="Type your password again"
                               name="repassword" required>
                    </div>
                    <div class="form-group">
                        <label for="address"><b>Address</b></label>
                        <input class="form-control" type="text" placeholder="298 NTT St., Dis. 4, HCMC" name="address"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="phone"><b>Phone Number</b></label>
                        <input class="form-control" type="text" placeholder="84123456789" name="phone" required>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" checked="checked" name="remember"> Get host offers via
                            e-mail</label>
                    </div>
                    <button class="btn btn-primary" type="submit" name="registerBtn">Sign up</button>
                    <span id="alreadyMember"><a href="#">Already member</a></span>
                </form>
            </div>
        </div>
    </div>

    <!--END SIGNUP PANEL-->

    <!--GAP DIV-->
    <div class="gap"></div>
    <!--END GAP DIV-->

    <!--*********************
            END - HEADER
        *********************-->

    <!--****************************
                MAIN CONTAINER
        THE CONTENT WILL CHANGE HERE
        ****************************-->
    <div class="main-content">