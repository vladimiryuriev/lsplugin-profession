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


$config = array();


Config::Set('db.table.prof', '___db.table.prefix___prof');
Config::Set('db.table.prof_user', '___db.table.prefix___prof_user');

Config::Set('block.rule_people', array(
	'action'  => array(
		'people',
	),
	'blocks'  => array(
		'right' => array(
			'actions/ActionPeople/sidebar.tpl',
            'Proftags'=>array('params'=>array('plugin'=>'prof')),
		)
	),
	'clear' => false,
));


$config['profarr']=array(
	'Гитарист',
	'Баянист',
	'Виолончелист'
);


return $config;

?>