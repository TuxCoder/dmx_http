<?php
namespace DmxHttp\Signal;


class SignalRamp implements Signal {
  
  private $startAt;
  private $width;
  private $wights;
  
  public function __construct($startAt=0,$width=1,$wights=[1,1,1,1,1]) {
    if($width<=0) {
      throw new \InvalidArgumentException("wdith has to be greater than 0");
    }

    $this->startAt =$startAt;
    $this->width =$width;
    $this->wights=$wights;
    Logger::getInstance("singal.ramp")->debug("created: ".$startAt.":".$width.":".$wights);
  }
  
  public function getValues($x) {
    $x-=$this->startAt;
    $y= $x>=0&&$x<=$this->width?$x*100/$this->width:0;
    return [$y*$this->wights[0],$y*$this->wights[1],$y*$this->wights[2],0,0];
  }
}
