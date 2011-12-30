<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * Information about publications as described in the data format specification.
 */
class Publication extends EntityBase {

  public function getUK() {

    $this->validate();
    return array( $this->Quotation, $this->PublDate );
  }

  public function isRequiredProperty( $propertyName ) {

    if ( is_null( $propertyName ) ) {
      return FALSE;
    }
    switch ( $propertyName ) {
      case 'Quotation' :
      case 'ShortDescription' :
        return TRUE;
      default :
        
        return FALSE;
    }
  }

  public function setQuotation( $x ) {

    $this->checkMaximumLength( $x, 500, 'Quotation' );
    $this->Quotation = $x;
    return $this;
  }

  public function setShortDescription( $x ) {

    $this->checkMaximumLength( $x, 500, 'ShortDescription' );
    $this->ShortDescription = $x;
    return $this;
  }

  public function setPublDate( $x ) {

    $this->checkDate4or10( $x, 'PublDate' );
    $this->PublDate = $x;
    return $this;
  }

  public function setPublType( PublicationTypeEnum $x ) {

    $this->PublType = $x;
    return $this;
  }

  /**
   * This adds this publication to the list of publications of the given institute.
   * 
   * @param Institute $institute
   */
  public function setInstitute( Institute $institute ) {

    if ( !is_null( $institute ) and $this->Institute != $institute ) {
      $this->Institute = $institute;
      $this->Institute->addPublication( $this );
    }
    return $this;
  }

  /**
   * @return the $Quotation
   */
  public function getQuotation() {

    return $this->Quotation;
  }

  /**
   * @return the $ShortDescription
   */
  public function getShortDescription() {

    return $this->ShortDescription;
  }

  /**
   * @return the $PublDate
   */
  public function getPublDate() {

    return $this->PublDate;
  }

  /**
   * @return the $PublType
   */
  public function getPublType() {

    return $this->PublType;
  }

  /**
   * @return the $Institute
   */
  public function getInstitute() {

    return $this->Institute;
  }

  public function validate() {

    if ( $this->isEmpty( $this->Quotation ) ) {
      throw new InvalidArgumentException( 'Quotation of publication must not be empty.' );
    }
    if ( $this->isEmpty( $this->ShortDescription ) ) {
      throw new InvalidArgumentException( 'Short description of publication must not be empty.' );
    }
  }

  public function __toString() {

    return "[Publication] {$this->Quotation}, {$this->ShortDescription}, {$this->PublDate}, {$this->PublType}, {$this->Institute}";
  }

  private $Quotation;

  private $ShortDescription;

  private $PublDate;

  private $PublType;

  private $Institute;

}
?>