<?php

class ProgRunLight {
  private $dmx;
  private $spots;
  
  
  public function ProgRunLight($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  public function run(){
    $x=0;
    while(1) {
      for($i=0;$i<5;$i++) {
        $y=max(sin(($i+$x)*1.5),0);
        $val=round($y*100);
        
        var_dump($val);
        $this->spots[$i]->setRGB($val,$val,$val);
      }
      
      $this->dmx->send();
      $x+=0.2;
      usleep(30000);
    }
  }
} 
