<?php
require_once "./config.php";
require_once "./klassen/datenbank.class.php";
require_once "./libs/smarty/Smarty.class.php";
require_once "./module/modul.modul.php";
require_once "./klassen/modul.class.php";
require_once "./klassen/einstellung.class.php";

/* Skriptablauf */

$datenbank = new Datenbank();

if (isset($_GET["format"]) && $_GET["format"] == "flipdot") {
  $flipDot = true;
} else {
  $flipDot = false;
}

// Gewünschtes Modul aus URL auslesen
if (isset($_GET["modul"])) {
  $zielModul = $_GET["modul"];
  $modul = new TModul;

  if ($modul->getByName($zielModul, $datenbank)) {
    $modulName = $modul->name;
  } else {
    sterben($zielModul, $datenbank);
  }
 
} else {
  sterben("", $datenbank);
}

function sterben($zielModul, $datenbank) {
  $alleModule = Array();
  $sql = TModul::SQL_SELECT_ALLE;
  
  $alleModule = $datenbank->queryArray($sql, Array(), new ModulFactory());

  $s = "Ein Modul mit dem Namen '" . $zielModul . "' ist leider nicht vorhanden :/<br/>\n" .
  "Mögliche Module:<br/>\n" . 
  "";
  
  foreach ($alleModule as $modul) {
    $s .= $modul->name . "<br/>\n";
  }
  
  $s .= "Einen dieser Namen in diese URL einsetzen:<br/>\n" .
  "beamer.lan/view.php?modul=NAME";
  
  die($s);
}

require_once "./module/" . $modulName . "/" . $modulName . ".modul.php";

// Modul-Objekt erzeugen, Daten laden lassen und Modul anzeigen
$modul = modulErzeugen($modulName, $datenbank);
modulAusgeben($modul, -1);

/* Funktionen */
function modulErzeugen($name, $datenbank) {
	$modul = new $name;
	$modul->datenLaden($datenbank);
	return $modul;
}

function modulAusgeben($modul, $naechstePosition) {
	global $flipDot;
  
	$smarty = new Smarty();
	$smarty->setTemplateDir("./module/" . $modul->getName() . "/");
	
	$smarty->assign("modulAnzeigeDauer", anzeigeDauerErmitteln());
	$smarty->assign("modulName", $modul->getName());
	$smarty->assign("naechstePosition", -1);
	
	foreach ($modul->getTemplateVars() as $key => $var) {
		$smarty->assign($key, $var);
	}
  
  if ($flipDot) {
    echo $modul->getFlipDotOutput();
  } else {
    $smarty->display("display.tpl");
  }
}

function anzeigeDauerErmitteln() {
	global $datenbank;
	
	$einstellung = new TEinstellung();
	return $einstellung->read("ModulAnzeigeDauerSekunden", $datenbank);
}
?>