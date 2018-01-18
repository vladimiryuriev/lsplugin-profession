{literal}
    <script language="JavaScript" type="text/javascript">
        jQuery(document).ready(function($){
            ls.autocomplete.add($("#profile_prof"), aRouter['ajax']+'ajaxproflist/', false);
        });
    </script>
{/literal}
<dl class="form-item">
    <dt><label for="profile_prof">{$aLang.plugin.prof.prof}:</label></dt>
    <dd>
        <input type="text" name="profile_prof" id="profile_prof" value="{$oUserCurrent->getProfileProf()|escape:'html'}" class="input-text input-width-250">
    </dd>
</dl>