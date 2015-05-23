<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/PhpOrient/vendor/autoload.php");
use PhpOrient\PhpOrient;
use PhpOrient\Protocols\Binary\Data\ID;
use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Common\ClusterMap;

/*
 * Database connection and functions.
 * Author: 	Alastair Netterfield
 * Revised: 20/03/2015
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
	/* PUBLIC FUNCTIONS */
	/********************/

  public function get_cluster_id($class_name) {
    return $this->cluster_map->getClusterID(strtolower($class_name));
  }

  public function command($command) {
    return $this->client->command($command);
  }

  public function query($query) {
    return $this->client->query($query);
  }

  /* REST Operations
  /****************************************************************************/

  public function load($cluster, $position) {
    $result = $this->client->recordLoad(new ID($cluster, $position))[0];
    $attributes = $result->getOData();
    $attributes["@rid"] = str_replace("#", "", $result->getRid());
    return $attributes;
  }

  public function create($cluster, $attributes=array()) {
    $record = (new Record())->setRid(new ID($cluster))->setOData($attributes);
    $result = $this->client->recordCreate($record);
    $attributes = $result->getOData();
    $attributes["@rid"] = str_replace("#", "", $result->getRid());
    return $attributes;
  }

  public function update($cluster, $position, $attributes=array()) {
    $record = (new Record())->setRid(new ID($cluster, $position))->setOData($attributes);
    $result = $this->client->recordUpdate($record);
    $attributes = $result->getOData();
    $attributes["@rid"] = str_replace("#", "", $result->getRid());
    return $attributes;
  }

  public function delete($cluster, $position) {
    $deleted = $this->client->recordDelete(new ID($cluster, $position));
    return $deleted;
  }

}
