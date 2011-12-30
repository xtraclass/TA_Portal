<?php

require_once 'taportal/tests/_Classes.php';

class PublicationTest extends TestBase {

  protected function setUp() {

    parent::setUp();
    $this->Publication = new Publication(/* parameters */);
  }

  protected function tearDown() {

    $this->Publication = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK2() {

    $this->Publication->setQuotation( 'Java forever' )->setPublDate( '2011' );
    $this->assertSame( array( 'Java forever', '2011' ), $this->Publication->getUK() );
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure_setQuotation() {

    $this->Publication->setQuotation( 'Java forever' );
    $this->Publication->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure_setPublDate() {

    $this->Publication->setPublDate( '2011' );
    $this->Publication->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure_2() {

    $this->Publication->setQuotation( '' )->setPublDate( '2011' );
    $this->Publication->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure_3() {

    $this->Publication->setQuotation( 'Java forever' )->setPublDate( '' );
    $this->Publication->getUK();
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testGetUK_failure() {

    $this->Publication->getUK();
  }

  public function testQuotation() {

    $this->performPropertyTests( $this->Publication, 'Quotation', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testShortDescription() {

    $this->performPropertyTests( $this->Publication, 'ShortDescription', array( 'a', 'bbbbbbbbbbbbbbbbbb', "cccccc\n\ndddddddddd", '1276187267816287162781678612761782612', self::TEXT500, -1, 0, 1, 3223232 ), array( self::TEXT500 . '1', self::TEXT500 . '2kjlk2jkl2j' ), array( self::IGNORE_EMPTY ) );
  }

  public function testPublDate() {

    $this->performPropertyTests( $this->Publication, 'PublDate', array( '1234', '1000', '2100', '2000-01-02', '1999-12-31', '2000-02-29' ), array( '0900', '3001', '2000-30-30', '2123-13-13', '1', '22', '333', '4444', '55555', '666666', '88888888', 'jkrjövkjdfigjirejfeijösjdöjijij' ), array( self::IGNORE_EMPTY, self::IGNORE_NULL ) );
  }

  public function testPublType() {

    $this->performPropertyTests( $this->Publication, 'PublType', array( PublicationTypeEnum::article(), PublicationTypeEnum::book(), PublicationTypeEnum::default_(), PublicationTypeEnum::presentation(), PublicationTypeEnum::project_report() ), array(), array( self::IGNORE_EMPTY, self::IGNORE_NULL ) );
  }

  public function testInstitute() {

  }

  private $Publication;

}

