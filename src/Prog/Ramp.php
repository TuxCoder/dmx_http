<?php
namespace DmxHttp\Prog;


use DmxHttp\Util\Logger;
use DmxHttp\Controller\DMX;
use DmxHttp\Device\Spot;
use DmxHttp\Signal\Signal;

class Ramp {
  /**
   * @var DMX
   */
  private $dmx;

  /**
   * @var \DmxHttp\Device\Device[]
   */
  private $devices;
  
  
  public function __construct($dmx) {
    $this->dmx=$dmx;
    $this->devices=$this->dmx->getDevices();
  }
  
  public function run(){
    $x=0;
    while(1) {
      for($i=0;$i<5;$i++) {
        //2*(x/a-ceil(1/2+x/a))
        $_x=$x+$i-4;
        //$y=max( $_x-max($_x-1,0)*($_x) ,0)/2*100;
        //$y=max( $_x-2*max($_x-100,0) ,0);
        if(!($_x<1 && $_x>=0))
          $y=0;
        else 
          $y=abs( 2*($_x/1-floor(1/2+$_x/1)))*100;
          
        $val=round($y);
        if($this->devices[$i] instanceof Spot)  {
          $this->devices[$i]->setRGB($val,$val,$val);
        }
      }
      
      $this->dmx->send();
      $x+=0.05;
      if($x>5) {
        $x=0;
      }
      usleep(30000);
    }
  }
  
  
} 
