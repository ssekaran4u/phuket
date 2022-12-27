<!DOCTYPE html>
<html class="loading light-layout" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
        <title><?php echo SITE_NAME; ?></title>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/charts/apexcharts.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/extensions/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/components.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/themes/dark-layout.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/themes/bordered-layout.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/themes/semi-dark-layout.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/pages/dashboard-ecommerce.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/plugins/charts/chart-apex.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/plugins/extensions/ext-component-toastr.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/pages/ui-feather.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>app-assets/vendors/css/forms/select/select2.min.css">

        <!-- Icons -->
        <link href="<?php echo BASE_URL; ?>app-assets/fonts/simple-line-icons/style.min.css" rel="stylesheet" type="text/css">
    </head>
    <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
        <input type="hidden" id="geturl" class="geturl" value="<?php echo BASE_URL; ?>">
        <input type="hidden" id="directory" class="directory" value="<?php echo $directory; ?>">
        <input type="hidden" id="cntrl" class="cntrl" value="<?php echo $cntrl; ?>">
        <input type="hidden" id="func" class="func" value="<?php echo $func; ?>">
        <input type="hidden" id="page_type" class="page_type" value="list">
        <input type="hidden" id="load_data" class="load_data" value="">