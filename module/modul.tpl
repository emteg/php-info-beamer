<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{$modulName}</title>
    {if $naechstePosition >= 0}
		<meta http-equiv="refresh" content="{$modulAnzeigeDauer};url=./index.php?playlistItem={$naechstePosition}">
    {else}
    <meta http-equiv="refresh" content="{$modulAnzeigeDauer};url={$url}">
    {/if}
		<link rel="stylesheet" type="text/css" href="./fonts/font.css">
		<link rel="stylesheet" type="text/css" href="infobeamer.css">
	</head>
	<body>
{block name=logo}
		<img src="logo.png" class="logo">
{/block}
{block name=titel}<h1>{$strings["event"]}</h1>{/block}
{block name=body}{/block}
{block name=uhrzeit}<span class="uhrzeit">{$zeit}</span>{/block}
  <script>var alarmAnzeigen = '{$alarmAnzeigen}';</script>
  <script src="poll.js"></script>
	</body>
</html>
