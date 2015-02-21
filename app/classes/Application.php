<?php

/*
 * Application base functions.
 * Author: 	Alastair Netterfield
 * Revised: 25/01/2015
 */
class Application {

	/**********************/
	/* INSTANCE VARIABLES */
	/**********************/

	/**************/
	/* CONTRUCTOR */
	/**************/

	public function __construct() {

	}

	/*********************/
	/* PRIVATE FUNCTIONS */
	/*********************/

  public static function init_messages() {
    if ( ! array_key_exists('errors', $_SESSION)) {
      $_SESSION['errors'] = array();
    }
    if ( ! array_key_exists('warnings', $_SESSION)) {
      $_SESSION['warnings'] = array();
    }
    if ( ! array_key_exists('infos', $_SESSION)) {
      $_SESSION['infos'] = array();
    }
    if ( ! array_key_exists('successes', $_SESSION)) {
      $_SESSION['successes'] = array();
    }
  }

  public static function set_development_environment($dev) {
    if ($dev) {
      define('GRUNT_ENV', 'development');
    } else {
      define('GRUNT_ENV', 'production');
    }
  }

	public static function crypt_apr1_md5($plainpasswd) {
		$tmp = "";
		$salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
		$len = strlen($plainpasswd);
		$text = $plainpasswd.'$apr1$'.$salt;
		$bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));
		for($i = $len; $i > 0; $i -= 16) { $text .= substr($bin, 0, min(16, $i)); }
		for($i = $len; $i > 0; $i >>= 1) { $text .= ($i & 1) ? chr(0) : $plainpasswd{0}; }
		$bin = pack("H32", md5($text));
		for($i = 0; $i < 1000; $i++) {
			$new = ($i & 1) ? $plainpasswd : $bin;
			if ($i % 3) $new .= $salt;
			if ($i % 7) $new .= $plainpasswd;
			$new .= ($i & 1) ? $bin : $plainpasswd;
			$bin = pack("H32", md5($new));
		}
		for ($i = 0; $i < 5; $i++) {
			$k = $i + 6;
			$j = $i + 12;
			if ($j == 16) $j = 5;
			$tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
		}
		$tmp = chr(0).chr(0).$bin[11].$tmp;
		$tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
		"./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
		return "$"."apr1"."$".$salt."$".$tmp;
	}

	/********************/
	/* STATIC FUNCTIONS */
	/********************/

  public static function app_dir() {
    return $_SERVER['DOCUMENT_ROOT'] . "/app/";
  }

  public static function ajax_dir() {
    return self::app_dir() . "ajax/";
  }

  public static function assets_dir() {
    return "/app/assets/";
  }

  public static function classes_dir() {
    return self::app_dir() . "classes/";
  }

  public static function partials_dir() {
    return self::app_dir() . "partials/";
  }

  /*
   * Includes a partial file.
   * file_name: the name of the file.
   * subdir: an array of subdirectory names.
   */
  public static function include_partial($file_name, $subdir=array()) {
    $path = implode('/', $subdir);
    $path .= ($path != "") ? "/" : "";
    include_once(self::partials_dir() . $path . $file_name);
  }

  /*
   * Include standard head includes and meta data for each page.
   */
  public static function include_head() {
    self::include_partial('head.php');
  }

  /*
   * Include the page header from a template file.
   */
  public static function include_header() {
    self::include_partial('header.php');
  }

  /*
   * Include the page footer and populate with notifications.
   */
  public static function include_footer() {
    self::include_partial('footer.php');
  }

  /*
   * Include a form.
   */
  public static function include_form($form_name) {
    self::include_partial($form_name . ".php", array('forms'));
  }

  /*
   * Prints active if the page is a parent of the request URI.
   */
  public static function print_active_dropdown($dropdown) {
    $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
    if (end($crumbs) == $dropdown) echo 'active';
  }

  /*
   * Prints active if the page is a parent of the request URI.
   */
  public static function print_active_page($page) {
    $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
    if ($crumbs[1] == $page) echo 'active';
  }

  /*
   * Prints an animated loading bar.
   */
  public static function print_loading() {
    echo "<div class='progress'>" .
            "<div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>" .
              "Loading" .
            "</div>" .
          "</div>";
  }

  /*
   * Prints the title meta tag of the page.
   */
  public static function print_title() {
    $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
    end($crumbs);
    $last_crumb = prev($crumbs);
    $exploded_name = explode("-",$last_crumb);
    $page_name = "";
    if ($last_crumb != "") {
      foreach ($exploded_name as $n) {
        $page_name .= " " . ucfirst($n);
      }
    }
    if ($page_name != "") $page_name .= " |";
    echo $page_name . " WebSense Hub";
  }

  /*
   * Adds an error message to the session message queue.
   */
  public static function add_error($message) {
    $_SESSION['errors'][] = $message;
  }

  /*
   * Adds a warning message to the session message queue.
   */
  public static function add_warning($message) {
    $_SESSION['warnings'][] = $message;
  }

  /*
   * Adds an info message to the session message queue.
   */
  public static function add_info($message) {
    $_SESSION['infos'][] = $message;
  }

  /*
   * Adds a success message to the session message queue.
   */
  public static function add_success($message) {
    $_SESSION['successes'][] = $message;
  }

  /*
   * Formats a collection of messages into HTML output.
   */
  public static function format_messages($messages=array(), $message_type) {

    $message_classes = array(
      'error' => 'alert-danger',
      'warning' => 'alert-warning',
      'info' => 'alert-info',
      'success' => 'alert-success'
    );

    if ( ! array_key_exists($message_type, $message_classes)) {
      $message_type = 'info';
    }

    $html = "<div class='alert " . $message_classes[$message_type] . " alert-dismissible' role='alert'>" .
              "<button type='button' class='close' data-dismiss='alert'>" . 
                "<span aria-hidden='true'>&times;</span>" . 
                "<span class='sr-only'>Close</span>" . 
              "</button>" . 
              "<p>" . implode('</p><p>', $messages) . "</p>" . 
            "</div>";

    return $html;
  }

  /*
   * Returns and removes all error messages in the session queue.
   */
  public static function errors() {
    $errors = '';
    if(empty($_SESSION['errors']) === false){
      $errors = self::format_messages(array_unique($_SESSION['errors']), 'error');
      $_SESSION['errors'] = array();
    }
    return $errors;
  }

  /*
   * Returns and removes all warning messages in the session queue.
   */
  public static function warnings() {
    $warnings = '';
    if(empty($_SESSION['warnings']) === false){
      $warnings = self::format_messages(array_unique($_SESSION['warnings']), 'warning');
      $_SESSION['warnings'] = array();
    }
    return $warnings;
  }

  /*
   * Returns and removes all info messages in the session queue.
   */
  public static function infos() {
    $infos = '';
    if(empty($_SESSION['infos']) === false){
      $infos = self::format_messages(array_unique($_SESSION['infos']), 'info');
      $_SESSION['infos'] = array();
    }
    return $infos;
  }

  /*
   * Returns and removes all success messages in the session queue.
   */
  public static function successes() {
    $successes = '';
    if(empty($_SESSION['successes']) === false){
      $successes = self::format_messages(array_unique($_SESSION['successes']), 'success');
      $_SESSION['successes'] = array();
    }
    return $successes;
  }

  /*
   * Returns and removes all messages in the session queue.
   */
  public static function messages() {
    return self::errors() . self::warnings() . self::infos() . self::successes();
  }

  /*
   * Returns true if the error message queue is empty.
   */
  public static function no_errors() {
    return empty($_SESSION['errors']);
  }

	/*
	 * Remove multiple line breaks from a string.
	 */
	public static function trim_line_breaks($str) {
		return preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', "\n\n", $str);
	}

  /* Remove potentially dangerous characters from queries. */
  public static function sanitize_html($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

	/* Remove potentially dangerous characters from numbers. */
	public static function sanitize_number($str) {
		return filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	}
	
	/* Remove potentially dangerous characters from a block of text. */
	public static function sanitize_text($str) {
		$str = preg_replace('/[\"\'\xC2\xA0]+/','',$str);
		$str = stripslashes($str);
		$str = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		return $str;
	}

	/* Get the date of the first day in the specified month. */
	public static function first_day_of_month($date) {
		return date("Y-m-01", strtotime($date));
	}

	/* Get the date of the last day in the specified month. */
	public static function last_day_of_month($date) {
		return date("Y-m-t", strtotime($date));
	}

}
