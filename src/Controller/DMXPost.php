<?php
namespace DmxHttp\Controller;

use DmxHttp\Device\Device;
use DmxHttp\Util\Logger;

class DMXPost extends DMX
{

    private $devices = array();

    private $status = array();

    private $data_old = null;

    private $curl;

    private $universe = '0';

    public function __construct()
    {

        for ($i = 0; $i < 512; $i++) {
            $this->status[$i] = 0;
        }


        $this->curl = curl_init();
    }

    function addDevice(Device $device)
    {
        $this->devices[] = $device;
    }

    function getDevices()
    {
        return $this->devices;
    }


    function render()
    {
        foreach ($this->devices as $device) {
            $ch = $device->getChannels();
            for ($i = 0; $i < $device->getSize(); $i++) {
                $this->status[$i + $device->getStartChannel() - 1] = $ch[$i];
            }
        }
    }

    function send()
    {
        $this->render();
        $this->transmit();
    }

    function transmit()
    {

        Logger::getInstance("dmx.http")->debug("prepare send");
        $url = str_replace("&amp;", "&", urldecode(trim("http://151.217.0.26:9090/set_dmx")));

        $data = array('u' => $this->universe, 'd' => implode(",", $this->status));

        if ($this->data_old === $data) {
            return;
        }
        $this->data_old = $data;

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Connection: Keep-Alive',
            'Keep-Alive: 300'
        ));
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        Logger::getInstance("dmx.http")->debug("send", [$data]);

        curl_exec($this->curl);
    }
}
