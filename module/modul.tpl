<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{$modulName}</title>
    {if $naechstePosition >= 0}
		<meta http-equiv="refresh" content="{$modulAnzeigeDauer};url=./index.php?playlistItem={$naechstePosition}">
    {else}
    <meta http-equiv="refresh" content="{$modulAnzeigeDauer};">
    {/if}
		<link rel="stylesheet" type="text/css" href="infobeamer.css">
		<!--<link rel="stylesheet" type="text/css" href="./fonts/Weathered SF.css">-->
	</head>
	<body>
{$logoDateiname = "logo.png"}
{block name=logo}
		<img src="{$logoDateiname}" class="logo">
{/block}
{block name=titel}<h1>Hadiko LAN-Party #6</h1>{/block}
{block name=body}{/block}
	</body>
</html>