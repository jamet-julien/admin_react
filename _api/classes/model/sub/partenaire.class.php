<?php

/*
//DATA
array(
 
        "id" => "",
  
        "slug" => "",
  
        "name" => "",
     );
*/


class Partenaire extends Acxiom{

	protected $_sTable        = 'partenaire';
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
                     "slug" => $this->slug,
                     "image" => $this->image,
                     "name" => $this->name,
             ));
    }


}
