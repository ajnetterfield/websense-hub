<?php

/*
 * Query functions.
 * Author: Alastair Netterfield
 * Revised: 20/03/2015
 */
class Query {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  private $attributes;
  private $classes;
  private $conditions;
  private $order_attributes;
  private $max_results;
  private $results;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct($class_name) {
    $this->attributes = [];
    $this->classes = [$class_name];
    $this->conditions = [];
    $this->order_attributes = [];
    $this->max_results = -1;
    $this->results = [];
  }

  /*********************/
  /* PRIVATE FUNCTIONS */
  /*********************/

  private function alias($attribute) {
    $as = Cast::to_sym($attribute);
    if ($attribute == "@rid") $attribute .= '.asString()';
    return $attribute . ' AS ' . $as;
  }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  /* Pre-Query */

  public function select($attributes=[]) {
    $attributes = Cast::to_a($attributes);
    $this->attributes = array_map(array($this, "alias"), $attributes);
    return $this;
  }

  public function from($classes) {
    $this->classes = Cast::to_a($classes);
    return $this;
  }

  public function where($conditions=[]) {
    $this->conditions = Cast::to_a($conditions);
    return $this;
  }

  public function order($order_attributes=[]) {
    $order_attributes = array_map(array($this, "translate"), $order_attributes);
    $this->order_attributes = Cast::to_a($order_attributes);
    return $this;
  }

  public function limit($max_results=-1) {
    $this->max_results = Cast::to_i($max_results, -1);
    return $this;
  }

  /* Query */

  public function get_statement() {

    /* Select */
    $select = empty($this->attributes) ? '*' : implode(', ', $this->attributes);

    /* From */
    $from = implode(', ', $this->classes);

    /* Where */
    $conditions = [];
    foreach ($this->conditions as $attribute => $value) {
      $conditions[] = $attribute . " = '" . $value . "'";
    }
    $where = implode(' AND ', $conditions);

    /* Order */
    $order = implode(', ', $this->order_attributes);

    /* Limit */
    $limit = $this->max_results;

    /* Query */
    $pieces = ['SELECT', $select, 'FROM', $from];
    if ( ! empty($where)) array_push($pieces, 'WHERE', $where);
    if ( ! empty($order)) array_push($pieces, 'ORDER BY', $order);
    if (isset($limit)) array_push($pieces, 'LIMIT', $limit);

    return implode(' ', $pieces);
  }

  public function execute() {
    global $db;
    if ($db) {
      $this->results = $db->query($this->get_statement());
    } else {
      $this->results = [];
    }
    return $this;
  }

  /* Post Query */

  public function get_results() {
    $results = [];
    foreach ($this->results as $result) {
      $attributes = $result->getOData();
      $attributes["@rid"] = str_replace("#", "", $result->getRid());
      $results[] = $attributes;
    }
    return $results;
  }

  public function count_results() {
    return count($this->results);
  }

}
