{extends file="../modul.tpl"}
{block name=titel}<h1>Spiel der Stunde</h1>{/block}
{block name=body}
    <table class="table-auto-height">
{if count($termine) > 0}
      <tr>
        <td colspan="3">
  {if $termine[0]["hatAngefangen"]}
          Das Spiel der Stunde ist für die nächsten {$termine[0]["Restzeit"]} ist {$termine[0]["Titel"]}.
  {else}
          Das nächste Spiel der Stunde ist {$termine[0]["Titel"]}. Beginn in {$termine[0]["Restzeit"]}
  {/if}
        </td>
      </tr>
{/if}
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
			<a href="{$url}&zeitplanAnzahl=mehr" title="Mehr Spiele anzeigen">m</a>
			<a href="">{$limit}</a>
			<a href="{$url}&zeitplanAnzahl=weniger" title="Weniger Spiele anzeigen">w</a>
		</span>
{/block}