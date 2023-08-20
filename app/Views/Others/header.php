<?php

use App\Models\SettingsModel;

$settingsModel = new SettingsModel();

$appName = $settingsModel->getAppName();

// $Appfine = $settingsModel->getAppfine();

// $fine = $Appfine['fine'];
// $fineStdDays = $Appfine['fine_std_days'];
// $fineStfDays = $Appfine['fine_stf_days'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title><?=$appName?></title>
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon/favicon.ico" type="image/x-icon">  

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/datatables/datatables.css" rel="stylesheet"/>

</head>

<body id="page-top">
