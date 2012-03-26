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

if (!class_exists('Plugin')) {
  die('Hacking attemp!');
}

class PluginProf extends Plugin {

	protected $aInherits=array(
		'module'  =>array('ModuleUser'),
        'action'=>array('ActionPeople','ActionAjax')
	);

	protected $aDelegates=array(
        'template'=>array(
            //'actions/ActionSettings/profile.tpl'=>'_actions/ActionSettings/profile.tpl',
        ),
	);

	public function Init() {
        return true;
	}

	public function Activate() {
		$this->ExportSQL(dirname(__FILE__).'/dump.sql');
		return true;
	}

	public function Deactivate() {
		return true;
	}
}
