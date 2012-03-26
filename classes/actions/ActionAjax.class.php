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
class PluginProf_ActionAjax extends PluginProf_Inherit_ActionAjax {
    
    protected function RegisterEvent() {
		parent::RegisterEvent();
		$this->AddEvent('ajaxproflist','EventAjaxProfList');
	}
		
	
	protected function EventAjaxProfList() {

        $this->Viewer_SetResponseAjax('json');

        if (!($sValue=getRequest('value',null,'post'))) {
            return ;
        }

        $aItems=array();
        $aProf=$this->PluginProf_Prof_GetItemsByFilter(array('prof_name like'=>$sValue.'%','#limit'=>10),'PluginProf_ModuleProf_EntityProf');
        
        foreach ($aProf as $oProf) {
            $aItems[]=$oProf->getProfName();
        }
        $this->Viewer_AssignAjax('aItems',$aItems);

    }
        
}
?>