<?php

use DmxHttp\DMXWebSocket;
use DmxHttp\Spot;
use DmxHttp\ProgMorse;
use DmxHttp\Scanner;

class Main {
  private $dmx;
  private $spots;
  
  function run(){
    $this->dmx=new \DmxHttp\DMXPost();
    $this->spots=array();
    $this->spots[]=new Spot(6);
    $this->spots[]=new Spot(12);
    $this->spots[]=new Spot(18);
    $this->spots[]=new Spot(24);
    $this->spots[]=new Spot(30);
    $this->spots[]=new Spot(36);
    $this->spots[]=new Spot(42);
    $this->spots[]=new Spot(48);
    $this->spots[]=new Scanner(300);
    $this->spots[]=new Scanner(305);
    $this->spots[]=new Scanner(310);
    $this->spots[]=new Scanner(314);

    $this->dmx->addDevice($this->spots[0]);
    $this->dmx->addDevice($this->spots[1]);
    $this->dmx->addDevice($this->spots[2]);
    $this->dmx->addDevice($this->spots[3]);
    $this->dmx->addDevice($this->spots[4]);
    
    //$prog=new ProgMorse($this->dmx,"tardis__");
    //$prog=new ProgRand($this->dmx);
    $prog=new DmxHttp\ProgRunLight($this->dmx);
    //$prog=new ProgCounter($this->dmx);
    //$prog=new ProgRamp($this->dmx);
    //$prog=new DmxHttp\ProgAdvanced($this->dmx);
    $prog->run();
  }
  
}

require __DIR__ . '/vendor/autoload.php';

$main=new Main();

$main->run();
