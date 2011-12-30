<?php

require_once 'taportal/harvester/Classes.php';
require_once 'taportal/institutes/webservice/tests/TestBase.php';
require_once 'PHPUnit\Framework\TestCase.php';

class ExpertTest extends TestBase {

  protected function setUp() {

    parent::setUp();
    $this->Expert = new Expert();
  }

  protected function tearDown() {

    $this->Expert = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  public function testGetUK() {

    $this->Expert->setSurname( 'Smith' )->setFirstnames( 'John' );
    $this->assertSame( array( 'Smith', 'John' ), $this->Expert->getUK() );
    
    $this->Expert->setSurname( ' ' )->setFirstnames( 'John' );
    $this->assertSame( array( ' ', 'John' ), $this->Expert->getUK() );
    
    $this->Expert->setSurname( 'Smith' )->setFirstnames( ' ' );
    $this->assertSame( array( 'Smith', ' ' ), $this->Expert->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure() {

    $this->Expert->getUK();
  }

  public function testProjects() {

    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 0, $this->Expert->getProjects()
      ->size() );
    
    $project1 = new Project();
    $project1->setShortTitleE( 'Proj1' )->setShortDescriptionE( 'bla' );
    
    $project2 = new Project();
    $project2->setShortTitleE( 'Proj2' )->setShortDescriptionE( 'blaxblax' );
    
    $this->Expert->addProject( $project1 );
    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 1, $this->Expert->getProjects()
      ->size() );
    $this->assertSame( $project1, $this->Expert->getProjects()
      ->get( 0 ) );
    
    $this->Expert->addProject( $project1 );
    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 1, $this->Expert->getProjects()
      ->size() );
    $this->assertSame( $project1, $this->Expert->getProjects()
      ->get( 0 ) );
    
    $this->Expert->clearProjects();
    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 0, $this->Expert->getProjects()
      ->size() );
    
    $this->Expert->addProject( $project1 );
    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 1, $this->Expert->getProjects()
      ->size() );
    $this->assertSame( $project1, $this->Expert->getProjects()
      ->get( 0 ) );
    $this->assertSame( $this->Expert, $project1->getContactPerson() );
    
    $this->Expert->addProject( $project2 );
    $this->assertNotNull( $this->Expert->getProjects() );
    $this->assertSame( 2, $this->Expert->getProjects()
      ->size() );
    $this->assertSame( $project1, $this->Expert->getProjects()
      ->get( 0 ) );
    $this->assertSame( $project2, $this->Expert->getProjects()
      ->get( 1 ) );
    $this->assertSame( $this->Expert, $project2->getContactPerson() );
  }

  public function testSurname() {

    $this->performPropertyTests( $this->Expert, 'Surname', array( 'a', 'dfsdfsd', "cccccc\n\ndddd", '1234567890123456789012345678901', self::TEXT150, -1, 0, 1, 3223232 ), array( self::TEXT150 . '1', self::TEXT150 . '4j23kjö42kj42j3k4' ), array( self::IGNORE_EMPTY ) );
  }

  public function testFirstnames() {

    $this->performPropertyTests( $this->Expert, 'Firstnames', array( 'a', 'dfsdfsd', "cccccc\n\ndddd", '1234567890123456789012345678901', self::TEXT100, -1, 0, 1, 3223232 ), array( self::TEXT100 . '1', self::TEXT100 . '4j23kjö42kj42j3k4' ), array( self::IGNORE_EMPTY ) );
  }

  public function testExpTitle() {

    $this->performPropertyTests( $this->Expert, 'ExpTitle', array( 'a', 'dfsdfsd', "cccccc\n\ndddd", '123456789012345', -1, 0, 1, 3223232 ), array( '1234567890123456', '1234567890123451111111111111111' ), array( self::IGNORE_EMPTY ) );
  }

  public function testEMail() {

    $this->performPropertyTests( $this->Expert, 'EMail', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '12345678901234567890123456789012345678901234567890123456789', self::TEXT256, -1, 0, 1, 3223232 ), array( self::TEXT256 . '1', self::TEXT256 . '1dkjfsdjf45trfrtvbt 45t'  ), array( self::IGNORE_EMPTY ) );
  }

  public function testPhoneNumber() {

    $this->performPropertyTests( $this->Expert, 'PhoneNumber', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '123456789012345678901', -1, 0, 1, 3223232 ), array( '1234567890123456789012', '1234567890123456789012345678kmvfkmfkvmkfmvkfmkvfm' ), array( self::IGNORE_EMPTY ) );
  }

  public function testSkypeID() {

    $this->performPropertyTests( $this->Expert, 'SkypeID', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1234567890123456789012345678', -1, 0, 1, 3223232 ), array( '12345678901234567890123456789', '1234567890123456789012345678kmvfkmfkvmkfmvkfmkvfm' ), array( self::IGNORE_EMPTY ) );
  }

  public function testExpertise() {

    $this->performPropertyTests( $this->Expert, 'Expertise', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '3eee3e3e3e3e3e3e' ), array( self::IGNORE_EMPTY ) );
  }

  public function testEmplURL() {

    $this->performPropertyTests( $this->Expert, 'EmplURL', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testInstitute() {

  }

  public function testTAPublicationURL() {

    $this->performPropertyTests( $this->Expert, 'TAPublicationURL', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testTAProjectURL() {

    $this->performPropertyTests( $this->Expert, 'TAProjectURL', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  private $Expert;

}

