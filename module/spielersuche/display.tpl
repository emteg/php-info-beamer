{extends file="../modul.tpl"}
{block name=titel}<h1>Mitspieler gesucht</h1>{/block}
{block name=body}
		<table>
			<tr>
				<th>Spiel</th>
				<th>Erreichbar via</th>
				<th>Von</th>
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
			<tr><td colspan="4" class="tdMittig">- Zur Zeit keine Gesuche eingetragen -</td></tr>
{/foreach}
      <tr><td colspan="4" class="tdMittig">Du suchst Mitspieler? Trag Dein Gesuch ein unter hlp.hadiko.de/spielersuche</td></tr>
		</table>
		<span class="configButtons">
			<a href="{$url}&spielersucheAnzahl=mehr" title="Mehr Gesuche anzeigen">m</a>
			<a href="">{$limit}</a>
			<a href="{$url}&spielersucheAnzahl=weniger" title="Weniger Gesuche anzeigen">w</a>
		</span>
{/block}