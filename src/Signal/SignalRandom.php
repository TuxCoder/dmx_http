<?php
namespace DmxHttp\Signal;

class SignalRandom implements Signal {
  
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
    $y0= $x>=0&&$x<=$this->width?rand(0,100):0;
    $y1= $x>=0&&$x<=$this->width?rand(0,100):0;
    $y2= $x>=0&&$x<=$this->width?rand(0,100):0;
    $y3= $x>=0&&$x<=$this->width?rand(0,100):0;
    $y4= $x>=0&&$x<=$this->width?rand(0,100):0;
    return [$y0,$y1,$y2,$y3,$y4];
  }
}
