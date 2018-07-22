<?php
/**
 * Created by PhpStorm.
 * User: Magomed Khamidov
 * Date: 21.07.2018
 * Time: 23:00
 */

namespace Lhttp\System;


use Campo\UserAgent as UA;
use Exception;
use Lhttp\System\Interfaces\IUserAgent;

class UserAgent implements IUserAgent
{
  /**
   * @param array $filter
   * @return string
   * @throws Exception
   */
  public function random(array $filter = ['device_type' => ['Desktop']]): string
  {
    return UA::random($filter);
  }
}