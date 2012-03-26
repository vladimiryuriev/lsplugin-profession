{if $oUserProfile->getProfileProf()}					
    <tr>
        <td class="var">{$aLang.prof}:</td>
        <td><a href="{router page='people'}prof/{$oUserProfile->getProfileProf()|escape:'html'}">{$oUserProfile->getProfileProf()|escape:'html'}</a></td>
    </tr>	
{/if}