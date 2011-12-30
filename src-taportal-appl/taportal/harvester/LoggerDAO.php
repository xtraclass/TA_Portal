<?php

/**
 * A DAO which saves the given log message to the database.
 * <p>
 * Used by Logger.
 */
final class LoggerDAO extends DAOBase
{



  /**
   * @param Logger $logger The parent logger.
   * @param HarvesterConfiguration $config For connecting to the database system.
   */
  public function __construct( Logger $logger, HarvesterConfiguration $config )
  {
    parent::__construct( $logger, $config );
  }



  /**
   * This stores the given message or exception or both in the database.
   * 
   * @param string $message May br NULL, but then exception must not be NULL.
   * @param Exception $exception May br NULL, but then message must not be NULL.
   * @param Institute $institute The institute for which a harvesting is performed.
   * @param int $harvestId The ID of the current harvest process.
   */
  public function saveInAppLog( $message, $exception = NULL, $institute = NULL, $harvestId = 0 )
  {
    $this->doInDB( function ( $me ) use($message, $exception, $institute, $harvestId )
    {
      $point = date( 'Y-m-d H:m:s' );
      $fkInstitute = is_null( $institute ) ? 0 : $institute->getId();
      $hid = is_null( $harvestId ) ? 0 : $harvestId;
      
      $sql = 'insert into joomla_harvesterlog( point, message, exception, fkinstitute, harvestid ) values ( ' . /***/
      "'" . $point . "'" . /***/
      ", '" . $message . "'" . /***/
      ", '" . $exception . "'" . /***/
      ", " . $fkInstitute . /***/
      ", " . $hid . /***/
      ' )';
      
      mysql_query( $sql, $me->getConnection() );
    } );
  }

}

?>