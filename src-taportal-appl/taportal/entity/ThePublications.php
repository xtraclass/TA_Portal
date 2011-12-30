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

}

?>