{extends file="../modul.tpl"}
{block name=titel}{/block}
{block name=logo}{/block}
{block name=body}
    {if $strings["pollen-url-2"] == ""}
    <img src="{$strings["pollen-url-1"]}" class="imgFull">
    {else}
    <img src="{$strings["pollen-url-1"]}" class="imgHalfWidth">
    <img src="{$strings["pollen-url-2"]}" class="imgHalfWidth">
    {/if}
{/block}
{block name=uhrzeit}{/block}