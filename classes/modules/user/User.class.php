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

 
class PluginProf_ModuleUser extends PluginProf_Inherit_ModuleUser {

    /**
	 * Получает дополнительные данные(объекты) для юзеров по их ID
	 *
	 */
	public function GetUsersAdditionalData($aUserId,$aAllowData=array('vote','session','friend')) {
		func_array_simpleflip($aAllowData);
		if (!is_array($aUserId)) {
			$aUserId=array($aUserId);
		}
		/**
		 * Получаем юзеров
		 */
		$aUsers=$this->GetUsersByArrayId($aUserId);
		/**
		 * Получаем дополнительные данные
		 */
		$aSessions=array();
		$aFriends=array();
		$aVote=array();
		if (isset($aAllowData['session'])) {
			$aSessions=$this->GetSessionsByArrayId($aUserId);
		}
		if (isset($aAllowData['friend']) and $this->oUserCurrent) {
			$aFriends=$this->GetFriendsByArray($aUserId,$this->oUserCurrent->getId());
		}

		if (isset($aAllowData['vote']) and $this->oUserCurrent) {
			$aVote=$this->Vote_GetVoteByArray($aUserId,'user',$this->oUserCurrent->getId());
		}

        $aProfs=$this->PluginProf_Prof_GetProfsByArrayId(array_unique($aUserId));

		/**
		 * Добавляем данные к результату
		 */
		foreach ($aUsers as $oUser) {
			if (isset($aSessions[$oUser->getId()])) {
				$oUser->setSession($aSessions[$oUser->getId()]);
			} else {
				$oUser->setSession(null); // или $oUser->setSession(new ModuleUser_EntitySession());
			}
			if ($aFriends&&isset($aFriends[$oUser->getId()])) {
				$oUser->setUserFriend($aFriends[$oUser->getId()]);
			} else {
				$oUser->setUserFriend(null);
			}

			if (isset($aVote[$oUser->getId()])) {
				$oUser->setVote($aVote[$oUser->getId()]);
			} else {
				$oUser->setVote(null);
			}

            if (isset($aProfs[$oUser->getId()])) {
                    $oUser->setProfileProf($aProfs[$oUser->getId()]->getProfName());
            } else {
                    $oUser->setProfileProf(null);
            }
		}

		return $aUsers;
	}
	
}
	