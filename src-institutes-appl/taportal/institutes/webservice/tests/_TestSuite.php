<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

require_once 'taportal/institutes/webservice/tests/TestBase.php';
require_once 'taportal/institutes/webservice/tests/VectorTest.php';
require_once 'taportal/institutes/webservice/tests/InstituteTest.php';
require_once 'taportal/institutes/webservice/tests/ExpertTest.php';
require_once 'taportal/institutes/webservice/tests/ProjectTest.php';
require_once 'taportal/institutes/webservice/tests/PublicationTest.php';
require_once 'taportal/institutes/webservice/tests/JSONBuilderTest.php';

require_once 'PHPUnit\Framework\TestSuite.php';

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

