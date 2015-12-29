<?php
namespace DmxHttp;

class Spot implements Device {
  private $startChannel =0;
  private $red=0;
  private $green=0;
  private $blue=0;
  private $strabo=0;
  private $mode=0;
  private $signals=array();
  
  function __construct($startChannel){
    $this->startChannel=$startChannel;
  }
  
  function setRGB($red,$green,$blue) {
    $this->red=$red;
    $this->green=$green;
    $this->blue=$blue;
  }
  
  function getChannels(){
    return array($this->red,$this->green,$this->blue,$this->strabo,$this->mode);
  }
  
  function getStartChannel() {
    return $this->startChannel;
  }
  
  function getSize(){
    return 5;
  }
  
  function addSignal($signal){
    $this->signals[]=$signal;
  }
  
  function reset(){
    $this->red    =0;
    $this->green  =0;
    $this->blue   =0;
    $this->strabo =0;
    $this->mode   =0;
  }
  
  function calc($x) {
    $this->reset();
    
    foreach($this->signals as $signal) {
      $values=$signal->getValues($x);
      //var_dump($values);
      $this->red    +=$values[0];
      $this->green  +=$values[1];
      $this->blue   +=$values[2];
      $this->strabo +=$values[3];
      $this->mode   +=$values[4];
    }
    
    $this->red    =min(100,$this->red);
    $this->green  =min(100,$this->green);
    $this->blue   =min(100,$this->blue);
    $this->strabo =min(100,$this->strabo);
    $this->mode   =min(100,$this->mode);
  }
}  
