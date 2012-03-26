{include file='header.tpl'}
		
		
<h2>{$aLang.user_list_prof}: <span>{$oProf->getProfName()}</span></h2>

{if $aUsersProf}
	<table class="table user-list">
		<thead>
			<tr>
				<td>{$aLang.user}</td>	
				<td align="center" width="160">{$aLang.user_date_last}</td>												
				<td align="center" width="160">{$aLang.user_date_registration}</td>
				<td align="center" width="60">{$aLang.user_rating}</td>
			</tr>
		</thead>
		
		<tbody>
		{foreach from=$aUsersProf item=oUser}
			{assign var="oSession" value=$oUser->getSession()}
			<tr>
				<td>
                <a href="{$oUser->getUserWebPath()}"><img src="{$oUser->getProfileAvatarPath(24)}" alt="" class="avatar" /></a>
                <a href="{$oUser->getUserWebPath()}" class="username">{$oUser->getLogin()}</a></td>														
				<td align="center" class="date">{if $oSession}{date_format date=$oSession->getDateLast()}{/if}</td>
				<td align="center" class="date">{date_format date=$oUser->getDateRegister()}</td>				
				<td align="center" class="rating"><strong>{$oUser->getRating()}</strong>
                </td>
			</tr>
		{/foreach}						
		</tbody>
	</table>
{else}
	{$aLang.user_empty}
{/if}

				
{include file='paging.tpl' aPaging="$aPaging"}
{include file='footer.tpl'}