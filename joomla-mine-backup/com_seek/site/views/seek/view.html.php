<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla view library
jimport( 'joomla.application.component.view' );
require_once 'taportal/harvester/_Classes.php';

/**
 * HTML View class for the Seek Component
 */
class SeekViewSeek extends JView
{



  // Overwriting JView display method
  function display( $tpl = null )
  {
    // Assign data to the view
    list( $this->institutes, $this->experts, $this->projects, $this->publications ) = $this->get( 'Data' );
    
    // Check for errors.
    if ( count( $errors = $this->get( 'Errors' ) ) )
    {
      JError::raiseError( 500, implode( '<br />', $errors ) );
      return false;
    }
    
    // Display the view
    parent::display( $tpl );
  }
}
?>