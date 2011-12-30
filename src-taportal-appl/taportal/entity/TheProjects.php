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

}

?>