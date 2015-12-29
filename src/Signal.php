<?php
namespace DmxHttp;

interface Signal {

  /**
   * @param $x
   * @return array with values
   */
  public function getValues($x);
}
