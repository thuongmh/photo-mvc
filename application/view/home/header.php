<?php
//echo "<pre>";
//var_dump($check_album)
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/jquery.filer.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css">

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!--js-->
    <script type="text/javascript" src="/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/jquery.filer.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/custom.js"></script>
    <script type="text/javascript" src="/plugins/fancybox/jquery.fancybox.pack.js"></script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.jquery.min.js"></script>
    <script src="/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <!--animation-->
    <link href="/css/animate.min.css" rel="stylesheet">
    <script src="/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body>
<input type="hidden" class="pagenum" value="1">
<header class="container-fluid">
    <div class="row menu-header menu-desktop">
        <div class="header-left col-xs">
            <h1 class="logo"><span class="fa fa-tumblr" style="font-size: 35px; color: white"></span></h1>
            <form class="form-group search-form">
                <input type="text" class="form-control search-control aa-input-search" placeholder="Search">
            </form>
        </div>
        <div class="header-right">

            <div class="menu-right">
                <ul>
                    <li><a href="/users/logout" id="btn-logout"><i class="fa fa-power-off" aria-hidden="true"></i></i>
                        </a></li>
                    <li>
                        <a class="user"><i class="fa fa-user"></i></a>
                        <div id="user-profile">
                            <ul>
                                <li>
                                    <div class="title-profile"  style="font-size: 15px; font-weight: 700"><?php echo $_SESSION["username"] ?></div>
                                </li>
                                <li>
                                    <a href="/users">Profile</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a><i class="fa fa-smile-o"></i></a></li>
                    <li><a><i class="fa fa-envelope "></i></a></li>
                    <li><a><i class="fa fa-home"></i></a></li>
                    <li>
                        <button class="btn btn-info"><span class="fa fa-pencil" style="font-size: 25px"></span></button>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="row menu-mobile">
        <div class="mobile-logo">
            <span class="fa fa-tumblr fa-2x"></span>
        </div>
        <div class="menu-mobile-right">
            <ul>
                <li id="search-mobile"><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="/users/logout" id="btn-logout"><i class="fa fa-power-off" aria-hidden="true"></i></i>
                    </a></li>
                <li>
                    <a class="user"><i class="fa fa-user"></i></a>
                </li>
                <li><a><i class="fa fa-home"></i></a></li>
                <form class="form-inline search-mobile-div">
                    <div class=" input-group wow fadeInRight  " data-wow-duration="1s" data-wow-delay="0.3s">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</header>

<style>
    .aa-input-container {
        display: inline-block;
        position: relative;
    }

    /*.aa-input-search {*/
        /*width: 300px;*/
        /*padding: 12px 28px 12px 12px;*/
        /*border: 2px solid #e4e4e4;*/
        /*border-radius: 4px;*/
        /*-webkit-transition: .2s;*/
        /*transition: .2s;*/
        /*font-family: "Montserrat", sans-serif;*/
        /*box-shadow: 4px 4px 0 rgba(241, 241, 241, 0.35);*/
        /*font-size: 11px;*/
        /*box-sizing: border-box;*/
        /*color: #333;*/
        /*-webkit-appearance: none;*/
        /*-moz-appearance: none;*/
        /*appearance: none;*/
    /*}*/

    .aa-input-search::-webkit-search-decoration, .aa-input-search::-webkit-search-cancel-button, .aa-input-search::-webkit-search-results-button, .aa-input-search::-webkit-search-results-decoration {
        display: none;
    }

    .aa-input-search:focus {
        outline: 0;
        border-color: #3a96cf;
        box-shadow: 4px 4px 0 rgba(58, 150, 207, 0.1);
    }

    .aa-input-icon {
        height: 16px;
        width: 16px;
        position: absolute;
        top: 50%;
        right: 16px;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        fill: #e4e4e4;
    }

    .aa-hint {
        color: #e4e4e4;
    }

    .aa-dropdown-menu {
        background-color: #fff;
        border: 2px solid rgba(228, 228, 228, 0.6);
        border-top-width: 1px;
        width: 100%;
        margin-top: 10px;
        /*box-shadow: 4px 4px 0 rgba(241, 241, 241, 0.35);*/
        font-size: 11px;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .aa-suggestion {
        padding: 12px;
        border-top: 1px solid rgba(228, 228, 228, 0.6);
        cursor: pointer;
        -webkit-transition: .2s;
        transition: .2s;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .aa-suggestions-category {
        text-transform: uppercase;
        border-bottom: 3px solid rgba(228, 228, 228, 0.6);
        border-top: 3px solid rgba(228, 228, 228, 0.6);
        padding: 6px 12px;
        color: #a9a9a9;
    }

    .aa-suggestion:hover, .aa-suggestion.aa-cursor {
        background-color: rgba(241, 241, 241, 0.35);
    }

    .aa-suggestion > span:first-child {
        color: #333;
    }

    .aa-suggestion > span:last-child {
        text-transform: uppercase;
        color: #a9a9a9;
    }

    .aa-suggestion > span:first-child em, .aa-suggestion > span:last-child em {
        font-weight: 700;
        font-style: normal;
        background-color: #36465d;
        color: #fff;
        padding: 2px 0 2px 2px;
    }
</style>

<script>
    var client = algoliasearch("ML9F9II7WZ", "c061ab1a7ddea2708ba0c12ff53215fe");
    var users = client.initIndex('users');
    var albums = client.initIndex('albums');
    //initialize autocomplete on search input (ID selector must match)
    $('.aa-input-search').autocomplete(
        {hint: false}, [
            {
                source: $.fn.autocomplete.sources.hits(users, {hitsPerPage: 3}),
                //value to be displayed in input control after user's suggestion selection
                displayKey: 'name',
                //hash of templates used when rendering dataset
                templates: {
                    header: '<div class="aa-suggestions-category">Users</div>',
                    //'suggestion' templating function used to render a single suggestion
                    suggestion: function (suggestion) {
                        return '<span>' +
                            '<img src="' + suggestion.avatar + '" style="width: 40px; height: auto">' + '</span><span>' +
                            suggestion._highlightResult.username.value + '</span><span>' +
                            suggestion._highlightResult.email.value + '</span><span>' +
                            suggestion._highlightResult.fullname.value + '</span>';
                    }
                }
            },
            {
                source: $.fn.autocomplete.sources.hits(albums, {hitsPerPage: 3}),
                //value to be displayed in input control after user's suggestion selection
                displayKey: 'name',
                //hash of templates used when rendering dataset
                templates: {
                    header: '<div class="aa-suggestions-category">Albums</div>',
                    //'suggestion' templating function used to render a single suggestion
                    suggestion: function (suggestion) {
                        return '<span>' +
                            suggestion._highlightResult.caption.value + '</span><span>' +
                            suggestion._highlightResult.content.value + '</span><span>' +
                            suggestion._highlightResult.content_type.value + '</span>';
                    }
                }
            }
        ]);

</script>