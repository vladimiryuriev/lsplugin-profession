{if $aTagList && count($aTagList)>0}
<div class="block">
    <div class="block-header">
		<strong>{$aLang.profs}</strong>
	</div>
	
	<ul class="cloud">						
		{foreach from=$aTagList item=aTag}
			<li><a class="w{$aTag.size}" rel="tag" href="{router page='people'}prof/{$aTag.name|escape:'html'}/" >{$aTag.name|escape:'html'}</a></li>	
		{/foreach}
	</ul>
</div>
{/if}