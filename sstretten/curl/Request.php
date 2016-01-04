<?php

namespace sstretten\curl;

class Request
{
  private $uri;
  private $method;
  private $headers;
  private $body;

  private function __construct()
  {
  }

  public static function Create()
  {
    return new Request();
  }

  public function setUri($value)
  {
    $this->uri = $value;
    return $this;
  }

  public function setMethod($value)
  {
    $this->method = $value;
    return $this;
  }

  public function setHeaders($value)
  {
    $this->headers = $value;
    return $this;
  }

  public function setBody($value)
  {
    $this->body = $value;
    return $this;
  }

  public function getUri()
  {
    return $this->uri;
  }

  public function getMethod()
  {
    return $this->method;
  }

  public function getHeaders()
  {
    return $this->headers;
  }

  public function getBody()
  {
    return $this->body;
  }
}
