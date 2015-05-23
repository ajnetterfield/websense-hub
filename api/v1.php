<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/init.php");

header("Content-Type: application/json");

$klein = new \Klein\Klein();

$klein->with("/api", function() use ($klein) {
  $klein->with("/v1", function() use ($klein) {

    $klein->respond("GET", "/import", function($req, $resp) { 
      $resp->json("importing...");
    });

    /* Sensors
    /**************************************************************************/

    $klein->respond("GET", "/sensors", function($req, $resp) {
      $conditions = $_GET;
      if (isset($conditions["limit"])) {
        $limit = $conditions["limit"];
        unset($conditions["limit"]);
      } else {
        $limit = -1;
      }
      $b_collection = Sensor::get_b_collection($conditions, $limit);
      $resp->json($b_collection);
    });

    $klein->respond("GET", "/sensors/[:rid]", function($req, $resp) {
      $model = new Sensor();
      $b_model = $model->set_rid($req->rid)->load()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("POST", "/sensors", function($req, $resp) {
      $attributes = json_decode(file_get_contents("php://input"));
      $model = new Sensor();
      $b_model = $model->set_attributes($attributes)->create()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("PUT", "/sensors/[:rid]", function($req, $resp) {
      $attributes = json_decode(file_get_contents("php://input"));
      $model = new Sensor();
      $b_model = $model->set_rid($req->rid)->set_attributes($attributes)->update()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("DELETE", "/sensors/[:rid]", function($req, $resp) {
      $model = new Sensor();
      $deleted = $model->set_rid($req->rid)->delete()->is_deleted();
      $resp->json($deleted);
    });

    /* Measurements
    /**************************************************************************/

    $klein->respond("GET", "/measurements", function($req, $resp) {
      $conditions = $_GET;
      if (isset($conditions["limit"])) {
        $limit = $conditions["limit"];
        unset($conditions["limit"]);
      } else {
        $limit = -1;
      }
      $b_collection = Measurement::get_b_collection($conditions, $limit);
      $resp->json($b_collection);
    });

    $klein->respond("GET", "/measurements/[:rid]", function($req, $resp) {
      $model = new Measurement();
      $b_model = $model->set_rid($req->rid)->load()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("POST", "/measurements", function($req, $resp) {
      $attributes = json_decode(file_get_contents("php://input"));
      $model = new Measurement();
      $b_model = $model->set_attributes($attributes)->create()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("PUT", "/measurements/[:rid]", function($req, $resp) {
      $attributes = json_decode(file_get_contents("php://input"));
      $model = new Measurement();
      $b_model = $model->set_rid($req->rid)->set_attributes($attributes)->update()->get_backbone_model();
      $resp->json($b_model);
    });

    $klein->respond("DELETE", "/measurements/[:rid]", function($req, $resp) {
      $model = new Measurement();
      $deleted = $model->set_rid($req->rid)->delete()->is_deleted();
      $resp->json($deleted);
    });

  });
});

$klein->dispatch();
