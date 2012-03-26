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

class PluginProf_HookProf extends Hook {
	public function RegisterHook() {
            $this->AddDelegateHook('module_user_update_after','update',__CLASS__,-3);
            $this->AddHook('template_form_settings_profile_begin', 'settings',__CLASS__,-3);
            $this->AddHook('template_prof_register', 'register',__CLASS__,-3);
            $this->AddHook('template_profile_whois_privat_item', 'profile',__CLASS__,-3);
	}


    public function update($aVars) {

        $oUser=$aVars['params'][0];

        if (func_check(getRequest('profile_prof'),'text',1,100)) {
                $oUser->setProfileProf($this->Text_Parser(mb_strtolower(getRequest('profile_prof'))));
        } else {
                $oUser->setProfileProf(null);
        }

        if ($oUser->getProfileProf()) {
            if (!($oProf=$this->PluginProf_Prof_GetByFilter(array('prof_name'=>$oUser->getProfileProf()),'PluginProf_ModuleProf_EntityProf'))) {
                    $oProf=Engine::GetEntity('PluginProf_ModuleProf_EntityProf');
                    $oProf->setName($oUser->getProfileProf());
                    $oProf->Add();
            }
            $this->PluginProf_Prof_SetProfUser($oProf->getProfId(),$oUser->getId());
        }

    }

    
    
    public function settings() {
        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_settingsprofile.tpl');
    }

    public function register() {
        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_register.tpl');
    }
    
    public function profile() {
        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_profile.tpl');
    }

}
?>