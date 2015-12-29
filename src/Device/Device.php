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

    public function addSignal(Signal $signal,$offset=0) {
        $this->signals[]=$signal;
    }

    /**
     * @param $t    time in seconds
     * @return mixed
     */
    public function calc($x) {
        $this->reset();

        foreach($this->signals as $signal) {
            $values=$signal->getValues($x);
            foreach($values as $i=>$value) {
                $this->channels[$i]+=$value;
            }
        }
    }
}