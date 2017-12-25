<?php

$bValid  = true;
$aPost   = filter_input_array( INPUT_POST);
$sClass  = 'SocioDemographique';
$oParent = new SocioDemographique();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/


$aDefault = array(
        "IBE_CPG_PET_DOGO" => "",
         "IBE_CPG_PET_CATO" => "",
         "Number_People" => "",
         "Housing_2" => "",
         "Housing_1" => "",
         "Number_Children" => "",
         "Presence_Children" => "",
         "Marital_Status" => "",
         "TR_age_OCR" => "",
         "cpt_indiv" => "",
         "id" => "",
         "Gender" => "",
         "Annual_Income" => "",
     );

$aMandatory = array(
        "IBE_CPG_PET_DOGO" => true,
         "IBE_CPG_PET_CATO" => true,
         "Number_People" => true,
         "Housing_2" => true,
         "Housing_1" => true,
         "Number_Children" => true,
         "Presence_Children" => true,
         "Marital_Status" => true,
         "TR_age_OCR" => true,
         "cpt_indiv" => true,
         "Gender" => true,
         "Annual_Income" => true,
     );

$aFilter = array(
        "IBE_CPG_PET_DOGO" => $_FILTER_STRING,
         "IBE_CPG_PET_CATO" => $_FILTER_STRING,
         "Number_People" => $_FILTER_STRING,
         "Housing_2" => $_FILTER_STRING,
         "Housing_1" => $_FILTER_STRING,
         "Number_Children" => $_FILTER_STRING,
         "Presence_Children" => $_FILTER_STRING,
         "Marital_Status" => $_FILTER_STRING,
         "TR_age_OCR" => $_FILTER_STRING,
         "cpt_indiv" => $_FILTER_STRING,
         "Gender" => $_FILTER_STRING,
         "Annual_Income" => $_FILTER_STRING,
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
