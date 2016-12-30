<?php
namespace DmxHttp\Prog;

class ColorLight {
  private $dmx;
  private $devices;
  
  
  public function __construct($dmx) {
    $this->dmx=$dmx;
    $this->devices=$this->dmx->getDevices();
  }
  
  public function run(){

    $fps=1e2;
    $speed=1e1;

    $x=0;
    while(1) {
      list($r,$g,$b)=\DmxHttp\Util\Color::HSV2RGB($x,1,1);


      for($i=0;$i<8;$i++) {
        $bight=100;
        $this->devices[$i]->setRGB($r*$bight,$g*$bight,$b*$bight);
      }
      
      $this->dmx->send();
      $x=$x+1/$fps;
      if($x>1) {
        $x--;
      }
      usleep(1/$fps*1e6/$speed);
    }
  }
} 
