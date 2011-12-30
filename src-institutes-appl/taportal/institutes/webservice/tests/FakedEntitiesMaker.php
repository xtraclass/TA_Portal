<?php

require_once 'taportal/institutes/webservice/base/Classes.php';

/**
 * Helper class for making fake (i. e. demo) entities like lists of
 * Institutes, Experts, Publications, Projects. They can be used in tests then. 
 */
class FakedEntitiesMaker {

  public static function fakeExample1() {

    $institutes = new TheInstitutes();
    $experts = new TheExperts();
    $projects = new TheProjects();
    $publications = new ThePublications();
    
    $institute1 = new Institute();
    $institutes->addInstitute( $institute1 );
    $institute1->setAbbreviation( 'A' );
    $institute1->setCity( 'Vienna' );
    $institute1->setCountryCode( 'AT' );
    $institute1->setDescription( 'A test institute' );
    $institute1->setName( 'IA' );
    $institute1->setStreet( 'Küniglbergstraße 10' );
    $institute1->setURL( 'www.ia.at' );
    $institute1->setZipCode( '1010' );
    
    $institute2 = new Institute();
    $institutes->addInstitute( $institute2 );
    $institute2->setAbbreviation( 'B' );
    $institute2->setCity( 'Vienna' );
    $institute2->setCountryCode( 'AT' );
    $institute2->setDescription( "A||||second||||test||||institute" );
    $institute2->setName( 'BBB' );
    $institute2->setStreet( 'MAriahilferstr. 2' );
    $institute2->setURL( 'www.bbb.at' );
    $institute2->setZipCode( '1020' );
    
    $expert1 = new Expert();
    $experts->addExpert( $expert1 );
    $expert1->setEMail( 'expert1@w.com' );
    $expert1->setEmplURL( 'www.e1.com' );
    $expert1->setExpertise( 'Java, JavaScript' );
    $expert1->setExpTitle( 'director' );
    $expert1->setFirstnames( 'Michael' );
    $expert1->setPhoneNumber( '123123' );
    $expert1->setSkypeID( '123' );
    $expert1->setSurname( 'Huber' );
    $expert1->setTAProjectURL( 'www.xxx.at' );
    $expert1->setTAPublicationURL( 'www.yyy.at' );
    
    $expert2 = new Expert();
    $experts->addExpert( $expert2 );
    $expert2->setEMail( 'expert2@w.com' );
    $expert2->setEmplURL( 'www.e2.com' );
    $expert2->setExpertise( 'php' );
    $expert2->setExpTitle( 'director' );
    $expert2->setFirstnames( 'Andreas' );
    $expert2->setPhoneNumber( '444222222' );
    $expert2->setSkypeID( '222' );
    $expert2->setSurname( 'Meier' );
    $expert2->setTAProjectURL( 'www.222.at' );
    $expert2->setTAPublicationURL( 'www.222.at/2' );
    
    $project1 = new Project();
    $projects->addProject( $project1 );
    $project1->setEndDate( '2014-12' );
    $project1->setFocus( 'Books' );
    $project1->setHomePage( 'www.proj1.com' );
    $project1->setLongTitleE( 'bla bla bla' );
    $project1->setPartnerCountries( 'Austria' );
    $project1->setScopeCountries( 'Austria, Germany' );
    $project1->setShortDescriptionE( 'bla' );
    $project1->setShortTitleE( 'B1' );
    $project1->setStartDate( '2011-01' );
    
    $project2 = new Project();
    $projects->addProject( $project2 );
    $project2->setEndDate( '2020-03' );
    $project2->setFocus( 'Papers' );
    $project2->setHomePage( 'www.proj2.com' );
    $project2->setLongTitleE( 'bla bla bla bla bla' );
    $project2->setPartnerCountries( 'Austria, Germany, Italy' );
    $project2->setScopeCountries( 'Austria' );
    $project2->setShortDescriptionE( 'bla2' );
    $project2->setShortTitleE( 'B2' );
    $project2->setStartDate( '2012-02' );
    
    $publication1 = new Publication();
    $publications->addPublication( $publication1 );
    $publication1->setPublDate( '2010-04-01' );
    $publication1->setPublType( PublicationTypeEnum::article() );
    $publication1->setQuotation( 'php forever' );
    $publication1->setShortDescription( 'php introduction' );
    
    $publication2 = new Publication();
    $publications->addPublication( $publication2 );
    $publication2->setPublDate( '2011' );
    $publication2->setPublType( PublicationTypeEnum::book() );
    $publication2->setQuotation( 'Java forever' );
    $publication2->setShortDescription( 'Java for experts' );
    
    $institute1->addExpert( $expert1 );
    $institute1->addExpert( $expert2 );
    $institute2->addExpert( $expert2 );
    
    $institute1->addPublication( $publication1 );
    $institute2->addPublication( $publication1 );
    $institute2->addPublication( $publication2 );
    
    $expert1->addProject( $project1 );
    $expert1->addProject( $project2 );
    $expert2->addProject( $project2 );
    
    return array( $institutes, $experts, $projects, $publications );
  }

  public static function fakeExample2() {

    $institutes = new TheInstitutes();
    $experts = new TheExperts();
    $projects = new TheProjects();
    $publications = new ThePublications();
    
    $institute = new Institute();
    $institutes->addInstitute( $institute );
    $institute->setAbbreviation( 'One' )
      ->setName( 'VIP' )
      ->setCity( 'Vienna' )
      ->setCountryCode( 'AT' )
      ->setDescription( 'Vienna Institute of Psychodynamics' );
    
    $institute = new Institute();
    $institutes->addInstitute( $institute );
    $institute->setAbbreviation( 'Two' )
      ->setName( 'Inst2' )
      ->setURL( 'www.two.at' )
      ->setZipCode( '1010' );
    
    $expert = new Expert();
    $experts->addExpert( $expert );
    $expert->setSurname( 'Meier' )
      ->setFirstnames( 'Hans' )
      ->setEMail( 'Hans@meier.at' )
      ->setEmplURL( 'http://employees.at' )
      ->setInstitute( $institutes->get( 0 ) );
    
    $expert = new Expert();
    $experts->addExpert( $expert );
    $expert->setSurname( 'Huber' )
      ->setFirstnames( 'Andreas' )
      ->setInstitute( $institutes->get( 1 ) );
    
    $project = new Project();
    $projects->addProject( $project );
    $project->setEndDate( '2012-03' )
      ->setFocus( 'abc' )
      ->setHomePage( 'http://project1.com' )
      ->setLongTitleE( 'dsjijdijj idj ij i j' )
      ->setPartnerCountries( 'Germany' )
      ->setScopeCountries( 'Germany, Austria, Switzerland' )
      ->setShortDescriptionE( 'short' )
      ->setShortTitleE( 'short title' )
      ->setStartDate( '2011-01' )
      ->setContactPerson( $experts->get( 0 ) );
    
    $project = new Project();
    $projects->addProject( $project );
    $project->setEndDate( '2012-01' )
      ->setFocus( 'def' )
      ->setHomePage( 'http://project1.com' )
      ->setLongTitleE( 'dsjijdijj idj ij i j' )
      ->setPartnerCountries( 'Germany' )
      ->setScopeCountries( 'Germany, Austria, Switzerland' )
      ->setShortDescriptionE( 'short' )
      ->setShortTitleE( '1111111111111111' )
      ->setStartDate( '2011-01' )
      ->setContactPerson( $experts->get( 1 ) );
    
    $project = new Project();
    $projects->addProject( $project );
    $project->setEndDate( '2012-07' )
      ->setFocus( 'abc' )
      ->setHomePage( 'http://project1.com' )
      ->setLongTitleE( 'dsjijdijj idj ij i j' )
      ->setPartnerCountries( 'Germany' )
      ->setScopeCountries( 'Germany, Austria, Switzerland' )
      ->setShortDescriptionE( 'short' )
      ->setShortTitleE( '2 2 2' )
      ->setStartDate( '2011-02' )
      ->setContactPerson( $experts->get( 1 ) );
    
    $publication = new Publication();
    $projects->addProject( $project );
    $publication->setPublDate( '2011' )
      ->setPublType( PublicationTypeEnum::article() )
      ->setQuotation( 'Whatever whatever' )
      ->setShortDescription( 'Fake publication הצüßי' )
      ->setInstitute( $institutes->get( 0 ) );
    
    return array( $institutes, $experts, $projects, $publications );
  }

}

?>