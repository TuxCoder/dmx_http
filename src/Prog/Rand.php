<?php
namespace DmxHttp\Prog;

class Rand
{
    private $dmx;
    private $spots;

    public function __construct($dmx)
    {
        $this->dmx = $dmx;
        $this->spots = $this->dmx->getDevices();
    }

    function run()
    {
        define("MAX", 255);
        while (1) {

            for ($i = 0; $i < 8; $i++) {
                $this->spots[$i]->reset();
                $color = rand(0, 2);
                $this->spots[$i]->setMode(255);
                switch ($color) {
                    case 0:
                        $this->spots[$i]->setRed(MAX);
                        break;
                    case 1:
                        $this->spots[$i]->setGreen(MAX);
                        break;
                    case 2:
                        $this->spots[$i]->setBlue(MAX);
                        break;
                }
                //$this->spots[$i]->setRGB(rand(0, MAX), rand(0, MAX), rand(0, MAX));
            }

            $this->dmx->send();
            //usleep(300000);
            usleep(300000);
        }
    }
}
