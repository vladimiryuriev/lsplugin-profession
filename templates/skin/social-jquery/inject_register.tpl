{literal}
<script language="JavaScript" type="text/javascript">
    jQuery(document).ready(function($){
        ls.autocomplete.add($("#profile_prof"), aRouter['ajax']+'ajaxproflist/', false);
    });

    function profadd() {

        var objProf=$('#prof_list');
        var objProfInput=$('#prof_list_input');
        if(objProf.val()=='_full_prof_'){
            objProf.css({display:'none'});
            objProf.attr('name','');
            objProfInput.css({display:'block'});
            objProfInput.attr('name','profile_prof');
            objProfInput.focus();
        }
    }
</script>
{/literal}

{*
<p><label for="profile_prof">{$aLang.prof}<br />
<input type="text" id="profile_prof" name="profile_prof" value="{$_aRequest.profile_prof}" class="input-wide" /></label></p>*}

<p><label for="profile_prof">{$aLang.prof}<br />
{if !$_aRequest.profile_prof || ($_aRequest.profile_prof && in_array($_aRequest.profile_prof,$oConfig->GetValue('plugin.prof.profarr')))}
    <select id="prof_list" name="profile_prof" onchange="profadd();" class="">
        {foreach from=$oConfig->GetValue('plugin.prof.profarr') item=oProf}    		
            <option value="{$oProf}" {if $oProf==$_aRequest.profile_prof}selected{/if}>{$oProf}</option>
        {/foreach}
        <option value="_full_prof_" >- {$aLang.prof_other} -</option>
    </select>
    <input type="text" class="input-text input-wide" id="prof_list_input" style="display:none" />
{elseif $_aRequest.profile_prof}
    <input type="text" name="profile_prof" class="input-text input-wide" value="{$_aRequest.profile_prof}" />
{/if}
</p>