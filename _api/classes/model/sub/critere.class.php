<?php

/*

//BULK
svg : 
facebook : 
dbm : 
definition : 
name : 
slug : 
id : 

//DATA
array(
"svg" => "",
"facebook" => "",
"dbm" => "",
"definition" => "",
"name" => "",
"slug" => "",
"id" => "",
);
*/


class Critere extends Acxiom{

	protected $_sTable        = 'critere';
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
     * [tags description]
     * @return [type] [description]
     */
    function tags(){

		$oLink   = new TagCritere();
		$aTagId  = $oLink->allData('tag_id', "critere_id='{$this->id}'");

		$oTag    = new Tag();
		$aResult = $oTag->all( "id IN('".implode("','", $aTagId)."') ORDER BY slug ASC");

		return $aResult;
    }

    /**
     * Undocumented function
     *
     * @param [type] $aString
     * @return void
     */
    function addTags( $aString){

        foreach( $aString as $sName){
          $oTag = new Tag([
            'name' => $sName
          ]);
  
          $oLink = new TagCritere([
            'tag_id'     => $oTag->id,
            'critere_id' => $this->id
          ]);
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param [type] $aObject
     * @return void
     */
    /*
    function deleteTags( $aObject){
      $oLink   = new TagCritere();
      $aTagId  = [];
      
      foreach( $aObject as $oTag){
        $aTagId[] = $oTag->id;
      }

      $aTagCritere  = $oLink->all("critere_id='{$this->id}' AND tag_id IN('".implode("','", $aTagId)."')");

      foreach( $aTagCritere as $oTagCritere){
        $oTagCritere->delete();
      }

      return $this;

    }
    */

    /**
     * Undocumented function
     *
     * @param [type] $aObject
     * @return void
     */
    function deleteTags( $aTagName){
      global $oDAO;

      $oTag    = new Tag();
      $aTagId  = $oTag->allData( 'id', "name IN('".implode("','", $aTagName)."')");

      $sQuery  = "DELETE FROM `tag_critere` WHERE critere_id='{$this->id}' AND tag_id IN('".implode("','", $aTagId)."')";      

      $oDAO->direct_query( $sQuery);

      return $this;

    }

    /**
     * [tags description]
     * @return [type] [description]
     */
    function tagsList(){

		$oLink   = new TagCritere();
		$aTagId  = $oLink->allData('tag_id', "critere_id='{$this->id}'");

		$oTag    = new Tag();
		$aResult = $oTag->allData('slug', "id IN('".implode("','", $aTagId)."') ORDER BY slug ASC");

		return $aResult;
    }

    /**
     * [tags description]
     * @return [type] [description]
     */
    function tagsName(){

		$oLink   = new TagCritere();
		$aTagId  = $oLink->allData('tag_id', "critere_id='{$this->id}'");

		$oTag    = new Tag();
		$aResult = $oTag->allData('name', "id IN('".implode("','", $aTagId)."') ORDER BY slug ASC");

		return $aResult;
    }

	    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array(
                     "svg"      => $this->svg,
                     "facebook"   => $this->facebook,
                     "dbm"        => $this->dbm,
                     "definition" => $this->definition,
                     "name"       => $this->name,
                     "slug"       => $this->slug,
                     "id"         => $this->id,
                     "tag"        => $this->tagsName,
             );
    }
}
