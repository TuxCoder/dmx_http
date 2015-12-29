<?php
namespace DmxHttp\Device;


interface Device
{
    public function getStartChannel();

    /**
     * @param $t    time in seconds
     * @return mixed
     */
    public function calc($t);

    /**
     * @return int
     */
    public function getSize();

    /**
     * @return int[$this->getSize()]
     */
    public function getChannels();
}