<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * Information about projects as described in the data format specification.
 */
class Project extends EntityBase {

  public function getUK() {

    $this->validate();
    return array( $this->ShortTitleE );
  }

  public function isRequiredProperty( $propertyName ) {

    if ( is_null( $propertyName ) ) {
      return FALSE;
    }
    switch ( $propertyName ) {
      case 'ShortTitleE' :
      case 'LongTitleE' :
        return TRUE;
      default :
        
        return FALSE;
    }
  }

  public function setShortTitleE( $x ) {

    $this->checkMaximumLength( $x, 40, 'ShortTitleE' );
    $this->ShortTitleE = $x;
    return $this;
  }

  public function setLongTitleE( $x ) {

    $this->checkMaximumLength( $x, 250, 'LongTitleE' );
    $this->LongTitleE = $x;
    return $this;
  }

  public function setShortDescriptionE( $x ) {

    $this->checkMaximumLength( $x, 500, 'ShortDescriptionE' );
    $this->ShortDescriptionE = $x;
    return $this;
  }

  public function setStartDate( $x ) {

    $this->checkDate7( $x, 'StartDate' );
    $this->StartDate = $x;
    return $this;
  }

  public function setEndDate( $x ) {

    $this->checkDate7( $x, 'EndDate' );
    $this->EndDate = $x;
    return $this;
  }

  public function setPartnerCountries( $x ) {

    $this->checkMaximumLength( $x, 150, 'PartnerCountries' );
    $this->PartnerCountries = $x;
    return $this;
  }

  public function setScopeCountries( $x ) {

    $this->checkMaximumLength( $x, 150, 'ScopeCountries' );
    $this->ScopeCountries = $x;
    return $this;
  }

  /**
   * This adds this project to the list of projects for which
   * the given expert is the contact person.
   * 
   * @param Expert $expert
   */
  public function setContactPerson( Expert $expert ) {

    if ( !is_null( $expert ) and $this->ContactPerson != $expert ) {
      $this->ContactPerson = $expert;
      $this->ContactPerson->addProject( $this );
    }
    return $this;
  }

  public function setHomePage( $x ) {

    $this->checkMaximumLength( $x, 250, 'HomePage' );
    $this->HomePage = $x;
    return $this;
  }

  public function setFocus( $x ) {

    $this->checkMaximumLength( $x, 500, 'Focus' );
    $this->Focus = $x;
    return $this;
  }

  /**
   * @return the $ShortTitleE
   */
  public function getShortTitleE() {

    return $this->ShortTitleE;
  }

  /**
   * @return the $LongTitleE
   */
  public function getLongTitleE() {

    return $this->LongTitleE;
  }

  /**
   * @return the $ShortDescriptionE
   */
  public function getShortDescriptionE() {

    return $this->ShortDescriptionE;
  }

  /**
   * @return the $StartDate
   */
  public function getStartDate() {

    return $this->StartDate;
  }

  /**
   * @return the $EndDate
   */
  public function getEndDate() {

    return $this->EndDate;
  }

  /**
   * @return the $PartnerCountries
   */
  public function getPartnerCountries() {

    return $this->PartnerCountries;
  }

  /**
   * @return the $ScopeCountries
   */
  public function getScopeCountries() {

    return $this->ScopeCountries;
  }

  /**
   * @return the $ContactPerson
   */
  public function getContactPerson() {

    return $this->ContactPerson;
  }

  /**
   * @return the $HomePage
   */
  public function getHomePage() {

    return $this->HomePage;
  }

  /**
   * @return the $Focus
   */
  public function getFocus() {

    return $this->Focus;
  }

  public function validate() {

    if ( $this->isEmpty( $this->ShortTitleE ) ) {
      throw new InvalidArgumentException( 'ShortTitleE of project must not be empty.' );
    }
    if ( $this->isEmpty( $this->LongTitleE ) ) {
      throw new InvalidArgumentException( 'LongTitleE description of project must not be empty.' );
    }
  }

  public function __toString() {

    return "[Project] {$this->ShortTitleE}, {$this->LongTitleE}, {$this->ShortDescriptionE}, {$this->StartDate}, {$this->EndDate}, " . "{$this->PartnerCountries}, {$this->ScopeCountries}, {$this->ContactPerson}, {$this->HomePage}, {$this->Focus}";
  }

  private $ShortTitleE;

  private $LongTitleE;

  private $ShortDescriptionE;

  private $StartDate;

  private $EndDate;

  private $PartnerCountries;

  private $ScopeCountries;

  private $ContactPerson;

  private $HomePage;

  private $Focus;

}

?>