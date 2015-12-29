<?php
namespace DmxHttp\Prog;

use DmxHttp\Controller\DMX;
use DmxHttp\Util\Logger;
use DmxHttp\Device\Device;
use DmxHttp\Device\Scanner;
use DmxHttp\Device\Spot;
use DmxHttp\Signal\Random;
use DmxHttp\Signal\Rectangel;
use DmxHttp\Signal\Ramp;

class Advanced
{
    /**
     * @var DMX
     */
    private $dmx;

    /**
     * @var Device[]
     */
    private $devices;

    public function __construct($dmx)
    {
        $this->dmx = $dmx;
        $this->devices = $this->dmx->getDevices();
    }

    function run()
    {
        foreach ($this->devices as $device) {
            $device->reset();
            $this->dmx->send();
        }

        foreach ($this->devices as $device) {
            if($device instanceof Spot) {
                $device->addSignal(new Rectangel(0, 0.1, [1, 1, 1, 0, 0]));
            }

            if($device instanceof Scanner) {
                $device->addSignal(new Rectangel(0, 0.1, [1, 1, 1, 0, 1]));
            }

        }

        $this->devices[0]->addSignal(new Ramp(0, 3, [0, 0, 1, 0, 0]));
        $this->devices[4]->addSignal(new Ramp(0, 3, [0, 0, 1, 0, 0]));

        $this->devices[1]->addSignal(new Ramp(2.5, 3, [0, 1, 0, 0, 0]));
        $this->devices[3]->addSignal(new Ramp(2.5, 3, [0, 1, 0, 0, 0]));

        $this->devices[2]->addSignal(new Ramp(5, 3, [1, 0, 0, 0, 0]));

        foreach ($this->devices as $spot) {
            $spot->addSignal(new Rectangel(8, 0.1, [1, 1, 1, 0, 0]));
            $spot->addSignal(new Random(8, 7, [1, 1, 1, 0, 0]));
        }

        $this->devices[0]->addSignal(new Ramp(15, 3, [0, 0, 1, 0, 0]));
        $this->devices[1]->addSignal(new Rectangel(15, 3, [0, 1, 0, 0, 0]));
        $this->devices[2]->addSignal(new Rectangel(15, 3, [1, 0, 0, 0, 0]));
        $this->devices[3]->addSignal(new Rectangel(15, 3, [0, 1, 0, 0, 0]));
        $this->devices[4]->addSignal(new Ramp(15, 3, [0, 0, 1, 0, 0]));

        $this->devices[0]->addSignal(new Rectangel(18, 0.5, [0, 0, 1, 0, 0]));
        $this->devices[1]->addSignal(new Rectangel(18.5, 0.5, [0, 1, 0, 0, 0]));
        $this->devices[2]->addSignal(new Rectangel(19, 0.5, [1, 0, 0, 0, 0]));
        $this->devices[3]->addSignal(new Rectangel(19.5, 0.5, [0, 1, 0, 0, 0]));
        $this->devices[4]->addSignal(new Rectangel(20, 0.5, [0, 0, 1, 0, 0]));

        $this->devices[4]->addSignal(new Rectangel(20, 0.5, [0, 0, 1, 0, 0]));
        $this->devices[3]->addSignal(new Rectangel(21, 0.5, [0, 1, 0, 0, 0]));
        $this->devices[2]->addSignal(new Rectangel(21.5, 0.5, [1, 0, 0, 0, 0]));
        $this->devices[1]->addSignal(new Rectangel(22, 0.5, [0, 1, 0, 0, 0]));
        $this->devices[0]->addSignal(new Rectangel(22.5, 0.5, [0, 0, 1, 0, 0]));

        foreach ($this->devices as $spot) {
            $spot->addSignal(new Random(23, 7, [1, 1, 1, 0, 0]));
        }

        $start = 0;

        $time = $start;
        while (1) {
            Logger::getInstance("prog.advanced")->debug("time: ".$time);

            $this->dmx->calcAll($time);
            $this->dmx->send();
            usleep(100000);

            $time += 0.1;
            if ($time > 30)
                $time = $start;
        }
    }
}
