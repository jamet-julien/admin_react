<?php

/*

//BULK
svg : 
name : 
slug : 
id : 

//DATA
array(
"svg" => "",
"name" => "",
"slug" => "",
"id" => "",
);
*/


class SousCategorie extends Acxiom{

	protected $_sTable        = 'sous_categorie';
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
	 * [critere description]
	 * @return [type] [description]
	 */
	public function critere(){

		$oLink      = new SousCategorieCritere();
		$aCritereId = $oLink->allData('critere_id', "sous_categorie_id='{$this->id}'");

		$oCritere   = new Critere();
		$aResult    = $oCritere->all( "id IN('".implode("','", $aCritereId)."') ORDER BY name ASC");

		return $aResult;
	}

    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
                    "svg" => $this->svg,
                    "name"  => $this->name,
                    "slug"  => $this->slug,
                    "id"    => $this->id,
             ));
    }


}
