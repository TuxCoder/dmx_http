<?php
namespace DmxHttp\Device;

class Spot extends Device {
  
  function __construct($startChannel){
    parent::__construct($startChannel);
  }
  
  function setRGB($red,$green,$blue) {
    $this->setRed($red);
    $this->setGreen($green);
    $this->setBlue($blue);
  }

  /**
   * @param int $val 0-255
   */
  public function setRed($val){
    $this->channels[0]=$val;
  }

  /**
   * @param int $val 0-255
   */
  public function setGreen($val){
    $this->channels[1]=$val;
  }

  /**
   * @param int $val 0-255
   */
  public function setBlue($val){
    $this->channels[2]=$val;
  }

  /**
   * @param int $val 0-255
   */
  public function setStrabo($val){
    $this->channels[3]=$val;
  }

  /**
   * @param int $val 0-255
   */
  public function setMode($val){
    $this->channels[4]=$val;
  }
  
  function getSize(){
    return 5;
  }

}  
