<?php
namespace DmxHttp\Device;


class Scanner extends Device
{

    public function __construct($channel)
    {
        parent::__construct($channel);
    }

    public function setX($val){
        $this->channels[0]=$val;
    }

    public function setY($val){
        $this->channels[1]=$val;
    }

    public function setColor($val){
        $this->channels[2]=$val;
    }

    public function setMode($val){
        $this->channels[3]=$val;
    }

    public function setStatus($val){
        $this->channels[4]=$val?255:0; //<255 off, 255 on
    }

    function getSize(){
        return 5;
    }

}