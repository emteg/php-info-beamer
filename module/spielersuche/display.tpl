{extends file="../modul.tpl"}
{block name=titel}<h1>{$strings["spielersuche-title"]}</h1>{/block}
{block name=body}
		<table class="table-auto-height">
			<tr>
				<th>{$strings["spielersuche-game"]}</th>
				<th>{$strings["spielersuche-location"]}</th>
				<th>{$strings["spielersuche-from"]}</th>
				<th></th>
			</tr>
{foreach $gesuche as $gesuch}
			<tr>
				<td>{$gesuch["Name"]}</td>
				<td>{$gesuch["Server"]}</td>
				<td>{$gesuch["Spieler"]}</td>
				<td style="width: 5em; text-align: right;">{$gesuch["Zeit"]}</td>
			</tr>
{foreachelse}
			<tr><td colspan="4" class="tdMittig">{$strings["spielersuche-no-requests"]}</td></tr>
{/foreach}
      <tr><td colspan="4" class="tdMittig">{$strings["spielersuche-info"]}</td></tr>
		</table>
		<span class="configButtons">
			<a href="{$url}&spielersucheAnzahl=mehr" title="{$strings["spielersuche-show-more"]}">{$strings["show-more"]}</a>
			<a href="">{$limit}</a>
			<a href="{$url}&spielersucheAnzahl=weniger" title="{$strings["spielersuche-show-less"]}">{$strings["show-less"]}</a>
		</span>
{/block}