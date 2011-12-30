<?php

require_once 'taportal/institutes/webservice/base/Classes.php';
require_once 'taportal/institutes/webservice/tests/TestBase.php';
require_once 'PHPUnit/Framework/TestCase.php';

class InstituteTest extends TestBase {

  protected function setUp() {

    parent::setUp();
    $this->Institute = new Institute(/* parameters */);
  }

  protected function tearDown() {

    $this->Institute = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  public function testGetUK() {

    $this->Institute->setAbbreviation( 'X' )->setName( 'Test' );
    $this->assertSame( array( 'X' ), $this->Institute->getUK() );
    
    $this->Institute->setAbbreviation( '123' )->setName( 'Test' );
    $this->assertSame( array( '123' ), $this->Institute->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure1() {

    $this->Institute->setAbbreviation( '' )->setName( 'Test' );
    $this->assertSame( array( '' ), $this->Institute->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure2() {

    $this->Institute->setAbbreviation( NULL )->setName( 'Test' );
    $this->assertSame( array( '' ), $this->Institute->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure3() {

    $this->Institute->getUK();
  }

  public function testExperts() {

    $this->assertNotNull( $this->Institute->getExperts() );
    $this->assertEquals( 0, $this->Institute->getExperts()
      ->size() );
    
    $expert1 = new Expert();
    $expert1->setSurname( 'Smith' );
    $expert1->setFirstnames( 'John' );
    $expert1->setPhoneNumber( '111 111' );
    
    $expert2 = new Expert();
    $expert2->setSurname( 'Foo' );
    $expert2->setFirstnames( 'Mary' );
    $expert2->setPhoneNumber( '22 22 22' );
    
    $this->Institute->addExpert( $expert1 );
    $this->Institute->addExpert( $expert2 );
    $this->Institute->addExpert( $expert1 );
    $this->Institute->addExpert( $expert2 );
    
    $this->assertNotNull( $this->Institute->getExperts() );
    $this->assertEquals( 2, $this->Institute->getExperts()
      ->size() );
    $this->assertEquals( $expert1, $this->Institute->getExperts()
      ->get( 0 ) );
    $this->assertEquals( $expert2, $this->Institute->getExperts()
      ->get( 1 ) );
    $this->assertNull( $this->Institute->getExperts()
      ->get( 2 ) );
    
    $this->Institute->clearExperts();
    $this->assertNotNull( $this->Institute->getExperts() );
    $this->assertEquals( 0, $this->Institute->getExperts()
      ->size() );
    
    $this->Institute->setExpert( $expert1 );
    $this->Institute->setExpert( $expert1 );
    $this->assertNotNull( $this->Institute->getExperts() );
    $this->assertEquals( 1, $this->Institute->getExperts()
      ->size() );
    $this->assertEquals( $expert1, $this->Institute->getExperts()
      ->get( 0 ) );
    
    $this->Institute->setExpert( $expert2 );
    $this->Institute->setExpert( $expert2 );
    $this->assertNotNull( $this->Institute->getExperts() );
    $this->assertEquals( 1, $this->Institute->getExperts()
      ->size() );
    $this->assertEquals( $expert2, $this->Institute->getExperts()
      ->get( 0 ) );
  }

  public function testPublications() {

    $this->assertNotNull( $this->Institute->getPublications() );
    $this->assertEquals( 0, $this->Institute->getPublications()
      ->size() );
    
    $publication1 = new Publication();
    $publication1->setShortDescription( 'One' );
    $publication1->setPublDate( '2010' );
    
    $publication2 = new Publication();
    $publication2->setShortDescription( 'Two' );
    $publication2->setPublDate( '2009' );
    
    $this->Institute->addPublication( $publication1 );
    $this->Institute->addPublication( $publication1 );
    $this->Institute->addPublication( $publication2 );
    $this->Institute->addPublication( $publication2 );
    
    $this->assertNotNull( $this->Institute->getPublications() );
    $this->assertEquals( 2, $this->Institute->getPublications()
      ->size() );
    $this->assertEquals( $publication1, $this->Institute->getPublications()
      ->get( 0 ) );
    $this->assertEquals( $publication2, $this->Institute->getPublications()
      ->get( 1 ) );
    $this->assertNull( $this->Institute->getPublications()
      ->get( 2 ) );
    
    $this->Institute->clearPublications();
    $this->assertNotNull( $this->Institute->getPublications() );
    $this->assertEquals( 0, $this->Institute->getPublications()
      ->size() );
    
    $this->Institute->setPublication( $publication1 );
    $this->Institute->setPublication( $publication1 );
    $this->assertNotNull( $this->Institute->getPublications() );
    $this->assertEquals( 1, $this->Institute->getPublications()
      ->size() );
    $this->assertEquals( $publication1, $this->Institute->getPublications()
      ->get( 0 ) );
    
    $this->Institute->setPublication( $publication2 );
    $this->Institute->setPublication( $publication2 );
    $this->assertNotNull( $this->Institute->getPublications() );
    $this->assertEquals( 1, $this->Institute->getPublications()
      ->size() );
    $this->assertEquals( $publication2, $this->Institute->getPublications()
      ->get( 0 ) );
  }

  public function Abbreviation() {

    $this->performPropertyTests( $this->Institute, 'Abbreviation', array( 'a', '123456789', "1234\n67890", -1, 0, 1, 3223232 ), array( '12345678901', '12345678901901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY ) );
  }

  public function testCountryCode() {

    $this->performPropertyTests( $this->Institute, 'CountryCode', array( 'ab', '12', '00', 12, -1 ), array( '12345678901', '12345678901901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY, self::IGNORE_NULL ) );
  }

  public function testZipCode() {

    $this->performPropertyTests( $this->Institute, 'ZipCode', array( 'a', '123456789', "1234\n67890", -1, 0, 1, 3223232 ), array( '12345678901', '12345678901901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY ) );
  }

  public function testCity() {

    $this->performPropertyTests( $this->Institute, 'City', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', '1234567890123456789012345678901234567890', -1, 0, 1, 3223232 ), array( '12345678901234567890123456789012345678901', '1234567890123456789012345678901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY ) );
  }

  public function testName() {

    $this->performPropertyTests( $this->Institute, 'Name', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', '123456789012345678901234567890123456789012345678901', -1, 0, 1, 3223232 ), array( '1234567890123456789012345678901234567890123456789012', '1234567890123456789012345678901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY ) );
  }

  public function testStreet() {

    $this->performPropertyTests( $this->Institute, 'Street', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', '12345678901234567890123456789012345678901234567890', -1, 0, 1, 3223232 ), array( '123456789012345678901234567890123456789012345678901', '1234567890123456789012345678901234567890123456789rrrrrrrrrrrrrr' ), array( self::IGNORE_EMPTY ) );
  }

  public function testDescription() {

    $this->performPropertyTests( $this->Institute, 'Description', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', '1234567890123456789012345678901234567890123456789', self::TEXT500, -1, 0, 1, 3223232 ), array(  self::TEXT500 . '1',  self::TEXT500 . 'jvgiojvitj' ), array( self::IGNORE_EMPTY ) );
  }

  public function testURL() {

    $this->performPropertyTests( $this->Institute, 'URL', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', '123456789012345678901234567890123456789012', self::TEXT500, -1, 0, 1, 3223232 ), array(  self::TEXT500 . '1',  self::TEXT500 . 'jvgiojvitj' ), array( self::IGNORE_EMPTY ) );
  }

  private $Institute;

}

