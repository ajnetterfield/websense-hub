<?php

/*
 * Sensor functions.
 * Author: Alastair Netterfield
 * Revised: 15/02/2015
 */
class ORM {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected $cluster;
  protected $position;
  protected $attributes;
  protected $in_sync;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct() {
    $this->cluster = -1;
    $this->position = -1;
    $this->attributes = array();
    $this->in_sync = false;
  }

  public function init($position=null, $attributes=array()) {
    global $db;
    $this->cluster = $db->get_cluster_id(static::$class_name);
    $this->position = $position;
    $this->attributes = $attributes;
  }

  /********************/
  /* STATIC FUNCTIONS */
  /********************/

  public static function parse_conditions($conditions=array()) {
    $parsed_conditions = array();
    if (empty($conditions)) {
      return $parsed_conditions;
    } else {
      foreach ($conditions as $key => $value) {
        $parsed_conditions[] = $key . " = '" . $value . "'"; 
      }
      return 'WHERE ' . implode(' AND ', $parsed_conditions);
    }
  }

  public static function where($conditions=array()) {
    global $db;
    $parts = array(
      'SELECT * FROM',
      ucfirst(static::$class_name),
      self::parse_conditions($conditions)
    );
    $records = $db->query(implode(' ', $parts));
    $result = [];
    foreach ($records as $record) {
      $result[] = $record->getOData();
    }
    return $result;
  }

  public static function all() {
    global $db;
    $parts = array(
      'SELECT * FROM',
      ucfirst(static::$class_name)
    );
    $records = $db->query(implode(' ', $parts));
    $result = [];
    foreach ($records as $record) {
      $result[] = $record->getOData();
    }
    return $result;
  }

  /***********************/
  /* PROTECTED FUNCTIONS */
  /***********************/

  protected function exists_in_db() {
    return ($this->cluster > -1 && $this->position > -1);
  }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  public function set_position($position) {
    $this->position = $position;
  }

  public function unset_position() {
    unset($this->position);
  }

  public function get_position() {
    return $this->position;
  }

  public function set_attributes($attributes) {
    $this->attributes = $attributes;
    $this->in_sync = false;
  }

  public function unset_attributes() {
    unset($this->attributes);
    $this->in_sync = false;
  }

  public function get_attributes() {
    return $this->attributes;
  }

  public function load() {
    global $db;
    $result = $db->retrieve($this->cluster, $this->position);
    if ($result) {
      $this->attributes = $result;
      $this->in_sync = true;
      return true;
    } else {
      return false;
    }
  }

  public function save() {
    global $db;
    if ($this->exists_in_db()) {
      $result = $db->update($this->cluster, $this->position, $this->attributes);
    } else {
      $result = $db->create($this->cluster, $this->attributes);
    }
    $this->position = $result['position'];
    $this->in_sync = true;
    return true;
  }

  public function destroy() {
    global $db;
    if ($this->persisted()) {
      $result = $db->delete($this->cluster, $this->position);
    } else {
      $result = false;
    }
    return $result;
  }
}
