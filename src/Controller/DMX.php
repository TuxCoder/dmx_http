<?php
namespace DmxHttp\Controller;

use DmxHttp\Device\Device;

abstract class DMX {


  /**
   * @param Device $device
   * @return mixed
   */
  abstract public function addDevice(Device $device);


  /**
   * @return Device[]
   */
  abstract public function getDevices();

  /**
   * @return get the current values of the
   */
  protected function render(){
    foreach($this->devices as $device) {
      $ch=$device->getChannels();
      for($i=0;$i<$device->getSize();$i++) {
        $this->status[$i+$device->getStartChannel()-1]=$ch[$i];
      }
    }
  }

  
  protected abstract function transmit();

  public function send() {
    $this->render();
    $this->transmit();

  }

}
