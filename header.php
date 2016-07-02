<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php echo buffpal('buffpal_web_description') ?>">
    <link id="favicon" href="<?php echo buffpal('buffpal_web_icon',get_template_directory_uri().'/img/icon.png') ?>" rel="icon" type="image/x-icon" />
    <title><?php echo buffpal('buffpal_web_name') ?> | <?php echo buffpal('buffpal_web_description') ?></title>
    <?php wp_head() ?>
    <style>
        #head{
            background-color: #30405B;
            position: relative;
            width: 100%;
            z-index: 9999;
        }
        #head-box{
            height:60px;
        }
        #buffpal_nav{
            width: 95%;
            height: 60px;
        }
        #buffpal_nav>li{
            height: 60px;
            float: left;
            text-align: center;
            line-height:60px;
            position: relative;
            transition: 1s;
            font-size: 14px;
        }
        #buffpal_nav>li:hover{
            background-color: rgba(0,0,0,.3);
        }
        #buffpal_nav>li a{
            padding:0 20px;
            width: 60px;
            display: block;
            transition:.5s;
            height: 100%;
            text-shadow: 0 0 1px #000;
        }
        #buffpal_nav>li .border{
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height:3px;
            background:radial-gradient(#00DBE7,#7DFFE9);
            z-index:20;
            transform-origin:center center;
            opacity:0;
            transform:scale(0,1);
            transition:transform .5s cubic-bezier(.7,.69,.49,1.31),opacity .8s;
        }
        #buffpal_nav>li:hover .border{
            opacity:1;
            transform: scale(1,1);
        }
        #buffpal_nav .sub-menu{
            position: absolute;
            left: 0;
            padding: 10px 0;
            top: 60px;
            background-color: #fff;
            border-bottom: 3px solid #6C778B;
            transform-origin:top;
            transform:scale(1,0);
            opacity:0;
            transition:transform .3s,opacity .4s;
            width: 140%;
        }
        #buffpal_nav .sub-menu .border{
            display: none;
        }
        #buffpal_nav li:hover .sub-menu{
            opacity:1;
            transform: scale(1,1);
            box-shadow: none;
        }
        #buffpal_nav .sub-menu>li{
            padding: 0;
            margin: 0;
            float: left;
            width: 100%;
            height: 20px;
            font-weight: 100;
            font-family:"Microsoft YaHei";
        }
        #buffpal_nav .sub-menu>li>a{
            padding:0 10px;
            text-align: left;
            height: 20px;
            line-height:20px;
            color: #888;
            text-shadow: none;
            transition:.5s;
        }
        #buffpal_nav .sub-menu>li>a:hover{
            color: #666;
        }
        #buffpal_nav li:hover .sub-menu .sub-menu{
            display: none;
        }
        nav{
            position: relative;
        }
        #search1{
            position: absolute;
            right:0;
            top: 15px;
            width: 34px;
            height: 34px;
            text-align: center;
            line-height:34px;
            background-color: #fff;
            color: #30405B;
            font-size: 23px;
            border-radius: 3px;
            cursor: pointer;
            transition:.4s;
        }
        #search1:hover{
            background-color: #30405B;
            color: #fff;
        }
        #search_hide{
            width: 285px;
            height: 30px;
            position: absolute;
            right: 0;
            top: 70px;
            display: none;
        }
        #search_hide input[type=text]{
            height: 35px;
            width: 280px;
            border:none;
            float: left;
            border-radius: 20px;
            text-indent:1rem;
            font-size: 18px;
            color: #444;
            transform-origin:right;
            opacity:0;
            transform:scale(0,1);
            transition:transform .5s ease-in-out,opacity .8s;
        }
        #search_hide input.show{
            opacity:1;
            transform:scale(1,1);
        }
        #search_hide button{
            width: 30px;
            border:none;
            height: 30px;
            font-size: 20px;
            text-align: center;
            color: #30405B;
            float: right;
            position: absolute;
            right: 10px;
            border-radius: 50%;
            top: 2px;
            background-color: #fff;
            box-shadow: 1px 1px 10px #aaa;
            cursor: pointer;
            transition:.4s;
            padding-bottom:5px;
        }
        #search_hide fieldset{
            border:none;
        }
        #search_hide button:hover{
            background-color: orangered;
            color: #fff;
        }
        #head .logo>a{
            display: block;
            position: relative;
            width: 210px;
            height: 60px;
            z-index: 5;
        }
    </style>
</head>
<body>
<header id="head">
    <div class="container" id="head-box">
        <aside class="logo fl">
            <?php
            $web_logo_url = '';
            if(empty($web_logo_url = buffpal('buffpal_web_logo'))):
                $web_logo_url = get_template_directory_uri().'/img/logo.png';
            endif;
            ?>
            <a href="<?php echo home_url() ?>" title="<?php echo buffpal('buffpal_web_name') ?>">
                <img src="<?php echo $web_logo_url ?>" title="<?php echo buffpal('buffpal_web_name') ?>" width="210" height="60">
            </a>
        </aside>
        <nav>
            <?php wp_nav_menu(
                //;
                array(
                    'menu_id' => 'buffpal_nav',
                    'after' => '<div class="border"></div>'
                )
            ) ?>
            <div id="search1">
                <i class="fa fa-search"></i>
            </div>
            <div id="search_hide">
                <?php get_search_form( true ) ?>
            </div>
        </nav>
    </div>
</header>

