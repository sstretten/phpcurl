# phpcurl

A small library to help with making curl calls in php.

##Usage

###Example Get Request

```php
use sstretten\curl;

$get_request = curl\Request::Create()
  ->setUri('http://localhost/example/api/person/123');

$worker = new curl\Worker();
$get_response = $worker->Get($post_request);
```

###Example Post Request

```php
use sstretten\curl;

$post_request = curl\Request::Create()
  ->setUri('http://localhost/example/api/person')
  ->setBody(json_encode(array('id'=>999, 'first'=>'John', 'last'=>'Doe')));

$worker = new curl\Worker();
$post_response = $worker->Post($post_request);
```

###Example Delete Request

```php
use sstretten\curl;

$get_request = curl\Request::Create()
  ->setUri('http://localhost/example/api/person/123');

$worker = new curl\Worker();
$get_response = $worker->Delete($post_request);
```
