<?php

$bValid  = true;
$aPost   = filter_input_array( INPUT_POST);
$sClass  = 'CategorieCritere';
$oParent = new CategorieCritere();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/


$aDefault = array(
        "critere_id" => "",
         "categorie_id" => "",
         "id" => "",
     );

$aMandatory = array(
        "critere_id"   => true,
        "categorie_id" => true,
     );

$aFilter = array(
        "critere_id"   => $_FILTER_STRING,
        "categorie_id" => $_FILTER_STRING,
     );



/***********************************************
  _____ ___ _   _____ _____ ____
 |  ___|_ _| | |_   _| ____|  _ \
 | |_   | || |   | | |  _| | |_) |
 |  _|  | || |___| | | |___|  _ <
 |_|   |___|_____|_| |_____|_| \_\
 ***********************************************/

if( count( $aPost)){

  $aPOST  = array_merge( $aDefault, $aPost);
  $aTreat = treatPost( $aPOST, $aFilter);

  



  // Mandatory OK ?
  foreach( $aMandatory as $sName => $bValue){
       if( in_array( $sName, $aTreat['error']) && !in_array( $sName, $aError)){
               $bValid               = false;
               $aMandatory[ $sName ] = false;
               $aError[]             = $sName;
       }
  }

/***********************************************
   ____ ____  _____    _  _____ _____
  / ___|  _ \| ____|  / \|_   _| ____|
 | |   | |_) |  _|   / _ \ | | |  _|
 | |___|  _ <| |___ / ___ \| | | |___
  \____|_| \_\_____/_/   \_\_| |_____|
***********************************************/

  if( $bValid){

    $oModel  = new $sClass( $aTreat['data']);

    if( trim( $oModel->id) != '0'){

      $a_Result['code']    = 1;
      $a_Result['message'] = 'success';
      $a_Result['data']    = $oModel->resume;

    }else{
      $a_Result['message'] = 'Instance doesn\'t create';
    }

  }else{

    $a_Result['message'] = 'error data';
    $a_Result['error']   = $aError;

  }

}else{
  $a_Result['message'] = 'error data needed';
}
