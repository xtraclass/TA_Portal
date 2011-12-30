<?php

require_once 'taportal/institutes/webservice/base/Classes.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Helper class used as super class of test classes. This offers a way to use generic test
 * cases for set/get-methods, i. e. one does not have to implement complicated tests
 * for set/get-methods, but only use a call to a helper method of this class here..
 */
class TestBase extends PHPUnit_Framework_TestCase {

  /**
   * Text of 50 characters. 
   */
  const TEXT50 = '01234567890123456789012345678901234567890123456789';

  /**
   * Text of 10 characters. 
   */
  const TEXT100 = '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789';

  /**
   * Text of 150 characters. 
   */
  const TEXT150 = '012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789';

  /**
   * Text of 200 characters. 
   */
  const TEXT200 = '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789';

  /**
   * Text of 250 characters. 
   */
  const TEXT250 = '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789';

  /**
   * Text of 256 characters. 
   */
  const TEXT256 = '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345';

  /**
   * Text of 500 characters. 
   */
  const TEXT500 = '01234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789';

  /**
   * Parameter for the configuration: tests with the value NULL shall not be performed. 
   */
  const IGNORE_NULL = 'ignoreNull';

  /**
   * Parameter for the configuration: tests with the value '' shall not be performed. 
   */
  const IGNORE_EMPTY = 'ignoreEmpty';

  /**
   * This does all necessary tests for the set- and get-method of a given property of a SUT. 
   * 
   * @param object $sut The subject under test
   * @param string $propertyName The name of the property for which a test case is being done, like 'Person', so here getPerson() is created
   * @param array of string of string values $validArguments Array of valid string values for the given property of the given object
   * @param array of string values $invalidArguments Array of invalid string values for the given property of the given object
   * @param array of string values $configuration Array of property names (if the name exists in this array, the property for this TestBase is seen as set to TRUE)
   */
  protected function performPropertyTests( $sut, $propertyName, $validArguments, $invalidArguments = array(), $configuration = NULL ) {

    $argsCount = count( $validArguments );
    $reflector = new ReflectionClass( $sut );
    $mess = 0;
    
    if ( $argsCount >= 1 ) {
      $this->set( $sut, $propertyName, $validArguments[ 0 ], $reflector );
      $this->assertNotNull( $this->get( $sut, $propertyName, $reflector ), 'Message dnjeuhg848ur84ujr' );
      $this->assertSame( $validArguments[ 0 ], $this->get( $sut, $propertyName, $reflector ), 'Message vfndv874z39urnvf' );
    }
    
    if ( !$this->hasConfigValue( $configuration, self::IGNORE_EMPTY ) ) {
      $exceptionThrown = FALSE;
      try {
        $this->set( $sut, $propertyName, '', $reflector );
        $this->assertNotNull( $this->get( $sut, $propertyName, $reflector ), 'Message 8ufr8ufjnvn--' . $mess++ );
        $this->assertSame( '', $this->get( $sut, $propertyName, $reflector ), 'Message trrtgbzntz456t45t--' . $mess++ );
      }
      catch ( InvalidArgumentException $x ) {
        $exceptionThrown = TRUE;
      }
      if ( !$exceptionThrown ) {
        $this->fail( 'InvalidArgumentException was not thrown, i. e. \'\' seems to be a possible value, but shoud not.' );
      }
    }
    
    if ( $argsCount >= 2 ) {
      $this->set( $sut, $propertyName, $validArguments[ 1 ], $reflector );
      $this->assertNotNull( $this->get( $sut, $propertyName, $reflector ), 'Message vfder3444h4556t5--' . $mess++ );
      $this->assertSame( $validArguments[ 1 ], $this->get( $sut, $propertyName, $reflector ), 'Message sewf456zh54r34--' . $mess++ );
    }
    
    if ( !$this->hasConfigValue( $configuration, self::IGNORE_NULL ) ) {
      $this->set( $sut, $propertyName, NULL, $reflector );
      $this->assertNull( $this->get( $sut, $propertyName, $reflector ), 'Message k,bhgff54vvdffd--' . $mess++ );
    }
    
    if ( $argsCount >= 3 ) {
      for( $i = 2; $i < $argsCount; $i++ ) {
        $this->set( $sut, $propertyName, $validArguments[ $i ], $reflector );
        $this->assertNotNull( $this->get( $sut, $propertyName, $reflector ), 'Message 8ufr8ufjnvn--' . $mess++ );
        $this->assertSame( $validArguments[ $i ], $this->get( $sut, $propertyName, $reflector ), 'Message hnh65ztrbgf34--' . $mess++ );
      }
    }
    
    foreach ( $invalidArguments as $arg ) {
      $exceptionThrown = FALSE;
      try {
        $this->set( $sut, $propertyName, $arg, $reflector );
      }
      catch ( InvalidArgumentException $x ) {
        $exceptionThrown = TRUE;
      }
      if ( !$exceptionThrown ) {
        $this->fail( 'InvalidArgumentException was not thrown for invalid argument \'' . $arg . '\'.' );
      }
    }
  }

  /**
   * This returns a handler to a get-method.
   * 
   * @param object $sut The subject under test
   * @param string $propertyName The name of the property for which a test case is being done, like 'Person', so here getPerson() is created
   * @param Reflector $reflector The reflection object for the class of the SUT
   */
  private function get( $sut, $propertyName, $reflector ) {

    return $reflector->getMethod( 'get' . $propertyName )->invoke( $sut );
  }

  /**
   * This returns a handler to a set-method.
   * 
   * @param object $sut The subject under test
   * @param string $propertyName The name of the property for which a test case is being done, like 'Person', so here setPerson(...) is created
   * @param Reflector $reflector The reflection object for the class of the SUT
   */
  private function set( $sut, $propertyName, $arg, $reflector ) {

    return $reflector->getMethod( 'set' . $propertyName )->invoke( $sut, $arg );
  }

  /**
   * This returns TRUE, if $name is contained in $configuration. 
   * 
   * @param array of string $configuration An array with configuration names (the property is configured if there is a corresponding property name in this array) 
   * @param strring $name a object which might be contained in the array (theck is done by ===)
   */
  private function hasConfigValue( $configuration, $name ) {

    if ( is_null( $configuration ) ) return FALSE;
    
    foreach ( $configuration as $conf ) {
      if ( $conf === $name ) {
        return TRUE;
      }
    }
    return FALSE;
  }
}

?>