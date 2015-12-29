<?php
namespace DmxHttp\Device;


use DmxHttp\Signal\Signal;

abstract class Device
{
    protected $startChannel;

    /**
     * @var int[$this->getSize()]
     */
    protected $channels;

    /**
     * @var Signal[]
     */
    protected $signals=[];

    public function __construct($startChannel)
    {
        $this->startChannel=$startChannel;
        $this->reset();
    }

    public function getStartChannel() {
        return $this->startChannel;
    }

    /**
     * @return int
     */
    public abstract function getSize();

    /**
     * @return int[$this->getSize()]
     */
    public function getChannels() {
        return $this->channels;
    }


    public function reset(){
        $this->channels=[];
        for($i=0;$i<$this->getSize();$i++) {
            $this->channels[$i]=0;
        }
    }

    public function addSignal(Signal $signal) {
        $signals[]=$signal;
    }

    /**
     * @param $t    time in seconds
     * @return mixed
     */
    public function calc($x) {
        $this->reset();

        foreach($this->signals as $signal) {
            $values=$signal->getValues($x);
            //var_dump($values);
            $this->red    +=$values[0];
            $this->green  +=$values[1];
            $this->blue   +=$values[2];
            $this->strabo +=$values[3];
            $this->mode   +=$values[4];
        }

        $this->red    =min(100,$this->red);
        $this->green  =min(100,$this->green);
        $this->blue   =min(100,$this->blue);
        $this->strabo =min(100,$this->strabo);
        $this->mode   =min(100,$this->mode);
    }
}