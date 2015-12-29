<?php
/**
 * Created by PhpStorm.
 * User: norbert
 * Date: 12/29/15
 * Time: 8:42 PM
 */

namespace DmxHttp;


class Scanner implements Device
{
    private $startChannel;

    private $x=0;
    private $y=0;
    private $color=0;
    private $mode=0;
    private $status=true;

    public function __construct($channel)
    {
        $this->startChannel=$channel;
    }

    public function getStartChannel()
    {
        return $this->startChannel;
    }

    /**
     * @param $t    time in seconds
     * @return mixed
     *
     * x
     * y
     * c color
     * g mode
     * s status <255 off, 255 on
     */
    public function calc($t)
    {

    }

    public function getChannels()
    {
        return [$this->x,$this->y,$this->color,$this->mode,$this->status?255:0];
    }

    function getSize(){
        return 5;
    }

}