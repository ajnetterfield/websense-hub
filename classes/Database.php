<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/classes/vendor/PhpOrient/vendor/autoload.php");
use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Common\ClusterMap;

/*
 * Database connection and functions.
 * Author: 	Alastair Netterfield
 * Revised: 25/02/2015
 */
class Database {

	/**********************/
	/* INSTANCE VARIABLES */
	/**********************/

  private $client;
  private $db_name = 'websensehub';
  private $db_config = array(
    'username' => 'admin',
    'password' => 'pi',
    'hostname' => 'localhost',
    'port'     => 2424
  );

  private $cluster_map;

	/**************/
	/* CONTRUCTOR */
	/**************/

	public function __construct() {
		$this->connect();
	}

	/*********************/
	/* PRIVATE FUNCTIONS */
	/*********************/

  private function connect() {
    $this->client = new PhpOrient();
    $this->client->configure($this->db_config);
    $this->client->connect();
    if ($this->client->dbExists($this->db_name)) {
      $this->cluster_map = $this->client->dbOpen($this->db_name);
    }
  }

  /********************/
  /* STATIC FUNCTIONS */
  /********************/

  public static function parse_rid($str) {
    $rid = new ID($str);
    return [$rid->cluster, $rid->position];
  }

	/********************/
	/* PUBLIC FUNCTIONS */
	/********************/

  public function get_rid($record) {
    $rid = $record->getRid();
    $id = array(
      'cluster' => $rid->cluster,
      'position' => $rid->position
    );
    return $id;
  }

  public function get_cluster_id($class_name) {
    return $this->cluster_map->getClusterID(strtolower($class_name));
  }

  public function command($command) {
    return $this->client->command($command);
  }

  public function query($query) {
    return $this->client->query($query);
  }

}
