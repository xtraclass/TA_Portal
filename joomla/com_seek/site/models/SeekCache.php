<?php

final class SeekCache
{



  public static function setMaximumCheck( $maximum )
  {
    if ( is_null( $maximum ) or $maximum <= 0 )
    {
      throw new InvalidArgumentException( "Argument 'maximum' is not greater than 0." );
    }
    
    $this->max = $maximum;
  }



  public static function expired()
  {
    ++SeekCache::$counter;
    
    if ( SeekCache::$counter >= SeekCache::$max )
    {
      SeekCache::$counter = 0;
      return TRUE;
    }
    
    return FALSE;
  }



  public static function getMaximum()
  {
    return SeekCache::$max;
  }



  public static function getCcounter()
  {
    return SeekCache::$counter;
  }

  private static $counter = 0;

  private static $max = 20;



  private function __construct()
  {
  }

}

?>