<?php

/**
 * The main configuration for the Harvester. 
 * <p>
 * It is used for connecting to the database system,
 * and for deciding where the Harvester is running, i. e. 
 * on the development or production system.
 */
final class HarvesterConfiguration
{



  /**
   * This checks, if the Harvester is running on the production
   * or development system, and sets the fields accordingly.
   */
  public function __construct()
  {
    $this->estimateIfOnProductionSystem();
    $this->update();
  }



  /**
   * This updates the fields of this object by the values
   * from the external production configuration file configuration.php
   * or sets it to hardcoded values for the development system.
   */
  private function update()
  {
    if ( $this->onProductionSystem )
    {
      /**
       * JConfig is defined in configuration.php which exists only on the production system
       * (it has to be copied from the Joomla directory to the taportal php directory).
       * <br>
       * Don't worry, if you don't have this file on your development machine. 
       */
      $joomlaConfig = new JConfig();
      
      $this->databaseHostName = $joomlaConfig->host;
      $this->databaseUserName = $joomlaConfig->user;
      $this->databasePassword = $joomlaConfig->password;
      $this->databaseName = $joomlaConfig->db;
    }
    else
    {
      $this->databaseHostName = 'localhost';
      $this->databaseUserName = 'root';
      $this->databasePassword = '';
      $this->databaseName = 'taportal';
    }
  }



  /**
   * This figures out if this object is on the production
   * or development system by checking if there is a configuration.php
   * file which can be included.
   */
  private function estimateIfOnProductionSystem()
  {
    $currentErrorLevel = error_reporting();
    error_reporting( E_ERROR );
    
    if ( ( include_once 'configuration.php' ) == 1 )
    {
      $this->onProductionSystem = TRUE;
    }
    else
    {
      $this->onProductionSystem = FALSE;
    }
    
    error_reporting( $currentErrorLevel );
  }



  /**
   * This returns true if the Harvester is currently running on a production system.
   */
  public function isOnProductionSystem()
  {
    return $this->onProductionSystem;
  }



  /**
   * This returns the host name of the database server (used for login to the database system).
   */
  public function getDatabaseHostName()
  {
    return $this->databaseHostName;
  }



  /**
   * This returns the name of the database user (used for login to the database system).
   */
  public function getDatabaseUserName()
  {
    return $this->databaseUserName;
  }



  /**
   * This returns the password of the database user (used for login to the database system).
   */
  public function getDatabasePassword()
  {
    return $this->databasePassword;
  }



  /**
   * This returns the name of the database catalogue (used for login to the database system).
   */
  public function getDatabaseName()
  {
    return $this->databaseName;
  }

  private $onProductionSystem;

  private $databaseHostName;

  private $databaseUserName;

  private $databasePassword;

  private $databaseName;

}

?>