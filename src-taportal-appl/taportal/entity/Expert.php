<?php

/**
 * Information about experts as described in the data format specification.
 */
class Expert extends EntityBase
{



  public function __construct()
  {
    $this->projects = new TheProjects();
  }



  public function getUK()
  {
    $this->validate();
    return array( $this->Surname, $this->Firstnames );
  }



  public function isRequiredProperty( $propertyName )
  {
    if ( is_null( $propertyName ) )
    {
      return FALSE;
    }
    switch ( $propertyName )
    {
      case 'Surname' :
      case 'Firstnames' :
        return TRUE;
      default :
        
        return FALSE;
    }
  }



  /**
   * This adds the given project to the list of projects for 
   * which this expert is the contact person.
   * 
   * @param Project $project
   */
  public function addProject( Project $project )
  {
    if ( !is_null( $project ) )
    {
      
      if ( !is_null( $project->getContactPerson() ) )
      {
        $project->getContactPerson()->removeProject( $project );
      }
      
      if ( $this->projects->addProject( $project ) )
      {
        $project->setContactPerson( $this );
      }
    
    }
    return $this;
  }



  /**
   * This removes the given project from the list of projects for 
   * which this expert is the contact person.
   * 
   * @param Project $project
   */
  public function removeProject( Project $project )
  {
    return $this->projects->remove( $project );
  }



  /**
   * This returns the list of projects for 
   * which this expert is the contact person.
   */
  public function getProjects()
  {
    return $this->projects;
  }



  /**
   * This remove all projects from this expert person for
   * which this expert is the contact person.
   */
  public function clearProjects()
  {
    for( $i = 0; $i < count( $this->projects ); $i++ )
    {
      if ( !is_null( $this->projects->get( $i ) ) )
      {
        $this->removeProject( $this->projects->get( $i ) );
      }
    }
    
    $this->projects->clear();
    return $this;
  }



  public function setSurname( $x )
  {
    $this->checkMaximumLength( $x, 150, 'Surname' );
    $this->Surname = $x;
    return $this;
  }



  public function setFirstnames( $x )
  {
    $this->checkMaximumLength( $x, 100, 'Firstnames' );
    $this->Firstnames = $x;
    return $this;
  }



  public function setExpTitle( $x )
  {
    $this->checkMaximumLength( $x, 15, 'ExpTitle' );
    $this->ExpTitle = $x;
    return $this;
  }



  public function setEMail( $x )
  {
    $this->checkMaximumLength( $x, 256, 'EMail' );
    $this->EMail = $x;
    return $this;
  }



  public function setPhoneNumber( $x )
  {
    $this->checkMaximumLength( $x, 21, 'PhoneNumber' );
    $this->PhoneNumber = $x;
    return $this;
  }



  public function setSkypeID( $x )
  {
    $this->checkMaximumLength( $x, 28, 'SkypeID' );
    $this->SkypeID = $x;
    return $this;
  }



  public function setExpertise( $x )
  {
    $this->checkMaximumLength( $x, 500, 'Expertise' );
    $this->Expertise = $x;
    return $this;
  }



  public function setEmplURL( $x )
  {
    $this->checkMaximumLength( $x, 500, 'EmplURL' );
    $this->EmplURL = $x;
    return $this;
  }



  /**
   * This adds this expert to the list of experts of the given institute. 
   * 
   * @param Institute $institute
   */
  public function setInstitute( Institute $institute )
  {
    if ( !is_null( $institute ) and $this->Institute != $institute )
    {
      $this->Institute = $institute;
      $this->Institute->addExpert( $this );
    }
    return $this;
  }



  public function setTAPublicationURL( $x )
  {
    $this->checkMaximumLength( $x, 500, 'TAPublicationURL' );
    $this->TAPublicationURL = $x;
    return $this;
  }



  public function setTAProjectURL( $x )
  {
    $this->checkMaximumLength( $x, 500, 'TAProjectURL' );
    $this->TAProjectURL = $x;
    return $this;
  }



  public function getSurname()
  {
    return $this->Surname;
  }



  public function getFirstnames()
  {
    return $this->Firstnames;
  }



  public function getExpTitle()
  {
    return $this->ExpTitle;
  }



  public function getEMail()
  {
    return $this->EMail;
  }



  public function getPhoneNumber()
  {
    return $this->PhoneNumber;
  }



  public function getSkypeID()
  {
    return $this->SkypeID;
  }



  public function getExpertise()
  {
    return $this->Expertise;
  }



  public function getEmplURL()
  {
    return $this->EmplURL;
  }



  public function getInstitute()
  {
    return $this->Institute;
  }



  public function getTAPublicationURL()
  {
    return $this->TAPublicationURL;
  }



  public function getTAProjectURL()
  {
    return $this->TAProjectURL;
  }



  public function belongsToExistingInstitute()
  {
    return !is_null( $this->Institute ) and !is_null( $this->Institute->getId() ) and $this->Institute->getId() > 0;
  }



  public function validate()
  {
    if ( $this->isEmpty( $this->Surname ) )
    {
      throw new InvalidArgumentException( 'Surname of expert must not be empty.' );
    }
    if ( $this->isEmpty( $this->Firstnames ) )
    {
      throw new InvalidArgumentException( 'Firstnames of expert must not be empty.' );
    }
  }



  public function __toString()
  {
    return "[Expert {$this->Id}] {$this->Surname}, {$this->Firstnames}, {$this->ExpTitle}, {$this->EMail}, {$this->PhoneNumber}, " . "{$this->SkypeID}, {$this->Expertise}, {$this->EmplURL}, {$this->Institute}, {$this->TAPublicationURL}, {$this->TAProjectURL}";
  }

  private $Surname;

  private $Firstnames;

  private $ExpTitle;

  private $EMail;

  private $PhoneNumber;

  private $SkypeID;

  private $Expertise;

  private $EmplURL;

  private $Institute;

  private $TAPublicationURL;

  private $TAProjectURL;

  private $projects;

}

?>