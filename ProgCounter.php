<?php

class ProgCounter {
  private $dmx;
  private $spots;
  
  
  public function ProgCounter($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  public function run(){
    $x=0;
    $val=30;
    while(1) {
      for($i=0;$i<5;$i++) {
        if(floor($x/pow(2,($i)))%2==1) {
          $this->spots[$i]->setRGB($val,$val,$val);
        }else {
          $this->spots[$i]->setRGB(0,0,0);
        }
      }
      
      $this->dmx->render();
      $this->dmx->send();
      $x+=1;
      usleep(1000000);
      echo "\n";
    }
  }
} 

