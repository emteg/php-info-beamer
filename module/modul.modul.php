<?php
abstract class Modul {
	protected $templateVars = Array();
	
	abstract public function datenLaden($datenbank);
	
	public function getTemplateVars() {
		return $this->templateVars;
	}
	
	public function getName() {
		return get_class($this);
	}
  
  public function getFlipDotOutput($lines = 2) {
    return "No FlipDot output\nfor this module :/";
  }
}
?>