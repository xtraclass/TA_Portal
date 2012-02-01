<?php
// No direct access to this file
defined( '_JEXEC' ) or die();

// import the list field type
jimport( 'joomla.form.helper' );
JFormHelper::loadFieldClass( 'list' );

/**
 * HelloWorld Form Field class for the HelloWorld component
 */
class JFormFieldSeek extends JFormFieldList
{

  /**
   * The field type.
   *
   * @var		string
   */
  protected $type = 'institutes';



  /**
   * Method to get a list of options for a list input.
   *
   * @return	array		An array of JHtml options.
   */
  protected function getOptions()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery( true );
    $query->select( 'id,abbreviation' );
    $query->from( '#__institute' );
    $db->setQuery( (string)$query );
    $rows = $db->loadObjectList();
    $options = array();
    if ( $rows )
    {
      foreach ( $row as $rows )
      {
        $options[] = JHtml::_( 'select.option', $row->id, $row->abbreviation );
      }
    }
    $options = array_merge( parent::getOptions(), $options );
    return $options;
  }
}
?>