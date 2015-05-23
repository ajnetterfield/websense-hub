<?php

/*
 * Measurement functions.
 * Author: Alastair Netterfield
 * Revised: 20/03/2015
 */
class Measurement extends Object {

  /**********************/
  /* INSTANCE VARIABLES */
  /**********************/

  protected static $class_name = 'Measurement';

  /**************/
  /* CONTRUCTOR */
  /**************/

  public function __construct($position=-1, $attributes=[]) {
    $this->init($position, $attributes);
  }
}
