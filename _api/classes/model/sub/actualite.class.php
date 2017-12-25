<?php

/*
//DATA
array(
 
        "id" => "",
  
        "name" => "",
  
        "label" => "",
  
        "content" => "",
  
        "image" => "",
  
        "source_image" => "",
  
        "date" => "",
     );
*/


class Actualite extends Acxiom{

	protected $_sTable        = 'actualite';
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
      return array(
                    "id"            => $this->id,
                    "name"          => $this->name,
                    "label"         => $this->label,
                    "content"       => $this->content,
                    "content_suite" => $this->content_suite,
                    "image"         => $this->image,
                    "source_image"  => $this->source_image,
                    "date"          => $this->date,
             );
    }

}
