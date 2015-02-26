<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/init.php");

$crumbs = explode("/", $_SERVER["REQUEST_URI"]);

print_r($crumbs);

exit();

$result = array(
  'code' => 0,
  'message' => '',
  'payload' => ''
);

$action_whitelist = array(
  'create',
  'retrieve',
  'update',
  'delete'
);

$action_whitelist = array(
  'create',
  'retrieve',
  'update',
  'delete'
);

$action = (isset($_GET['action']) && in_array($_GET['action'], $action_whitelist)) ? $_GET['action'] : '';
$position = (isset($_GET['position']) && $_GET['position'] > -1) ? $_GET['position'] : '';

switch($action) {

  case 'retrieve':
    $sensor = new Sensor();
    $sensor->set_position($position);
    $sensor->load();
    $attributes = $sensor->get_attributes();
    $result['code'] = 1;
    $result['message'] = 'Success';
    $result['payload'] = $attributes;
    break;

  default:
    $result['code'] = -1;
    $result['message'] = "Missing or invalid action";
    break;

}

exit(json_encode($result));

?>
