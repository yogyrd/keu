<?php $this->load->helper('url');
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE html>

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <meta content="Keuangan" name="author">

    <meta name="viewport" content="user-scalable=yes, initial-scale=1, maximum-scale=3, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

    

    <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">

    <link href="<?= base_url(); ?>assets/js/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <link href="<?= base_url(); ?>assets/js/jquery_ui/jquery-ui.min.css" rel="stylesheet" type="text/css">

    

    <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/jquery_ui/jquery-ui.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/moment-with-locales.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/transition.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/collapse.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

    <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootbox.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/jquery/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/js/bootstrap/js/dataTables.bootstrap.js" type="text/javascript"></script>

    <link href="<?= base_url(); ?>assets/highcharts/css/highcharts.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url(); ?>assets/highcharts/js/highcharts.js"></script>
    <script src="<?= base_url(); ?>assets/highcharts/js/modules/exporting.js"></script>

    <link href="<?= base_url(); ?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="none" onload="if(media!='all')media='all'">

    

    <link href="<?= base_url(); ?>assets/css/all.css" rel="stylesheet" type="text/css">

    

    <?php

    

    $img_url = base_url() . 'assets/images/';

    

    if(isset($page_js)&&(!is_array($page_js))&&(trim($page_js) !== '')){

        $page_js = [$page_js];

    }

    

    if(!isset($page_js)){

        $page_js = [];

    }

    

    if(isset($page_css)&&(!is_array($page_css))&&(trim($page_css) !== '')){

        $page_css = [$page_css];

    } 

    

    if(!isset($page_css)) {

        $page_css = [];

    }

    ?>

    <?= $this->auth_login->cek_login(); ?>

    

    <?php foreach($page_css as $css_file){ ?>

        <link href="<?= base_url(); ?>assets/css/<?= $css_file; ?>" rel="stylesheet" type="text/css">

    <?php } ?>

    

    <?php foreach($page_js as $js_file){ ?>

        <script src="<?= base_url(); ?>assets/js/<?= $js_file; ?>" type="text/javascript"></script>

    <?php } ?>



    <title>Keuangan || Mitra Medicare</title>

    <!-- <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.ico" type="image/x-icon" /> -->

</head>

<body>

    <div id="container">

            <div id="header">



            </div>

