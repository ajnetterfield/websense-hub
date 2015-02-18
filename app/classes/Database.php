<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/vendor/PhpOrient/vendor/autoload.php");
use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Common\ClusterMap;

/*
 * Database connection and functions.
 * Author: 	Alastair Netterfield
 * Revised: 25/01/2015
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

  /********************/
  /* STATIC FUNCTIONS */
  /********************/

  public static function parse_rid($str) {
    $rid = new ID($str);
    return [$rid->cluster, $rid->position];
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

  private function record_to_id($record) {
    $rid = $record->getRid();
    $id = array(
      'cluster' => $rid->cluster,
      'position' => $rid->position
    );
    return $id;
  }

	/********************/
	/* PUBLIC FUNCTIONS */
	/********************/

  public function get_cluster_id($class_name) {
    return $this->cluster_map->getClusterID(strtolower($class_name));
  }

  /* Base Operations
  /****************************************************************************/

  public function command($command) {
    $result = $this->client->command($command);
    return $result;
  }

  public function query($query) {
    $result = $this->client->query($query);
    return $result;
  }

  /* CRUD Operations
  /****************************************************************************/

  public function create($cluster, $attributes=array()) {
    $record = (new Record())->setRid(new ID($cluster))->setOData($attributes);
    $result = $this->client->recordCreate($record);
    return $this->record_to_id($result);
  }

  public function retrieve($cluster, $position) {
    $result = $this->client->recordLoad(new ID($cluster, $position));
    if (isset($result[0])) {
      return $result[0]->getOData();
    } else {
      return false;
    }
  }

  public function update($cluster, $position, $attributes=array()) {
    $record = (new Record())->setRid(new ID($cluster, $position))->setOData($attributes);
    $result = $this->client->recordUpdate($record);
    return $this->record_to_id($result);
  }

  public function delete($cluster, $position) {
    $deleted = $this->client->recordDelete(new ID($cluster, $position));
    return $deleted;
  }

}
