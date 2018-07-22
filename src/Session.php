<?php
/**
 * Created by PhpStorm.
 * User: Magomed Khamidov
 * Date: 22.07.2018
 * Time: 2:42
 */

namespace Lhttp;


use Lhttp\System\Interfaces\IRequest;

class Session
{
  /**
   * @var array Request item
   */
  protected $_requests;

  /**
   * @var resource
   */
  protected $_handler;

  /**
   * Session constructor.
   * @param array $requests
   */
  public function __construct(array $requests)
  {
    $this->_requests = $requests;
    $this->_handler = curl_multi_init();
  }

  /**
   * @return $this
   */
  public function initialize()
  {
    /** @var IRequest $request */
    foreach ($this->_requests as $request) {
      curl_multi_add_handle($this->_handler, $request->getHandler());
    }
    return $this;
  }

  /**
   * Running multi cUrl
   */
  public function run()
  {
    do curl_multi_exec($this->_handler, $active); while ($active);
  }

  /**
   * Deleting cUrl resources
   */
  public function destruct()
  {
    /** @var IRequest $request */
    foreach ($this->_requests as $request) {
      curl_multi_remove_handle($this->_handler, $request->getHandler());
      curl_close($request->getHandler());
    }
    curl_multi_close($this->_handler);
  }
}