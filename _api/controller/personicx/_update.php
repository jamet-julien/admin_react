<?php
parse_str( file_get_contents( 'php://input') ,$aPUT);
$bValid  = true;
$sClass  = 'Personicx';
$oParent = new Personicx();
$aError  = [];


/***********************************************
 __     ___    ____
 \ \   / / \  |  _ \
  \ \ / / _ \ | |_) |
   \ V / ___ \|  _ <
    \_/_/   \_\_| \_\
***********************************************/

$aDefault = array(
        "couple",
         "famille",
         "revenus_faibles",
         "revenus_moyens",
         "45_60",
         "revenus_tres_eleves",
         "urbain",
         "periurbain",
         "campagne",
         "revenus_eleves",
         "id",
         "slug",
         "code",
         "moins_de_30",
         "30_45",
         "senior",
         "celibat",
         "name",
         "descriptif",
         "segment",
         "richesse",
         "age",
         "image",
         "pictos",
     );

$aFilter = array(
        "couple"              => $_FILTER_STRING,
        "famille"             => $_FILTER_STRING,
        "revenus_faibles"     => $_FILTER_STRING,
        "revenus_moyens"      => $_FILTER_STRING,
        "45_60"               => $_FILTER_STRING,
        "revenus_tres_eleves" => $_FILTER_STRING,
        "urbain"              => $_FILTER_STRING,
        "periurbain"          => $_FILTER_STRING,
        "campagne"            => $_FILTER_STRING,
        "revenus_eleves"      => $_FILTER_STRING,
        "id"                  => $_FILTER_STRING,
        "slug"                => $_FILTER_STRING,
        "code"                => $_FILTER_STRING,
        "moins_de_30"         => $_FILTER_STRING,
        "30_45"               => $_FILTER_STRING,
        "senior"              => $_FILTER_STRING,
        "celibat"             => $_FILTER_STRING,
        "name"                => $_FILTER_STRING,
        "descriptif"          => $_FILTER_STRING,
        "segment"             => $_FILTER_STRING,
        "richesse"            => $_FILTER_STRING,
        "age"                 => $_FILTER_STRING,
        "image"               => $_FILTER_STRING,
        "pictos"              => $_FILTER_STRING,
     );



/***********************************************
  _____ ___ _   _____ _____ ____
 |  ___|_ _| | |_   _| ____|  _ \
 | |_   | || |   | | |  _| | |_) |
 |  _|  | || |___| | | |___|  _ <
 |_|   |___|_____|_| |_____|_| \_\
 ***********************************************/
 if( count( $a_Query)){

  $aTreat   = treatPost( $aPUT, $aFilter);

  $sSerial  = array_shift( $a_Query);
  $oModel   = new $sClass( $sSerial);

  if( 
      $oModel->slug != toSlug( $aTreat['data']['name']) &&
      $oParent->slugExist( $aTreat['data']['name'])
    ){
        
    $bValid               = false;
    $aMandatory[ 'name' ] = false;
    $aError[]             = "slug exist => {$aTreat['data']['name']}";
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

        $aFieldImg = ['image'];

        foreach ( $aFieldImg as $sField) {
          if( isset( $aTreat['data'][$sField] ) && trim( $aTreat['data'][$sField]) != ''){
            $aTreat['data'][$sField] = base64ToImg( $aTreat['data'][$sField] ,
                                                    toSlug( 'perso-'.$sField.'-'.$aTreat['data']['name'])
                                                  );
          }
        }

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
