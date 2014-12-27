<?php

class DMX {
  
  private $devices=array();
  
  private $status=array();
  
  public function DMX(){
    
    for($i=0;$i<512;$i++) {
      $this->status[$i]=0;
    }
  }
  
  function addDevice($device) {
    $this->devices[]=$device;
  }
  
  function render(){
    foreach($this->devices as $device) {
      $ch=$device->getChannels();
      for($i=0;$i<$device->getSize();$i++) {
        $this->status[$i+$device->getStartChannel()-1]=$ch[$i];
      }
    }
  }
  
  function send(){
    
    //var_dump($this->status);
    $url = 'http://151.217.34.32:9090/set_dmx';
    $data = array('u' => '1', 'd' => implode(",",$this->status));
    //var_dump($data);
    
    // use key 'http' even if you send the request to https://...
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
  }
}
