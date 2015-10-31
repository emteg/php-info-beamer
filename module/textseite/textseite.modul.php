<?php
class Textseite extends Modul {
	public function datenLaden($datenbank) {
	
		$letzteSeite = $this->letzteSeitenIdAuslesen();
		$this->neueSeiteLaden($letzteSeite, $datenbank);
		$this->titelLaden($datenbank);
    parent::datenLaden($datenbank);
		
	}
	
	private function letzteSeitenIdAuslesen() {
		
		if (isset($_COOKIE["textSeiteLetzteId"])) {
			return $_COOKIE["textSeiteLetzteId"];
		} else {
			return 0;
		}

	}
	
	private function neueSeiteLaden($letzteSeite, $datenbank) {
	
		$records = $this->aktiveSeitenLaden($datenbank);
		
		if (count($records) > 0) {
		
			$index = $this->naechsteSeiteBestimmen($records, $letzteSeite);
			$this->templateVars["inhalt"] = nl2br($records[$index]["Inhalt"]);
			
			$this->neueSeitenIdSetzen($records[$index]["Id"]);
			
		} else {
			$this->templateVars["inhalt"] = "";
			$this->neueSeitenIdSetzen(0);
		}
		
		
		
	}
	
	private function aktiveSeitenLaden($datenbank) {
	
		$sql = "
			SELECT 
				* 
			FROM 
				`textseite` 
			WHERE 
				IstAktiv AND 
				ZeigenAb <= NOW() AND 
				(ZeigenBis IS NULL OR ZeigenBis >= NOW())";
		
		return $datenbank->queryDirektArray($sql);
		
	}
	
	private function naechsteSeiteBestimmen($records, $letzteSeite) {
	
		foreach ($records as $key => $record) {
			if ($record["Id"] > $letzteSeite) {
				return $key;			// Index der nächsten Seite zurückgeben
			}
		}
		return 0;						// oder Index der ersten Seite zurückgeben
		
	}
	
	private function neueSeitenIdSetzen($seitenId) {
		
		setcookie("textSeiteLetzteId", $seitenId);
		
	}
	
	private function titelLaden($datenbank) {
		$this->templateVars["titel"] = $this->getEinstellung("eventTitel", $datenbank);
	}
}
?>
