<?php

/**
 * Base class for all DAO's (Data Access Objects).
 * <p>
 * Offers functionality for opening and closing a database connection, logging, and
 * a template method for operations with the database.
 */
abstract class DAOBase
{

  /**
   * Must be static, because the connection has to be the same for all DAO objects.
   */
  private static $connection;

  /**
   * Must be static, because the logger has to be the same for all DAO objects.
   * 
   * @var Logger
   */
  protected static $logger;



  /**
   * @param Logger $logger Must not be NULL.
   * @param HarvesterConfiguration $config Must not be NULL.
   * @throws InvalidArgumentException If method arguments are NULL.
   */
  public function __construct( Logger $logger, HarvesterConfiguration $config )
  {
    if ( is_null( self::$logger ) and is_null( $logger ) )
    {
      throw new InvalidArgumentException( 'Argument "$logger" must not be NULL.' );
    }
    if ( is_null( $config ) )
    {
      throw new InvalidArgumentException( 'Argument "$config" must not be NULL.' );
    }
    
    $this->config = $config;
    
    if ( is_null( self::$logger ) )
    {
      self::$logger = $logger;
    }
  }



  /**
   * Makes a new connection to the database system, if none is open already.
   * 
   * @throws RuntimeException If connection cannot be established or database catalogue cannot be selected.
   */
  protected function connect()
  {
    if ( is_null( self::$connection ) )
    {
      $hostName = $this->config->getDatabaseHostName();
      $userName = $this->config->getDatabaseUserName();
      $password = $this->config->getDatabasePassword();
      $databaseName = $this->config->getDatabaseName();
      
      self::$connection = @mysql_connect( $hostName, $userName, $password );
      
      if ( is_null( self::$connection ) )
      {
        throw new RuntimeException( "Could not connect to MySQL database system on $hostName for user $userName: " . mysql_error() );
      }
      else
      {
        if ( !@mysql_select_db( $databaseName, self::$connection ) )
        {
          throw new RuntimeException( "Could not open database $databaseName: " . mysql_error() );
        }
      }
    }
  }



  /**
   * This closes the database connection, if it is open. 
   */
  protected function close()
  {
    if ( !is_null( self::$connection ) )
    {
      mysql_close( self::$connection );
      self::$connection = NULL;
    }
  }



  /**
   * This method calls the given function.
   * <p>
   * This method can be used to do something within the database without thinking about opening and closing a database connection.
   * <p>
   * First it opens a database connection, if none is open.
   * Then it calls the given function.
   * Finally it closes the database connection, if one is open.
   * <p>
   * If an exception is thrown within the given function, this method re-throws it.
   * <br>
   * If opening or closing the database connection causes an exception, then that exception is thrown, unless
   * the given function has thrown one, then the exception of the given function is re-thrown.
   *
   * @param $function
   * @throws Exception
   * @throws Ambigous <NULL, Exception>
   */
  protected function doInDB( $function )
  {
    /**
     * Stores the exception thrown in the given function,
     * so that it can be re-thrown.
     */
    $exceptionInFunction = NULL;
    
    try
    {
      $this->connect();
      
      try
      {
        $function( $this );
      }
      catch ( Exception $x2 )
      {
        $exceptionInFunction = $x2;
      }
      
      $this->close();
      if ( !is_null( $exceptionInFunction ) )
      {
        throw $exceptionInFunction;
      }
    }
    catch ( Exception $x1 )
    {
      if ( is_null( $exceptionInFunction ) )
      {
        throw $x1;
      }
      else
      {
        throw $exceptionInFunction;
      }
    }
  }



  /**
   * This returns the current, open connection.
   */
  public function getConnection()
  {
    if ( is_null( self::$connection ) )
    {
      $this->connect();
    }
    
    return self::$connection;
  }



  /**
   * This returns the list of messages, i. e. the logging output.
   */
  public function getMessages()
  {
    return $this->messages;
  }



  /**
   * This logs the given message or exception.
   * 
   * @param string $message The logging message. May be NULL, but then exception must not be NULL.
   * @param Exception $exception The exception of which the stack trace is logged. May be NULL, but then message must not be NULL.
   * @param Institute $institute The institute of which the data are gathered currently. May be NULL.
   * @param int $harvestId The ID of this run of the Harvester. May be NULL.
   */
  public function log( $message, $exception = NULL, $institute = NULL, $harvestId = NULL )
  {
    if ( !is_null( self::$logger ) )
    {
      self::$logger->log( $message, $exception, $institute, $harvestId );
    }
  }

  /**
   * Configuration object for connecting to the database system.
   * 
   * @var HarvesterConfiguration
   */
  protected $config;

}

?>