<?php
/*********************************************************************
iciwebface 
Шапка страницы
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/

?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Icinga2: Микроинтерфейс</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#263238">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Icinga2: Микроинтерфейс">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">


    <script data-require="jquery@2.1.1" data-semver="1.9.1" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/icinga-get-hosts.js"></script>
    <script src="js/icinga-check.js"></script>
    
    <link type="image/png" rel="shortcut icon" href="img/favicon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.css" />
    <script defer src="js/material.min.js"></script>

    <link rel="stylesheet" href="css/style.css">



  </head>
  <body>
    <div class="icinga2app-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100 mdl-layout--overlay-drawer-button">


      <div class="icinga2app-ribbon"></div>
      <main class="icinga2app-main mdl-layout__content">
        <div class="icinga2app-container mdl-grid">

