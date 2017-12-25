<?php

/*

//BULK
svg : 
name : 
slug : 

//DATA
array(
"svg" => "",
"name" => "",
"slug" => "",
);
*/


class Categorie extends Acxiom{

	protected $_sTable        = 'categorie';
	protected $_sReferer      = 'id';

	/**
	 * [_treatInput traitement avant enregistrement dans la base]
	 * @param  $_aData [description]
	 * @return [type]         [description]
	 */
	protected function _treatInputInsert( $_aData){

			$_aData           = parent::_treatInputInsert( $_aData);

		return $_aData;

	}

	/**
	 * [critere description]
	 * @return [type] [description]
	 */
	public function critere(){

		$oLink      = new CategorieCritere();
		$aCritereId = $oLink->allData('critere_id', "categorie_id='{$this->id}'");

		$oCritere   = new Critere();
		$aResult    = $oCritere->all( "id IN('".implode("','", $aCritereId)."') ORDER BY name ASC");

		return $aResult;
	}

	/**
	 * [sousCategorie description]
	 * @return [type] [description]
	 */
	public function sousCategorie(){

		$oLink            = new CategorieSousCategorie();
		$aSousCategorieId = $oLink->allData('sous_categorie_id', "categorie_id='{$this->id}'");

		$oSousCategorie   = new SousCategorie();
		$aResult          = $oSousCategorie->all( "id IN('".implode("','", $aSousCategorieId)."') ORDER BY name ASC");

		return $aResult;
	}

    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
										 "id"    => $this->id,
                     "svg" => $this->svg,
                     "name"  => $this->name,
                     "slug"  => $this->slug,
             ));
    }


}
