<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/init.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/api/test_data.php");

header('Content-Type: application/json');

$result = array();

try {

  // URL
  $url = $_SERVER['REQUEST_URI'];
  $parsed_url = parse_url($url);
  $path = $parsed_url['path'];
  $rest_path = rtrim(preg_replace('#/api/v1/#', '', $path), '/');

  // GET Paramaters
  if (isset($parsed_url['query'])) {
    parse_str($parsed_url['query'], $params);
  } else {
    $params = array();
  }

  // POST Parameters
  $attributes = array();

  // PUT Parameters
  $_PUT = array();

  // DELETE Parameters
  $_DELETE = array();

  // Resource and ID
  $args = explode('/', $rest_path);
  $resource = isset($args[0]) ? urldecode($args[0]) : null;
  $id = isset($args[1]) ? urldecode($args[1]) : null;

  switch($_SERVER['REQUEST_METHOD']) {

    case 'GET':
      header("HTTP/1.0 200 OK", true, 200);
      $result = array(
        $test_data_1,
        $test_data_2,
        $test_data_3
      );
      // $result = $test_data_1;
      break;

    case 'POST':
      header("HTTP/1.0 200 OK", true, 200);
      $result['resource'] = $resource;
      if (isset($id)) $result['id'] = $id;
      $result['params'] = $params;
      $attributes = json_decode(file_get_contents('php://input'));
      $result['attributes'] = $attributes;
      break;

    case 'PUT':
      header("HTTP/1.0 200 OK", true, 200);
      parse_str(file_get_contents('php://input'), $_PUT);
      $result['resource'] = $resource;
      if (isset($id)) $result['id'] = $id;
      $result['params'] = $params;

      break;

    case 'DELETE':
      header("HTTP/1.0 200 OK", true, 200);
      parse_str(file_get_contents('php://input'), $_DELETE);
      break;

    default:
      header("HTTP/1.0 405 Method Not Allowed", true, 405);
      break;
  }

} catch (Exception $e) {
  header("HTTP/1.0 500 Internal Server Error", true, 500);
}

exit(json_encode($result));

?>
    