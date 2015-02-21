<?php

/*
 * Sensor functions.
 * Author: Alastair Netterfield
 * Revised: 15/02/2015
 */
class Object {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected $cluster;
  protected $position;
  protected $attributes;
  protected $in_sync;
  protected $query;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct() {
    $this->cluster = -1;
    $this->position = -1;
    $this->attributes = array();
  }

  public function init($position=null, $attributes=array()) {
    global $db;
    $this->cluster = $db->get_cluster_id(static::$class_name);
    $this->position = $position;
    $this->attributes = $attributes;
    return $this;
  }

  /********************/
  /* STATIC FUNCTIONS */
  /********************/

  public static function query() {
    return new Query(static::$class_name);
  }

  // public static function parse_conditions($conditions=array()) {
  //   $parsed_conditions = array();
  //   if (empty($conditions)) {
  //     return $parsed_conditions;
  //   } else {
  //     foreach ($conditions as $key => $value) {
  //       $parsed_conditions[] = $key . " = '" . $value . "'"; 
  //     }
  //     return 'WHERE ' . implode(' AND ', $parsed_conditions);
  //   }
  // }

  // public static function where($conditions=array()) {
  //   global $db;
  //   $parts = array(
  //     'SELECT * FROM',
  //     ucfirst(static::$class_name),
  //     self::parse_conditions($conditions)
  //   );
  //   $records = $db->query(implode(' ', $parts));
  //   $result = [];
  //   foreach ($records as $record) {
  //     $result[] = $record->getOData();
  //   }
  //   return $result;
  // }

  // public static function all() {
  //   global $db;
  //   $parts = array(
  //     'SELECT * FROM',
  //     ucfirst(static::$class_name)
  //   );
  //   $records = $db->query(implode(' ', $parts));
  //   $result = [];
  //   foreach ($records as $record) {
  //     $result[] = $record->getOData();
  //   }
  //   return $result;
  // }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  /* Setters (Chainable)
  /****************************************************************************/

  public function set_position($position) {
    $this->position = $position;
    return $this;
  }

  public function set_attributes($attributes) {
    $this->attributes = $attributes;
    return $this;
  }

  public function unset_position() {
    unset($this->position);
    return $this;
  }

  public function unset_attributes() {
    unset($this->attributes);
    return $this;
  }

  /* Getters
  /****************************************************************************/

  public function get_position() {
    return $this->position;
  }

  public function get_attributes() {
    return $this->attributes;
  }

  public function get_rid() {
    if (isset($this->cluster) && isset($this->position)) {
      return "#" . $this->cluster . ":" . $this->position;
    } else {
      return false;
    }
  }

  public function get_options($conditions=[]) {
    $options = [];
    $results = $this->query()->select(['@rid', 'title'])->where($conditions)->execute()->get_results();
    foreach ($results as $result) {
      $options[] = Format::option($result['rid'], $result['title']);
    }
    return implode('', $options);
  }

  /* Operators
  /****************************************************************************/

  public function exists() {
    global $db;
    $rid = $this->get_rid();
    if ($rid) {
      $query = new Query(static::$class_name);
      $query->select('@rid')->where(['@rid' => $rid])->limit(1)->execute();
      // print_r($query->count_results());
      return ($query->count_results() > 0);
    } else {
      return false;
    }
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
    if ($this->exists_in_db()) {
      $result = $db->delete($this->cluster, $this->position);
    } else {
      $result = false;
    }
    return $result;
  }

}
