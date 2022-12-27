<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">        
        <title><?php echo SITE_NAME; ?></title>
        <link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>app-assets/images/ico/apple-icon-120.html">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/components.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/pages/authentication.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/extensions/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/plugins/extensions/ext-component-toastr.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css">
    </head>

    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
        <input type="hidden" id="geturl" class="geturl" value="<?php echo BASE_URL; ?>">
        <input type="hidden" id="directory" class="directory" value="<?php echo $directory; ?>">
        <input type="hidden" id="cntrl" class="cntrl" value="<?php echo $cntrl; ?>">
        <input type="hidden" id="func" class="func" value="<?php echo $func; ?>">