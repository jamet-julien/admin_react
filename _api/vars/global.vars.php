<?php
// CONSTANT
$bPortNeed = true;
define('HTTP_DOMAIN', 	'http://' . $_SERVER['SERVER_NAME']);

if( strpos( $_SERVER['SERVER_NAME'], 'opes.byarmstrong') !== false){
  $bPortNeed = false;
  define('PATH_ROOT'  ,		'/acxiom/site/');
  define('SPACE', "DEV");
} else if( strpos( $_SERVER['SERVER_NAME'], 'localhost') !== false){

  define('PATH_ROOT'  ,		'/00-commande/acxiom/_site/');
  define('SPACE', "LOCAL");
} else {
  define('PATH_ROOT'  ,		'//');
  define('SPACE', "PROD");
}

define('DEBUG_ACTIVE',	true);

$sPort = '';

if( $bPortNeed && isset( $_SERVER['SERVER_PORT']) && trim( $_SERVER['SERVER_PORT']) != ''){
  $sPort = ':'.$_SERVER['SERVER_PORT'];
}

// VAR
define('HTTP_ROOT'   ,	HTTP_DOMAIN . $sPort. PATH_ROOT);
define('HTTP_MEDIA'  ,	HTTP_ROOT   . 'tmp/');
define('SERVER_TMP'  , __DIR__   . '/../../_public/tmp/');


if( SPACE == "LOCAL"){
  define( 'SECRET_KEY'     , pack('H*', "Abe0eb9e114a0cd8b54763051cef08bc55abe029fdebae6e1d418e3ffb2a11a3"));
  define( 'SECRET_VECTEUR' , "CJYCb05vJgDhuWKWBtKY6gkzfP4RsLCy2dy1LNBwMZc=");
}else{
  define( 'SECRET_KEY'     , pack('H*', getenv('SECRET_KEY')));
  define( 'SECRET_VECTEUR' , getenv('SECRET_VECTEUR'));

}
