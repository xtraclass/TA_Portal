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

}

?>