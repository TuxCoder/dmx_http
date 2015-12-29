<?php
namespace DmxHttp\Prog;

class RunLight {
  private $dmx;
  private $spots;
  
  
  public function __construct($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  public function run(){
    $x=0;
    while(1) {
      for($i=0;$i<5;$i++) {
        $y=max(sin(($i+$x)*1.5),0);
        $val=round($y*100);

        $this->spots[$i]->setRGB($val,$val,$val);
      }
      
      $this->dmx->send();
      $x+=0.2;
      usleep(30000);
    }
  }
} 
