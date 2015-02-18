<?php

/*
 * Location functions.
 * Author:   Alastair Netterfield
 * Revised: 15/02/2015
 */
class Location extends ORM {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected static $class_name = 'Location';

  private $title;
  private $parent;

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
