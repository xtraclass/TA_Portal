<?php
/**
 * This calls the Harvester.
 */

require_once 'taportal/harvester/_Classes.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

/**
 * 
 */
Harvester::harvest();

?>