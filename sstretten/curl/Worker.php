<?php

namespace sstretten\curl;

class Worker
{
  var $uri;

  public function Get(Request $request)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request->getUri());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $response = curl_exec($ch);
    $r = $this->ConvertCurlResponse($response, $ch);
    curl_close($ch);
    return $r;
  }

  public function Post(Request $request)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request->getUri());
    curl_setopt($ch, CURLOPT_POST, 1); //0 for a get request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getBody());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $response = curl_exec($ch);
    $r = $this->ConvertCurlResponse($response, $ch);
    curl_close($ch);
    return $r;
  }

  public function Delete(Request $request)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request->getUri());
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $response = curl_exec($ch);
    $r = $this->ConvertCurlResponse($response, $ch);
    curl_close($ch);
    return $r;
  }

  private function ConvertCurlResponse($response, $ch)
  {
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    $r = new Response();
    $r->setHeaders($this->http_parse_headers($header));
    $r->setHttpCode(curl_getinfo($ch, CURLINFO_HTTP_CODE));
    $r->setBody($body);
    return $r;
  }

  private function http_parse_headers($headers=false)
  {
    if($headers === false)
    {
        return false;
    }

    $headers = str_replace("\r","",$headers);
    $headers = explode("\n",$headers);

    foreach($headers as $value)
    {
        $header = explode(": ",$value);
        if($header[0] && !isset($header[1]))
        {
            $headerdata['status'] = $header[0];
        }
        elseif($header[0] && $header[1])
        {
            $headerdata[$header[0]] = $header[1];
        }
    }
    return $headerdata;
  }
}
