<?php
parse_str( file_get_contents( 'php://input') ,$aPUT);
$bValid     = true;
$bTagAction = false;
$sClass  = 'Critere';
$oParent = new Critere();
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
         "facebook",
         "dbm",
         "definition",
         "name",
         "slug",
         "id",
     );

$aFilter = array(
        "svg"       => $_FILTER_STRING,
         "facebook"   => $_FILTER_STRING,
         "dbm"        => $_FILTER_STRING,
         "definition" => $_FILTER_STRING,
         "name"       => $_FILTER_STRING,
         "slug"       => $_FILTER_STRING,
         "id"         => $_FILTER_STRING,
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


  if( isset( $aTreat['data']['tag'])){
    $aTagPlain  = json_decode( $aTreat['data']['tag']);
    $bTagAction = true;
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

        /**
         * Undocumented function
         *
         * @param [type] $el
         * @return void
         */
        function getName( $el){
          return $el->name;
        }

        /**
         * Undocumented function
         *
         * @param [type] $el
         * @return void
         */
        function getNew( $el){
          return ($el->id == 0);
        }

        if($bTagAction){

          $aAdd    = [];
          $aDelete = [];
          
          $aInput = $aTagPlain;
          $aBase  = $oModel->tagsName;
         
          $aAdd    = array_diff( $aTagPlain, $aBase);
          $aDelete = array_diff( $aBase, $aTagPlain);
          
          $oModel->addTags( $aAdd)
                  ->deleteTags( $aDelete);

        }
        $a_Result['code']        = 1;
        $a_Result['message']     = 'success';
        $a_Result['data']        = $oModel->resume;
        $a_Result['data']['tag'] = $aInput;


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
