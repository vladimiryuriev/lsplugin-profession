{literal}
<script language="JavaScript" type="text/javascript">
    jQuery(document).ready(function($){
        ls.autocomplete.add($("#profile_prof"), aRouter['ajax']+'ajaxproflist/', false);
    });
</script>
{/literal}
<p>
    <label for="profile_prof">{$aLang.prof}:</label><br />
    <input type="text" class="input-200" id="profile_prof" name="profile_prof" value="{$oUserCurrent->getProfileProf()|escape:'html'}"/><br />
</p>