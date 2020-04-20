<?php
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}

$currentPage = basename($_SERVER['SCRIPT_FILENAME'], ".php");


 ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tastepad</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Manrope&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include "include/form/login-form.php"; ?>
    <div class="wrapper">
      <header>
        <div class="lo-search">
          <div class="logo">
            Tastepad
          </div>
          <div class="search-bar-div">
            <form class="search-bar" action="index.html" method="post">
              <img class="icon" src="img/icon/icons8-search-192.png" alt="">
              <input type="text" name="" value="" placeholder="I want to search for...">
            </form>
          </div>
        </div>
        <div class="login">
          <button type="button" name="button" class="login-btn button" id="form-btn">Login</button>
        </div>
      </header>
