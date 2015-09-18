{extends file="../modul.tpl"}
{block name=titel}<h1>Spiel der Stunde</h1>{/block}
{block name=body}
{if count($termine) > 0}
	{if $termine[0]["hatAngefangen"]}
		<p class="wichtigMittig">{$termine[0]["Titel"]} <div class="normalMittig"> {$termine[0]["Restzeit"]}</div></p>
	{else}
		<p class="wichtigMittig">{$termine[0]["Titel"]} <div class="normalMittig">in {$termine[0]["Restzeit"]}</div></p>
	{/if}
{/if}
		<table>
{foreach $termine as $termin name=loop}
{if !$smarty.foreach.loop.first}
			<tr>
				<td>{$termin["Titel"]}</td>
				<td style="width: 7em; text-align: right;">
{if $termin["hatAngefangen"]}
					noch {$termin["Restzeit"]}
{else}
					{$termin["Restzeit"]}
{/if}
				</td>
			</tr>
{/if}
{foreachelse}
			<tr><td colspan="3" class="tdMittig">- Zur Zeit keine Spiele eingetragen -</td></tr>
{/foreach}
		</table>
		<span class="configButtons">
			<a href="{$url}&zeitplanAnzahl=mehr" title="Mehr Spiele anzeigen">+</a>
			<a href="">{$limit}</a>
			<a href="{$url}&zeitplanAnzahl=weniger" title="Weniger Spiele anzeigen">-</a>
		</span>
{/block}