<?php
class Zeitplan extends Modul {
	public function datenLaden($datenbank) {
		$termine = Array();
		
		$sql = "
			SELECT
				*
			FROM 
				`event` 
			WHERE 
				Beginn >= NOW() OR 
				(Beginn <= NOW() AND Ende >= NOW())
			ORDER BY
				Beginn ASC
			LIMIT " . $this->limitAuslesen();
		$records = $datenbank->queryDirektArray($sql);
		
		foreach ($records as $record) {
			$termine[] = $this->eventVerarbeiten($record);
		}
		
		$this->templateVars["termine"] = $termine;
		$this->templateVars["zeit"] = date("H:i");
		$this->templateVars["limit"] = $this->limitAuslesen();
    parent::datenLaden($datenbank);
	}
	
	private function eventVerarbeiten($record) {	
		$result["Titel"] = $record["Titel"];
		$result["Beginn"] = date("D H:i", strtotime($record["Beginn"]));
		
		$now = new DateTime();
		$beginn = new DateTime($record["Beginn"]);
		$ende = new DateTime($record["Ende"]);
		
		if (strtotime($record["Beginn"]) > time()) {
			$result["hatAngefangen"] = false;
			$interval = $beginn->diff($now);
		} else {
			$result["hatAngefangen"] = true;
			$interval = $ende->diff($now);
		}
		
		$hours = $interval->h + $interval->days * 24;
		
		if ($hours == 0) {
			$result["Restzeit"] = $interval->format("%im");
		} else {
			$result["Restzeit"] = $hours . "h " . $interval->format("%im");
		}
		
		return $result;
	}
	
	private function limitAuslesen() {
	
		if (isset($_COOKIE["zeitplanAnzahl"])) {
			$limit = $_COOKIE["zeitplanAnzahl"];
		} else {
			$limit = 8;
		}
	
		if (isset($_GET["zeitplanAnzahl"])) {
		
			if ($_GET["zeitplanAnzahl"] == "mehr") {
				$limit++;
			} else {
				$limit = max($limit - 1, 1);
			}
		
		}
		
		setcookie("zeitplanAnzahl", $limit);
		return $limit;
		
	}
}
?>