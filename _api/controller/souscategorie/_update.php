<?php
parse_str( file_get_contents( 'php://input') ,$aPUT);
$bValid  = true;
$sClass  = 'SousCategorie';
$oParent = new SousCategorie();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/

$aDefault = array(
        "svg",
         "name",
         "slug",
         "id",
     );

$aFilter = array(
        "svg" => $_FILTER_STRING,
         "name" => $_FILTER_STRING,
         "slug" => $_FILTER_STRING,
         "id" => $_FILTER_STRING,
     );



/***********************************************
  _____ ___ _   _____ _____ ____
 |  ___|_ _| | |_   _| ____|  _ \
 | |_   | || |   | | |  _| | |_) |
 |  _|  | || |___| | | |___|  _ <
 |_|   |___|_____|_| |_____|_| \_\
 ***********************************************/
 if( count( $a_Query)){

  $aTreat = treatPost( $aPUT, $aFilter);

  $sSerial  = array_shift( $a_Query);
  $oModel   = new $sClass( $sSerial);

  if( $oModel->slug != toSlug( $aTreat['data']['name']) &&
      $oParent->slugExist( $aTreat['data']['name'])){
    $bValid               = false;
    $aMandatory[ 'name' ] = false;
    $aError[]             = 'exist';
  }
/***********************************************
  _   _ ____  ____    _  _____ _____
 | | | |  _ \|  _ \  / \|_   _| ____|
 | | | | |_) | | | |/ _ \ | | |  _|
 | |_| |  __/| |_| / ___ \| | | |___
  \___/|_|   |____/_/   \_\_| |_____|
***********************************************/
  if(  $bValid){

      if($oModel->isExist){

        $bUpdated = false;

        foreach ( $aTreat['data'] as $sKey => $sValue) {
          if( !in_array( $sKey, $aTreat['error']) && in_array( $sKey, $aDefault)){
            $bUpdated  = true;
            $oModel->$sKey = $sValue;
          }
        }

        if( $bUpdated){
          $oModel->save();
        }

        $a_Result['code']    = 1;
        $a_Result['message'] = 'success';
        $a_Result['data']    = $oModel->resume;


      }else{
        $a_Result['message'] = 'Instance doesn\'t exist';
      }
  }else{
    $a_Result['message'] = 'error data';
    $a_Result['error']   = $aError;
  }


}else{
  $a_Result['message'] = 'error identifiant needed';
}
