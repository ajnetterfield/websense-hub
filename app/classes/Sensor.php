<?php

/*
 * Sensor functions.
 * Author:   Alastair Netterfield
 * Revised: 15/02/2015
 */
class Sensor extends ORM {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected static $class_name = 'Sensor';

  private $title;
  private $sensor_id;
  private $location;

  private $created_at;
  private $updated_at;
  private $deleted_at;

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct($position=null, $attributes=array()) {
    $this->init($position, $attributes);
  }
}
