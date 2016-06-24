<?php

namespace mvv\controllers;

/**
 * Class indexController
 * @package mvv\controllers
 */
class indexController {

  /**
   * @var array $_config The application configuration array
   */
  private static $_config;

  /**
   * __construct method
   */
  public function __construct() {
    // Get the configuration file for the application
    self::$_config = parse_ini_file(BASE_PATH . '/includes/config/config.ini');
  }

  /**
   * __destruct method
   */
  public function __destruct() {
    //
  }
  /**
   * index method
   */
  public function index(){

    // Render the view
    require_once(BASE_PATH . '/includes/views/index.php');
  }
}