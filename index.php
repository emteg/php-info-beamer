<?php
require_once "./config.php";
require_once "./klassen/datenbank.class.php";
require_once "./libs/smarty/Smarty.class.php";
require_once "./module/modul.modul.php";
require_once "./klassen/playlist.class.php";
require_once "./klassen/einstellung.class.php";

/* Skriptablauf */

$datenbank = new Datenbank();
$playlist = new Playlist();

// Den Namen des nächsten Moduls ermitteln und die entsprechende Datei einbinden
$aktuellePlaylistPosition = playlistPositionErmitteln();
$naechstePlaylistPosition = naechstePlaylistPositionErmitteln($aktuellePlaylistPosition);

$aktuellesModul = strtolower($playlist->playlist[$aktuellePlaylistPosition]["Name"]);

require_once "./module/" . $aktuellesModul . "/" . $aktuellesModul . ".modul.php";

// Modul-Objekt erzeugen, Daten laden lassen und Modul anzeigen
$modul = modulErzeugen($playlist->playlist[$aktuellePlaylistPosition]["Name"], $datenbank);
modulAusgeben($modul, $naechstePlaylistPosition);

/* Funktionen */

function playlistPositionErmitteln() {
	global $datenbank;
	global $playlist;

	$playlist->ladePlaylist($datenbank);
	
	if (isset($_GET["playlistItem"])) {
		$aktuell = $_GET["playlistItem"];
	} else {
		$aktuell = 0;
	}
	
	if ($aktuell < count($playlist->playlist)) {
		return $aktuell;
	} else {
		return 0;
	}
}

function naechstePlaylistPositionErmitteln($aktuellePosition) {
	global $playlist;
	
	if ($aktuellePosition < count($playlist->playlist) - 1) {
		return $aktuellePosition + 1;
	} else {
		return 0;
	}
}

function modulErzeugen($name, $datenbank) {
	$modul = new $name;
	$modul->datenLaden($datenbank);
	return $modul;
}

function modulAusgeben($modul, $naechstePosition) {
	global $aktuellePlaylistPosition;
	
	$smarty = new Smarty();
	$smarty->setTemplateDir("./module/" . strtolower($modul->getName()) . "/");
	
	$smarty->assign("modulName", $modul->getName());
	$smarty->assign("naechstePosition", $naechstePosition);
	
	$smarty->assign("url", $_SERVER["PHP_SELF"] . "?playlistItem=" . $aktuellePlaylistPosition);
	
	
	foreach ($modul->getTemplateVars() as $key => $var) {
		$smarty->assign($key, $var);
	}
	
	$smarty->display("display.tpl");
}
?>
