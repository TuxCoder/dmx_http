<?php
namespace DmxHttp\Signal;

class SignalSawtooth implements Signal {
  
  private $startAt;
  private $width;
  private $wights;
  
  public function __construct($startAt=0,$width=1,$wights=[1,1,1,1,1]) {
    $this->startAt =$startAt;
    $this->width =$width;
    $this->wights=$wights;
  }
  
  public function getValues($x) {
    $x-=$this->startAt;
    $y= $x>=0&&$x<=$this->width?2*($x/$this->width-floor(1/2+$x/$this->width))*100:0;
    
    return [$y*$this->wights[0],$y*$this->wights[1],$y*$this->wights[2],0,0];
  }
}
