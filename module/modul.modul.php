<?php
require_once "./klassen/einstellung.class.php";

abstract class Modul {
	protected $templateVars = Array();
	
	public function datenLaden($datenbank) {
    $this->getModulAnzeigeDauer($datenbank);
    $this->templateVars["zeit"] = date("H:i");
    
    $this->templateVars["alarmAnzeigen"] = 
        $this->getEinstellung("alarmAnzeigen", $datenbank);
    if ($this->templateVars["alarmAnzeigen"] == "alarmAnzeigen not set") {
      $this->templateVars["alarmAnzeigen"] = "false";
    }
    $this->templateVars["alarmText"] = 
        $this->getEinstellung("alarmText", $datenbank);
    $this->templateVars["strings"] = $this->loadStrings();
  }
	
	public function getTemplateVars() {
		return $this->templateVars;
	}
	
	public function getName() {
		return get_class($this);
	}
  
  public function getFlipDotOutput($lines = 2) {
    return "No FlipDot output\nfor this module :/";
  }
  
  public function getModulAnzeigeDauer($datenbank) {
    $this->templateVars["modulAnzeigeDauer"] = 
      $this->getEinstellung("ModulAnzeigeDauerSekunden", $datenbank);
    return $this->templateVars["modulAnzeigeDauer"];
  }
  
  public function getEinstellung($name, $datenbank) {
    $einstellung = new TEinstellung();
    $wert = $einstellung->read($name, $datenbank);
    
    if ($wert === false) {
      $wert = $name . " not set";
      $einstellung->create($name, $wert, $datenbank);
    }
    
    return $wert;
  }
  
  public function setEinstellung($name, $wert, $datenbank) {
    $einstellung = new TEinstellung();
    $einstellung->update($name, $wert, $datenbank);
  }
  
  public function loadStrings() {
    global $config;
    
    $result = Array();
    $temp = Array();
    $file = "strings.txt";
    $contents = file_get_contents($file);
    
    if ($contents !== false) {
      if (strpos($contents, "\r\n") === false) {
        $temp = explode("\n", $contents);
      } else {
        $temp = explode("\r\n", $contents);
      }
      
      foreach ($temp as $value) {
        if (strlen($value) > 0) {
          $values = explode("=", $value);
          if (count($values) == 2) {
            $result[$values[0]] = $values[1];
          }
        }
      }
    }

    return $result;
    
  }
}
?>