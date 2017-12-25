<?php

parse_str( file_get_contents( 'php://input'), $aDelete);
$sClass  = 'PersonicxComportement';
$oParent = new PersonicxComportement();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/


$aDefault = array(
        "id" => "",
         "personicx_id" => "",
         "comportement_id" => "",
     );

$aMandatory = array(
        "id" => true,
         "personicx_id" => true,
         "comportement_id" => true,
     );

$aFilter = array(
        "id" => $_FILTER_STRING,
         "personicx_id" => $_FILTER_STRING,
         "comportement_id" => $_FILTER_STRING,
     );



/***********************************************
  _____ ___ _   _____ _____ ____
 |  ___|_ _| | |_   _| ____|  _ \
 | |_   | || |   | | |  _| | |_) |
 |  _|  | || |___| | | |___|  _ <
 |_|   |___|_____|_| |_____|_| \_\
 ***********************************************/
 if( count( $a_Query)&& in_array( 'ref', array_keys( $aDelete))){







  $sSerial  = array_shift( $a_Query);
  $oModel   = new $sClass( $sSerial, $aDelete['ref']);
/***********************************************
  ____  _____ _     _____ _____ _____
 |  _ \| ____| |   | ____|_   _| ____|
 | | | |  _| | |   |  _|   | | |  _|
 | |_| | |___| |___| |___  | | | |___
 |____/|_____|_____|_____| |_| |_____|
 ***********************************************/

  if( $oModel->isExist){

    $oModel->delete();
    $a_Result['code']    = 1;
    $a_Result['message'] = 'success';

  }else{
    $a_Result['message'] = 'Instance doesn\'t exist';
  }

}else{
  $a_Result['message'] = 'error identifiant needed';
}
