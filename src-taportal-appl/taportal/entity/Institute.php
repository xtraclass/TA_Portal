<?php

/**
 * Information about institutes as described in the data format specification.
 */
class Institute extends EntityBase
{



  public function __construct()
  {
    $this->experts = new TheExperts();
    $this->publications = new ThePublications();
  }



  public function getUK()
  {
    $this->validate();
    return array( $this->Abbreviation );
  }



  public function isRequiredProperty( $propertyName )
  {
    if ( is_null( $propertyName ) )
    {
      return FALSE;
    }
    switch ( $propertyName )
    {
      case 'Abbreviation' :
      case 'Name' :
        return TRUE;
      default :
        return FALSE;
    }
  }



  public function setAbbreviation( $x )
  {
    $this->checkMaximumLength( $x, 10, 'Abbreviation' );
    $this->Abbreviation = $x;
    return $this;
  }



  /**
   * @return the $Name
   */
  public function getName()
  {
    return $this->Name;
  }



  /**
   * @return the $CountryCode
   */
  public function getCountryCode()
  {
    return $this->CountryCode;
  }



  /**
   * @return the $ZipCode
   */
  public function getZipCode()
  {
    return $this->ZipCode;
  }



  /**
   * @return the $City
   */
  public function getCity()
  {
    return $this->City;
  }



  /**
   * @return the $Street
   */
  public function getStreet()
  {
    return $this->Street;
  }



  /**
   * @return the $Description
   */
  public function getDescription()
  {
    return $this->Description;
  }



  /**
   * @return the $URL
   */
  public function getURL()
  {
    return $this->URL;
  }



  /**
   * @param field_type $Name
   */
  public function setName( $x )
  {
    
    $this->checkMaximumLength( $x, 51, 'Name' );
    $this->Name = $x;
    return $this;
  }



  /**
   * @param field_type $CountryCode
   */
  public function setCountryCode( $x )
  {
    $this->checkExactLength( $x, 'CountryCode', 2 );
    $this->CountryCode = $x;
    return $this;
  }



  /**
   * @param field_type $ZipCode
   */
  public function setZipCode( $x )
  {
    $this->checkMaximumLength( $x, 10, 'ZipCode' );
    $this->ZipCode = $x;
    return $this;
  }



  /**
   * @param field_type $City
   */
  public function setCity( $x )
  {
    $this->checkMaximumLength( $x, 40, 'City' );
    $this->City = $x;
    return $this;
  }



  /**
   * @param field_type $Street
   */
  public function setStreet( $x )
  {
    $this->checkMaximumLength( $x, 50, 'Street' );
    $this->Street = $x;
    return $this;
  }



  /**
   * @param field_type $Description
   */
  public function setDescription( $x )
  {
    $this->checkMaximumLength( $x, 500, 'Description' );
    $this->Description = $x;
    return $this;
  }



  /**
   * @param field_type $URL
   */
  public function setURL( $x )
  {
    $this->checkMaximumLength( $x, 500, 'URL' );
    $this->URL = $x;
    return $this;
  }



  /**
   * This returns the list of experts of this institute.
   *
   *
   */
  public function getExperts()
  {
    return $this->experts;
  }



  /**
   * This adds the given expert to the list of experts of this institute.
   *
   * 
   * @param Expert $expert
   */
  public function addExpert( Expert $expert )
  {
    if ( !is_null( $expert ) )
    {
      if ( !is_null( $expert->getInstitute() ) )
      {
        $expert->getInstitute()->removeExpert( $expert );
      }
      
      if ( $this->experts->addExpert( $expert ) )
      {
        $expert->setInstitute( $this );
      }
    }
    return $this;
  }



  /**
   * This removes the given expert from the list
   * of experts of this institute.
   *
   * 
   * @param Expert $expert
   */
  public function removeExpert( Expert $expert )
  {
    return $this->experts->remove( $expert );
  }



  /**
   * This adds the given expert to the list of
   * experts of this institute.
   *
   * 
   * @param Expert $expert
   */
  public function setExpert( Expert $expert )
  {
    $this->clearExperts();
    $this->addExpert( $expert );
    return $this;
  }



  /**
   * This removes all experts from the list of experts
   * of this institute.
   *
   *
   */
  public function clearExperts()
  {
    for( $i = 0; $i < count( $this->experts ); $i++ )
    {
      if ( !is_null( $this->experts->get( $i ) ) )
      {
        $this->removeExpert( $this->experts->get( $i ) );
      }
    }
    
    $this->experts->clear();
    return $this;
  }



  /**
   * This returns the list of publications of this institute.
   *
   *
   */
  public function getPublications()
  {
    return $this->publications;
  }



  /**
   * This adds the given publication to the list of publications of this institute.
   *
   * 
   * @param Publication $publication
   */
  public function addPublication( Publication $publication )
  {
    if ( !is_null( $publication ) )
    {
      
      if ( !is_null( $publication->getInstitute() ) )
      {
        $publication->getInstitute()->removePublication( $publication );
      }
      
      if ( $this->publications->addPublication( $publication ) )
      {
        $publication->setInstitute( $this );
      }
    
    }
    return $this;
  }



  /**
   * This removes the given publication from the list of publications of this institute.
   *
   * 
   * @param Publication $publication
   */
  public function removePublication( Publication $publication )
  {
    return $this->publications->remove( $publication );
  }



  /**
   * This sets this publication as the only publication of this institute.
   *
   * 
   * @param Publication $publication
   */
  public function setPublication( Publication $publication )
  {
    $this->clearPublications();
    $this->addPublication( $publication );
    return $this;
  }



  /**
   * This removes all publications from the list of publications of this institute.
   *
   *
   */
  public function clearPublications()
  {
    for( $i = 0; $i < count( $this->publications ); $i++ )
    {
      if ( !is_null( $this->publications->get( $i ) ) )
      {
        $this->removePublication( $this->publications->get( $i ) );
      }
    }
    
    $this->publications->clear();
    return $this;
  }



  /**
   * @return the $Abbreviation
   */
  public function getAbbreviation()
  {
    return $this->Abbreviation;
  }


  /**
   * @return the $HarvesterUrl
   */
  public function getHarvesterUrl()
  {
    return $this->HarvesterUrl;
  }



  /**
   * Returns true, if the data of this institute should be gathered by the Harvester.
   * 
   * @return the $ForHarvest
   */
  public function getForHarvest()
  {
    return $this->ForHarvest;
  }



  /**
   * @param field_type $HarvesterUrl
   */
  public function setHarvesterUrl( $HarvesterUrl )
  {
    $this->HarvesterUrl = $HarvesterUrl;
  }



  /**
   * @param field_type $ForHarvest
   */
  public function setForHarvest( $ForHarvest )
  {
    $this->ForHarvest = $ForHarvest;
  }



  public function validate()
  {
    if ( $this->isEmpty( $this->Abbreviation ) )
    {
      throw new InvalidArgumentException( 'Abbreviation of institute must not be empty.' );
    }
    if ( $this->isEmpty( $this->Name ) )
    {
      throw new InvalidArgumentException( 'Name of institute must not be empty.' );
    }
  }



  public function __toString()
  {
    return "[Institute {$this->Id}] {$this->Abbreviation} with {$this->experts->size()} experts and with {$this->publications->size()} publications," . " {$this->Name} {$this->CountryCode} {$this->ZipCode} {$this->City} {$this->Street} {$this->Description} {$this->URL}";
  }



  public function shortDisplayString()
  {
    return "institute [{$this->Id}] {$this->Abbreviation} - {$this->Name}";
  }

  private $Abbreviation;

  private $Name;

  private $CountryCode;

  private $ZipCode;

  private $City;

  private $Street;

  private $Description;

  private $URL;

  private $experts;

  private $publications;

  private $HarvesterUrl;

  private $ForHarvest;

}

?>