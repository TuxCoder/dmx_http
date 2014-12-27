<?php

class ProgRand {
  private $dmx;
  private $spots;
  
  public function ProgRand($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  function run(){
    define("MAX",25);
    while(1) {
      for($i=0;$i<5;$i++) {
        $this->spots[$i]->setRGB(rand(0,MAX),rand(0,MAX),rand(0,MAX));
      }
      
      $this->dmx->render();
      $this->dmx->send();
      usleep(300000);
    }
  }
}
