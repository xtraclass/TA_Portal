<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * List of Publication objects
 */
class ThePublications extends Vector {

  public function __construct() {

    parent::__construct();
  }

  public function addPublication( Publication $x ) {

    return $this->add( $x );
  }

}

?>