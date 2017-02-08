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
    <title>Login</title>
</head>
<body>

<header class="container-fluid">
    <div class="hero">
        <div class="hero__back hero__back--static"></div>
        <div class="hero__back hero__back--mover"></div>
        <div class="hero__front"></div>
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
                    <li><a href="/users/register">Register</a></li>
                    <li>
                        <a href="javascript:void(0)" id="loginContainer">Login</a>
                        <div id="loginBox">
                            <form id="loginForm" method="POST" action="/users/login">
                                <fieldset id="body">
                                    <p style="text-align: center; color: #aa1111;">
                                        <?php
                                        if (isset($_SESSION["error"])) {
                                            foreach ($_SESSION["error"] as $error) {
                                                echo $error . "<br />";
                                            }
                                        }
                                        ?>
                                    </p>
                                    <fieldset>
                                        <label for="username">Username</label>
                                        <input type="text" name="username-login" id="username" value="<?php echo isset($_SESSION['input']['old_username']) ? $_SESSION['input']['old_username'] : null; ?>">
                                    </fieldset>
                                    <fieldset>
                                        <label for="password">Password</label>
                                        <input type="password" name="password-login" id="password" value="<?php echo isset($_SESSION['input']['old_password']) ? $_SESSION['input']['old_password'] : null; ?>">
                                    </fieldset>
                                    <input type="submit" id="login" name="btn-login" value="Sign in">
                                    <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember
                                            me</i></label>
                                </fieldset>
                                <strong style="display:block; text-align: center">OR</strong>
                                <button type="button" class="loginBtn loginBtn--google" onclick="window.location.href = '/users/loginGoogle' ">
                                    Login with Google
                                </button>
                                <span><a href="/users/reset">Forgot your password?</a></span>
                            </form>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
</header>

<!-- stacks-wrapper -->
<div class="stack-slider">
    <div class="stacks-wrapper">
    </div>
    <!-- /stacks-wrapper -->
</div>

<?php
unset($_SESSION["error"]);
unset($_SESSION["input"]);
?>
<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/flickity.pkgd.min.js"></script>
<script type="text/javascript" src="/js/smoothscroll.js"></script>
<script type="text/javascript" src="/js/modernizr.custom.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

</body>
</html>