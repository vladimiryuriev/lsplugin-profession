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
     * Объект маппера
     *
     * @var ModuleProf_MapperProf
     */
    protected $oMapper;

    /**
     * Инициализация
     *
     */
    public function Init()
    {
        $this->oMapper = Engine::GetMapper(__CLASS__);
    }

    /**
	 * Привязывает профессию к пользователю
	 *
     * @param int $sProfId
     * @param int $sUserId
     * @return bool
	 */
	public function SetProfUser($sProfId,$sUserId) {
        return $this->oMapper->SetProfUser($sProfId, $sUserId);
    }

    /**
     * Получить список юзеров с лимитом
     *
     * @param int $sLimit
     * @return array
     */
    public function GetUsersProf($sLimit)
    {
        return $this->oMapper->GetUsersProf($sLimit);
    }

    /**
	 * Получить спиок юзеров по профессии
	 *
     * @param string $sProf
     * @param int $iPage
     * @param int $iPerPage
     * @return array
	 */
	public function GetUsersByProf($sProf,$iPage,$iPerPage) {
        $sCacheKey = "user_prof_{$sProf}_{$iPage}_{$iPerPage}";
        if (false === ($data = $this->Cache_Get($sCacheKey))) {
            $data = array('collection' => $this->oMapper->GetUsersByProf($sProf, $iCount, $iPage, $iPerPage), 'count' => $iCount);
            $this->Cache_Set($data, $sCacheKey, array("user_update"), 60 * 60 * 24 * 2);
		}
		$data['collection']=$this->User_GetUsersAdditionalData($data['collection']);
		return $data;
	}

    /**
     * Получить спиосок профессий по массиву user_id пользователей
     *
     * @param array $aUserId
     * @return array
     */
    public function GetProfsByArrayId($aUserId)
    {
        return $this->oMapper->GetProfsByArrayId($aUserId);
    }

    /**
     * Получить объект профессии по названию
     *
     * @param string $sName
     * @return object
     */
    public function GetProfByName($sName)
    {
        return $this->oMapper->GetProfByName($sName);
	}
}
