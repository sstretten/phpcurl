<?php

namespace sstretten\curl;

class Response
{
  private $headers;
  private $http_code;
  private $body;

  public function setHttpCode($value)
  {
    $this->http_code = $value;
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

  public function getHttpCode()
  {
    return $this->http_code;
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
