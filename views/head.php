<!DOCTYPE HTML>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-gb" class="no-js">
<!--<![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>
        <?php

            if(isset($_GET['page'])){
                $page = $_GET['page'];
                switch ($page){
                case "home":
                    echo 'RHPS-News | Home';
                    break;
                    case "contact":
                        echo 'RHPS-News | Contact';
                        break;
                    case "author":
                        echo 'RHPS-News | Author';
                        break;
                    case "post":
                        echo 'RHPS-News | Post';
                        break;
                    case "all-posts":
                        echo 'RHPS-News | All News';
                        break;
                    case "about":
                        echo 'RHPS-News | About';
                        break;
                    case "registration":
                        echo 'RHPS-News | Registration';
                        break;
                    default:
                        echo 'RHPS-News | home';
                        break;
            }
            }
        ?>
    </title>
    <meta name="description" content="">
    <meta name="author" content="Marko Radivojevic">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
    <![endif]-->
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    <!-- Animation -->
    <link rel="stylesheet" href="css/style-animate.css"  type="text/css"/>
    <!-- Font Awesome -->
    <link href="font/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <!--Slider CSS-->
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <!--Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/custom.css">

</head>

<body>
