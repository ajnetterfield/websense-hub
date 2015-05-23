<?php

	session_start();

	date_default_timezone_set('Australia/Perth');

  /* PHP Vendor Libraries */
  require_once 'vendor/autoload.php';

  /* Database */
  require_once 'models/Database.php';
  $db = new Database();

  /* Helpers */
  require_once 'models/Application.php';
  require_once 'models/Cast.php';
  require_once 'models/Format.php';

  /* Models */
  require_once 'models/Query.php';
  require_once 'models/Object.php';
  require_once 'models/Sensor.php';
  require_once 'models/Measurement.php';
  require_once 'models/Location.php';

  /* Initialise Environment */
  Application::init_messages();
  Application::set_development_environment(true);

	/* Turn off Browser Caching for development environment */
	header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

?>
