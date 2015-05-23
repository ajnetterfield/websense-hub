<?php

/*
 * Sensor functions.
 * Author: Alastair Netterfield
 * Revised: 20/03/2015
 */
class Object {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected $cluster;
  protected $position;
  protected $attributes;
  protected $deleted;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct() {
    $this->cluster = -1;
    $this->position = -1;
    $this->attributes = array();
    $this->deleted = false;
  }

  public function init($position=null, $attributes=array()) {
    global $db;
    $this->cluster = $db->get_cluster_id(static::$class_name);
    $this->position = $position;
    $this->attributes = $attributes;
    $this->deleted = false;
    return $this;
  }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  /* Setters (Chainable)
  /****************************************************************************/

  public function set_rid($rid) {
    $rid = str_replace("#", "", $rid);
    $pieces = split(":", $rid);
    $this->cluster = $pieces[0];
    $this->position = $pieces[1];
    return $this;
  }

  public function set_position($position) {
    $this->position = $position;
    return $this;
  }

  public function set_attributes($attributes) {
    $attributes = (array) $attributes;
    foreach ($attributes as $key => $value) {
      if (isset($value)) {
        $this->attributes[$key] = $value;
      }
    }
    return $this;
  }

  /* Getters
  /****************************************************************************/

  public function get_cluster() {
    return $this->cluster;
  }

  public function get_position() {
    return $this->position;
  }

  public function get_attributes() {
    return $this->attributes;
  }

  public function get_backbone_model() {
    return ["model" => $this->attributes];
  }

  public static function get_backbone_collection($conditions=[], $limit=-1) {
    $query = new Query(static::$class_name);
    $results = $query->where($conditions)->limit($limit)->execute()->get_results();
    $collection = [];
    foreach ($results as $result) {
      $collection[] = ["model" => $result];
    }
    return ["collection" => $collection];
  }

  public function is_deleted() {
    return $this->deleted;
  }

  public function get_rid() {
    if ($this->cluster > 0 && $this->position > 0) {
      return $this->cluster . ":" . $this->position;
    } else {
      return false;
    }
  }

  /* REST Operations
  /****************************************************************************/

  public function load() {
    global $db;
    $attributes = $db->load($this->cluster, $this->position);
    if ($attributes) {
      $this->attributes = $attributes;
    }
    return $this;
  }

  public function create() {
    global $db;
    $attributes = $db->create($this->cluster, $this->attributes);
    if ($attributes) {
      $this->attributes = $attributes;
    }
    return $this;
  }

  public function update() {
    global $db;
    $attributes = $db->update($this->cluster, $this->position, $this->attributes);
    if ($attributes) {
      $this->attributes = $attributes;
    }
    return $this;
  }

  public function delete() {
    global $db;
    $this->deleted = $db->delete($this->cluster, $this->position);
    return $this;
  }

}
