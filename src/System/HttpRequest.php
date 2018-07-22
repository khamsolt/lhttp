<?php
/**
 * Created by PhpStorm.
 * User: Magomed Khamidov
 * Date: 21.07.2018
 * Time: 20:59
 */

namespace Lhttp\System;


use Lhttp\System\Interfaces\IRequest;
use Lhttp\System\Interfaces\IUserAgent;

class HttpRequest implements IRequest
{
  /**
   * @var string
   */
  protected $_url;

  /**
   * @var resource
   */
  protected $_handler;

  /**
   * Request constructor.
   * @param string $url
   */
  public function __construct(string $url)
  {
    $this->_url = $url;
    $this->_handler = curl_init();
    curl_setopt($this->_handler, CURLOPT_URL, $this->_url);
    curl_setopt($this->_handler, CURLOPT_RETURNTRANSFER, true);
  }

  /**
   * @param array $params
   */
  public function addGet(array $params)
  {
    if (empty($params)) return;
    curl_setopt($this->_handler, CURLOPT_URL, $this->_url . '?' . http_build_str($params));
  }

  /**
   * @param array $params
   */
  public function addPost(array $params)
  {
    if (empty($params)) return;
    curl_setopt($this->_handler, CURLOPT_POST, true);
    curl_setopt($this->_handler, CURLOPT_POSTFIELDS, $params);
  }

  /**
   * @param array $params
   */
  public function addHttpHeaders(array $params)
  {
    curl_setopt($this->_handler, CURLOPT_HTTPHEADER, $params);
  }

  /**
   * @param IUserAgent $userAgent
   */
  public function addUserAgent(IUserAgent $userAgent)
  {
    curl_setopt($this->_handler, CURLOPT_USERAGENT, $userAgent->random());
  }

  /**
   * @param string $proxyHost
   * @param string $userpwd
   */
  public function addProxyParams(string $proxyHost, string $userpwd)
  {
    if (empty($params)) return;
    curl_setopt($this->_handler, CURLOPT_PROXY, $proxyHost);
    curl_setopt($this->_handler, CURLOPT_PROXYUSERPWD, $userpwd);
  }

  /**
   * @return resource
   */
  public function getHandler()
  {
    return $this->_handler;
  }

  /**
   * @return string
   */
  public function getContent(): string
  {
    return curl_multi_getcontent($this->_handler);
  }

  /**
   * @return int
   */
  public function getErrorCode()
  {
    return curl_error($this->_handler);
  }

  /**
   * @return string
   */
  public function getError(): string
  {
    return curl_error($this->_handler);
  }

  /**
   * @return array
   */
  public function getInfo(): array
  {
    if (empty($this->_info)) $this->_info = curl_getinfo($this->_handler) ?? [];
    return $this->_info;
  }
}