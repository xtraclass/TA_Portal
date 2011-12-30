<?php

require_once 'taportal/tests/_Classes.php';

class ProjectTest extends TestBase {

  protected function setUp() {

    parent::setUp();
    $this->Project = new Project();
  }

  protected function tearDown() {

    $this->Project = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK1() {

    $this->Project->setShortTitleE( 'MyProject' );
    $this->assertSame( array( 'MyProject' ), $this->Project->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure1() {

    $this->Project->setShortTitleE( '' );
    $this->Project->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure2() {

    $this->Project->setShortTitleE( NULL );
    $this->Project->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure() {

    $this->Project->getUK();
  }

  public function testShortTitleE() {

    $this->performPropertyTests( $this->Project, 'ShortTitleE', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', '1234567890123456789012345678901234567890', -1, 0, 1, 3223232 ), array( self::TEXT150, self::TEXT250 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testLongTitleE() {

    $this->performPropertyTests( $this->Project, 'LongTitleE', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT250, -1, 0, 1, 3223232 ), array( self::TEXT250 . '1', self::TEXT250 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testShortDescriptionE() {

    $this->performPropertyTests( $this->Project, 'ShortDescriptionE', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testStartDate() {

    $this->performPropertyTests( $this->Project, 'StartDate', array( '1234-11', '1000-12', '2100-01' ), array( '0900-02', '2000-13', '2001-14', '2001-00', '1', '22', '333', '4444', '55555', '666666', '88888888', 'jkrjövkjdfigjirejfeijösjdöjijij' ), array( self::IGNORE_EMPTY, self::IGNORE_NULL ) );
  }

  public function testEndDate() {

    $this->performPropertyTests( $this->Project, 'EndDate', array( '1234-11', '1000-12', '2100-01' ), array( '0900-02', '2000-13', '2001-14', '2001-00', '1', '22', '333', '4444', '55555', '666666', '88888888', 'jkrjövkjdfigjirejfeijösjdöjijij' ), array( self::IGNORE_EMPTY, self::IGNORE_NULL ) );
  }

  public function testPartnerCountries() {

    $this->performPropertyTests( $this->Project, 'PartnerCountries', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT150, -1, 0, 1, 3223232 ), array( self::TEXT150 . '1', self::TEXT150 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testScopeCountries() {

    $this->performPropertyTests( $this->Project, 'ScopeCountries', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT150, -1, 0, 1, 3223232 ), array( self::TEXT150 . '1', self::TEXT150 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testHomePage() {

    $this->performPropertyTests( $this->Project, 'HomePage', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT250, -1, 0, 1, 3223232 ), array( self::TEXT250 . '1', self::TEXT250 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testFocus() {

    $this->performPropertyTests( $this->Project, 'Focus', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc||||||||dddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  private $Project;

}

