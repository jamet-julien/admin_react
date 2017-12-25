<?php

/*

//BULK
critere_id : 
categorie_id : 
id : 

//DATA
array(
"critere_id" => "",
"categorie_id" => "",
"id" => "",
);
*/


class CategorieCritere extends Acxiom{

	protected $_sTable        = 'categorie_critere';
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
                     "categorie_id" => $this->categorie_id,
                     "id" => $this->id,
             ));
    }


}
