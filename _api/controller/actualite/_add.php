<?php

$bValid  = true;
$aPost   = filter_input_array( INPUT_POST);
$sClass  = 'Actualite';
$oParent = new Actualite();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/


$aDefault = array(
        "id"            => "",
        "name"         => "",
        "label"         => "",
        "content"       => "",
        "content_suite" => "",
        "image"         => "",
        "source_image"  => "",
        "date"          => date('Y-m-d H:i:s'),
     );

$aMandatory = array(
        "name"         => true,
        "label"         => true,
        "content"       => true,
        "image"         => true,
     );

$aFilter = array(
         "name"         => $_FILTER_STRING,
         "label"         => $_FILTER_STRING,
         "content"       => $_FILTER_STRING,
         "content_suite" => $_FILTER_STRING,
         "image"         => $_FILTER_STRING,
         "source_image"  => $_FILTER_STRING,
         "date"          => $_FILTER_STRING,
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

    $aFieldImg = ['image'];

    foreach ( $aFieldImg as $sField) {
      if( isset( $aTreat['data'][$sField] ) && trim( $aTreat['data'][$sField]) != ''){
        $aTreat['data'][$sField] = base64ToImg( $aTreat['data'][$sField] ,
                                                toSlug( 'actu-'.$sField.'-'.$aTreat['data']['name'])
                                              );
      }
    }

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
