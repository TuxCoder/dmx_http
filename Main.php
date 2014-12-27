<?php
require "Spot.php";
require "DMX.php";
require "MorseCode.php";

class Main {
  private $dmx;
  
  function run(){
    $this->dmx=new DMX();
    $this->spots=array();
    $this->spots[]=new Spot(6);
    $this->spots[]=new Spot(12);
    $this->spots[]=new Spot(18);
    $this->spots[]=new Spot(24);
    $this->spots[]=new Spot(30);
    $this->dmx->addDevice($this->spots[0]);
    $this->dmx->addDevice($this->spots[1]);
    $this->dmx->addDevice($this->spots[2]);
    $this->dmx->addDevice($this->spots[3]);
    $this->dmx->addDevice($this->spots[4]);
    
    while(1) {
      $this->morese(MorseCode::convert("wearesweden"));
    }
    $toogle=true;
    define("MAX",50);
    while(1) {
      for($i=0;$i<5;$i++) {
        $this->spots[$i]->setRGB(rand(0,MAX),rand(0,MAX),rand(0,MAX));
      }
      
      
      $this->dmx->render();
      $this->dmx->send();
      usleep(300000);
    }
  }
  
  private $bright=30;
  
  function morese($string) {
    foreach(str_split($string) as $command) {
      var_dump($command);
      switch($command) {
        case ".":
          $this->short($this->spots);
          break;
        case "-":
          $this->long($this->spots);
          break;
        default:
      }
      
      $this->dmx->render();
      $this->dmx->send();
    }
  }
  
  function long($spots) {
    foreach($spots as $spot) {
      $spot->setRGB($this->bright,$this->bright,$this->bright);
    }
    $this->dmx->render();
    $this->dmx->send();
    usleep(450000); //light
    foreach($spots as $spot) {
      $spot->setRGB(0,0,0);
    }
    $this->dmx->render();
    $this->dmx->send();
    usleep(150000); //dark
  }
  
  function short($spots) {
    foreach($spots as $spot) {
      $spot->setRGB($this->bright,$this->bright,$this->bright);
    }
    $this->dmx->render();
    $this->dmx->send();
    usleep(150000); //light
    foreach($spots as $spot) {
      $spot->setRGB(0,0,0);
    }
    $this->dmx->render();
    $this->dmx->send();
    usleep(150000);//dark
  }
}

$main=new Main();

$main->run();
