<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * List of Expert objects
 */
class TheExperts extends Vector {

  public function __construct() {

    parent::__construct();
  }

  public function addExpert( Expert $x ) {

    return $this->add( $x );
  }

}

?>