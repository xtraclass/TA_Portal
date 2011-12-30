<?php

/**
 * Logger implementation which stores messages
 * either in the database
 * or in memory (for displaying them later as HTML).
 */
final class Logger
{



  /**
   * Returns a singleton instance of a logger
   * which generates HTML output.
   */
  public static function getLoggerForHTMLOutput()
  {
    if ( !is_null( self::$LOGGER_HTML ) )
    {
      return self::$LOGGER_HTML;
    }
    
    self::$LOGGER_HTML = new Logger( TRUE );
    
    return self::$LOGGER_HTML;
  }



  /**
   * Returns a singleton instance of a logger
   * which stores the messages in the database.
   */
  public static function getLoggerForDatabaseOutput( HarvesterConfiguration $harvesterConfiguration )
  {
    if ( !is_null( self::$LOGGER_DATABASE ) )
    {
      return self::$LOGGER_DATABASE;
    }
    
    self::$LOGGER_DATABASE = new Logger( NULL, $harvesterConfiguration );
    
    return self::$LOGGER_DATABASE;
  }



  /**
   * Returns a singleton instance of a logger
   * which generates HTML output and stores the messages in the database.
   */
  public static function getLoggerForHTMLAndDatabaseOutput( HarvesterConfiguration $harvesterConfiguration )
  {
    if ( !is_null( self::$LOGGER_HTML_DATABASE ) )
    {
      return self::$LOGGER_HTML_DATABASE;
    }
    
    self::$LOGGER_HTML_DATABASE = new Logger( TRUE, $harvesterConfiguration );
    
    return self::$LOGGER_HTML_DATABASE;
  }

  /**
   * The singleton instance of a logger for HTML output.
   * 
   * @var Logger
   */
  private static $LOGGER_HTML;

  /**
   * The singleton instance of a logger for database output.
   * 
   * @var Logger
   */
  private static $LOGGER_DATABASE;

  /**
   * The singleton instance of a logger for HTML and database output.
   * 
   * @var Logger
   */
  private static $LOGGER_HTML_DATABASE;



  /**
   * @param HarvesterConfiguration $harvesterConfiguration For connecting to the database.
   */
  private function __construct( $htmlOutput, $harvesterConfiguration = NULL )
  {
    date_default_timezone_set( 'UTC' );
    
    if ( $htmlOutput )
    {
      $this->messages = new HarvesterMessages();
    }
    
    if ( !is_null( $harvesterConfiguration ) )
    {
      $this->dao = new LoggerDAO( $this, $harvesterConfiguration );
    }
    
    return $this;
  
  }



  /**
   * This logs the given message or exception or both.
   * 
   * @param string $message May br NULL, but then exception must not be NULL.
   * @param Exception $exception May br NULL, but then message must not be NULL.
   * @param Institute $institute The institute for which a harvesting is performed.
   * @param int $harvestId The ID of the current harvest process.
   */
  public function log( $message, $exception = NULL, $institute = NULL, $harvestId = NULL )
  {
    if ( is_null( $message ) and is_null( $exception ) )
    {
      return;
    }
    
    if ( !is_null( $this->messages ) )
    {
      $this->messages->addMessage( $this->makeTotalMessage( $message, $exception, $institute, $harvestId ) );
    }
    
    if ( !is_null( $this->dao ) )
    {
      $this->dao->saveInAppLog( $message, $exception, $institute, $harvestId );
    }
    
    $this->setErrorWasLogged( ( !is_null( $message ) and !( strpos( $message, 'ERROR ' ) === FALSE ) ) or !is_null( $exception ) );
    
    return $this;
  }



  /**
   * This returns a single string containing all the given method arguments.
   *
   * @param string $message May br NULL, but then exception must not be NULL.
   * @param Exception $exception May br NULL, but then message must not be NULL.
   * @param Institute $institute The institute for which a harvesting is performed.
   * @param int $harvestId The ID of the current harvest process.
   */
  private function makeTotalMessage( $message, $exception = NULL, $institute = NULL, $harvestId = NULL )
  {
    $hasMessage = !is_null( $message );
    $hasException = !is_null( $exception );
    
    $now = date( 'Y-m-d H:m:s', strtotime( 'now' ) );
    $text = "$now";
    
    if ( !is_null( $institute ) )
    {
      $text .= " {$institute->shortDisplayString()}";
    }
    
    if ( !is_null( $harvestId ) )
    {
      $text .= ", harvest: {$harvestId}";
    }
    
    if ( $hasMessage )
    {
      $text .= ", {$message}";
    }
    
    if ( $hasException )
    {
      $text .= ", ERROR: {$exception->getMessage()}";
      $text .= ", {$exception->getTraceAsString()}";
    }
    
    return $text;
  }



  /**
   * This returns true, if either an error message (exception) was logged
   * or if the flaf was set manually.
   */
  public function wasErrorLogged()
  {
    return $this->errorWasLogged;
  }



  /**
   * This sets the internal error flag to the given value.
   * 
   * @param boolean $wasLogged
   * @return This Logger.
   */
  public function setErrorWasLogged( $wasLogged )
  {
    $this->errorWasLogged = $wasLogged;
    return $this;
  }



  /**
   * This returns the internal list of messages
   * formatted as HTML.
   */
  public function getMessagesIfAnyAsHTML()
  {
    if ( is_null( $this->messages ) )
    {
      return '';
    }
    else
    {
      return $this->messages->asHTML();
    }
  }

  /**
   * The internal list of logging messages.
   */
  private $messages;

  /**
   * The DAO for logging messages.
   */
  private $dao;

  /**
   * The internal error flag to indicate if an error message
   * was logged.
   */
  private $errorWasLogged = FALSE;

}

?>