<?php
$oAdmin      = new Admin();
$_bConnected = false;
$oUser       = false;

if( isset( $_SESSION['token']) && trim( $_SESSION['token']) != ''){
  $_bConnected = $oAdmin->testToken( $_SESSION['token'], $oUser);
}

if(
    (isset($_POST['login']) && trim( $_POST['login']) != '') &&
    (isset($_POST['password']) && trim( $_POST['password']) != '')
  ){

    if( $oAdmin->testLogin( $_POST['login'], $_POST['password'], $sToken)){
        $_SESSION['token'] = $sToken;   
    }
    
    header("Refresh:0");
    exit();    
  }
