<?php

namespace mvv\models;

class statusModel {

  /**
   * @var sqlModel $_model The instance of the SQL model
   */
  protected static $_model;

  /**
   * @var object $_assets The SQL result object of the query
   */
  private $_assets;

  /**
   * __construct method
   */
  public function __construct() {
    // Init the mySQL connection
    require_once (BASE_PATH . '/includes/models/sqlModel.php');
    // Get the singleton instance of $model
    self::$_model = sqlModel::getInstance();
  }

  /**
   * Gets all assets in the DB
   *
   * @return mixed Result of the query
   */
  public function getAllIngestsByStatus($status) {
    $sql = "
      SELECT
        *
      FROM
        ingest i,
        status s
      WHERE
        i.id = s.id AND
        s.status = 0
      ORDER BY i.id";

    $this->_assets = self::$_model->executeStmt($sql);

    return $this->_assets;
  }
}