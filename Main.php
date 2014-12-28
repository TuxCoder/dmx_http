<?php
require "Spot.php";
require "DMX.php";
require "MorseCode.php";
require "ProgMorse.php";
require "ProgRand.php";
require "ProgRunLight.php";
require "ProgCounter.php";

class Main {
  private $dmx;
  
  function run(){
    $this->dmx=new DMX();
    $this->spots=array();
    $this->spots[]=new Spot(6);
    $this->spots[]=new Spot(12);
    $this->spots[]=new Spot(18);
    $this->spots[]=new Spot(24);
    $this->spots[]=new Spot(30);
    $this->dmx->addDevice($this->spots[0]);
    $this->dmx->addDevice($this->spots[1]);
    $this->dmx->addDevice($this->spots[2]);
    $this->dmx->addDevice($this->spots[3]);
    $this->dmx->addDevice($this->spots[4]);
    
    //$prog=new ProgMorse($this->dmx,"beer");
    //$prog=new ProgRand($this->dmx);
    //$prog=new ProgRunLight($this->dmx);
    $prog=new ProgCounter($this->dmx);
    $prog->run();
  }
  
}

$main=new Main();

$main->run();
