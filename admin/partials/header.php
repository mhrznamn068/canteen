<?php

    if(!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin']==false){
        header("location:".base_url()."login.php");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Canteen Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>themes/3rdparty/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>themes/3rdparty/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>themes//css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>themes/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>themes/3rdparty/morrisjs/morris.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>themes/3rdparty/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>themes/3rdparty/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>themes/3rdparty/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>themes/3rdparty/jquery/dist/jquery.min.js"></script>
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>



<body>
    
