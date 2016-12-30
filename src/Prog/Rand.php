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
        $status=false;
        while (1) {

            $status=$status?false:true;
            for ($i = 0; $i < 5; $i++) {
                $this->spots[$i]->reset();
                $this->spots[$i]->setMode(255);
                if($status) {
                    $this->spots[$i]->setBlue(MAX);
                }else {
                    $this->spots[$i]->setRed(MAX);
                }
                /*$color = rand(0, 2);
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
                }*/
                //$this->spots[$i]->setRGB(rand(0, MAX), rand(0, MAX), rand(0, MAX));
            }

            $this->dmx->send();
            //usleep(300000);
            usleep(300000);
        }
    }
}
