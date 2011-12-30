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

}

?>