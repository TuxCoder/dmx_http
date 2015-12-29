<?php
namespace DmxHttp;

use Hoa\Socket;
use Hoa\Websocket\Client;

class DMXWebSocket implements  DMX{

  private $ws;

  private $status=[];

  public function __construct()
  {
    $this->ws=new Client(new Socket\Client("tcp://151.217.22.63:9999/qlcplusWS"));
    $this->ws->setHost('151.217.22.63');

    try {
      $this->ws->connect();
    }catch(\Exception $e) {
      Logger::getInstance("ws")->error("can't connect to server");
      exit(1);
    }

    $this->ws->send("QLC+API|getChannelsValues|1|1|128");
    Logger::getInstance("ws")->debug("connected to server");

  }


  private $devices=[];

  /**
   * @param Device $device
   * @return mixed
   */
  public function addDevice(Device $device){
    $this->devices[]=$device;
  }


  /**
   *
   */
  public function getDevices() {
    return $this->devices;
  }
  
  
  function render() {
    foreach($this->devices as $device) {
      $ch = $device->getChannels();
      for ($i = 0; $i < $device->getSize(); $i++) {
        $this->status[$i + $device->getStartChannel() - 1] = $ch[$i];
      }
    }
  }
  
  function send() {
    $this->render();
    $this->transmit();

  }

  private $oldStatus=[];
  function transmit() {


    if($this->oldStatus===$this->status) {
      return;
    }

    foreach($this->status as $channel=>$value) {
      if(!isset($this->oldStatus[$channel]) || $this->oldStatus[$channel]!==$this->status[$channel]) {
        $data="CH|$channel|$value";
        Logger::getInstance()->debug($data,["ws"]);
        $this->ws->send($data);
      }
    }

    $this->oldStatus=$this->status;
  }
}
