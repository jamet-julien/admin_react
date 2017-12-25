<?php

/*

//BULK
critere_id : 
id : 
tag_id : 

//DATA
array(
"critere_id" => "",
"id" => "",
"tag_id" => "",
);
*/


class TagCritere extends Acxiom{

	protected $_sTable        = 'tag_critere';
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
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
                    "critere_id" => $this->critere_id,
                    "id"         => $this->id,
                    "tag_id"     => $this->tag_id,
             ));
    }


}
