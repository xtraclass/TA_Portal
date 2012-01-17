<?php

/**
 * The DAO for the Harvester, for storing institute, expert data, and so on.
 */
final class HarvesterDAO extends DAOBase
{



  public function __construct( Logger $logger, HarvesterConfiguration $config )
  {
    parent::__construct( $logger, $config );
  }



  /**
   * This reads the institutes of the database, selects those for which
   * data should be gathered, and returns them.
   */
  public function readInstitutesForHarvesting()
  {
    return $this->filterInstitutesForHarvesting( $this->readInstitutes() );
  }



  /**
   * This selects those institutes of the given list of institutes 
   * for which data should be gathered, and returns them.
   * 
   * @param TheInstitutes $institutesFromDB The unfiltered institutes.
   */
  private function filterInstitutesForHarvesting( TheInstitutes $institutesFromDB )
  {
    $institutesForHarvesting = new TheInstitutes();
    
    $plural = $institutesFromDB->size() >= 2 ? 's' : '';
    $this->log( "Found {$institutesFromDB->size()} institute{$plural} in database." );
    
    for( $i = 0; $i < $institutesFromDB->size(); $i++ )
    {
      $institute = $institutesFromDB->get( $i );
      if ( $institute->getForHarvest() and !is_null( $institute->getHarvesterUrl() ) )
      {
        $institutesForHarvesting->addInstitute( $institute );
      }
    }
    
    $plural = $institutesForHarvesting->size() >= 2 ? 's' : '';
    $this->log( "Found {$institutesForHarvesting->size()} institute{$plural} for harvesting." );
    
    return $institutesForHarvesting;
  }



  /**
   * This reads all institutes from the database and returns them.
   */
  public function readInstitutes()
  {
    $institutes = new TheInstitutes();
    $sql = 'select * from joomla_institute limit 250;';
    
    $this->doInDB( function ( HarvesterDAO $me ) use($institutes, $sql )
    {
      $result = mysql_query( $sql, $me->getConnection() );
      
      $row = mysql_fetch_assoc( $result );
      while ( $row )
      {
        $institutes->addInstitute( $me->row2Institute( $row ) );
        $row = mysql_fetch_assoc( $result );
      }
    } );
    
    return $institutes;
  }



  /**
   * This returns a validated Institute object with the values
   * of the given institute database row.
   */
  public function row2Institute( $row )
  {
    $institute = new Institute();
    
    $this->obj_set( $row, $institute, 'abbreviation', 'abbreviation' );
    $this->obj_set( $row, $institute, 'name', 'name' );
    $this->obj_set( $row, $institute, 'countryCode', 'countrycode' );
    $this->obj_set( $row, $institute, 'zipCode', 'zipcode' );
    $this->obj_set( $row, $institute, 'city', 'city' );
    $this->obj_set( $row, $institute, 'street', 'street' );
    $this->obj_set( $row, $institute, 'description', 'description' );
    $this->obj_set( $row, $institute, 'url', 'url' );
    $this->obj_set( $row, $institute, 'id', 'id' );
    $this->obj_set( $row, $institute, 'harvesterUrl', 'harvesterurl' );
    $this->obj_set( $row, $institute, 'forHarvest', 'forharvest' );
    
    $institute->validate();
    
    return $institute;
  }



  /**
   * This method stores in the given object ($object) a value
   * from the given database row ($row).
   * <br>
   * The value is taken from the column with name $columnname
   * and stored in the object as the property with the name $propertyName.
   * 
   * @param $row Database row. Must not be NULL.
   * @param Expert, Institute, Project, Publication $object The object where the new value will be stored. Must not be NULL.
   * @param string $propertyName The property where the new value will be stored. Must not be NULL.
   * @param string $columnName The name of the column in the database row. Must not be NULL.
   */
  private function obj_set( $row, $object, $propertyName, $columnName )
  {
    if ( isset( $row[ $columnName ] ) )
    {
      $object->{"set" . ucfirst( $propertyName )}( $row[ $columnName ] );
    }
  }



  /**
   * This method stores the given institute
   * in the database, where a new one is created, if not already existent;
   * otherwise the existing one in the database is overwritten with the given one.
   * 
   * @param Institute $institute Must not be NULL.
   */
  public function updateInstitute( Institute $institute )
  {
    if ( is_null( $institute ) )
    {
      throw new InvalidArgumentException( 'Argument "$$institute" must not be NULL.' );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($institute )
    {
      $me->log( "updateInstitute, \$institute = $institute", NULL, $institute );
      
      $institute->validate();
      
      $hasId = $institute->hasID();
      $sql = '';
      if ( $hasId )
      {
        $sql = "update joomla_institute set ";
        
        $me->sql_set( &$sql, $institute, 'abbreviation', 'abbreviation' );
        $me->sql_set( &$sql, $institute, 'name', 'name' );
        $me->sql_set( &$sql, $institute, 'countryCode', 'countrycode' );
        $me->sql_set( &$sql, $institute, 'zipCode', 'zipcode' );
        $me->sql_set( &$sql, $institute, 'city', 'city' );
        $me->sql_set( &$sql, $institute, 'street', 'street' );
        $me->sql_set( &$sql, $institute, 'description', 'description' );
        $me->sql_set( &$sql, $institute, 'URL', 'url' );
        $me->sql_set( &$sql, $institute, 'harvesterUrl', 'harvesterurl' );
        $me->sql_set( &$sql, $institute, 'forHarvest', 'forharvest' );
        
        $sql .= " where id={$institute->getId()}";
      }
      else
      {
        $sql = 'insert into joomla_institute ( abbreviation, name' . /***/
        ( !is_null( $institute->getCountryCode() ) ? ', countrycode' : '' ) . /***/
        ( !is_null( $institute->getZipCode() ) ? ', zipcode' : '' ) . /***/
        ( !is_null( $institute->getCity() ) ? ', city' : '' ) . /***/
        ( !is_null( $institute->getStreet() ) ? ', street' : '' ) . /***/
        ( !is_null( $institute->getDescription() ) ? ', description' : '' ) . /***/
        ( !is_null( $institute->getURL() ) ? ', url' : '' ) . /***/
        ( !is_null( $institute->getHarvesterUrl() ) ? ', harvesterurl' : '' ) . /***/
        ( !is_null( $institute->getForHarvest() ) ? ', forharvest' : '' ) . /***/
        ' ) values ( ' . /***/
        '\'' . $institute->getAbbreviation() . '\', ' . /***/
        '\'' . $institute->getName() . '\'' . /***/
        ( !is_null( $institute->getCountryCode() ) ? ', \'' . $institute->getCountryCode() . '\'' : '' ) . /***/
        ( !is_null( $institute->getZipCode() ) ? ', \'' . $institute->getZipCode() . '\'' : '' ) . /***/
        ( !is_null( $institute->getCity() ) ? ', \'' . $institute->getCity() . '\'' : '' ) . /***/
        ( !is_null( $institute->getStreet() ) ? ', \'' . $institute->getStreet() . '\'' : '' ) . /***/
        ( !is_null( $institute->getDescription() ) ? ', \'' . $institute->getDescription() . '\'' : '' ) . /***/
        ( !is_null( $institute->getURL() ) ? ', \'' . $institute->getURL() . '\'' : '' ) . /***/
        ( !is_null( $institute->getHarvesterUrl() ) ? ', \'' . $institute->getHarvesterUrl() . '\'' : '' ) . /***/
        ( !is_null( $institute->getForHarvest() ) ? ', ' . $institute->getForHarvest() : '' ) . /***/
        ')';
      }
      $me->log( "Performing SQL:\n$sql", NULL, $institute );
      
      mysql_query( $sql, $me->getConnection() );
      
      $err = mysql_error( $me->getConnection() );
      if ( !is_null( $err ) and strlen( $err ) >= 1 )
      {
        $me->log( "SQL ERROR: $err, \$sql = $sql", NULL, $institute );
      }
      else
      {
        if ( !$hasId )
        {
          $institute->setId( mysql_insert_id( $me->getConnection() ) );
          $me->log( "Added ID to $institute" );
        }
      }
    } );
  }



  /**
   * This method stores the given expert
   * in the database, where a new one is created, if not already existent;
   * otherwise the existing one in the database is overwritten with the given one.
   * 
   * @param Expert $expert Must not be NULL.
   */
  public function updateExpert( Expert $expert )
  {
    if ( is_null( $expert ) )
    {
      throw new InvalidArgumentException( 'Argument "$$expert" must not be NULL.' );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($expert )
    {
      $me->log( "updateExpert, \$expert = $expert" );
      
      $expert->validate();
      
      $hasId = $expert->hasID();
      $sql = '';
      if ( $hasId )
      {
        $sql = "update joomla_expert set ";
        
        $me->sql_set( &$sql, $expert, 'surname', 'surname' );
        $me->sql_set( &$sql, $expert, 'firstnames', 'firstnames' );
        $me->sql_set( &$sql, $expert, 'expTitle', 'exptitle' );
        $me->sql_set( &$sql, $expert, 'email', 'email' );
        $me->sql_set( &$sql, $expert, 'phoneNumber', 'phonenumber' );
        $me->sql_set( &$sql, $expert, 'skypeID', 'skypeid' );
        $me->sql_set( &$sql, $expert, 'expertise', 'expertise' );
        $me->sql_set( &$sql, $expert, 'emplURL', 'emplurl' );
        $me->sql_set( &$sql, $expert, 'TAPublicationURL', 'tapublicationurl' );
        $me->sql_set( &$sql, $expert, 'TAProjectURL', 'taprojecturl' );
        
        if ( substr( $sql, count( $sql ) - 2, 1 ) == "'" )
        {
          $sql .= ', ';
        }
        $sql .= " fkinstitute = " . $expert->getInstitute()->getId();
        
        $sql .= " where id={$expert->getId()}";
      }
      else
      {
        $sql = 'insert into joomla_expert ( surname, firstnames' . /***/
        ( !is_null( $expert->getExpTitle() ) ? ', exptitle' : '' ) . /***/
        ( !is_null( $expert->getEMail() ) ? ', email' : '' ) . /***/
        ( !is_null( $expert->getPhoneNumber() ) ? ', phonenumber' : '' ) . /***/
        ( !is_null( $expert->getSkypeID() ) ? ', skypeid' : '' ) . /***/
        ( !is_null( $expert->getExpertise() ) ? ', expertise' : '' ) . /***/
        ( !is_null( $expert->getEmplURL() ) ? ', emplurl' : '' ) . /***/
        ( !is_null( $expert->getTAPublicationURL() ) ? ', tapublicationurl' : '' ) . /***/
        ( !is_null( $expert->getTAProjectURL() ) ? ', taprojecturl' : '' ) . /***/
        ', fkinstitute' . /***/
        ' ) values ( ' . /***/
        '\'' . $expert->getSurname() . '\', ' . /***/
        '\'' . $expert->getFirstnames() . '\'' . /***/
        ( !is_null( $expert->getExpTitle() ) ? ', \'' . $expert->getExpTitle() . '\'' : '' ) . /***/
        ( !is_null( $expert->getEMail() ) ? ', \'' . $expert->getEMail() . '\'' : '' ) . /***/
        ( !is_null( $expert->getPhoneNumber() ) ? ', \'' . $expert->getPhoneNumber() . '\'' : '' ) . /***/
        ( !is_null( $expert->getSkypeID() ) ? ', \'' . $expert->getSkypeID() . '\'' : '' ) . /***/
        ( !is_null( $expert->getExpertise() ) ? ', \'' . $expert->getExpertise() . '\'' : '' ) . /***/
        ( !is_null( $expert->getEmplURL() ) ? ', \'' . $expert->getEmplURL() . '\'' : '' ) . /***/
        ( !is_null( $expert->getTAPublicationURL() ) ? ', \'' . $expert->getTAPublicationURL() . '\'' : '' ) . /***/
        ( !is_null( $expert->getTAProjectURL() ) ? ', \'' . $expert->getTAProjectURL() . '\'' : '' ) . /***/
        ', ' . $expert->getInstitute()->getId() . /***/
        ')';
      }
      $me->log( "Performing SQL:\n$sql" );
      
      mysql_query( $sql, $me->getConnection() );
      
      $err = mysql_error( $me->getConnection() );
      if ( !is_null( $err ) and strlen( $err ) >= 1 )
      {
        $me->log( "SQL ERROR: $err, \$sql = $sql" );
      }
      else
      {
        if ( !$hasId )
        {
          $expert->setId( mysql_insert_id( $me->getConnection() ) );
          $me->log( "Added ID to $expert" );
        }
      }
    } );
  }



  /**
   * This method stores the given project
   * in the database, where a new one is created, if not already existent;
   * otherwise the existing one in the database is overwritten with the given one.
   * 
   * @param Project $project Must not be NULL.
   */
  public function updateProject( Project $project )
  {
    if ( is_null( $project ) )
    {
      throw new InvalidArgumentException( 'Argument "$$project" must not be NULL.' );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($project )
    {
      $me->log( "updateProject, \$project = $project" );
      
      $project->validate();
      
      $hasId = $project->hasID();
      if ( $hasId )
      {
        $sql = "update joomla_project set ";
        
        $me->sql_set( &$sql, $project, 'shortTitleE', 'shorttitle' );
        $me->sql_set( &$sql, $project, 'longTitleE', 'longtitle' );
        $me->sql_set( &$sql, $project, 'shortDescriptionE', 'shortdescription' );
        $me->sql_set( &$sql, $project, 'startDate', 'startdate', FALSE, TRUE );
        $me->sql_set( &$sql, $project, 'endDate', 'enddate', FALSE, TRUE );
        $me->sql_set( &$sql, $project, 'partnerCountries', 'partnercountries' );
        $me->sql_set( &$sql, $project, 'scopeCountries', 'scopecountries' );
        $me->sql_set( &$sql, $project, 'homePage', 'homepage' );
        $me->sql_set( &$sql, $project, 'focus', 'focus' );
        
        if ( substr( $sql, count( $sql ) - 2, 1 ) == "'" )
        {
          $sql .= ', ';
        }
        $sql .= " fkcontactperson = " . $project->getContactPerson()->getId();
        
        $sql .= " where id={$project->getId()}";
      }
      else
      {
        $sql = 'insert into joomla_project ( shorttitle, longtitle' . /***/
        ( !is_null( $project->getShortDescriptionE() ) ? ', shortdescription' : '' ) . /***/
        ( !is_null( $project->getStartDate() ) ? ', startdate' : '' ) . /***/
        ( !is_null( $project->getEndDate() ) ? ', enddate' : '' ) . /***/
        ( !is_null( $project->getPartnerCountries() ) ? ', partnercountries' : '' ) . /***/
        ( !is_null( $project->getScopeCountries() ) ? ', scopecountries' : '' ) . /***/
        ( !is_null( $project->getHomePage() ) ? ', homepage' : '' ) . /***/
        ( !is_null( $project->getFocus() ) ? ', focus' : '' ) . /***/
        ', fkcontactperson' . /***/
        ' ) values ( ' . /***/
        '\'' . $project->getShortTitleE() . '\', ' . /***/
        '\'' . $project->getLongTitleE() . '\'' . /***/
        ( !is_null( $project->getShortDescriptionE() ) ? ', \'' . $project->getShortDescriptionE() . '\'' : '' ) . /***/
        ( !is_null( $project->getStartDate() ) ? ', \'' . $me->yearMonth2yearMonth01( $project->getStartDate() ) . '\'' : '' ) . /***/
        ( !is_null( $project->getEndDate() ) ? ', \'' . $me->yearMonth2yearMonth01( $project->getEndDate() ) . '\'' : '' ) . /***/
        ( !is_null( $project->getPartnerCountries() ) ? ', \'' . $project->getPartnerCountries() . '\'' : '' ) . /***/
        ( !is_null( $project->getScopeCountries() ) ? ', \'' . $project->getScopeCountries() . '\'' : '' ) . /***/
        ( !is_null( $project->getHomePage() ) ? ', \'' . $project->getHomePage() . '\'' : '' ) . /***/
        ( !is_null( $project->getFocus() ) ? ', \'' . $project->getFocus() . '\'' : '' ) . /***/
        ', ' . $project->getContactPerson()->getId() . /***/
        ')';
      }
      $me->log( "Performing SQL:\n$sql" );
      
      mysql_query( $sql, $me->getConnection() );
      
      $err = mysql_error( $me->getConnection() );
      if ( !is_null( $err ) and strlen( $err ) >= 1 )
      {
        $me->log( "SQL ERROR: $err, \$sql = $sql" );
      }
      else
      {
        if ( !$hasId )
        {
          $project->setId( mysql_insert_id( $me->getConnection() ) );
          $me->log( "Added ID to $project" );
        }
      }
    } );
  }



  /**
   * This method stores the given publication
   * in the database, where a new one is created, if not already existent;
   * otherwise the existing one in the database is overwritten with the given one.
   * 
   * @param Publication $publication Must not be NULL.
   */
  public function updatePublication( Publication $publication )
  {
    if ( is_null( $publication ) )
    {
      throw new InvalidArgumentException( 'Argument "$$publication" must not be NULL.' );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($publication )
    {
      $me->log( "updatePublication, \$publication = $publication" );
      
      $publication->validate();
      
      $hasId = $publication->hasID();
      if ( $hasId )
      {
        $sql = "update joomla_publication set ";
        
        $me->sql_set( &$sql, $publication, 'quotation', 'quotation' );
        $me->sql_set( &$sql, $publication, 'shortDescription', 'shortdescription' );
        $me->sql_set( &$sql, $publication, 'publDate', 'publdate', FALSE, FALSE, FALSE, TRUE );
        $me->sql_set( &$sql, $publication, 'publType', 'publtype', FALSE, FALSE, TRUE );
        
        if ( substr( $sql, count( $sql ) - 2, 1 ) == "'" )
        {
          $sql .= ', ';
        }
        $sql .= " fkinstitute = " . $publication->getInstitute()->getId();
        
        $sql .= " where id={$publication->getId()}";
      }
      else
      {
        $sql = 'insert into joomla_publication ( quotation, shortdescription' . /***/
        ( !is_null( $publication->getPublDate() ) ? ', publdate' : '' ) . /***/
        ( !is_null( $publication->getPublType() ) ? ', publtype' : '' ) . /***/
        ', fkinstitute' . /***/
        ' ) values ( ' . /***/
        '\'' . $publication->getQuotation() . '\', ' . /***/
        '\'' . $publication->getShortDescription() . '\'' . /***/
        ( !is_null( $publication->getPublDate() ) ? ', \'' . $me->yearOrDate2yearMonth01( $publication->getPublDate() ) . '\'' : '' ) . /***/
        ( !is_null( $publication->getPublType() ) ? ', \'' . $publication->getPublType()->value() . '\'' : '' ) . /***/
        ', ' . $publication->getInstitute()->getId() . /***/
        ')';
      }
      $me->log( "Performing SQL:\n$sql" );
      
      mysql_query( $sql, $me->getConnection() );
      
      $err = mysql_error( $me->getConnection() );
      if ( !is_null( $err ) and strlen( $err ) >= 1 )
      {
        $me->log( "updatePublication: SQL ERROR: $err, \$sql = $sql" );
      }
      else
      {
        if ( !$hasId )
        {
          $publication->setId( mysql_insert_id( $me->getConnection() ) );
          $me->log( "updatePublication: Added ID to $publication" );
        }
      }
    } );
  }



  /**
   * The given entity is stored in the database.
   * <p>
   * This method checks if there is a database record available
   * for the given entity (where the check is done by the unique key
   * of the entity). If so, then the primary key of the found
   * database record is stored as the ID of the given entity.
   * <p>
   * In other words, the ID of the given entity is set, before
   * the store action is performed.
   */
  public function mergeInstituteIntoDB( Institute $institute )
  {
    if ( is_null( $institute ) )
    {
      return;
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($institute )
    {
      $sql = "select id from joomla_institute where abbreviation = '{$institute->getAbbreviation()}' ";
      $row = mysql_fetch_assoc( mysql_query( $sql, $me->getConnection() ) );
      
      if ( $row )
      {
        $institute->setId( $row[ 'id' ] );
      }
      
      $me->updateInstitute( $institute );
    } );
  }



  /**
   * The given entity is stored in the database.
   * <p>
   * This method checks if there is a database record available
   * for the given entity (where the check is done by the unique key
   * of the entity). If so, then the primary key of the found
   * database record is stored as the ID of the given entity.
   * <p>
   * In other words, the ID of the given entity is set, before
   * the store action is performed.
   */
  public function mergeExpertIntoDB( Expert $expert )
  {
    if ( is_null( $expert ) )
    {
      return;
    }
    if ( !$expert->belongsToExistingInstitute() )
    {
      throw new InvalidArgumentException( "Expert must belong to an institute: $expert" );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($expert )
    {
      $sql = "select id from joomla_expert where surname = '{$expert->getSurname()}' and firstnames = '{$expert->getFirstnames()}' and fkinstitute = {$expert->getInstitute()->getId()}";
      $row = mysql_fetch_assoc( mysql_query( $sql, $me->getConnection() ) );
      
      if ( $row )
      {
        $expert->setId( $row[ 'id' ] );
      }
      
      $me->updateExpert( $expert );
    } );
  }



  /**
   * The given entity is stored in the database.
   * <p>
   * This method checks if there is a database record available
   * for the given entity (where the check is done by the unique key
   * of the entity). If so, then the primary key of the found
   * database record is stored as the ID of the given entity.
   * <p>
   * In other words, the ID of the given entity is set, before
   * the store action is performed.
   */
  public function mergeProjectIntoDB( Project $project )
  {
    if ( is_null( $project ) )
    {
      return;
    }
    if ( !$project->belongsToExistingContactPerson() )
    {
      throw new InvalidArgumentException( "Project must have a contact person: $project" );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($project )
    {
      $sql = "select id from joomla_project where shorttitle = '{$project->getShortTitleE()}' and fkcontactperson = {$project->getContactPerson()->getId()}";
      $row = mysql_fetch_assoc( mysql_query( $sql, $me->getConnection() ) );
      
      if ( $row )
      {
        $project->setId( $row[ 'id' ] );
      }
      
      $me->updateProject( $project );
    } );
  }



  /**
   * The given entity is stored in the database.
   * <p>
   * This method checks if there is a database record available
   * for the given entity (where the check is done by the unique key
   * of the entity). If so, then the primary key of the found
   * database record is stored as the ID of the given entity.
   * <p>
   * In other words, the ID of the given entity is set, before
   * the store action is performed.
   */
  public function mergePublicationIntoDB( Publication $publication )
  {
    if ( is_null( $publication ) )
    {
      return;
    }
    if ( !$publication->belongsToExistingInstitute() )
    {
      throw new InvalidArgumentException( "Publication must belong to an institute: $publication" );
    }
    
    $this->doInDB( function ( HarvesterDAO $me ) use($publication )
    {
      if ( is_null( $publication->getPublDate() ) )
      {
        $sql = "select id from joomla_publication where quotation = '{$publication->getQuotation()}' and fkinstitute = {$publication->getInstitute()->getId()}";
      }
      else
      {
        $sql = "select id from joomla_publication where quotation = '{$publication->getQuotation()}' and publdate = '{$me->yearOrDate2yearMonth01($publication->getPublDate())}' and fkinstitute = {$publication->getInstitute()->getId()}";
      }
      $row = mysql_fetch_assoc( mysql_query( $sql, $me->getConnection() ) );
      
      if ( $row )
      {
        $publication->setId( $row[ 'id' ] );
      }
      
      $me->updatePublication( $publication );
    } );
  }



  /**
   * This method changes the given SQL string (which contains an
   * UPDATE command), so that another SET col=value part is added.
   * <br>
   * The value is taken from the given object $object,
   * the property name is in $get. If the property is not NULL, its
   * value is used in the SQL statement, otherwise this method does nothing.
   * 
   * @param $sql Must not be NULL.
   * @param $object Must not be NULL.
   * @param $get Must not be NULL.
   * @param $column Must not be NULL.
   * @param $string If TRUE, then the given property is a string value, BUT THIS IS NOT USED CURRENTLY. May be NULL.
   * @param $isYearMonth If TRUE, then yearMonth2yearMonth01() is called to convert the property value to a value suitable for the database. May be NULL.
   * @param $isYearOrDate If TRUE, then yearOrDate2yearMonth01() is called to convert the property value to a value suitable for the database. May be NULL.
   * @param $isPublType If TRUE, then -&gt;value() is called to convert the property value to a value suitable for the database. May be NULL.
   */
  public function sql_set( &$sql, $object, $get, $column, $string = FALSE, $isYearMonth = FALSE, $isPublType = FALSE, $isYearOrDate = FALSE )
  {
    if ( !is_null( $object->{"get" . ucfirst( $get ) }() ) )
    {
      if ( substr( $sql, count( $sql ) - 2, 1 ) == "'" )
      {
        $sql .= ', ';
      }
      
      if ( $isYearMonth )
      {
        $sql .= " {$column}='" . $this->yearMonth2yearMonth01( $object->{"get" . ucfirst( $get ) }() ) . "'";
      }
      else if ( $isYearOrDate )
      {
        $sql .= " {$column}='" . $this->yearOrDate2yearMonth01( $object->{"get" . ucfirst( $get ) }() ) . "'";
      }
      else if ( $isPublType )
      {
        $sql .= " {$column}='" . $object->{"get" . ucfirst( $get ) }()->value() . "'";
      }
      else
      {
        $sql .= " {$column}='" . $object->{"get" . ucfirst( $get ) }() . "'";
      }
    }
  }



  /**
   * This converts the given year-month combination to a year-month-day combination
   * for the database.
   */
  public function yearMonth2yearMonth01( $date )
  {
    if ( is_null( $date ) )
    {
      return '2100-01-01';
    }
    
    return $date . '-01';
  }



  /**
   * This converts the given year year-month-day combination
   * for the database, or leaves it as it is, if already year-month-day.
   */
  public function yearOrDate2yearMonth01( $date )
  {
    if ( is_null( $date ) )
    {
      return '2100-01-01';
    }
    
    if ( strlen( $date ) == 4 )
    {
      return $date . '-01-01';
    }
    else
    {
      return $date;
    }
  }



  /**
   * This stores the given data in the database.
   * 
   * @param array $result An array with TheInstitutes, TheExperts, ... Must not be NULL.
   * @param Institute $institute The institute from which data are gathered currently. May be NULL.
   * @param int $harvestId The ID of the current harvest process. May be NULL.
   */
  public function mergeIntoDB( $result, $harvestedInstitute, $harvestId )
  {
    if ( self::$logger->wasErrorLogged() )
    {
      return;
    }
    if ( is_null( $result ) )
    {
      throw new InvalidArgumentException( 'Argument "$$result" must not be NULL.' );
    }
    
    try
    {
      $institutes = $result[ 0 ];
      $experts = $result[ 1 ];
      $projects = $result[ 2 ];
      $publications = $result[ 3 ];
      
      if ( !is_null( $institutes ) )
      {
        for( $i = 0; $i < $institutes->size(); $i++ )
        {
          try
          {
            $this->mergeInstituteIntoDB( $institutes->get( $i ) );
          }
          catch ( Exception $x )
          {
            $this->log( "ERROR: Could not merge data of institute into database, $i. institute: {$institutes->get( $i )}", $x, $harvestedInstitute, $harvestId );
          }
        }
      }
      if ( !is_null( $experts ) )
      {
        for( $i = 0; $i < $experts->size(); $i++ )
        {
          try
          {
            $this->mergeExpertIntoDB( $experts->get( $i ) );
          }
          catch ( Exception $x )
          {
            $this->log( "ERROR: Could not merge data of expert into database, $i. expert: {$experts->get( $i )}", $x, $harvestedInstitute, $harvestId );
          }
        }
      }
      if ( !is_null( $projects ) )
      {
        for( $i = 0; $i < $projects->size(); $i++ )
        {
          try
          {
            $this->mergeProjectIntoDB( $projects->get( $i ) );
          }
          catch ( Exception $x )
          {
            $this->log( "ERROR: Could not merge data of project into database, $i. institute: {$projects->get( $i )}", $x, $harvestedInstitute, $harvestId );
          }
        }
      }
      if ( !is_null( $publications ) )
      {
        for( $i = 0; $i < $publications->size(); $i++ )
        {
          try
          {
            $this->mergePublicationIntoDB( $publications->get( $i ) );
          }
          catch ( Exception $x )
          {
            $this->log( "ERROR: Could not merge data of publication into database, $i. institute: {$publications->get( $i )}", $x, $harvestedInstitute, $harvestId );
          }
        }
      }
    
    }
    catch ( Exception $x3 )
    {
      $this->log( "Could not merge harvested data into database", $x3, $harvestedInstitute, $harvestId );
    }
  }



  /**
   * This stores information about the current harvest process in the database.
   * 
   * @param Institute $institute The insitute of which the data are gathered. Must not be NULL.
   * @param int $harvestId May be NULL, then a new Harvest entry is created. Otherwise the old one is updated.
   * @param string $json May be NULL, then errorMsg should not be NULL.
   * @param string $errorMsg Some error message, if any. May be NULL. 
   * @param long $endTime The end time of the current harvest action. May be NULL. If not, then this means that the current harvest action is finished. A possible value is the return value of time().
   */
  public function saveInHarvestLog( Institute $institute, $harvestId = NULL, $json = NULL, $errorMsg = NULL, $endTime = NULL )
  {
    $newHarvestId = $harvestId;
    
    $this->doInDB( function ( $me ) use($institute, $harvestId, $json, $errorMsg, $endTime, &$newHarvestId )
    {
      $isNew = is_null( $harvestId ) or $harvestId <= 0;
      $hasJson = !is_null( $json );
      $hasError = !is_null( $errorMsg );
      $hasEnd = !is_null( $endTime );
      
      if ( $isNew )
      {
        $startTime = date( 'Y-m-d H:m:s' );
        
        $sql = 'insert into joomla_harvest( fkinstitute, starttime, url ) values ( ' . /***/
        $institute->getId() . ', \'' . $startTime . '\', \'' . $institute->getHarvesterUrl() . '\' );';
      }
      else
      {
        $endTimeFormatted = date( 'Y-m-d H:m:s', $endTime );
        $comma = FALSE;
        
        $sql = 'update joomla_harvest set ';
        if ( $hasJson )
        {
          $data = mysql_real_escape_string( $json, $me->getConnection() );
          $sql .= "json='{$data}'";
          $comma = TRUE;
        }
        if ( $hasError )
        {
          if ( $comma )
          {
            $sql .= ', ';
          }
          $sql .= "errormsg='{$errorMsg}'";
          $comma = TRUE;
        }
        if ( $hasEnd )
        {
          if ( $comma )
          {
            $sql .= ', ';
          }
          $sql .= "endtime='{$endTimeFormatted}'";
        }
        $sql .= " where id=$harvestId";
      }
      
      mysql_query( $sql, $me->getConnection() );
      
      if ( $isNew )
      {
        $newHarvestId = mysql_insert_id( $me->getConnection() );
      }
      
      $err = mysql_error( $me->getConnection() );
      if ( !is_null( $err ) and strlen( $err ) >= 1 )
      {
        $me->log( "saveInHarvestLog: SQL ERROR: $err" );
      }
    
    } );
    
    return $newHarvestId;
  }

}

?>