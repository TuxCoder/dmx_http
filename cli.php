<?php

use DmxHttp\Controller\DMXWebSocket;
use DmxHttp\Device\Spot;
use DmxHttp\Prog\Morse;
use DmxHttp\Device\Scanner;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class cli
{
    /**
     * @var \DmxHttp\Controller\DMX
     */
    private $dmx;
    private $spots;

    function run()
    {
        $this->dmx = new \DmxHttp\Controller\DMXPost();

        $this->dmx->addDevice(new Spot(6));
        $this->dmx->addDevice(new Spot(12));
        $this->dmx->addDevice(new Spot(18));
        $this->dmx->addDevice(new Spot(24));
        $this->dmx->addDevice(new Spot(30));
        $this->dmx->addDevice(new Spot(36));
        $this->dmx->addDevice(new Spot(42));
        $this->dmx->addDevice(new Spot(48));
        $this->dmx->addDevice(new Scanner(300));
        $this->dmx->addDevice(new Scanner(305));
        $this->dmx->addDevice(new Scanner(310));
        $this->dmx->addDevice(new Scanner(314));

        $console = new \Symfony\Component\Console\Application();


        $console->register("ls")
            ->setDefinition(array(//new InputArgument('dir', InputArgument::REQUIRED, 'Directory name'),
            ))
            ->setDescription("list devices")
            ->
            setCode(function (\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {

                $table = new \Symfony\Component\Console\Helper\Table($output);
                $table
                    ->setHeaders(array('Start Channel', 'Type', 'status'));

                foreach ($this->dmx->getDevices() as $device) {
                    $table->addRow([$device->getStartChannel(), get_class($device), '[' . implode(',', $device->getChannels()) . ']']);
                }
                $table->render();
            });


        $console->register("run")
            ->setDefinition(array(
                new InputArgument('device', InputArgument::REQUIRED, 'start channel of a device'),
                new InputArgument('method', InputArgument::REQUIRED, 'method'),
                new InputArgument('args', InputArgument::IS_ARRAY, 'arguments')
            ))
            ->setDescription("set command")
            ->
            setCode(function (InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output) {
                $device=null;
                foreach ($this->dmx->getDevices() as $_device) {
                    if($_device->getStartChannel()==$input->getArgument("device")) {
                        $device=$_device;
                        break;
                    }
                }

                if($device===null) {
                    $output->writeln("<error>can't find device</error>");
                    return 1;
                }

                $method=$input->getArgument("method");
                $args=$input->getArgument("args");
                call_user_func_array([$device,$method],$args);
                $this->dmx->send();

            });

        $console->run();

    }

}

require __DIR__ . '/vendor/autoload.php';

$cli = new cli();

$cli->run();