<?php

/**
 * List of Project objects
 */
final class TheProjects extends Vector
{



  public function __construct()
  {
    parent::__construct();
  }



  public function addProject( Project $x )
  {
    return $this->add( $x );
  }



  public function search( $lookFor )
  {
    $found = new TheProjects();
    
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

}

?>