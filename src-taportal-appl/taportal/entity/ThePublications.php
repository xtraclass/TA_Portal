<?php

/**
 * List of Publication objects
 */
final class ThePublications extends Vector
{



  public function __construct()
  {
    parent::__construct();
  }



  public function addPublication( Publication $x )
  {
    return $this->add( $x );
  }



  public function search( $lookFor )
  {
    $found = new ThePublications();
    
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
    else
    {
      return $this;
    }
    
    return $found;
  }



  public function searchByPublType( $lookFor, $publType )
  {
    $found = new ThePublications();
    
    if ( !is_null( $lookFor ) and strlen( $lookFor ) >= 1 )
    {
      for( $i = 0; $i < $this->size(); $i++ )
      {
        if ( $publType == $this->get( $i )->getPublType() and $this->get( $i )->search( $lookFor ) )
        {
          $found->add( $this->get( $i ) );
        }
      }
    }
    
    return $found;
  }

}

?>