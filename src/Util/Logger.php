<?php
namespace DmxHttp\Util;

use Monolog\Handler\StreamHandler;

class Logger
{

    /**
     * @var Logger[];
     */
    static private $instances=[];

    private function __construct()
    {
    }

    /**
     * @param $channel
     * @return \Monolog\Logger
     */
    static public function getInstance($channel){
        if(!isset(self::$instances[$channel])) {
            self::$instances[$channel]=new \Monolog\Logger($channel);
            $level=\Monolog\Logger::DEBUG;
            switch($channel) {
                case "dmx.http":
                    $level=\Monolog\Logger::DEBUG;
                    break;
            }
            self::$instances[$channel]->pushHandler(new StreamHandler('/dev/fd/0', $level));
        }
        return self::$instances[$channel];
    }
}