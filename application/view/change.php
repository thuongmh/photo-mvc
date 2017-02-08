<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/flickity.css">
    <link rel="stylesheet" href="/css/main.css">
    <title>Change Password</title>
</head>
<body>

<header class="container-fluid">
    <div class="hero">
    </div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><i class="fa fa-tumblr fa-lg" aria-hidden="true"
                                                    style="color: #fff;"></i></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                </ul>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control search-input" placeholder="Search">
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Register</a></li>
                    <li>
                        <a href="#" id="loginContainer">Login</a>
                        <div id="loginBox">
                            <form id="loginForm">
                                <fieldset id="body">
                                    <fieldset>
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username">
                                    </fieldset>
                                    <fieldset>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password">
                                    </fieldset>
                                    <input type="submit" id="login" value="Sign in">
                                    <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember
                                            me</i></label>
                                </fieldset>
                                <span><a href="/users/reset">Forgot your password?</a></span>
                            </form>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</header>

<section class="container">
    <div class="change-box">
        <form action="/users/change" method="POST" role="form">
            <div class="form-group personal-info">
                <h3>Change Password</h3>
                <div class="row">
                    <p class="error" style="text-align: center; color: #aa1111;">
                        <?php
                        if (isset($_SESSION["error"])) {
                            foreach ($_SESSION["error"] as $error) {
                                echo $error . "<br />";
                            }
                        }
                        ?>
                    </p>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
                        <label for="firstname-register">Old Password (*)</label>
                        <input type="password" name="old-password" id="input" class="form-control" value="">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
                        <label for="lastname-register">New Password (*)</label>
                        <input type="password" name="new-password" id="input" class="form-control" value="">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3">
                        <label for="email-register">Confirm Password (*)</label>
                        <input type="password" name="confirm-password" id="input" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-change" name="btn-change">Register</button>
            </div>
        </form>
    </div>
</section>
<?php
unset($_SESSION["error"]);
?>

<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

</body>
</html>

