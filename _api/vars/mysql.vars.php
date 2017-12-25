<?php

if( strpos( $_SERVER['SERVER_NAME'], 'staging') !== false){
  define('MYSQL_HOST' , 'acxweb-stage.csgdzoghfbdz.us-east-1.rds.amazonaws.com');
  define('MYSQL_LOGIN', 'acxibd_user');
  define('MYSQL_PWD'  , 'PQ+d:m6vV5T9TTJgILmC');
  define('MYSQL_DB'   , 'acxibd_db');
}else{
  define('MYSQL_HOST' , 'acxweb-prod-test.csgdzoghfbdz.us-east-1.rds.amazonaws.com');
  define('MYSQL_LOGIN', 'acxibd_user');
  define('MYSQL_PWD'  , '5;860wo3vQU;8OL71ONv');
  define('MYSQL_DB'   , 'acxibd_db');
}
