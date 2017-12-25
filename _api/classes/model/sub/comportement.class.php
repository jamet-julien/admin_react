<?php

/*
//DATA
array(
 
        "id" => "",
  
        "slug" => "",
  
        "name" => "",
  
        "svg" => "",
  
        "categorie" => "",

        "catsvg" => "",
     );
*/


class Comportement extends Acxiom{

	protected $_sTable        = 'comportement';
	protected $_sReferer      = 'id';

	/**
	 * [_treatInput traitement avant enregistrement dans la base]
	 * @param  $_aData [description]
	 * @return [type]         [description]
	 */
	protected function _treatInputInsert( $_aData){

			$_aData['id']     = '';
			$_aData           = parent::_treatInputInsert( $_aData);

		return $_aData;

	}

    /**
     * 
     */
    function volumeEstimate( $sSelection){
        $oPersonicx = new Personicx();
        $oLink      = new PersonicxComportement();
        $aPersonicxIntersect = "";

        $sWhere = "1";
        $aData = json_decode( $sSelection, true);

        if( $aData){
            $aComportement = $this->all('slug in ("'.implode('","',array_keys($aData)).'")');
            foreach($aComportement as $oComportement){
                $aPersonicxId = $oLink->allData('personicx_id', "comportement_id='{$oComportement->id}'");
                if($aPersonicxIntersect == ""){
                    $aPersonicxIntersect = $aPersonicxId;
                } else {
                    $aPersonicxIntersect = array_intersect($aPersonicxIntersect, $aPersonicxId);
                }
            }
            if(!empty($aPersonicxIntersect)){
                $sWhere = "id in (".implode(",",$aPersonicxIntersect).")";
                $volume = $oPersonicx->sum('segment', $sWhere);
            } else {
                $volume[0] = 0;
            }
            $volumeTotal = $oPersonicx->sum('segment');
            $percent = round( (intval($volume[0])*100/intval($volumeTotal[0])), 1);

            $volumeSend = round( ($volume[0]/1000000), 1)."M pers";
            if($volumeSend == "0M pers"){
                $volumeSend = round( ($volume[0]/1000), 1)."K pers";
                if($volumeSend == "0K pers"){
                    $volumeSend = $volume[0]." pers";
                }
            }
            return ["volume" => $volumeSend, "percent" => $percent."%"];
        } else {
            return ["volume" => "0M pers", "percent" => "0%"];
        }
    }

    /**
     * [tags description]
     * @return [type] [description]
     */
    function personicx(){

        $oLink        = new PersonicxComportement();
        $aPersonicxId = $oLink->allData('personicx_id', "comportement_id='{$this->id}'");

        $oPersonicx = new Personicx();
        $aResult    = $oPersonicx->all( "id IN('".implode("','", $aPersonicxId)."') ORDER BY slug ASC");

        return $aResult;
    }

	
    /**
     * 
     */
    function quantity(){
        $qty = 0;
        foreach($this->personicx as $oPersonicx){
            $qty += intval($oPersonicx->segment);
        }

        $qtySend = round( ($qty/1000000), 1)."M pers";

        return $qtySend;
    }

    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
                    "id" => $this->id,
                     "slug" => $this->slug,
                     "name" => $this->name,
                     "svg" => $this->svg,
                     "categorie" => $this->categorie,
                     "catsvg" => $this->catsvg,
             ));
    }


}
