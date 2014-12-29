<?php
require_once "SignalSawtooth.php";
require_once "SignalRectangel.php";

class ProgAdvanced {
  private $dmx;
  private $spots;
  
  public function ProgAdvanced($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  function run(){
    
    $this->spots[0]->addSignal(new SignalSawtooth(0,4,[0,1,0,1]));
    $this->spots[0]->addSignal(new SignalSawtooth(0.3,4,[0,0,1,1,1]));
    $this->spots[1]->addSignal(new SignalSawtooth(0,10,[1,0,0,1,1]));
    
    $this->spots[3]->addSignal(new SignalRectangel(2,5));
    
    $x=0;
    while(1) {
      for($i=0;$i<5;$i++) {
        $this->spots[$i]->calc($x);
      }
      
      $this->dmx->send();
      usleep(100000);
      
      $x+=0.3;
      if($x>10)
        $x=0;
    }
  }
}
