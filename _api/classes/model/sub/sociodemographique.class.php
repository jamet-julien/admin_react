<?php

/*

//BULK
IBE_CPG_PET_DOGO : 
IBE_CPG_PET_CATO : 
Number_People : 
Housing_2 : 
Housing_1 : 
Number_Children : 
Presence_Children : 
Marital_Status : 
TR_age_OCR : 
cpt_indiv : 
id : 
Gender : 
Annual_Income : 

//DATA
array(
"IBE_CPG_PET_DOGO" => "",
"IBE_CPG_PET_CATO" => "",
"Number_People" => "",
"Housing_2" => "",
"Housing_1" => "",
"Number_Children" => "",
"Presence_Children" => "",
"Marital_Status" => "",
"TR_age_OCR" => "",
"cpt_indiv" => "",
"id" => "",
"Gender" => "",
"Annual_Income" => "",
);
*/


class SocioDemographique extends Acxiom{

	protected $_sTable        = 'socio_demographique';
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
     * 
     */
    function volumeEstimate( $sSelection){
        $sWhere = "1";
        $aData = json_decode( $sSelection, true);

        if( $aData){
            foreach( $aData as $sKey => $aValue){
                if($sKey == "ibe_cpg_pet"){
                    $sWhere .= " AND (" . $this->sqlPet($aValue) . ")";
                } else {
                    $sWhere .= " AND (" . $sKey . "='" . implode( "' OR " . $sKey . "='", $aValue) . "')";
                }
            }

            $volumeTotal = $this->sum('cpt_indiv');
            $volume = $this->sum('cpt_indiv', $sWhere);
            $percent = round( (intval($volume[0])*100/intval($volumeTotal[0])), 1);

            $volumeSend = round( ($volume[0]/1000000), 1)."M pers";
            if($volumeSend == "0M pers"){
                $volumeSend = round( ($volume[0]/1000), 1)."K pers";
                if($volumeSend == "0K pers"){
                    $volumeSend = $volume[0]." pers";
                }
            }
            return ["volume" => $volumeSend, "percent" => $percent."%"];
        } else {
            return ["volume" => "0M pers", "percent" => "0%"];
        }
    }

    /**
     * 
     */
    function sqlPet( $aValue){
        $sWhere = [];
        foreach( $aValue as $value){
            switch($value){
                case "0":
                    $sWhere[] = "(IBE_CPG_PET_CATO=0 AND IBE_CPG_PET_DOGO=0)";
                    break;
                case "1":
                    $sWhere[] = "IBE_CPG_PET_CATO=1";
                    break;
                case "2":
                    $sWhere[] = "IBE_CPG_PET_DOGO=1";
                    break;
                case "3":
                    $sWhere[] = "(IBE_CPG_PET_CATO=1 AND IBE_CPG_PET_DOGO=1)";
                    break;
                default:
            }
        }

        return implode(" OR ", $sWhere);
    }

	/**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
                     "IBE_CPG_PET_DOGO"  => $this->IBE_CPG_PET_DOGO,
                     "IBE_CPG_PET_CATO"  => $this->IBE_CPG_PET_CATO,
                     "Number_People"     => $this->Number_People,
                     "Housing_2"         => $this->Housing_2,
                     "Housing_1"         => $this->Housing_1,
                     "Number_Children"   => $this->Number_Children,
                     "Presence_Children" => $this->Presence_Children,
                     "Marital_Status"    => $this->Marital_Status,
                     "TR_age_OCR"        => $this->TR_age_OCR,
                     "cpt_indiv"         => $this->cpt_indiv,
                     "id"                => $this->id,
                     "Gender"            => $this->Gender,
                     "Annual_Income"     => $this->Annual_Income,
             ));
    }


}
