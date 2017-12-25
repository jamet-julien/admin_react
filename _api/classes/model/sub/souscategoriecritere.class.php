<?php

/*

//BULK
id : 
sous_categorie_id : 
critere_id : 

//DATA
array(
"id" => "",
"sous_categorie_id" => "",
"critere_id" => "",
);
*/


class SousCategorieCritere extends Acxiom{

	protected $_sTable        = 'sous_categorie_critere';
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
                    "id"                => $this->id,
                    "sous_categorie_id" => $this->sous_categorie_id,
                    "critere_id"        => $this->critere_id,
             ));
    }


}
