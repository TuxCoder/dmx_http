<?php
namespace DmxHttp\Prog;

class Morse {
  private $dmx;
  private $spots;
  
  private $msg=" ";
  
  public function __construct($dmx,$msg) {
    $this->msg=$msg;
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  public function run(){
    while(1) {
      $this->morese(MorseCode::convert($this->msg));
    }
  }
  
  private $bright=30;
  
  function morese($string) {
    foreach(str_split($string) as $command) {
      switch($command) {
        case ".":
          $this->short($this->spots);
          break;
        case "-":
          $this->long($this->spots);
          break;
        case "_":
          usleep(1500000);
        default:
      }
      
      $this->dmx->send();
    }
  }
  
  function long($spots) {
    foreach($spots as $spot) {
      $spot->setRGB($this->bright,$this->bright,0);
    }
    $this->dmx->send();
    usleep(450000); //light
    foreach($spots as $spot) {
      $spot->setRGB(0,0,0);
    }
    $this->dmx->send();
    usleep(150000); //dark
  }
  
  function short($spots) {
    foreach($spots as $spot) {
      $spot->setRGB(0,0,$this->bright);
    }
    $this->dmx->send();
    usleep(150000); //light
    foreach($spots as $spot) {
      $spot->setRGB(0,0,0);
    }
    $this->dmx->send();
    usleep(150000);//dark
  }
} 
