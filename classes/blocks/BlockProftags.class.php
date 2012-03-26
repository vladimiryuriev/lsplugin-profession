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

class PluginProf_BlockProftags extends Block {
	public function Exec() {

        $aTags=$this->oEngine->PluginProf_Prof_GetUsersProf(70);
        //var_dump($aTags);
		/**
		 * Расчитываем логарифмическое облако тегов
		 */
		if ($aTags and count($aTags)>0) {
			$iMinSize=1; // минимальный размер шрифта
			$iMaxSize=10; // максимальный размер шрифта
			$iSizeRange=$iMaxSize-$iMinSize;

			$iMin=10000;
			$iMax=0;
			foreach ($aTags as $aTag) {
				if ($iMax<$aTag['count']) {
					$iMax=$aTag['count'];
				}
				if ($iMin>$aTag['count']) {
					$iMin=$aTag['count'];
				}
			}

			$iMinCount=log($iMin+1);
			$iMaxCount=log($iMax+1);
			$iCountRange=$iMaxCount-$iMinCount;
			if ($iCountRange==0) {
				$iCountRange=1;
			}
			foreach ($aTags as $key => $aTag) {
				$iTagSize=$iMinSize+(log($aTag['count']+1)-$iMinCount)*($iSizeRange/$iCountRange);
				$aTags[$key]['size']=round($iTagSize);
			}
			/**
		 	* Устанавливаем шаблон вывода
		 	*/
			$this->Viewer_Assign("aTagList",$aTags);
            
		}
	}
}
?>