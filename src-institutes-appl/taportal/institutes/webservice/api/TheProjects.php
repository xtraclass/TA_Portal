<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * List of Project objects
 */
class TheProjects extends Vector {

  public function __construct() {

    parent::__construct();
  }

  public function addProject( Project $x ) {

    return $this->add( $x );
  }

}

?>