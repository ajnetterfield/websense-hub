<?php

/*
 * Sensor functions.
 * Author:   Alastair Netterfield
 * Revised: 15/02/2015
 */
class Sensor extends Object {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected static $class_name = 'Sensor';

  private $created_at;
  private $updated_at;
  private $deleted_at;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct($position=-1, $attributes=[]) {
    $this->init($position, $attributes);
  }

  public static function find($attributes=[], $conditions=[]) {
    $results = self::query()->select($attributes)->where($conditions)->execute()->get_results();
    return $results;
  }

  public static function parse_results($results) {
    $collection = [];
    foreach($results as $result) {
      $attributes = [];
      foreach($result as $key => $value) {
        $attributes[$key] = $value;
      }
      $collection[] = new self($attributes['rid'], $attributes);
    }
    return $collection;
  }
}
