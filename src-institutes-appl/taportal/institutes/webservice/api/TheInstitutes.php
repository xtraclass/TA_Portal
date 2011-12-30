<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * List of Institute objects
 */
class TheInstitutes extends Vector {

  public function __construct() {

    parent::__construct();
  }

  public function addInstitute( Institute $x ) {

    return $this->add( $x );
  }

}

?>