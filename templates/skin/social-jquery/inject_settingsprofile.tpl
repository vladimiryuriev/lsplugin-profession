{if $sEvent=='profile'}
    {literal}
    <script language="JavaScript" type="text/javascript">
        jQuery(document).ready(function($){
            ls.autocomplete.add($("#profile_prof"), aRouter['ajax']+'ajaxproflist/', false);
        });
    </script>
    {/literal}
    <dl class="form-item">
        <dd><label for="profile_prof">{$aLang.prof}:</label></dd>
        <dt><input type="text" name="profile_prof" id="profile_prof" value="{$oUserCurrent->getProfileProf()|escape:'html'}" class="input-200" /></dt>
    </dl>
{/if}