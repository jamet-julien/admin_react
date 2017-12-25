<?php


$bPortNeed = true;
$protocol  = strtolower( substr( $_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ?'https':'http';

define('HTTP_DOMAIN', 	$protocol . '://' . $_SERVER['SERVER_NAME']);

if( strpos( $_SERVER['SERVER_NAME'], 'opes.byarmstrong') !== false){

  define('PATH_ROOT'  ,		'/acxiom/site/');
  $bPortNeed = false;
  define('SPACE', "DEV");

} else if( strpos( $_SERVER['SERVER_NAME'], 'localhost') !== false){

  define('PATH_ROOT'  ,		'/00-commande/acxiom/_site/');
  define('SPACE', "LOCAL");

} else {

  define('PATH_ROOT'  ,		'/');
  $bPortNeed = false;
  define('SPACE', "PROD");

}


$sPort = '';

if( $bPortNeed && isset( $_SERVER['SERVER_PORT']) && trim( $_SERVER['SERVER_PORT']) != ''){
  $sPort = ':'.$_SERVER['SERVER_PORT'];
}

// VAR
define('HTTP_ROOT'   ,	HTTP_DOMAIN .$sPort. PATH_ROOT.'admin');
define('HTTP_TMP'    ,	HTTP_ROOT . '_tmp/');
define('HTTP_MEDIA'  ,	HTTP_ROOT . 'media/');
