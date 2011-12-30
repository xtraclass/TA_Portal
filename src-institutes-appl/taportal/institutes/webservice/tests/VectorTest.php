<?php

require_once 'taportal/institutes/webservice/base/Classes.php';
require_once 'taportal/institutes/webservice/tests/TestBase.php';
require_once 'PHPUnit\Framework\TestCase.php';

class VectorTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    parent::setUp();
    $this->Vector = new Vector(/* parameters */);
  }

  protected function tearDown() {

    $this->Vector = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  public function testAddRemoveGet() {

    $this->assertTrue( $this->Vector->size() === 0 );
    
    $result = $this->Vector->add( '123' );
    $this->assertTrue( $result );
    $this->assertTrue( $this->Vector->size() === 1 );
    
    $result = $this->Vector->add( '456' );
    $this->assertTrue( $result );
    $this->assertTrue( $this->Vector->size() === 2 );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    $this->assertSame( '456', $this->Vector->get( 1 ) );
    
    $this->Vector->remove( '456' );
    $this->assertTrue( $this->Vector->size() === 1 );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    
    $result = $this->Vector->add( '123' );
    $this->assertTrue( $this->Vector->size() === 1 );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    
    $result = $this->Vector->add( '789' );
    $this->assertTrue( $this->Vector->size() === 2 );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    $this->assertSame( '789', $this->Vector->get( 1 ) );
    
    $result = $this->Vector->add( '456' );
    $this->assertTrue( $result );
    $this->assertTrue( $this->Vector->size() === 3 );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    $this->assertSame( '789', $this->Vector->get( 1 ) );
    $this->assertSame( '456', $this->Vector->get( 2 ) );
  }

  public function testGet() {

    $this->assertNull( $this->Vector->get( 0 ) );
    
    $this->Vector->add( '123' );
    $this->Vector->add( '456' );
    $this->assertSame( '123', $this->Vector->get( 0 ) );
    $this->assertSame( '456', $this->Vector->get( 1 ) );
  
  }

  public function testClear() {

    $this->Vector->clear();
    $this->assertTrue( $this->Vector->size() == 0 );
    
    $this->Vector->add( '123' );
    $this->Vector->add( '456' );
    $this->assertTrue( $this->Vector->size() != 0 );
    
    $this->Vector->clear();
    $this->assertTrue( $this->Vector->size() == 0 );
  
  }

  public function testContains() {

    $this->assertFalse( $this->Vector->contains( '123' ) );
    
    $this->Vector->add( '123' );
    $this->Vector->add( '456' );
    
    $this->assertTrue( $this->Vector->contains( '123' ) );
    $this->assertTrue( $this->Vector->contains( '456' ) );
    $this->assertFalse( $this->Vector->contains( '1' ) );
  
  }

  private $Vector;

}