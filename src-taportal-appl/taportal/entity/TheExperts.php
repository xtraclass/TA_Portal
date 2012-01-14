<?php

/**
 * List of Expert objects
 */
final class TheExperts extends Vector
{



  public function __construct()
  {
    parent::__construct();
  }



  public function addExpert( Expert $x )
  {
    return $this->add( $x );
  }



  public function search( $lookFor )
  {
    $found = new TheExperts();
    
    if ( !is_null( $lookFor ) and strlen( $lookFor ) >= 1 )
    {
      for( $i = 0; $i < $this->size(); $i++ )
      {
        if ( $this->get( $i )->search( $lookFor ) )
        {
          $found->add( $this->get( $i ) );
        }
      }
    }
    
    return $found;
  }

}

?>