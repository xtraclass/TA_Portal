<?php
/**
 * This is a small demo program which creates a few entities and
 * returns them as JSON formatted to the web browser.
 */

require_once 'taportal/harvester/_Classes.php';
require_once 'taportal/tests/FakedEntitiesMaker.php';

header( "Content-type: application/json; charset=ISO-8859-1" );
header( "Content-Transfer-Encoding: 8bit" );
header( 'Cache-Control: no-cache, must-revalidate' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );

list( $institutes, $experts, $projects, $publications ) = FakedEntitiesMaker::fakeExample1();

echo JSONBuilder::build( $institutes, $experts, $projects, $publications );

?>