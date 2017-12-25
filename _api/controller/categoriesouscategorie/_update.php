<?php
parse_str( file_get_contents( 'php://input') ,$aPUT);
$bValid  = true;
$sClass  = 'CategorieSousCategorie';
$oParent = new CategorieSousCategorie();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/

$aDefault = array(
        "sous_categorie_id",
         "categorie_id",
         "id",
     );

$aFilter = array(
        "sous_categorie_id" => $_FILTER_STRING,
         "categorie_id" => $_FILTER_STRING,
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
