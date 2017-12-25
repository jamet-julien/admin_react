<?php

/*
//DATA
array(
 
        "id" => "",
  
        "personicx_id" => "",
  
        "comportement_id" => "",
     );
*/


class PersonicxComportement extends Acxiom{

	protected $_sTable        = 'personicx_comportement';
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
                    "id" => $this->id,
                     "personicx_id" => $this->personicx_id,
                     "comportement_id" => $this->comportement_id,
             ));
    }


}
