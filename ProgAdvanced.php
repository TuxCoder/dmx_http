<?php
require_once "SignalSawtooth.php";
require_once "SignalRectangel.php";
require_once "SignalRamp.php";
require_once "SignalRandom.php";

class ProgAdvanced {
  private $dmx;
  private $spots;
  
  public function ProgAdvanced($dmx) {
    $this->dmx=$dmx;
    $this->spots=$this->dmx->getDevices();
  }
  
  function run(){
    
    foreach($this->spots as $spot) {
      $spot->addSignal(new SignalRectangel(0,0.1,[1,1,1,0,0]));
    }
    
    $this->spots[0]->addSignal(new SignalRamp(0,3,[0,0,1,0,0]));
    $this->spots[4]->addSignal(new SignalRamp(0,3,[0,0,1,0,0]));
    
    $this->spots[1]->addSignal(new SignalRamp(2.5,3,[0,1,0,0,0]));
    $this->spots[3]->addSignal(new SignalRamp(2.5,3,[0,1,0,0,0]));
      
    $this->spots[2]->addSignal(new SignalRamp(5,3,[1,0,0,0,0]));
      
      foreach($this->spots as $spot) {
        $spot->addSignal(new SignalRectangel(8,0.1,[1,1,1,0,0]));
          $spot->addSignal(new SignalRandom(8,7,[1,1,1,0,0]));
      }
    $this->spots[0]->addSignal(new SignalRamp(15,3,[0,0,1,0,0]));
    $this->spots[1]->addSignal(new SignalRectangel(15,3,[0,1,0,0,0]));
    $this->spots[2]->addSignal(new SignalRectangel(15,3,[1,0,0,0,0]));
    $this->spots[3]->addSignal(new SignalRectangel(15,3,[0,1,0,0,0]));
    $this->spots[4]->addSignal(new SignalRamp(15,3,[0,0,1,0,0]));
    
    $this->spots[0]->addSignal(new SignalRectangel(18,0.5,[0,0,1,0,0]));
    $this->spots[1]->addSignal(new SignalRectangel(18.5,0.5,[0,1,0,0,0]));
    $this->spots[2]->addSignal(new SignalRectangel(19,0.5,[1,0,0,0,0]));
    $this->spots[3]->addSignal(new SignalRectangel(19.5,0.5,[0,1,0,0,0]));
    $this->spots[4]->addSignal(new SignalRectangel(20,0.5,[0,0,1,0,0]));
      
    $this->spots[4]->addSignal(new SignalRectangel(20,0.5,[0,0,1,0,0]));
    $this->spots[3]->addSignal(new SignalRectangel(21,0.5,[0,1,0,0,0]));
    $this->spots[2]->addSignal(new SignalRectangel(21.5,0.5,[1,0,0,0,0]));
    $this->spots[1]->addSignal(new SignalRectangel(22,0.5,[0,1,0,0,0]));
    $this->spots[0]->addSignal(new SignalRectangel(22.5,0.5,[0,0,1,0,0]));
      
      foreach($this->spots as $spot) {
          $spot->addSignal(new SignalRandom(23,7,[1,1,1,0,0]));
      }
    
      $start=0;
      
    $x=$start;
    while(1) {
      for($i=0;$i<5;$i++) {
        $this->spots[$i]->calc($x);
      }
      
      $this->dmx->send();
      usleep(10000);
      
      $x+=0.05;
      if($x>30)
        $x=$start;
    }
  }
}
