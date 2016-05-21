<?php
class Verkaufsstatistik extends Modul {
	public function datenLaden($datenbank) {
		
		$daten = file_get_contents("http://localhost/kasse/stats.php?format=csv");
		
		if ($daten !== false) {
			$verkaufe = $this->csvLesen(@mb_convert_encoding($daten, "UTF-8", "Windows-1252 (CP1252)"));
		} else {
			$verkaufe = Array();
		}
		
		$this->templateVars["verkaufe"] = $verkaufe;
		$this->templateVars["limit"] = $this->limitAuslesen();
    parent::datenLaden($datenbank);
		
	}
	
	private function csvLesen($daten) {
		
		$result = Array();
		$zeilen = explode("\n", $daten);
		$limit = $this->limitAuslesen();
		
		foreach ($zeilen as $zeile) {
		
			$neu = $this->zeileLesen(explode(";", $zeile));

			
			
			if ($neu !== true) {
				$result[] = $neu;
			}
			
			if (count($result) == $limit) {
				break;
			}
			
		}
	
		return $result;
	}
	
	private function zeileLesen($werte) {
		
		if (isset($werte[0]) && isset($werte[1])) {
		
			$name = $werte[0];
			$verkauft = $werte[1];
			$istLeer = false;
			
			if ($hatMenge = isset($werte[2])) {
				$menge = $werte[2];
				if ($menge == $verkauft) {
					$istLeer = true;
				}
				$prozent = number_format($verkauft / $menge * 100, 0);
			} else {
				$menge = 0;
				$prozent = 0;
			}
		
			return Array("Name" => $name, "Verkauft" => $verkauft, 
				"HatMenge" => $hatMenge, "Menge" => $menge, "IstLeer" => $istLeer,
				"Prozent" => $prozent);
		} else {
			return false;
		}
		
	}
	
	private function limitAuslesen() {
	
		if (isset($_COOKIE["verkaufsstatistikAnzahl"])) {
			$limit = $_COOKIE["verkaufsstatistikAnzahl"];
		} else {
			$limit = 8;
		}
	
		if (isset($_GET["verkaufsstatistikAnzahl"])) {
		
			if ($_GET["verkaufsstatistikAnzahl"] == "mehr") {
				$limit++;
            } else if (is_numeric($_GET["verkaufsstatistikAnzahl"]) and $_GET["verkaufsstatistikAnzahl"] > 0) {
                $limit = $_GET["verkaufsstatistikAnzahl"];
			} else {
				$limit = max($limit - 1, 1);
			}
		
		}
		
		setcookie("verkaufsstatistikAnzahl", $limit);
		return $limit;
		
	}
}
?>