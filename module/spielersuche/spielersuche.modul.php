<?php
class Spielersuche extends Modul {
	public function datenLaden($datenbank) {
		$now = new DateTime();
		$gesuche = Array();
		
		$sql = "
			SELECT
				*
			FROM 
				`spiel`
      ORDER BY
        Zeit DESC
      LIMIT " . 
        $this->limitAuslesen();
		$records = $datenbank->queryDirektArray($sql);
		
		foreach ($records as $record) {
			$gesuche[] = $this->gesuchVerarbeiten($record);
		}
		
		$this->templateVars["gesuche"] = $gesuche;
		$this->templateVars["limit"] = $this->limitAuslesen();
	}
	
	private function gesuchVerarbeiten($record) {

		$now = new DateTime();
		$then = new DateTime($record["Zeit"]);
		$interval = $now->diff($then);
    if ($interval->h > 0) {
      $record["Zeit"] = "vor " . $interval->format("%hh%im");
    } else {
      $record["Zeit"] = "vor " . $interval->format("%im");
    }
		
		if ($record["Suche"] == "ingame") {
			$record["Server"] = "In-Game Suche";
		} else if ($record["Suche"] == "IP") {
			$record["Server"] = "IP: " . $record["Server"];
		}
		
		return $record;
	}
	
	private function limitAuslesen() {
	
		if (isset($_COOKIE["spielersucheAnzahl"])) {
			$limit = $_COOKIE["spielersucheAnzahl"];
		} else {
			$limit = 8;
		}
	
		if (isset($_GET["spielersucheAnzahl"])) {
		
			if ($_GET["spielersucheAnzahl"] == "mehr") {
				$limit++;
			} else {
				$limit = max($limit - 1, 1);
			}
		
		}
		
		setcookie("spielersucheAnzahl", $limit);
		return $limit;
		
	}
}
?>