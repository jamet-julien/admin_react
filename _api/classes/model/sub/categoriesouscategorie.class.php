<?php

/*

//BULK
sous_categorie_id : 
categorie_id : 
id : 

//DATA
array(
"sous_categorie_id" => "",
"categorie_id" => "",
"id" => "",
);
*/


class CategorieSousCategorie extends Acxiom{

	protected $_sTable        = 'categorie_sous_categorie';
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
                    "sous_categorie_id" => $this->sous_categorie_id,
                     "categorie_id" => $this->categorie_id,
                     "id" => $this->id,
             ));
    }


}
