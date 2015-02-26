<?php

/*
 * User management functions.
 * Author:   Alastair Netterfield
 * Revised: 01/02/2015
 */
 
class User{

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

  private function generate_salt() {
    $salt = "$2y$08$";
    for ($i = 0; $i < 22; $i++) {
      $salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
    }
    return $salt;
  }

  /*
   * Generates a random key using the MD5 hashing algorithm.
   */
  private function generate_key() {
    $salt = "";
    for ($i = 0; $i < 22; $i++) {
      $salt .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
    }
    $time = time();
    $key = md5($salt . $time);
    return $key;
  }

  /********************/
  /* PUBLIC FUNCTIONS */
  /********************/

  /*
   * Gets the personal data of the user.
   */
  public function user_data() {
    if (isset($_SESSION['id'])) {
      try {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(array(':id' => $_SESSION['id']));
        return $stmt->fetch();
      } catch(PDOException $e) {
        return array();
      }
    } else {
      return array();
    }
  }

  /*
   * Checks whether a user with the provided username already exists.
   */
  public function user_exists($username) {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(id) FROM users WHERE username = :username");
      $stmt->execute(array(':username' => $username));
      $rows = $stmt->fetchColumn();
      return ($rows == 1);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /*
   * Checks whether a user with the provided name already exists.
   */
  public function name_exists($fname, $lname) {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(id) FROM users WHERE fname = :fname AND lname = :lname");
      $stmt->execute(array(':fname' => $fname, ':lname' => $lname));
      $rows = $stmt->fetchColumn();
      return ($rows == 1);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /*
   * Checks whether a user with the provided email already exists.
   */
  public function email_exists($email) {
    try {
      $stmt = $this->db->prepare("SELECT COUNT(id) FROM users WHERE email = :email");
      $stmt->execute(array(':email' => $email));
      $rows = $stmt->fetchColumn();
      return ($rows == 1);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /*
   * Registers a user.
   */
  public function register($username, $password, $fname, $lname){
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $password = crypt($password, $this->generate_salt());
    try {
      $stmt = $this->db->prepare("INSERT INTO users (username, password, fname, lname, ip_address) VALUES (:username, :password, :fname, :lname, :ip_address) ");
      $stmt->execute(array(':username' => $username, ':password' => $password, ':fname' => $fname, ':lname' => $lname, ':ip_address' => $ip_address));
    } catch(PDOException $e) {
      die($e->getMessage());
    }  
  }

  /*
   * Logs a user in.
   * username: The user's username.
   * password: The user's password.
   */
  public function login($username, $password) {
    try {

      $stmt = $this->db->prepare("SELECT password, id, activated FROM users WHERE username = :username");
      $stmt->execute(array(':username' => $username));
      $data = $stmt->fetch();
      $stored_password = $data['password'];
      $id = $data['id'];
      $activated = $data['activated'];

      if (crypt($password, $stored_password) == $stored_password) {
        if ($activated == 0) {
          return array(false, 'Sorry, your account is not activated');
        }
        $ip_address = $_SERVER['REMOTE_ADDR'];

        /* Call just before setting $_SESSION['id'] to prevent session fixation attack when logging in */
        session_regenerate_id(true);
        $_SESSION['id'] = $id;

        /* Update the record of when the user last logged in */
        $stmt = $this->db->prepare("UPDATE users SET last_login=NOW(), ip_address=:ip_address WHERE username = :username");
        $stmt->execute(array(':username' => $username, ':ip_address' => $ip_address));
        return array(true, '');

      } else {
        return array(false, 'That password is invalid.');
      }
    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  /*
   * Checks whether a user is logged in.
   */
  public function is_logged_in() {
    return isset($_SESSION['id']);
  }

  /*
   * Returns true if the user has administrative privileges.
   */
  public function is_admin() {
    $user = $this->user_data();
    return $this->is_logged_in() ? $user['admin'] : false;
  }

  /*
   * Returns the id of the user if they are logged in, 0 otherwise
   */
  public function get_user_id() {
    return $this->is_logged_in() ? $_SESSION['id'] : 0;
  }

  /*
   * Gets the username of the user if logged in, or Guest if not logged in.
   */
  public function get_username() {
    $user = $this->user_data();
    return $this->is_logged_in() ? $user['username'] : 'Guest';
  }

  /*
   * Gets the full name of the user if logged in, or Guest if not logged in.
   */
  public function get_full_name() {
    if ($this->is_logged_in()) {
      $user = $this->user_data();
      return $user['fname'] . " " . $user['lname'];
    } else {
      return 'Guest';
    }
  }

  /*
   * Gets the first name of the user if logged in, or Guest if not logged in.
   */
  public function get_short_name() {
    $user = $this->user_data();
    return $this->is_logged_in() ? $user['fname'] : 'Guest';
  }

  /*
   * Updates a user's profile.
   */
  public function update_profile($fname, $lname, $location, $department, $role, $email, $mobile, $extension, $start_date, $password) {

    $id = $this->get_user_id();

    $update = "UPDATE users";
    $set = "SET fname = :fname, lname = :lname, location = :location, department = :department, role = :role, email = :email, mobile = :mobile, extension = :extension, start_date = :start_date";
    $where = "WHERE id = :id";

    if ($location == "Please Select") {
      $location = NULL;
    }

    if ($department == "Please Select") {
      $department = NULL;
    }

    if ($start_date == "") {
      $start_date = NULL;
    } else {
      $start_date = $this->formatDateSql($start_date);
    }

    if ($extension == "") {
      $extension = NULL;
    }

    $values = array(
          ':fname' => $fname, 
          ':lname' => $lname, 
          ':location' => $location, 
          ':department' => $department, 
          ':role' => $role, 
          ':email' => $email, 
          ':mobile' => $mobile, 
          ':extension' => $extension, 
          ':start_date' => $start_date, 
          ':id' => $id
        );

    if ($password != "") {
      $password = crypt($password, $this->generate_salt());
      $set .= ", password = :password";
      $values[':password'] = $password;
    }

    try {
      $stmt = $this->db->prepare("$update $set $where");
      $stmt->execute($values);
    } catch(PDOException $e){
      $message = "An error occurred.";
      return array('updated' => false, 'message' => $message);
    }

    $message = "Successfully updated Profile.";
    return array('updated' => true, 'message' => $message);
  }

}
