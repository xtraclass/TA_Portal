<?php

/**
 * List of Institute objects
 */
final class TheInstitutes extends Vector
{



  public function __construct()
  {
    parent::__construct();
  }



  public function addInstitute( Institute $x )
  {
    return $this->add( $x );
  }



  public function search( $lookFor )
  {
    $found = new TheInstitutes();
    
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



  public function getAllExperts()
  {
    $all = array();
    
    for( $i = 0; $i < $this->size(); $i++ )
    {
      $exp = $this->get( $i )->getExperts();
      for( $j = 0; $j < $exp->size(); $j++ )
      {
        if ( isset( $exp ) )
        {
          $all[] = $exp->get( $j );
        }
      }
    }
    
    return $all;
  }



  public function getAllPublications()
  {
    $all = array();
    
    for( $i = 0; $i < $this->size(); $i++ )
    {
      $pub = $this->get( $i )->getPublications();
      for( $j = 0; $j < $pub->size(); $j++ )
      {
        if ( isset( $pub ) )
        {
          $all[] = $pub->get( $j );
        }
      }
    }
    
    return $all;
  }

}

?>