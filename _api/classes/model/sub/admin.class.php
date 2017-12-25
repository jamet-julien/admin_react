<?php

/*
//DATA
array(
        "id"          => "",
        "serial"      => "",
        "name"        => "",
        "login"       => "",
        "password"    => "",
        "token"       => "",
        "create"      => "",
        "lastConnect" => "",
        "actif"       => "",
     );

        "id          :
        "serial      :
        "name        :
        "login       :
        "password    :
        "token       :
        "create      :
        "lastConnect :
        "actif       :
*/


class Admin extends Acxiom{

    protected $_sTable        = 'admin';
    protected $_sReferer      = 'serial';

    /**
     * [_treatInput traitement avant enregistrement dans la base]
     * @param  $_aData [description]
     * @return [type]         [description]
     */
    protected function _treatInputInsert( $_aData){

      $_aData['id']     = '';
      $_aData['serial'] = '';
      $_aData['actif']  = '1';

      if( ( isset( $_aData['login'])    && trim( $_aData['login'])    != '') &&
          ( isset( $_aData['password']) && trim( $_aData['password']) != ''))
      {
          $_aData['password'] = $this->_hashPassword( $_aData['login'], $_aData['password']);
      }

      $_aData['created']     = date("y-m-d H:i:s");
      $_aData['lastConnect'] = date("y-m-d H:i:s");
      $_aData['token']       = $this->_generateToken();

      $_aData           = parent::_treatInputInsert( $_aData);

      return $_aData;

    }


    protected function _hashPassword( $login, $password){
        return md5("4cX|0m$login.$password");
    }

    /**
     *
     * @return void
     */
    protected function _generateToken( $iNum = 0){

        $sToken  = $this->_generateRandomString( 24);
        $iResult = $this->count(" token='{$sToken}' AND actif=1");

        if( $iResult){
            if( $iNum < 5){
              $sToken = $this->_generateToken( ++$iNum);
            }else{
              exit('Too token wrong.');
            }
        }

        return $sToken;
    }

    /**
     * @return [boolean]
     */
    function testToken( $token, &$oUser){

        $token  .= "|".$_SERVER["REMOTE_ADDR"];
        $aResult = $this->all( "token='{$token}'" );

        if( count( $aResult)){
            $oUser = current($aResult);
            return true;
        }
      
        return false;
    }

    /**
     * Undocumented function
     *
     * @param [string] $login
     * @param [string] $password
     * @param [string] rference du token en sortie
     * @return [boolean]
     */
    function testLogin( $login , $password, &$token){

        $password = $this->_hashPassword( $login, $password);
        $aResult = $this->all(" password='{$password}' AND login='{$login}' AND actif= 1" );

        if( count($aResult) && count($aResult) == 1){
        
          $sToken                  = $this->_generateToken();
          $aResult[0]->token       = $sToken."|".$_SERVER["REMOTE_ADDR"];
          $aResult[0]->lastConnect = date("y-m-d H:i:s");

          $aResult[0]->save();
          $token = $sToken;
          return true;
        }

        return false;

    }

    /**
     * [resume description]
     * @return [type] [description]
     */
    function resume(){
      return array_map( "trim", array(
          "serial" => $this->serial,
          "name"   => $this->name
      ));
    }

}
