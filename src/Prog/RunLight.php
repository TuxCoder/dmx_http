<?php
namespace DmxHttp\Prog;

class RunLight {
  private $dmx;
  private $devices;


  public function __construct($dmx) {
    $this->dmx=$dmx;
    $this->devices=$this->dmx->getDevices();
  }

  public function run(){

    $fps=20;
    $speed=4;
    $speed2=1;
    $count=6;
    $bight=100;

    $x=0;
    while(1) {
      for($i=0;$i<$count;$i++) {
        $y=max(sin(($i+$x)*$speed),0);

        $y2=abs(sin(($i+$x)*$speed2));

        list($r,$g,$b)=\DmxHttp\Util\Color::HSV2RGB($y2,1,$y);
        $this->devices[$i]->setRGB($r*$bight,$g*$bight,$b*$bight);
      }

      $this->dmx->send();
      $x+=1/$fps;
      usleep(1/$fps*1e6);
    }
  }
}
