<?php

namespace mvv\controllers;
use mvv\models\ingestModel;

require_once(BASE_PATH . '/includes/models/ingestModel.php');

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
   * @var string $_cove_ingest_asset_uri TPT's asset URI endpoint
   */
  private static $_cove_ingest_asset_uri;

  /**
   * @var string $_cove_ingest_uri The COVE API URI endpoint
   */
  private static $_cove_ingest_uri;

  /**
   * @var object $_model The model for the controller
   */
  private static $_model;

  /**
   * __construct method
   */
  public function __construct() {
    // Get the configuration file for the application
    self::$_config = parse_ini_file(BASE_PATH . '/includes/config/config.ini');

    self::$_cove_ingest_asset_uri  = self::$_config['cove_ingest_asset_uri'];
    self::$_cove_ingest_uri = self::$_config['cove_ingest_uri'];
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

    // Build the data for the payload
    $data = array(
      'slug' => 'test-sd-519505-2',
      'title' => 'Test ingestion SD 519505 2',
      'contentChannel' => 'tpt-archive',
      'autoPublish' => FALSE,
      'contentType' => 'EPISODE',
      'premiereDate' => '2016-01-01 12:00:00',
      'encoreDate' => '2016-01-01 12:00:00',
      'longDescription' => 'Long Description Here',
      'shortDescription' => 'Short Description Here',
      'tags' => 'tag1, tag2, tag3',
      'language' => 'en',
      'topics' => array(
        array(
          'namespace' => 'PBS Taxonomy',
          'topic_slug' => 'news-public-affairs-government'
        )
      ),
      'files' => array(
        'video' => array(
          'profile' => 'hd-mezzanine-4x3',
          'location' => 'http://tpt.vo.llnwd.net/o26/testingest/519505.mp4'
        ),
        'image' => array(
          'profile' => 'Mezzanine',
          'location' => 'http://tpt.vo.llnwd.net/o26/testingest/519505.jpg'
        ),
        'caption' => array(
          'location' => 'http://tpt.vo.llnwd.net/o26/testingest/519505.xml'
        )
      )
    );

    self::$_model = new ingestModel($data);
    //$response = self::$_model->setTask();
    $response = self::$_model->getTask(self::$_cove_ingest_uri . '/batchingester/api/1.0/ingestiontask/29565/', false);

    // Render the view
    require_once(BASE_PATH . '/includes/views/index.php');
  }
}