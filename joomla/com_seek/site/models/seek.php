<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla modelitem library
jimport( 'joomla.application.component.modelitem' );
require_once 'taportal/harvester/_Classes.php';

/**
 * Seek Model
 */
class SeekModelSeek extends JModelItem
{

  protected $institutes;

  protected $experts;

  protected $projects;

  protected $publications;



  public function __construct()
  {
    $this->init();
  }



  public function getTable( $type = 'seek', $prefix = 'SeekTable', $config = array() )
  {
    return JTable::getInstance( $type, $prefix, $config );
  }



  public function getData()
  {
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return array( $this->institutes, $this->experts, $this->projects, $this->publications );
  }



  public function getInstitutes()
  {
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return $this->institutes;
  }



  public function getExperts()
  {
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return $this->experts;
  }



  public function getProjects()
  {
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return $this->projects;
  }



  public function getPublications()
  {
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return $this->publications;
  }



  public function search( $lookFor )
  {
    if ( is_null( $lookFor ) or strlen( $lookFor ) == 0 )
    {
      return $this->getData();
    }
    
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return array( /***/
    $this->institutes->search( $lookFor ), /***/
    $this->experts->search( $lookFor ), /***/
    $this->projects->search( $lookFor ), /***/
    $this->publications->search( $lookFor ) );
  }



  public function searchPublicationsByType( $lookFor, $publType )
  {
    if ( is_null( $lookFor ) or strlen( $lookFor ) == 0 )
    {
      return $this->getData();
    }
    if ( is_null( $publType ) )
    {
      return $this->getData();
    }
    
    if ( SeekCache::expired() )
    {
      $this->readData();
    }
    
    return array( new TheInstitutes(), new TheExperts(), new TheProjects(), /***/
    $this->publications->searchByPublType( $lookFor, $publType ) );
  }



  private function readData()
  {
    $this->init();
    
    $instById = array();
    $expsById = array();
    
    $query = "SELECT * FROM #__institute";
    $dbInstitutes = $this->_getList( $query, 0, 0 );
    
    if ( !is_null( $dbInstitutes ) )
    {
      for( $i = 0; $i < count( $dbInstitutes ); $i++ )
      {
        $d = $dbInstitutes[ $i ];
        
        $x = new Institute();
        $this->institutes->addInstitute( $x );
        
        $x->setAbbreviation( $d->abbreviation );
        $x->setName( $d->name );
        $x->setDescription( $d->description );
        $x->setCountryCode( $d->countrycode );
        $x->setURL( $d->url );
        $x->setID( $d->id );
        
        $insByID[ $x->getId() ] = $x;
      }
    }
    
    $query = "SELECT * FROM #__expert";
    $dbExperts = $this->_getList( $query, 0, 0 );
    
    if ( !is_null( $dbExperts ) )
    {
      for( $i = 0; $i < count( $dbExperts ); $i++ )
      {
        $d = $dbExperts[ $i ];
        
        $x = new Expert();
        $this->experts->addExpert( $x );
        
        $x->setSurname( $d->surname );
        $x->setFirstnames( $d->firstnames );
        $x->setExpTitle( $d->exptitle );
        $x->setEMail( $d->email );
        $x->setPhoneNumber( $d->phonenumber );
        $x->setSkypeID( $d->skypeid );
        $x->setExpertise( $d->expertise );
        $x->setInstitute( $insByID[ $d->fkinstitute ] );
        $x->setId( $d->id );
        
        $expsById[ $x->getId() ] = $x;
      }
    }
    
    $query = "SELECT * FROM #__project";
    $dbProjects = $this->_getList( $query, 0, 0 );
    
    if ( !is_null( $dbProjects ) )
    {
      for( $i = 0; $i < count( $dbProjects ); $i++ )
      {
        $d = $dbProjects[ $i ];
        
        $x = new Project();
        $this->projects->addProject( $x );
        
        $x->setShortTitleE( $d->shorttitle );
        $x->setLongTitleE( $d->longtitle );
        $x->setShortDescriptionE( $d->shortdescription );
        if ( $d->startdate != '0000-00-00' )
        {
          if ( strlen( $d->startdate ) > 7 )
          {
            $x->setStartDate( substr( $d->startdate, 0, 7 ) );
          }
          else if ( strlen( $d->startdate ) == 7 )
          {
            $x->setStartDate( $d->startdate );
          }
        }
        if ( $d->enddate != '0000-00-00' )
        {
          if ( strlen( $d->enddate ) > 7 )
          {
            $x->setEndDate( substr( $d->enddate, 0, 7 ) );
          }
          else if ( strlen( $d->enddate ) == 7 )
          {
            $x->setEndDate( $d->enddate );
          }
        }
        $x->setHomePage( $d->homepage );
        $x->setId( $d->id );
        $x->setContactPerson( $expsById[ $d->fkcontactperson ] );
      }
    }
    
    $query = "SELECT * FROM #__publication";
    $dbPublications = $this->_getList( $query, 0, 0 );
    
    if ( !is_null( $dbPublications ) )
    {
      for( $i = 0; $i < count( $dbPublications ); $i++ )
      {
        $d = $dbPublications[ $i ];
        
        $x = new Publication();
        $this->publications->addPublication( $x );
        
        $x->setQuotation( $d->quotation );
        if ( $d->publdate != '0000-00-00' )
        {
          $x->setPublDate( $d->publdate );
        }
        if ( !is_null( $d->publtype ) )
        {
          $x->setPublType( PublicationTypeEnum::byStringValue( $d->publtype ) );
        }
        $x->setId( $d->id );
        $x->setInstitute( $insByID[ $d->fkinstitute ] );
      }
    }
  }



  private function init()
  {
    $this->institutes = new TheInstitutes();
    $this->experts = new TheExperts();
    $this->projects = new TheProjects();
    $this->publications = new ThePublications();
  }

}
?>