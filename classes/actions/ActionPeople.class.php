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


class PluginProf_ActionPeople extends PluginProf_Inherit_ActionPeople {
	
    protected function RegisterEvent() {
        parent::RegisterEvent();
		$this->AddEventPreg('/^prof$/i','/^.+$/i','/^(page(\d+))?$/i','EventProf');
	}

    protected function EventProf() {
		if (!($oProf=$this->PluginProf_Prof_GetProfByName(urldecode($this->getParam(0))))) {
			return parent::EventNotFound();
		}
		/**
		 * Передан ли номер страницы
		 */
		$iPage=$this->GetParamEventMatch(1,2) ? $this->GetParamEventMatch(1,2) : 1;
		/**
		 * Получаем список юзеров
		 */
		$aResult=$this->PluginProf_Prof_GetUsersByProf($oProf->getProfName(),$iPage,Config::Get('module.user.per_page'));
		$aUsersProf=$aResult['collection'];
		/**
		 * Формируем постраничность
		 */
		$aPaging=$this->Viewer_MakePaging($aResult['count'],$iPage,Config::Get('module.user.per_page'),4,Router::GetPath('people').$this->sCurrentEvent.'/'.$oProf->getProfName());
		/**
		 * Загружаем переменные в шаблон
		 */
		if ($aUsersProf) {
			$this->Viewer_Assign('aPaging',$aPaging);
		}
		$this->Viewer_Assign('oProf',$oProf);
		$this->Viewer_Assign('aUsersProf',$aUsersProf);
        
        /**
         * Получаем статистику
         */
        $this->GetStats();
	}
}
?>