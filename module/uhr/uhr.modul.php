<?php
class Uhr extends Modul {
	public function datenLaden($datenbank) {
		$this->templateVars["zeit"] = date("H:i");
	}
}
?>