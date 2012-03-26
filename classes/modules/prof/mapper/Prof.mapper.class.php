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
 
class PluginProf_ModuleProf_MapperProf extends MapperORM {


    public function SetProfUser($sProfId,$sUserId) {
		$sql = "REPLACE ".Config::Get('db.table.prof_user')."
			SET
				prof_id = ? ,
				user_id = ?
		";
		return $this->oDb->query($sql,$sProfId,$sUserId);
	}

    public function GetUsersProf($sLimit) {
		$sql = "
			SELECT
				count(u.user_id) as count,
				p.prof_name as name
			FROM 
                ".Config::Get('db.table.prof')." as p,
                ".Config::Get('db.table.prof_user')." as pu,
                ".Config::Get('db.table.user')." as u 
            WHERE 
                pu.prof_id=p.prof_id
                AND
                pu.user_id=u.user_id
                AND
                u.user_activate=1
            GROUP BY 
				p.prof_name
			ORDER BY 
                count desc		
			LIMIT 0, ?d
		";
		$result=$this->oDb->select($sql,$sLimit);
		return $result;
	}

    
    public function GetUsersByProf($sProf,&$iCount,$iCurrPage,$iPerPage) {
		$sql = "
			SELECT pu.user_id
			FROM
				".Config::Get('db.table.prof')." as p,
				".Config::Get('db.table.prof_user')." as pu,
                ".Config::Get('db.table.user')." as u 
			WHERE
				p.prof_name = ?
				AND
				p.prof_id=pu.prof_id
                AND
                pu.user_id=u.user_id
                AND
                u.user_activate=1
			ORDER BY pu.user_id DESC
			LIMIT ?d, ?d ";
		$aReturn=array();
		if ($aRows=$this->oDb->selectPage($iCount,$sql,$sProf,($iCurrPage-1)*$iPerPage, $iPerPage)) {
			foreach ($aRows as $aRow) {
				$aReturn[]=$aRow['user_id'];
			}
		}
		return $aReturn;
	}

    public function GetProfsByArrayId($aArrayId) {
		if (!is_array($aArrayId) or count($aArrayId)==0) {
			return array();
		}

		$sql = "SELECT 
                p.prof_id,
                p.prof_name,
                pu.user_id,
                pu.prof_id
			FROM
				".Config::Get('db.table.prof')." as p,
				".Config::Get('db.table.prof_user')." as pu,
                ".Config::Get('db.table.user')." as u 
			WHERE
				pu.user_id IN(?a)
				AND
				p.prof_id=pu.prof_id
                AND
                pu.user_id=u.user_id
                AND
                u.user_activate=1
                ";
		$aRes=array();
		if ($aRows=$this->oDb->select($sql,$aArrayId)) {
			foreach ($aRows as $aRow) {
				$oUserProf=Engine::GetEntity('PluginProf_ModuleProf_EntityProfUser',$aRow);
                $aRes[$oUserProf->getUserId()]=$oUserProf;
			}
		}
        return $aRes;
	}

    public function GetProfByName($sName) {
		$sql = "SELECT * FROM ".Config::Get('db.table.prof')." WHERE prof_name = ? ";
		if ($aRow=$this->oDb->selectRow($sql,$sName)) {
			return Engine::GetEntity('PluginProf_ModuleProf_EntityProf',$aRow);
		}
		return null;
	}

}
	