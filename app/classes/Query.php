<?php

/*
 * Query functions.
 * Author: Alastair Netterfield
 * Revised: 18/02/2015
 */
class Query {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  private $attributes;
  private $classes;
  private $conditions;
  private $results;
  private $order_attributes;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct() {
    $this->attributes = [];
    $this->classes = [];
    $this->conditions = [];
    $this->results = [];
    $this->order_attributes = [];
  }

  /*********************/
  /* PRIVATE FUNCTIONS */
  /*********************/

  private function aliase($attributes) {
    $aliased_attributes = [];
    foreach($attributes as $attribute) {
      $as = preg_replace('/[.\s]+/', '_', $attribute);
      $as = preg_replace('/[@()]+/', '', $as);
      if (substr($attribute, -4) == '@rid'){
        $attribute .= '.asString()';
      }
      $aliased_attributes[] = $attribute . ' AS ' . $as;
    } 
    return $aliased_attributes;
  }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  /* Chainable Methods */

  public function select($attributes) {
    $this->attributes = array_unique(array_merge($this->attributes, $this->aliase($attributes)));
    return $this;
  }

  public function from($classes) {
    $this->classes = array_unique(array_merge($this->classes, $classes));
    return $this;
  }

  public function where($conditions) {
    $this->conditions = array_unique(array_merge($this->conditions, $conditions));
    return $this;
  }

  public function order($order_attributes) {
    $this->order_attributes = array_unique(array_merge($this->order_attributes, $order_attributes));
    return $this;
  }

  public function execute() {
    global $db;
    if ($db) {
      $this->results = $db->query($this->to_s());
    } else {
      $this->results = [];
    }
    return $this;
  }

  /* Termination Methods */

  public function to_s() {
    $merged_conditions = [];
    foreach ($this->conditions as $attribute => $value) {
      $merged_conditions[] = $attribute . " = '" . $value . "'";
    }
    $pieces = array(
      "SELECT",
      implode(', ', $this->attributes),
      "FROM",
      implode(', ', $this->classes),
      "WHERE",
      implode(' AND ', $merged_conditions),
      "ORDER BY",
      implode(', ', $this->order_attributes)
    );
    return implode(' ', $pieces);
  }

  public function to_a() {
    $results = [];
    foreach ($this->results as $result) {
      $results[] = $result->getOData();
    }
    return $results;
  }

}
