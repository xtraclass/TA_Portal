<?php

require_once 'taportal/harvester/_Classes.php';

/**
 * Main class of the Harvester program.
 * <p>
 * This class has to be called from outside to start the harvesting process.
 */
final class Harvester
{



  /**
   * Entry point of the Harvester application.
   * <p>
   * Call this to start the Harvester.
   */
  public static function harvest()
  {
    $harvester = new Harvester();
    $harvester->start();
  }



  /**
   * This initializes the fields of the Harvester.
   */
  function __construct()
  {
    $this->config = new HarvesterConfiguration();
    
    $this->logger = Logger::getLoggerForHTMLAndDatabaseOutput( $this->config );
    
    $this->dao = new HarvesterDAO( $this->logger, $this->config );
  }



  /**
   * This returns the message that the Harvester has been started, and on which system
   * (production or development).
   */
  private function makeStartMessage()
  {
    if ( $this->config->isOnProductionSystem() )
    {
      return "### Harvester started on the production system. ### ";
    }
    else
    {
      return "___ Harvester started on a development machine. ___";
    }
  }



  /**
   * This starts the harvesting of the data of the institutes, and prints 
   * out any logging messages.
   */
  private function start()
  {
    $this->logger->log( $this->makeStartMessage() );
    
    try
    {
      $this->harvestInstitutes( $this->dao->readInstitutesForHarvesting() );
    }
    catch ( Exception $x )
    {
      $this->log( "Error while reading institutes for harvesting.", $x );
    }
    
    $this->log( "### Harvester stopped. ###" );
    print $this->logger->getMessagesIfAnyAsHTML();
  }



  /**
   * This gathers the data of the given institutes.
   * 
   * @param TheInstitutes $institutes Should not be NULL.
   */
  private function harvestInstitutes( $institutes )
  {
    if ( is_null( $institutes ) or count( $institutes ) === 0 )
    {
      $this->log( 'There are no institute data to process.' );
      return;
    }
    
    for( $i = 0; $i < $institutes->size(); $i++ )
    {
      try
      {
        $institute = $institutes->get( $i );
        
        /**
         * ID of this harvest. Must be unique for every time the Harvester
         * has been started.
         */
        $harvestId = $this->logToHarvestLog( $institute );
        
        /**
         * The data of the institute, formatted as JSON.
         */
        $jsonRoot = $this->harvestOneInstitute( $institutes->get( $i ), $harvestId );
        
        $jsonText = is_null( $jsonRoot ) ? '' : json_encode( $jsonRoot );
        $this->logToHarvestLog( $institute, $harvestId, $jsonText, NULL, time() );
      }
      catch ( Exception $x1 )
      {
        $this->logToHarvestLog( $institute, $harvestId, $jsonText, "Error while harvesting data from institute {$institutes->get( $i )->getName()}: " . $x1->getMessage(), time() );
        $this->log( "Error while harvesting data from institute {$institutes->get( $i )->getName()}.", $x1 );
      }
    }
  }



  /**
   * This gathers the data of one institute.
   * 
   * @param Institute $institute The institute of which the data are to be gathered. May be NULL, then no gathering is performed.
   * @param int $harvestId The ID of the current harvesting action. May be NULL.
   */
  private function harvestOneInstitute( Institute $institute, $harvestId )
  {
    if ( is_null( $institute ) )
    {
      return;
    }
    
    try
    {
      $jsonRoot = $this->readContentsOfAnInstitute( $institute );
      
      try
      {
        $objectBuilder = new ObjectBuilder( $this->logger );
        
        $this->dao->mergeIntoDB( $objectBuilder->build( $jsonRoot, $institute ), $institute, $harvestId );
      }
      catch ( Exception $x2 )
      {
        $this->log( "Could not parse JSON data from harvested institute and store it in database, url: {$institute->getHarvesterUrl()}", $x2, $institute, $harvestId );
      }
    }
    catch ( Exception $x1 )
    {
      $this->log( "ERROR reading data of institute, url: {$institute->getHarvesterUrl()}", $x1, $institute, $harvestId );
    }
    
    return $jsonRoot;
  }



  /**
   * This returns the JSON data of the page which 
   * corresponds to the Harvester URL of the given institute.
   * That means, this method connects to the web (the insitute) and gets the JSON data.
   * 
   * @param Institute $institute The institute of which data are to be gathered. Cannot be NULL.
   */
  private function readContentsOfAnInstitute( Institute $institute )
  {
    if ( is_null( $institute ) )
    {
      return;
    }
    
    try
    {
      $contents = file_get_contents( $url = $institute->getHarvesterUrl() );
    }
    catch ( Exception $x1 )
    {
      throw new RuntimeException( "Could not read contents of page at $url", 2132, $x1 );
    }
    
    try
    {
      $utf = utf8_encode( $contents );
    }
    catch ( Exception $x2 )
    {
      throw new RuntimeException( "Could not convert to UTF8 contents of page at $url", 2131, $x2 );
    }
    
    try
    {
      $jsonRoot = json_decode( $utf );
    }
    catch ( Exception $x3 )
    {
      throw new RuntimeException( "Could not decode from JSON of page at $url", 2130, $x3 );
    }
    
    if ( is_null( $jsonRoot ) )
    {
      throw new RuntimeException( "Harvester could not read JSON data from institute: url: {$institute->getHarvesterUrl()}" );
    }
    if ( is_null( $jsonRoot->V ) )
    {
      throw new RuntimeException( "Version 'V' number does not exist in JSON data, url: {$institute->getHarvesterUrl()}" );
    }
    
    return $jsonRoot;
  }



  /**
   * This logs the given arguments to the HarvestLog.
   * 
   * @param Institute $institute The insitute of which the data are gathered. Must not be NULL.
   * @param $harvestId May be NULL, then a new Harvest entry is created. Otherwise the old one is updated.
   * @param $json May be NULL, then errorMsg should not be NULL.
   * @param $errorMsg Some error message, if any. May be NULL. 
   * @param $endTime The end time of the current harvest action. May be NULL. If not, then this means that the current harvest action is finished. A possible value is the return value of time().
   */
  private function logToHarvestLog( Institute $institute, $harvestId = NULL, $json = NULL, $errorMsg = NULL, $endTime = NULL )
  {
    return $this->dao->saveInHarvestLog( $institute, $harvestId, $json, $errorMsg, $endTime );
  }



  /**
   * This logs the given message or exception.
   * 
   * @param string $message The logging message. May be NULL, but then exception must not be NULL.
   * @param Exception $exception The exception of which the stack trace is logged. May be NULL, but then message must not be NULL.
   * @param Institute $institute The institute of which the data are gathered currently. May be NULL.
   * @param int $harvestId The ID of this run of the Harvester. May be NULL.
   */
  private function log( $message, $exception = NULL, $institute = NULL, $harvestId = NULL )
  {
    $this->logger->log( $message, $exception, $institute, $harvestId );
  }

  /**
   * Configuration object for connecting to the database system.
   * 
   * @var HarvesterConfiguration
   */
  private $config;

  /**
   * The application logger.
   * 
   * @var Logger
   */
  private $logger;

  /**
   * The DAO for gathereddata.
   */
  private $dao;

}
?>