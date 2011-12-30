<?php

/**
 * This classes generates a JSON string for some entities
 * as described in the data format specification. 
 */
final class JSONBuilder
{

  /**
   * The whole JSON string / representation must not be longer than this constant says. (Current value: 5 MB)
   * 
   * @var int
   */
  const MAX_LENGTH = 5242880; // 5 MB



  /**
   * This generates a JSON string / representation for the given list of objects
   * as described in the data format specification.
   * 
   * @param TheInstitutes $institutes May be null
   * @param TheExperts $experts May be null
   * @param TheProjects $projects May be null
   * @param ThePublications $publications May be null
   */
  public static function build( TheInstitutes $institutes = NULL, TheExperts $experts = NULL, TheProjects $projects = NULL, ThePublications $publications = NULL )
  {
    
    $needComa = FALSE;
    $json = '{"V":';
    $json .= DataFormatSpecificationConstants::SPECIFICATION_VERSION;
    $json .= ',';
    
    if ( !is_null( $institutes ) and $institutes->areThere() )
    {
      if ( $needComa ) $json .= ',';
      $json .= '"I":' . self::buildManyInstitutes( $institutes );
      $needComa = TRUE;
    }
    
    if ( !is_null( $experts ) and $experts->areThere() )
    {
      if ( $needComa ) $json .= ',';
      $json .= '"E":' . self::buildManyExperts( $experts );
      $needComa = TRUE;
    }
    
    if ( !is_null( $projects ) and $projects->areThere() )
    {
      if ( $needComa ) $json .= ',';
      $json .= '"R":' . self::buildManyProjects( $projects );
      $needComa = TRUE;
    }
    
    if ( !is_null( $publications ) and $publications->areThere() )
    {
      if ( $needComa ) $json .= ',';
      $json .= '"U":' . self::buildManyPublications( $publications );
      $needComa = TRUE;
    }
    
    $json .= '}';
    
    $json = str_replace( "\n", '||||', $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Institute object.
   * 
   * @param Institute $institute
   */
  private static function buildOneInstitute( Institute $institute )
  {
    
    if ( is_null( $institute ) ) return '';
    $institute->validate();
    
    $json = '{' . /***/
    '"E":"' . $institute->getAbbreviation() . '"' . /***/
    ( !is_null( $institute->getName() ) ? ',' . '"N":"' . $institute->getName() . '"' : '' ) . /***/
    ( !is_null( $institute->getCountryCode() ) ? ',' . '"O":"' . $institute->getCountryCode() . '"' : '' ) . /***/
    ( !is_null( $institute->getZipCode() ) ? ',' . '"Z":"' . $institute->getZipCode() . '"' : '' ) . /***/
    ( !is_null( $institute->getCity() ) ? ',' . '"C":"' . $institute->getCity() . '"' : '' ) . /***/
    ( !is_null( $institute->getStreet() ) ? ',' . '"S":"' . $institute->getStreet() . '"' : '' ) . /***/
    ( !is_null( $institute->getDescription() ) ? ',' . '"D":"' . $institute->getDescription() . '"' : '' ) . /***/
    ( !is_null( $institute->getURL() ) ? ',' . '"U":"' . $institute->getURL() . '"' : '' ) . /***/
    '}';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Expert object.
   * 
   * @param Expert $expert
   */
  private static function buildOneExpert( Expert $expert )
  {
    
    if ( is_null( $expert ) ) return '';
    $expert->validate();
    
    $json = '{' . /***/
    '"S":"' . $expert->getSurname() . '"' . ',' . /***/
    '"F":"' . $expert->getFirstnames() . '"' . /***/
    ( !is_null( $expert->getExpTitle() ) ? ',' . '"T":"' . $expert->getExpTitle() . '"' : '' ) . /***/
    ( !is_null( $expert->getEMail() ) ? ',' . '"E":"' . $expert->getEMail() . '"' : '' ) . /***/
    ( !is_null( $expert->getPhoneNumber() ) ? ',' . '"P":"' . $expert->getPhoneNumber() . '"' : '' ) . /***/
    ( !is_null( $expert->getSkypeID() ) ? ',' . '"D":"' . $expert->getSkypeID() . '"' : '' ) . /***/
    ( !is_null( $expert->getExpertise() ) ? ',' . '"X":"' . $expert->getExpertise() . '"' : '' ) . /***/
    ( !is_null( $expert->getEmplURL() ) ? ',' . '"L":"' . $expert->getEmplURL() . '"' : '' ) . /***/
    ( !is_null( $expert->getInstitute() ) ? ',' . '"I":' . self::buildUKofInsitutue( $expert->getInstitute() ) : '' ) . /***/
    ( !is_null( $expert->getTAPublicationURL() ) ? ',' . '"U":"' . $expert->getTAPublicationURL() . '"' : '' ) . /***/
    ( !is_null( $expert->getTAProjectURL() ) ? ',' . '"J":"' . $expert->getTAProjectURL() . '"' : '' ) . /***/
    '}';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Publication object.
   * 
   * @param Publication $publication
   */
  private static function buildOnePublication( Publication $publication )
  {
    
    if ( is_null( $publication ) ) return '';
    $publication->validate();
    
    $json = '{' . /***/
    '"Q":"' . $publication->getQuotation() . '"' . ',' . /***/
    '"D":"' . $publication->getPublDate() . '"' . /***/
    ( !is_null( $publication->getShortDescription() ) ? ',' . '"S":"' . $publication->getShortDescription() . '"' : '' ) . /***/
    ( !is_null( $publication->getPublType() ) ? ',' . '"T":"' . $publication->getPublType()->value() . '"' : '' ) . /***/
    ( !is_null( $publication->getInstitute() ) ? ',' . '"I":' . self::buildUKofInsitutue( $publication->getInstitute() ) : '' ) . /***/
    '}';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Project object.
   * 
   * @param Project $project
   */
  private static function buildOneProject( Project $project )
  {
    
    if ( is_null( $project ) ) return '';
    $project->validate();
    
    $json = '{' . /***/
    '"S":"' . self::escape( $project->getShortTitleE() ) . '"' . /***/
    ( !is_null( $project->getLongTitleE() ) ? ',' . '"L":"' . self::escape( $project->getLongTitleE() ) . '"' : '' ) . /***/
    ( !is_null( $project->getShortDescriptionE() ) ? ',' . '"D":"' . self::escape( $project->getShortDescriptionE() ) . '"' : '' ) . /***/
    ( !is_null( $project->getStartDate() ) ? ',' . '"T":"' . self::escape( $project->getStartDate() ) . '"' : '' ) . /***/
    ( !is_null( $project->getEndDate() ) ? ',' . '"N":"' . self::escape( $project->getEndDate() ) . '"' : '' ) . /***/
    ( !is_null( $project->getPartnerCountries() ) ? ',' . '"Y":"' . self::escape( $project->getPartnerCountries() ) . '"' : '' ) . /***/
    ( !is_null( $project->getScopeCountries() ) ? ',' . '"Z":"' . self::escape( $project->getScopeCountries() ) . '"' : '' ) . /***/
    ( !is_null( $project->getContactPerson() ) ? ',' . '"O":' . self::buildUKofExpert( $project->getContactPerson() ) : '' ) . /***/
    ( !is_null( $project->getHomePage() ) ? ',' . '"H":"' . self::escape( $project->getHomePage() ) . '"' : '' ) . /***/
    ( !is_null( $project->getFocus() ) ? ',' . '"U":"' . self::escape( $project->getFocus() ) . '"' : '' ) . /***/
    '}';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Expert objects.
   * 
   * @param TheExperts $values
   */
  private static function buildManyExperts( TheExperts $values )
  {
    
    $json = '[';
    for( $i = 0; $i < $values->size(); $i++ )
    {
      $json .= self::buildOneExpert( $values->get( $i ) ) . ',';
    }
    $json = substr( $json, 0, count( $json ) - 2 ) . ']';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Publication objects.
   * 
   * @param ThePublications $values
   */
  private static function buildManyPublications( ThePublications $values )
  {
    
    $json = '[';
    for( $i = 0; $i < $values->size(); $i++ )
    {
      $json .= self::buildOnePublication( $values->get( $i ) ) . ',';
    }
    $json = substr( $json, 0, count( $json ) - 2 ) . ']';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Project objects.
   * 
   * @param TheProjects $values
   */
  private static function buildManyProjects( TheProjects $values )
  {
    
    $json = '[';
    for( $i = 0; $i < $values->size(); $i++ )
    {
      $json .= self::buildOneProject( $values->get( $i ) ) . ',';
    }
    $json = substr( $json, 0, count( $json ) - 2 ) . ']';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Institute objects.
   * 
   * @param TheInstitutes $values
   */
  private static function buildManyInstitutes( TheInstitutes $values )
  {
    
    $json = '[';
    for( $i = 0; $i < $values->size(); $i++ )
    {
      $json .= self::buildOneInstitute( $values->get( $i ) ) . ',';
    }
    $json = substr( $json, 0, count( $json ) - 2 ) . ']';
    self::checkMaximumLength( $json );
    
    return $json;
  }



  /**
   * This returns the JSON string for the given Institute object.
   * 
   * @param Institute $institute
   */
  public static function buildUKofInsitutue( Institute $institute )
  {
    
    if ( is_null( $institute ) ) return '';
    
    $uk = $institute->getUK();
    
    return '{"E":"' . $uk[ 0 ] . '"}';
  }



  /**
   * This returns the JSON string for the given Expert object.
   * 
   * @param Expert $expert
   */
  public static function buildUKofExpert( Expert $expert )
  {
    
    if ( is_null( $expert ) ) return '';
    
    $uk = $expert->getUK();
    
    return '{"S":"' . $uk[ 0 ] . '","F":"' . $uk[ 1 ] . '"}';
  }



  /**
   * This checks if the given string is not longer than MAX_LENGTH. 
   * 
   * @param string $json
   * @throws Exception if the string is too long
   */
  private static function checkMaximumLength( $json )
  {
    
    if ( strlen( $json ) > self::MAX_LENGTH )
    {
      throw new Exception( 'JSON message is too big, i .e. bigger than ' . self::MAX_LENGTH . ' bytes.' );
    }
  }



  /**
   * This changes all characters in the given string to something which is valid
   * within the value of a JSON text, and then returns that new string. Currently only " is changed to \". 
   * 
   * @param string $value
   * @return string
   */
  private static function escape( $value )
  {
    
    return str_replace( "\"", "\\\"", $value );
  }
}
?>