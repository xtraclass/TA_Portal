<?php
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla table library
jimport( 'joomla.database.table' );

/**
 * Seek Table class
 */
class SeekTableSeek extends JTable
{



  /**
   * Constructor
   *
   * @param object Database connector object
   */
  function __construct( &$db )
  {
    parent::__construct( '#__institute', 'id', $db );
  }
}
?>