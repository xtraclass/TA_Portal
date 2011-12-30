<?php

/**
 * This is used for converting JSON formatted to
 * php objects.
 */
final class ObjectBuilder
{



  public function __construct( $logger )
  {
    $this->logger = $logger;
  }



  /**
   * This converts the given JSON formatted text to php objects.
   * 
   * @param string $jsonObject Must not be NULL:
   * @return array( $institutes, $experts, $projects, $publications )
   */
  public function build( $jsonObject )
  {
    if ( is_null( $jsonObject ) )
    {
      throw new InvalidArgumentException( 'Argument "$$jsonObject" must not be NULL.' );
    }
    
    $institutesByUK = array();
    $expertsByUK = array();
    
    try
    {
      $institutes = $this->parseTheInstitutes( $jsonObject, &$institutesByUK );
    }
    catch ( Exception $x )
    {
      throw new RuntimeException( "ERROR parsing data of institutes", 1234, $x );
    }
    try
    {
      $experts = $this->parseTheExperts( $jsonObject, &$institutesByUK, &$expertsByUK );
    }
    catch ( Exception $x )
    {
      throw new RuntimeException( "ERROR parsing data of experts", 1234, $x );
    }
    try
    {
      $projects = $this->parseTheProjects( $jsonObject, &$expertsByUK );
    }
    catch ( Exception $x )
    {
      throw new RuntimeException( "ERROR parsing data of projects", 1234, $x );
    }
    try
    {
      $publications = $this->parseThePublications( $jsonObject, &$institutesByUK );
    }
    catch ( Exception $x )
    {
      throw new RuntimeException( "ERROR parsing data of publications", 1234, $x );
    }
    
    return array( $institutes, $experts, $projects, $publications );
  }



  /**
   * This method converts all JSON formatted pieces of information about institutes
   * in the given object to a TheInstitutes object which is then returned.
   *
   * @param array $institutesByUK A map with unique key -- Institute
   */
  private function parseTheInstitutes( $object, &$institutesByUK )
  {
    if ( is_null( $object ) or is_null( $object->I ) )
    {
      $this->log( 'No institutes found.' );
      return new TheInstitutes();
    }
    
    $theInstitutes = new TheInstitutes();
    
    if ( count( $object->I ) >= 1 )
    {
      foreach ( $object->I as $jsonObject )
      {
        try
        {
          $theInstitutes->addInstitute( $this->parseOneInstitute( $jsonObject, $object, &$institutesByUK ) );
        }
        catch ( Exception $x )
        {
          $this->log( "Could not parse data of one institute for $jsonObject", $x );
        }
      }
    }
    else
    {
      $this->log( 'No institutes found, only empty "I" element.' );
    }
    
    return $theInstitutes;
  }



  /**
   * This method converts all JSON formatted pieces of information about experts
   * in the given object to a TheExperts object which is then returned.
   *
   * @param array $expertsByUK A map with unique key -- Expert
   */
  private function parseTheExperts( $object, &$institutesByUK, &$expertsByUK )
  {
    if ( is_null( $object ) or is_null( $object->E ) )
    {
      $this->log( 'No experts found.' );
      return new TheExperts();
    }
    
    $theExperts = new TheExperts();
    
    if ( count( $object->E ) >= 1 )
    {
      foreach ( $object->E as $jsonObject )
      {
        try
        {
          $theExperts->addExpert( $this->parseOneExpert( $jsonObject, $object, &$institutesByUK, &$expertsByUK ) );
        }
        catch ( Exception $x )
        {
          $this->log( "Could not parse data of one expert for $jsonObject", $x );
        }
      }
    }
    else
    {
      $this->log( 'No experts found, only empty "E" element.' );
    }
    
    return $theExperts;
  }



  /**
   * This method converts all JSON formatted pieces of information about projects
   * in the given object to a TheProjects object which is then returned.
   *
   * @param array $expertsByUK A map with unique key -- Expert
   */
  private function parseTheProjects( $object, &$expertsByUK )
  {
    if ( is_null( $object ) or is_null( $object->R ) )
    {
      $this->log( 'No projects found.' );
      return new TheProjects();
    }
    
    $theProjects = new TheProjects();
    
    if ( count( $object->R ) >= 1 )
    {
      foreach ( $object->R as $jsonObject )
      {
        try
        {
          $theProjects->addProject( $this->parseOneProject( $jsonObject, $object, &$expertsByUK ) );
        }
        catch ( Exception $x )
        {
          $this->log( "Could not parse data of one project for $jsonObject", $x );
        }
      }
    }
    else
    {
      $this->log( 'No projects found, only empty "R" element.' );
    }
    
    return $theProjects;
  }



  /**
   * This method converts all JSON formatted pieces of information about publications
   * in the given object to a ThePublications object which is then returned.
   *
   * @param array $institutesByUK A map with unique key -- Publication
   */
  private function parseThePublications( $object, &$institutesByUK )
  {
    if ( is_null( $object ) or is_null( $object->U ) )
    {
      $this->log( 'No publications found.' );
      return new ThePublications();
    }
    
    $thePublications = new ThePublications();
    
    if ( count( $object->U ) >= 1 )
    {
      foreach ( $object->U as $jsonObject )
      {
        try
        {
          $thePublications->addPublication( $this->parseOnePublication( $jsonObject, $object, &$institutesByUK ) );
        }
        catch ( Exception $x )
        {
          $this->log( "Could not parse data of one publication for $jsonObject", $x );
        }
      }
    }
    else
    {
      $this->log( 'No publications found, only empty "U" element.' );
    }
    
    return $thePublications;
  }



  /**
   * This parses the given JSON institute to a php Institute object.
   */
  private function parseOneInstitute( $jsonObject, $object, &$institutesByUK )
  {
    if ( is_null( $jsonObject ) )
    {
      return NULL;
    }
    
    $institute = new Institute();
    
    $this->set( $institute, 'Abbreviation', $jsonObject, 'E' );
    $this->set( $institute, 'Name', $jsonObject, 'N' );
    $this->set( $institute, 'CountryCode', $jsonObject, 'O' );
    $this->set( $institute, 'ZipCode', $jsonObject, 'Z' );
    $this->set( $institute, 'City', $jsonObject, 'C' );
    $this->set( $institute, 'Street', $jsonObject, 'S' );
    $this->set( $institute, 'Description', $jsonObject, 'D' );
    $this->set( $institute, 'URL', $jsonObject, 'U' );
    
    if ( $this->lookForAdditionalProperties( $jsonObject, 'E, N, O, Z, C, S, D, U, ', 'institute', $institute ) )
    {
      try
      {
        $institutesByUK[ JSONBuilder::buildUKofInsitutue( $institute ) ] = $institute;
        
        $this->validateObject( $institute );
      }
      catch ( Exception $x )
      {
        $this->log( "No additional properties for $jsonObject", $x );
      }
    }
    
    return $institute;
  }



  /**
   * This parses the given JSON expert to a php Expert object.
   */
  private function parseOneExpert( $jsonObject, $object, &$institutesByUK, &$expertsByUK )
  {
    if ( is_null( $jsonObject ) )
    {
      return NULL;
    }
    
    $expert = new Expert();
    
    $this->set( $expert, 'Surname', $jsonObject, 'S' );
    $this->set( $expert, 'Firstnames', $jsonObject, 'F' );
    $this->set( $expert, 'ExpTitle', $jsonObject, 'T' );
    $this->set( $expert, 'EMail', $jsonObject, 'E' );
    $this->set( $expert, 'PhoneNumber', $jsonObject, 'P' );
    $this->set( $expert, 'SkypeID', $jsonObject, 'D' );
    $this->set( $expert, 'Expertise', $jsonObject, 'X' );
    $this->set( $expert, 'EmplURL', $jsonObject, 'L' );
    $this->set( $expert, 'TAPublicationURL', $jsonObject, 'U' );
    $this->set( $expert, 'TAProjectURL', $jsonObject, 'J' );
    
    if ( $this->lookForAdditionalProperties( $jsonObject, 'S, F, T, E, P, D, X, L, U, J, I, ', 'expert', $expert ) )
    {
      try
      {
        $expertsByUK[ JSONBuilder::buildUKofExpert( $expert ) ] = $expert;
        
        if ( !is_null( $jsonObject->I ) and !is_null( $jsonObject->I->E ) )
        {
          
          $uk = '{"E":"' . $jsonObject->I->E . '"}';
          
          if ( isset( $institutesByUK[ $uk ] ) )
          {
            
            $institute = $institutesByUK[ $uk ];
            
            if ( !is_null( $institute ) )
            {
              $expert->setInstitute( $institute );
            }
            else
            {
              $this->log( "JSON-ERROR: There was no institute found for the unique key {$uk} for the expert [{$expert->getSurname()} {$expert->getFirstnames()}]" );
            }
          }
        }
        else
        {
          $this->log( "JSON ERROR: Expert [{$expert->getSurname()} {$expert->getFirstnames()}] must have an institute where the expert belongs to." );
        }
        
        $this->validateObject( $expert );
      }
      catch ( Exception $x )
      {
        $this->log( "No additional properties for $jsonObject", $x );
      }
    }
    
    return $expert;
  }



  /**
   * This parses the given JSON project to a php Project object.
   */
  private function parseOneProject( $jsonObject, $object, &$expertsByUK )
  {
    if ( is_null( $jsonObject ) )
    {
      return NULL;
    }
    
    $project = new Project();
    
    $this->set( $project, 'ShortTitleE', $jsonObject, 'S' );
    $this->set( $project, 'LongTitleE', $jsonObject, 'L' );
    $this->set( $project, 'ShortDescriptionE', $jsonObject, 'D' );
    $this->set( $project, 'StartDate', $jsonObject, 'T' );
    $this->set( $project, 'EndDate', $jsonObject, 'N' );
    $this->set( $project, 'PartnerCountries', $jsonObject, 'Y' );
    $this->set( $project, 'ScopeCountries', $jsonObject, 'Z' );
    $this->set( $project, 'HomePage', $jsonObject, 'H' );
    $this->set( $project, 'Focus', $jsonObject, 'U' );
    
    if ( $this->lookForAdditionalProperties( $jsonObject, 'S, L, D, T, N, Y, Z, H, U, O, ', 'project', $project ) )
    {
      try
      {
        if ( !is_null( $jsonObject->O ) and !is_null( $jsonObject->O->S ) and !is_null( $jsonObject->O->F ) )
        {
          $uk = '{"S":"' . $jsonObject->O->S . '","F":"' . $jsonObject->O->F . '"}';
          $expert = $expertsByUK[ $uk ];
          if ( !is_null( $expert ) )
          {
            $project->setContactPerson( $expert );
          }
          else
          {
            $this->log( "JSON-ERROR: There was no expert found for the unique key {$uk} for the project [{$project->getShortTitleE()}]" );
          }
        }
        else
        {
          $this->log( "JSON ERROR: Project [{$project->getShortTitleE()}] must have a contact person (expert) where the project belongs to." );
        }
        
        $this->validateObject( $project );
      }
      catch ( Exception $x )
      {
        $this->log( "No additional properties for $jsonObject", $x );
      }
    }
    
    return $project;
  }



  /**
   * This parses the given JSON publication to a php Publication object.
   */
  private function parseOnePublication( $jsonObject, $object, &$institutesByUK )
  {
    if ( is_null( $jsonObject ) )
    {
      return NULL;
    }
    
    $publication = new Publication();
    
    $this->set( $publication, 'Quotation', $jsonObject, 'Q' );
    $this->set( $publication, 'PublDate', $jsonObject, 'D' );
    $this->set( $publication, 'ShortDescription', $jsonObject, 'S' );
    
    if ( !is_null( $jsonObject->T ) )
    {
      $enum = PublicationTypeEnum::byStringValue( $jsonObject->T );
      if ( !is_null( $enum ) )
      {
        $publication->setPublType( $enum );
      }
    }
    
    if ( $this->lookForAdditionalProperties( $jsonObject, 'Q, D, S, T, I, ', 'publication', $publication ) )
    {
      try
      {
        if ( !is_null( $jsonObject->I ) and !is_null( $jsonObject->I->E ) )
        {
          $uk = '{"E":"' . $jsonObject->I->E . '"}';
          $institute = $institutesByUK[ $uk ];
          if ( !is_null( $institute ) )
          {
            $publication->setInstitute( $institute );
          }
          else
          {
            $this->log( "JSON-ERROR: There is no institute found for the unique key {$uk} for the publication [{$publication->getQuotation()} {$publication->getPublDate()}]" );
          }
        }
        else
        {
          $this->log( "JSON ERROR: Publication [{$publication->getQuotation()} {$publication->getPublDate()}] must have an institute where the publication belongs to." );
        }
        
        $this->validateObject( $publication );
      }
      catch ( Exception $x )
      {
        $this->log( "No additional properties for $jsonObject", $x );
      }
    }
    
    return $publication;
  }



  /**
   * This sets the given property of the given object
   * to the value of the given JSON expression.
   */
  private function set( $object, $propertyName, $jsonObject, $jsonPropertyName )
  {
    if ( isset( $jsonObject->{$jsonPropertyName} ) )
    {
      try
      {
        $object->{"set" . $propertyName}( $this->replacePipesByLineBreaks( $jsonObject->{$jsonPropertyName} ) );
      }
      catch ( Exception $x )
      {
        $this->log( NULL, $x );
      }
    }
    else
    {
      if ( $object->isRequiredProperty( $propertyName ) )
      {
        $this->log( "Did not find property {$jsonPropertyName} in JSON text of [{$object}]." );
      }
    }
  }



  /**
   * This checks if the given JSON object has more properties as mentioned in the
   * given string of property names. If so, FALSE is returned.
   * 
   * @param string $jsonObject The JSON object which additional properties are looked for.
   * @param string $propertyNames A coma separated list of property names (of the php object). Like 'S, F, T, E, P, D, X, L, U, J, I, '
   * @param string $entityName The name of the entity, i. e. Institute ir expert...
   * @param Expert, Institute, Project, Publication $object The object itself, i. e. an institute or expert...
   */
  private function lookForAdditionalProperties( $jsonObject, $propertyNames, $entityName, $object )
  {
    $additionalProperties = '';
    $reflector = new ReflectionObject( $jsonObject );
    
    foreach ( $reflector->getProperties( ReflectionProperty::IS_PUBLIC ) as $property )
    {
      if ( strpos( $propertyNames, $property->getName() . ', ' ) <= -1 )
      {
        $additionalProperties .= $property->getName() . ', ';
      }
    }
    
    if ( strlen( $additionalProperties ) >= 3 )
    {
      $additionalProperties = substr( $additionalProperties, 0, strlen( $additionalProperties ) - 2 );
      $this->log( 'The ' . $entityName . ' [' . $object . /***/
      '] has the following additional, invalid properties: ' . $additionalProperties );
      return FALSE;
    }
    
    return TRUE;
  }



  /**
   * This calls the validate method of the given object, unless
   * an error was alread logged.
   *
   * 
   * @param Expert, Institute, Project, Publication $object
   */
  private function validateObject( $object )
  {
    if ( !$this->logger->wasErrorLogged() )
    {
      try
      {
        $object->validate();
      }
      catch ( InvalidArgumentException $x )
      {
        $this->log( NULL, $x );
      }
    }
  }



  /**
   * This replaces all occurrences of |||| by \n of the given string and returns a ne string.
   */
  private function replacePipesByLineBreaks( $text )
  {
    return str_replace( '||||', "\n", $text );
  }



  /**
   * Delegates to the logger.
   */
  private function log( $message, $exception = NULL, $institute = NULL, $harvestId = NULL )
  {
    $this->logger->log( $message, $exception, $institute, $harvestId );
  }

  private $logger;

}

?>