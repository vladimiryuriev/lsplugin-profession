<?php
/*-------------------------------------------------------
*
*	Plugin "Prof"
*	Author: Vladimir Yuriev (extravert)
*	Official site: lsmods.ru
*	Contact e-mail: support@lsmods.ru
*
---------------------------------------------------------
*/

 
class PluginProf_ModuleProf extends ModuleORM {


        /**
	 * Привязывает профессию к пользователю
	 *
	 * @param unknown_type $sProfId
	 * @param unknown_type $sUserId
	 * @return unknown
	 */
	public function SetProfUser($sProfId,$sUserId) {
                $oMapper=Engine::GetMapper(__CLASS__);
		return $oMapper->SetProfUser($sProfId,$sUserId);
	}
        

        public function GetUsersProf($sLimit) {
                $oMapper=Engine::GetMapper(__CLASS__);
		return $oMapper->GetUsersProf($sLimit);
	}

        /**
	 * Получить спиок юзеров по профессии
	 *
	 * @param unknown_type $sProf
	 * @param unknown_type $iCurrPage
	 * @param unknown_type $iPerPage
	 * @return unknown
	 */
	public function GetUsersByProf($sProf,$iPage,$iPerPage) {
                if (false === ($data = $this->Cache_Get("user_prof_{$sProf}_{$iPage}_{$iPerPage}"))) {
                        $oMapper=Engine::GetMapper(__CLASS__);
			$data = array('collection'=>$oMapper->GetUsersByProf($sProf,$iCount,$iPage,$iPerPage),'count'=>$iCount);
			$this->Cache_Set($data, "user_prof_{$sProf}_{$iPage}_{$iPerPage}", array("user_update"), 60*60*24*2);
		}
		$data['collection']=$this->User_GetUsersAdditionalData($data['collection']);
		return $data;
	}

        public function GetProfsByArrayId($aUserId) {
            $oMapper=Engine::GetMapper(__CLASS__);
            return $oMapper->GetProfsByArrayId($aUserId);
        }

        public function GetProfByName($sName) {
                $oMapper=Engine::GetMapper(__CLASS__);
		return $oMapper->GetProfByName($sName);
	}

}
	