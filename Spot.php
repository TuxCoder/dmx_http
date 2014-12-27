<?php

class Spot {
  private $startChannel =0;
  private $red=0;
  private $green=0;
  private $blue=0;
  private $strabo=0;
  private $mode=0;
  
  function Spot($startChannel){
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
}  
