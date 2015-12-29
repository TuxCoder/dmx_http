<?php

use DmxHttp\Controller\DMXWebSocket;
use DmxHttp\Device\Spot;
use DmxHttp\Prog\Morse;
use DmxHttp\Device\Scanner;

class Main {
  private $dmx;
  private $spots;
  
  function run(){
    $this->dmx=new \DmxHttp\Controller\DMXPost();
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

    $this->dmx->addDevice(new Spot(6));
    $this->dmx->addDevice(new Spot(12));
    $this->dmx->addDevice(new Spot(18));
    $this->dmx->addDevice(new Spot(24));
    $this->dmx->addDevice(new Spot(30));
    $this->dmx->addDevice(new Spot(36));
    $this->dmx->addDevice(new Spot(42));
    $this->dmx->addDevice(new Spot(48));
    $this->dmx->addDevice(new Scanner(300));
    $this->dmx->addDevice(new Scanner(305));
    $this->dmx->addDevice(new Scanner(310));
    $this->dmx->addDevice(new Scanner(314));
    
    //$prog=new ProgMorse($this->dmx,"tardis__");
    $prog=new DmxHttp\Prog\Rand($this->dmx);
    //$prog=new DmxHttp\Prog\RunLight($this->dmx);
    //$prog=new ProgCounter($this->dmx);
    //$prog=new ProgRamp($this->dmx);
    //$prog=new DmxHttp\Prog\Advanced($this->dmx);
    $prog->run();
  }
  
}

require __DIR__ . '/vendor/autoload.php';

$main=new Main();

$main->run();
