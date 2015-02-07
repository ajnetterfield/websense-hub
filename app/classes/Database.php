<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/vendor/PhpOrient/vendor/autoload.php");
use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;

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
      $this->client->dbOpen($this->db_name);
    }
  }

	/********************/
	/* PUBLIC FUNCTIONS */
	/********************/

  public function records_to_hash($records=array()) {
    $hash = array();
    if ( ! is_array($records)) $records = array($records);
    foreach ($records as $record) {
      $rid = $record->getRid();
      $cluster = $rid->cluster;
      $position = $rid->position;
      $hash["#" . $cluster . ":" . $position] = $record->getOData();
    }
    return $hash;
  }

  /* Base Operations
  /****************************************************************************/

  public function command($command) {
    $result = $this->client->command($command);
    return $result;
  }

  public function query($query) {
    $result = $this->client->query($query);
    return $this->records_to_hash($result);
  }

  /* CRUD Operations
  /****************************************************************************/

  public function create($cluster, $attributes=array()) {
    $record = (new Record())->setRid(new ID($cluster))->setOData($attributes);
    $result = $this->client->recordCreate($record);
    return $this->records_to_hash($result);
  }

  public function retrieve($cluster, $position) {
    $result = $this->client->recordLoad(new ID($cluster, $position))[0];
    return $this->records_to_hash($result);
  }

  public function update($cluster, $position, $contents=array()) {
    $record = (new Record())->setRid(new ID($cluster, $position))->setOData($attributes);
    $result = $this->client->recordUpdate($record);
    return $this->records_to_hash($result);
  }

  public function delete($cluster, $position) {
    $deleted = $this->client->recordDelete(new ID($cluster, $position));
    return $deleted;
  }

}
