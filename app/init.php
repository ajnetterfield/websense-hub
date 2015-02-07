<?php

	session_start();

	date_default_timezone_set('Australia/Perth');

  /* Classes */
  require_once 'classes/Application.php';
  require_once 'classes/Database.php';
  require_once 'classes/Date.php';
  require_once 'classes/Import.php';
  require_once 'classes/User.php';

  /* Initialise Environment */
  Application::init_messages();
  Application::development_environment(true);

	/* Turn off Browser Caching */
	header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

?>
