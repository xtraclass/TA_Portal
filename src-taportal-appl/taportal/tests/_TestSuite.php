<?php

require_once 'taportal/tests/_Classes.php';

/**
 * Static test suite.
 */
class webserviceTestSuite extends PHPUnit_Framework_TestSuite {

  /**
   * This contains the list of test classes which should be run.
   * Change this if you want to change the test classes which should be run.
   */
  public function __construct() {

    $this->setName( 'webserviceTestSuite' );
    
    $this->addTestSuite( 'VectorTest' );
    $this->addTestSuite( 'InstituteTest' );
    $this->addTestSuite( 'ExpertTest' );
    $this->addTestSuite( 'ProjectTest' );
    $this->addTestSuite( 'PublicationTest' );
    $this->addTestSuite( 'JSONBuilderTest' );
  }

  /**
   * Creates the suite.
   */
  public static function suite() {

    return new self();
  }
}

