{extends file="../modul.tpl"}
{block name=logo}
{if $layout == "Mittig"}
		<div class="imgAutoSizeContainer">
			<img src="./img_upload/{$id}.{$extension}" class="imgAutoSize">
		</div>
{else}
		<img src="logo.png" class="logo">
{/if}
{/block}
{if $layout == "Mittig"}
{block name=titel}{/block}
{/if}
{block name=body}
{if $layout != "Mittig"}
		<div class="linkeSpalte">
			<img src="./img_upload/{$id}.{$extension}" class="imgAutoSize">
		</div>
		<div class="rechteSpalte">{$beschriftung}</div>
{else}
		<div class="imgBeschriftungUntenMittig">{$beschriftung}</div>
{/if}
{/block}