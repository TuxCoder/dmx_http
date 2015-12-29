<?php
namespace DmxHttp;

interface DMX {


  /**
   * @param Device $device
   * @return mixed
   */
  public function addDevice(Device $device);


  public function getDevices();
  
  
  function render();
  
  function send();
  
  function transmit();
}
