<?php
/**
 * Created by PhpStorm.
 * User: Magomed Khamidov
 * Date: 21.07.2018
 * Time: 23:01
 */

namespace Lhttp\System\Interfaces;

/**
 * Interface IUserAgent
 * @package Lhttp\System
 */
interface IUserAgent
{
  /**
   * @param array $filter
   * @return string
   */
  public function random(array $filter = []): string;
}