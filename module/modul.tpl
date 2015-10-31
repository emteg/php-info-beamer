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
		<link rel="stylesheet" type="text/css" href="./fonts/font.css">
		<link rel="stylesheet" type="text/css" href="infobeamer.css">
	</head>
	<body>
{block name=logo}
		<img src="logo.png" class="logo">
{/block}
{block name=titel}<h1>{$titel}</h1>{/block}
{block name=body}{/block}
  <script src="poll.js"></script>
	</body>
</html>
