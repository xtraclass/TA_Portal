<?php

/**
 * Enumeration for the type of a publication. Instead of using
 * strings or integers or simliar types which are not restricted, the
 * usage of an enumeration only allows certain values to be used.
 */
final class PublicationTypeEnum
{



  /**
   * This returns the (singleton) enum witrh the value 'default'. 
   */
  public static function default_()
  {
    if ( is_null( self::$enum0 ) )
    {
      self::$enum0 = new PublicationTypeEnum( 'default' );
    }
    return self::$enum0;
  }



  /**
   * This returns the (singleton) enum witrh the value 'article'. 
   */
  public static function article()
  {
    if ( is_null( self::$enum1 ) )
    {
      self::$enum1 = new PublicationTypeEnum( 'article' );
    }
    return self::$enum1;
  }



  /**
   * This returns the (singleton) enum witrh the value 'book'. 
   */
  public static function book()
  {
    if ( is_null( self::$enum2 ) )
    {
      self::$enum2 = new PublicationTypeEnum( 'book' );
    }
    return self::$enum2;
  }



  /**
   * This returns the (singleton) enum witrh the value 'project report'. 
   */
  public static function project_report()
  {
    if ( is_null( self::$enum3 ) )
    {
      self::$enum3 = new PublicationTypeEnum( 'project report' );
    }
    return self::$enum3;
  }



  /**
   * This returns the (singleton) enum witrh the value 'presentation'. 
   */
  public static function presentation()
  {
    if ( is_null( self::$enum4 ) )
    {
      self::$enum4 = new PublicationTypeEnum( 'presentation' );
    }
    return self::$enum4;
  }



  /**
   * This returns the enum for the given string value.
   * 
   * @param string $stringValue
   */
  public static function byStringValue( $stringValue )
  {
    switch ( $stringValue )
    {
      case 'article' :
        return self::article();
      case 'book' :
        return self::book();
      case 'default' :
        return self::default_();
      case 'presentation' :
        return self::presentation();
      case 'project report' :
        return self::project_report();
      default :
        return NULL;
    }
  }

  /**
   * This singleton instance is the first enum. 
   */
  private static $enum0;

  /**
   * This singleton instance is the second enum. 
   */
  private static $enum1;

  /**
   * This singleton instance is the third enum. 
   */
  private static $enum2;

  /**
   * This singleton instance is the fourth enum. 
   */
  private static $enum3;

  /**
   * This singleton instance is the fifth enum. 
   */
  private static $enum4;



  /**
   * This creates an enum with the given (string) value. 
   */
  private function __construct( $value )
  {
    $this->value = $value;
  }



  /**
   * This returns the value (a string). 
   */
  public function value()
  {
    return $this->value;
  }



  public function __toString()
  {
    return "[PublicationTypeEnum]{$this->value}";
  }

  /**
   * The string value of the enum. 
   */
  private $value;

}

?>