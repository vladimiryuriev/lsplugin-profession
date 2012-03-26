{if $aTagList && count($aTagList)>0}
<div class="block">
    <h2>{$aLang.profs}</h2>
	<ul class="cloud">						
		{foreach from=$aTagList item=aTag}
			<li><a class="w{$aTag.size}" rel="tag" href="{router page='people'}prof/{$aTag.name|escape:'html'}/" >{$aTag.name|escape:'html'}</a></li>	
		{/foreach}
	</ul>
</div>
{/if}