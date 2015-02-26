<?php

/*
 * Import functions.
 * Author: 	Alastair Netterfield
 * Revised: 01/02/2015
 */
class Import {

	/**********************/
	/* INSTANCE VARIABLES */
	/**********************/

  private $database;

	/**************/
	/* CONTRUCTOR */
	/**************/

	public function __construct($database) {
		$this->database = $database;
	}

	/*********************/
	/* PRIVATE FUNCTIONS */
	/*********************/

  

	/********************/
	/* PUBLIC FUNCTIONS */
	/********************/

  public static function get_html($url, $verify_ssl=true, $file=false, $timeout=5) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verify_ssl);
    if ($file) curl_setopt($ch, CURLOPT_FILE, $file);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
  }

  public static function extract_file_urls($html, $valid_extensions) {
    $file_urls = [];
    $extensions_regexp = implode('|', $valid_extensions);
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//a/@href');
    foreach ($nodes as $href) {
      $url = $href->nodeValue;
      if (preg_match('/.*\.(' . $extensions_regexp . ')$/i', $url)) {
        $file_urls[] = $href->nodeValue;
      }
    }
    return $file_urls;
  }

  /*
   * Upload a CSV file.
   */
  public function import_measurements($file, $sensor) {

    /* Get file details */

    $file_type = $file["type"];
    $temp = explode(".", $file["name"]);
    $extension = end($temp);
    $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

    /* Check file type */

    if ( ! in_array($file_type, $mimes) || $extension !== "csv") {
      $this->application->add_error("Invalid file type. Please reformat your spreadsheet to CSV.");
      return false;
    }

    /* Check if file exists */

    $csv_file = $file['tmp_name'];
    if (!is_file($csv_file)) {
      $this->application->add_error("File not found.");
      return false;
    }

    /* Upload the MCTA data */

    $first = 1;
    $sql = "";

    if (($handle = fopen( $csv_file, "r")) !== FALSE) {

      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $customer = $this->general->sanitizeNumber($data[0]);
        $sales = $this->general->sanitizeNumber($data[1]);

        $uploaded_customers[] = $customer;

        if ($first == 1) {
          $sql = "REPLACE INTO sales(customer,month,year,sales) VALUES ($customer, '$month', $year, $sales)";
          $first = 0;
        } else {
          $sql .= ", ($customer, '$month', $year, $sales)";
        }
      }

      fclose($handle);
    }

    try {
      $stmt = $this->db->prepare("$sql;");
      $stmt->execute();
    } catch(PDOException $exception) { 
      $this->general->errorMessage("An error has occurred.");
      return false;
    }

    $new_customers = array_diff($uploaded_customers, $existing_customers);

    foreach($new_customers as $customer) {
      $insert = "INSERT INTO customers(account,name,manager) VALUES (:customer, :name, :manager)";
      $values = array(
            ':customer' => $customer,
            ':name' => "New Customer",
            ':manager' => 100
          );
      try {
        $stmt = $this->db->prepare("$insert;");
        $stmt->execute($values);
        $this->general->successMessage("created customer <a href='/admin/sales/customers/'>$customer</a>");
      } catch(PDOException $exception) {
        $this->general->errorMessage("an error occurred while creating customer $customer");
        return false;
      }
    }

    $this->application->add_success("Upload was successful!");

    return true;
  }

}
