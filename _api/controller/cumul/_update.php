<?php
parse_str( file_get_contents( 'php://input') ,$aPUT);
$bValid  = true;
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
        "IBE_CPG_PET_DOGO",
         "IBE_CPG_PET_CATO",
         "Number_People",
         "Housing_2",
         "Housing_1",
         "Number_Children",
         "Presence_Children",
         "Marital_Status",
         "TR_age_OCR",
         "cpt_indiv",
         "id",
         "Gender",
         "Annual_Income",
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
         "id" => $_FILTER_STRING,
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
