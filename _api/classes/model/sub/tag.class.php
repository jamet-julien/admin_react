<?php

/*

//BULK
id : 
slug : 
name : 

//DATA
array(
"id" => "",
"slug" => "",
"name" => "",
);
*/


class Tag extends Acxiom{

	protected $_sTable        = 'tag';
	protected $_sReferer      = 'id';

	/**
	 * [_treatInput traitement avant enregistrement dans la base]
	 * @param  $_aData [description]
	 * @return [type]         [description]
	 */
	protected function _treatInputInsert( $_aData){

		if( $this->slugExist( $_aData['name'])){

			$oTag = new Tag( toSlug( $_aData['name']), 'slug');
			$this->setData( $oTag->getData());

			return array();
		}else{

			$_aData['id']     = '';
			$_aData['slug']   = toSlug( $_aData['name']);
			$_aData           = parent::_treatInputInsert( $_aData);

			return $_aData;

		}
	}

	/********
	 * 
	 ********/
	public function slugExist( $sString){
		$sString = toSlug( $sString);
		return !!$this->count("slug='{$sString}'");
	}

	/**
	 * [critere description]
	 * @return [type] [description]
	 */
	public function critere(){

		$oLink      = new TagCritere();
		$aCritereId = $oLink->allData('critere_id', "tag_id='{$this->id}'");

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
                    "id" => $this->id,
                    "slug" => $this->slug,
                    "name" => $this->name,
             ));
    }


}
