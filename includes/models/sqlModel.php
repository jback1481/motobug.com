<?php

namespace mvv\models;

/**
 * Class sqlModel
 * @package mvv\models
 */
class sqlModel extends \mysqli {

  /**
   * @var array $_config The configuration array for the application
   */
  protected static $_config;

  /**
   * @var string $_host The host for the DB connection
   */
  protected static $_host;

  /**
   * @var string $_user The username for the DB connection
   */
  protected static $_user;

  /**
   * @var string $_pass The password for the DB connection
   */
  protected static $_pass;

  /**
   * @var string $_db The DB name for the DB connection
   */
  protected static $_db;

  /**
   * @var string $_instance The DB static instance for the DB connection
   */
  protected static $_instance;

  /**
   * @var string $_queryTypes The query types for the prepared statement
   */
  private $_queryTypes;

  /**
   * @var array $queryParams The parameters array for the prepared statement
   */
  private $_queryParams;

  /**
   * @var object $result The return of the prepared statement execution
   */
  private $_result;

  /**
   * @var object $stmt The mySQLi prepared statement object
   */
  private $_stmt;

  /**
   * __construct method
   * Inits the mySQLi object
   *
   */
  public function __construct() {
    parent::__construct(self::$_host, self::$_user, self::$_pass, self::$_db);

    if (mysqli_connect_error()) {
      die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
  }

  /**
   * getInstance method
   * Return the singleton of the mySQLi instance
   *
   * @return sqlModel $instance The singleton of the mySQLi object
   */
  public static function getInstance() {
    if (self::$_instance) {
      // Instance already exists
    } else {
      // Set the DB connection credentials
      // Get the configuration file for the application
      self::$_config = parse_ini_file(BASE_PATH . '/includes/config/config.ini');
      // Get the singleton instance of $model
      self::$_host = self::$_config['db_host'];
      self::$_user = self::$_config['db_user'];
      self::$_pass = self::$_config['db_pass'];
      self::$_db   = self::$_config['db_name'];
      // Init the instance
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  /**
   * executeQuery method
   * Executes a mySQLi prepared statement and returns the result
   *
   * @param string $sql The sql statement
   * @param array $params The parameters for values for the prepared statement
   *
   * @return object The result of the mySQLi prepared statement
   */
  public function executeStmt($sql, $params = array()) {
    // Init the mySQLi statement object
    $this->_stmt = self::$_instance->stmt_init();
    // Prepare the SQL statement
    $this->_stmt->prepare($sql);

    // Do only if parameters are sent along with the SQL statement
    if (empty($params)) {
      //
    } else {
      // Dynamically bind the parameters to the mySQLi object
      // Generate your param type string (for instance "sss" for 3 string parameters)
      // For each parameter, determine it's type and map it to the predetermined mySQLi types:
      //   i - corresponding variable has type integer
      //   d - corresponding variable has type double (float)
      //   s - corresponding variable has type string
      //   b - corresponding variable is a blob and will be sent in packets

      $this->_queryTypes = '';

      foreach ($params as $item) {
        switch (gettype($item)) {
          case "integer":
            $this->_queryTypes .= 'i';
            break;
          case "double":
            $this->_queryTypes .= 'd';
            break;
          case "string":
            $this->_queryTypes .= 's';
            break;
          default:
            $this->_queryTypes .= 's';
        }
      }

      // Add the type string to the query params array (passed by reference)
      $this->_queryParams[] = &$this->_queryTypes;
      // Add the parameters to the array (passed by reference)
      foreach ($params as $id => $term) {
        $this->_queryParams[] = &$params[$id];
      }

      // Call bind_param to bind the parameters to the statement
      call_user_func_array(array($this->_stmt, 'bind_param'), $this->_queryParams);
      // Unset the query parameters
      unset($this->_queryParams);
    }

    // Execute the query
    $this->_stmt->execute();
    // Return the result
    $this->_result = $this->_stmt->get_result();
    // Close the mySQLi handle
    $this->_stmt->close();

    return $this->_result;
  }
}