{extends file="../modul.tpl"}
{block name=titel}<h1>{$modulName}</h1>{/block}
{block name=body}
		<table>
{foreach $termine as $termin}
			<tr>
				<td style="width: 6em;">{$termin["Beginn"]}</td>
				<td>{$termin["Titel"]}</td>
				<td style="width: 7em; text-align: right;">
{if $termin["hatAngefangen"]}
					noch {$termin["Restzeit"]}
{else}
					in {$termin["Restzeit"]}
{/if}
				</td>
			</tr>
{foreachelse}
			<tr><td colspan="3" class="tdMittig">- Zur Zeit keine Events eingetragen -</td></tr>
{/foreach}
		</table>
		<span class="configButtons">
			<a href="{$url}&zeitplanAnzahl=mehr" title="Mehr Events anzeigen">m</a>
			<a href="">{$limit}</a>
			<a href="{$url}&zeitplanAnzahl=weniger" title="Weniger Events anzeigen">w</a>
		</span>
{/block}