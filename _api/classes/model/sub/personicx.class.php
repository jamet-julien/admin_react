<?php

/*

//BULK
couple : 
famille : 
revenus_faibles : 
revenus_moyens : 
45_60 : 
revenus_tres_eleves : 
urbain : 
periurbain : 
campagne : 
revenus_eleves : 
id : 
slug : 
code : 
moins_de_30 : 
30_45 : 
senior : 
celibat : 

//DATA
array(
"couple" => "",
"famille" => "",
"revenus_faibles" => "",
"revenus_moyens" => "",
"45_60" => "",
"revenus_tres_eleves" => "",
"urbain" => "",
"periurbain" => "",
"campagne" => "",
"revenus_eleves" => "",
"id" => "",
"slug" => "",
"code" => "",
"moins_de_30" => "",
"30_45" => "",
"senior" => "",
"celibat" => "",
);
*/


class Personicx extends Acxiom{

	protected $_sTable        = 'personicx';
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
     * [filter description]
     * @return [type] [description]
     */
    function filtre(){
        return implode(',', array_keys(array_intersect_assoc(
                array(
                    "moins_de_30" => 1,
                    "30_45" => 1,
                    "45_60" => 1,
                    "senior" => 1,
                    "celibat" => 1,
                    "couple" => 1,
                    "famille" => 1,
                    "revenus_faibles" => 1,
                    "revenus_moyens" => 1,
                    "revenus_eleves" => 1,
                    "revenus_tres_eleves" => 1,
                    "urbain" => 1,
                    "periurbain" => 1,
                    "campagne" => 1,
                ),
                array(
                    "moins_de_30" => $this->moins_de_30,
                    "30_45" => $this->{'30_45'},
                    "45_60" => $this->{'45_60'},
                    "senior" => $this->senior,
                    "celibat" => $this->celibat,
                    "couple" => $this->couple,
                    "famille" => $this->famille,
                    "revenus_faibles" => $this->revenus_faibles,
                    "revenus_moyens" => $this->revenus_moyens,
                    "revenus_eleves" => $this->revenus_eleves,
                    "revenus_tres_eleves" => $this->revenus_tres_eleves,
                    "urbain" => $this->urbain,
                    "periurbain" => $this->periurbain,
                    "campagne" => $this->campagne,
                )
            )));
    }

    /**
     * [pictos description]
     * @return [type] [description]
     */
    function pictos(){
        $pictos = $this->getData("pictos");
        return json_decode($pictos);
    }

    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
                    "id"         => $this->id,
                    "name"      => $this->name,
                    "descriptif" => $this->descriptif
             ));
    }


}
