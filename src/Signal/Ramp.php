<?php
namespace DmxHttp\Signal;


class Ramp implements Signal {
  
  private $startAt;
  private $width;
  private $wights;
  
  public function __construct($startAt=0,$width=1,array $wights=[1]) {
    if($width<=0 || count($wights) === 0) {
      throw new \InvalidArgumentException("wdith has to be greater than 0");
    }

    $this->startAt =$startAt;
    $this->width =$width;
    $this->wights=$wights;
    Logger::getInstance("singal.ramp")->debug("created: ".$startAt.":".$width.":".$wights);
  }
  
  public function getValues($x) {
    $x=$x-$this->startAt;
    $y= $x>=0&&$x<=$this->width?$x*100/$this->width:0;
    $out=[];
    foreach($this->wights as $wight) {
      $out[]=$wight*$y;
    }
    return $out;
  }
}
