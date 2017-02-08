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
    <title>Register</title>
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
                                <span><a href="#">Forgot your password?</a></span>
                            </form>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</header>

<section class="container">
    <div class="reset-box">
        <form action="/users/register" method="POST" role="form">
            <div class="form-group">
                <div class="row">
                    <h3 class="text-center">Nhập email của bạn để nhận yêu cầu reset mật khẩu</h3>
                    <div class="col-md-6 col-md-offset-3">
                        <div id="circularG">
                            <div id="circularG_1" class="circularG"></div>
                            <div id="circularG_2" class="circularG"></div>
                            <div id="circularG_3" class="circularG"></div>
                            <div id="circularG_4" class="circularG"></div>
                            <div id="circularG_5" class="circularG"></div>
                            <div id="circularG_6" class="circularG"></div>
                            <div id="circularG_7" class="circularG"></div>
                            <div id="circularG_8" class="circularG"></div>
                        </div>
                        <input type="text" name="email-reset" id="email-reset" class="form-control"
                               value="<?php echo isset($_SESSION['input']['old_email']) ? $_SESSION['input']['old_email'] : null; ?>"
                               title=""
                               required="required" placeholder="Email của bạn" style="margin-bottom: 20px;">
                        <input type="button" name="submit-reset" id="submit-reset" class="btn btn-primary"
                               value="SEND" title="" required="required" style="margin-bottom: 20px;">
                        <p id="notication" style="text-align: center; color: #aa1111;"></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</section>
<?php
unset($_SESSION["error"]);
unset($_SESSION["input"]);
?>

<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

</body>
</html>

