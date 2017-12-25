<?php
session_start();

// utils
require_once __DIR__ . '/../_api/classes/utils.php' ;

// mysql
require_once __DIR__ . '/../_api/vars/mysql.vars.php' ;
if( MYSQL_DB !== '') $oDAO = new DAO();

//init
require_once __DIR__ . '/ctrl/_connection.php' ;
require_once __DIR__ . '/ctrl/_init_var.php' ;
require_once __DIR__ . '/vars/global.php' ;


if( array_key_exists('logout', $_GET)){
    $_SESSION['token'] = '';
    header("Location: ".HTTP_ROOT."/");
    exit();

}


// locales
require_once __DIR__ . '/locales/fr_FR/trad.php' ;
require_once __DIR__ . '/locales/fr_FR/configuration.php' ;

$aControler = array(
    'root'    => __DIR__,
    'folder'  => 'ctrl',
    'ctrl'    => '404.php',
);

if(
    isset( $aModule[ $sUri ]) &&
    isset( $aModule[ $sUri ]['controller'])
  ){
    $aControler['ctrl'] = $aModule[ $sUri ]['controller'];
}


$_file = implode( '/', $aControler);
if( is_file( $_file)) require_once( $_file );
unset($_file);


require_once( __DIR__ . '/view/template/core.phtml');
