<?php

require_once 'taportal/tests/_Classes.php';

/**
 * JSONBuilder test case.
 */
class JSONBuilderTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {

    parent::setUp();
    
    $this->JSONBuilder = new JSONBuilder();
    
    $this->institute = new Institute();
    $this->institute->setName( 'The Wow' );
    $this->institute->setAbbreviation( 'WOW' );
  }

  protected function tearDown() {

    $this->JSONBuilder = null;
    parent::tearDown();
  }

  public function __construct() {

  }

  public function testBuildExpertAsJSON() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( '' );
    $expert->setPhoneNumber( '' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","E":"john@smith.com","P":"","D":"ARGL999","X":"","L":"http://theemployess/myurl","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
    
    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","P":"456 789 0","D":"ARGL999","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
    
    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","P":"456 789 0","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
    
    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","E":"john@smith.com","P":"456 789 0","D":"ARGL999","L":"http://theemployess/myurl","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
  
  }

  public function testCompleteExpert() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","E":"john@smith.com","P":"456 789 0","D":"ARGL999","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
  }

  public function testExpertWithTAPublicationURL() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","P":"456 789 0","D":"ARGL999","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"},"U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
  }

  public function testExpertWithTAProjectURL() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","P":"456 789 0","D":"ARGL999","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"},"J":"http://www.xxx.aaa"}]}' );
  }

  public function testExpertWithSkypeID() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","P":"456 789 0","D":"ARGL999","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"}}]}' );
  }

  public function testExpertWithPhoneNumber() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $expert->setPhoneNumber( '456 789 0' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","P":"456 789 0","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"}}]}' );
  }

  public function testExpertWithExpertise() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setExpertise( 'This is an expertise.' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","X":"This is an expertise.","L":"http://theemployess/myurl","I":{"E":"WOW"}}]}' );
  }

  public function testExpertWithEmplURL() {

    $expert = new Expert();
    $expert = $expert->setSurname( 'Surname' )
      ->setFirstnames( 'A B Cde' )
      ->setEMail( 'john@smith.com' )
      ->setEmplURL( 'http://theemployess/myurl' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","L":"http://theemployess/myurl","I":{"E":"WOW"}}]}' );
  }

  public function testExpertWithEMail() {

    $expert = new Expert();
    $expert = $expert->setSurname( 'Surname' )
      ->setFirstnames( 'A B Cde' )
      ->setEMail( 'john@smith.com' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","E":"john@smith.com","I":{"E":"WOW"}}]}' );
  }

  public function testExpertWithFirstnames() {

    $expert = new Expert();
    $expert = $expert->setSurname( 'Surname' )->setFirstnames( 'A B Cde' );
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","I":{"E":"WOW"}}]}' );
  }

  /**
   * @expectedException Exception
   */
  public function testNullExpert() {

    $expert = NULL;
    $this->institute->setExpert( $expert );
    $this->checkExpert( $expert, '' );
  }

  public function testExpertWithoutInstitute() {

    $expert = new Expert();
    $expert->setSurname( 'Surname' );
    $expert->setFirstnames( 'A B Cde' );
    $expert->setEMail( 'john@smith.com' );
    $expert->setEmplURL( 'http://theemployess/myurl' );
    $expert->setPhoneNumber( '456 789 0' );
    $expert->setSkypeID( 'ARGL999' );
    $expert->setTAProjectURL( 'http://www.xxx.aaa' );
    $expert->setTAPublicationURL( 'http://www.publications.com/123' );
    $expert->setExpTitle( 'director' );
    $this->checkExpert( $expert, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"E":[{"S":"Surname","F":"A B Cde","T":"director","E":"john@smith.com","P":"456 789 0","D":"ARGL999","L":"http://theemployess/myurl","U":"http://www.publications.com/123","J":"http://www.xxx.aaa"}]}' );
  }

  private function checkExpert( Expert $expert, $expected ) {

    $experts = new TheExperts();
    $experts->addExpert( $expert );
    
    $json = $this->JSONBuilder->build( NULL, $experts, NULL, NULL );
    
    echo "checkExpert:\nexpe:\t{$expected}\njson:\t\t{$json}\n\n";
    
    $this->assertNotNull( $json );
    $this->assertTrue( $json == $expected );
  }

  public function testCompleteInstitute() {

    $institute = new Institute();
    $institute->setAbbreviation( 'IA' );
    $institute->setCity( 'Vienna' );
    $institute->setCountryCode( 'AT' );
    $institute->setDescription( 'Test institute' );
    $institute->setName( 'I.A.A.I.' );
    $institute->setStreet( 'XStreet 1' );
    $institute->setURL( 'www.aaa.com' );
    $institute->setZipCode( '1111' );
    
    $this->checkInstitute( $institute, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"I":[{"E":"IA","N":"I.A.A.I.","O":"AT","Z":"1111","C":"Vienna","S":"XStreet 1","D":"Test institute","U":"www.aaa.com"}]}' );
  }

  private function checkInstitute( Institute $institute, $expected ) {

    $institutes = new TheInstitutes();
    $institutes->addInstitute( $institute );
    
    $json = $this->JSONBuilder->build( $institutes, NULL, NULL, NULL );
    
    echo "checkInstitute:\nexpe:\t{$expected}\njson:\t\t{$json}\n\n";
    
    $this->assertNotNull( $json );
    $this->assertTrue( $json == $expected );
  }

  public function testCompletePublication() {

    $publication = new Publication();
    $publication->setPublDate( '2000' );
    $publication->setPublType( PublicationTypeEnum::book() );
    $publication->setQuotation( 'Groovy in Action' );
    $publication->setShortDescription( 'Programming language Groovy' );
    
    $this->checkPublication( $publication, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"U":[{"Q":"Groovy in Action","D":"2000","S":"Programming language Groovy","T":"book"}]}' );
  }

  private function checkPublication( Publication $publication, $expected ) {

    $publications = new ThePublications();
    $publications->addPublication( $publication );
    
    $json = $this->JSONBuilder->build( NULL, NULL, NULL, $publications );
    
    echo "checkPublication:\nexpe:\t{$expected}\njson:\t\t{$json}\n\n";
    
    $this->assertNotNull( $json );
    $this->assertTrue( $json == $expected );
  }

  public function testCompleteProject() {

    $project = new Project();
    $project->setEndDate( '2014-04' );
    $project->setFocus( 'Psychology<>&"' );
    $project->setHomePage( 'www.psy.com' );
    $project->setLongTitleE( 'PPP' );
    $project->setPartnerCountries( 'Austria, Germany' );
    $project->setScopeCountries( 'Austria, Germany, Italy' );
    $project->setShortDescriptionE( 'psy' );
    $project->setShortTitleE( 'psy' );
    $project->setStartDate( '2012-01' );
    
    $this->checkProject( $project, '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"R":[{"S":"psy","L":"PPP","D":"psy","T":"2012-01","N":"2014-04","Y":"Austria, Germany","Z":"Austria, Germany, Italy","H":"www.psy.com","U":"Psychology<>&\""}]}' );
  }

  private function checkProject( Project $project, $expected ) {

    $projects = new TheProjects();
    $projects->addProject( $project );
    
    $json = $this->JSONBuilder->build( NULL, NULL, $projects, NULL );
    
    echo "checkProject:\nexpe:\t{$expected}\njson:\t\t{$json}\n\n";
    
    $this->assertNotNull( $json );
    $this->assertTrue( $json == $expected );
  }

  public function testExample1() {

    list( $institutes, $experts, $projects, $publications ) = FakedEntitiesMaker::fakeExample1();
    
    $json = JSONBuilder::build( $institutes, $experts, $projects, $publications );
    $expectedJSON = '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"I":[{"E":"A","N":"IA","O":"AT","Z":"1010","C":"Vienna","S":"Küniglbergstraße 10","D":"A test institute","U":"www.ia.at"},{"E":"B","N":"BBB","O":"AT","Z":"1020","C":"Vienna","S":"MAriahilferstr. 2","D":"A||||second||||test||||institute","U":"www.bbb.at"}],"E":[{"S":"Huber","F":"Michael","T":"director","E":"expert1@w.com","P":"123123","D":"123","X":"Java, JavaScript","L":"www.e1.com","I":{"E":"A"},"U":"www.yyy.at","J":"www.xxx.at"},{"S":"Meier","F":"Andreas","T":"director","E":"expert2@w.com","P":"444222222","D":"222","X":"php","L":"www.e2.com","I":{"E":"B"},"U":"www.222.at/2","J":"www.222.at"}],"R":[{"S":"B1","L":"bla bla bla","D":"bla","T":"2011-01","N":"2014-12","Y":"Austria","Z":"Austria, Germany","O":{"S":"Huber","F":"Michael"},"H":"www.proj1.com","U":"Books"},{"S":"B2","L":"bla bla bla bla bla","D":"bla2","T":"2012-02","N":"2020-03","Y":"Austria, Germany, Italy","Z":"Austria","O":{"S":"Meier","F":"Andreas"},"H":"www.proj2.com","U":"Papers"}],"U":[{"Q":"php forever","D":"2010-04-01","S":"php introduction","T":"article","I":{"E":"B"}},{"Q":"Java forever","D":"2011","S":"Java for experts","T":"book","I":{"E":"B"}}]}';
    
    echo 'testExample1: j ' . $json . "\n";
    echo 'testExample1: e ' . $expectedJSON . "\n";
    
    $this->assertSame( $expectedJSON, $json );
  }

  public function testExample2() {

    list( $institutes, $experts, $projects, $publications ) = FakedEntitiesMaker::fakeExample2();
    
    $json = JSONBuilder::build( $institutes, $experts, $projects, $publications );
    $expectedJSON = '{"V":' . DataFormatSpecificationConstants::SPECIFICATION_VERSION . ',"I":[{"E":"One","N":"VIP","O":"AT","C":"Vienna","D":"Vienna Institute of Psychodynamics"},{"E":"Two","N":"Inst2","Z":"1010","U":"www.two.at"}],"E":[{"S":"Meier","F":"Hans","E":"Hans@meier.at","L":"http://employees.at","I":{"E":"One"}},{"S":"Huber","F":"Andreas","I":{"E":"Two"}}],"R":[{"S":"short title","L":"dsjijdijj idj ij i j","D":"short","T":"2011-01","N":"2012-03","Y":"Germany","Z":"Germany, Austria, Switzerland","O":{"S":"Meier","F":"Hans"},"H":"http://project1.com","U":"abc"},{"S":"1111111111111111","L":"dsjijdijj idj ij i j","D":"short","T":"2011-01","N":"2012-01","Y":"Germany","Z":"Germany, Austria, Switzerland","O":{"S":"Huber","F":"Andreas"},"H":"http://project1.com","U":"def"},{"S":"2 2 2","L":"dsjijdijj idj ij i j","D":"short","T":"2011-02","N":"2012-07","Y":"Germany","Z":"Germany, Austria, Switzerland","O":{"S":"Huber","F":"Andreas"},"H":"http://project1.com","U":"abc"}]}';
    
    echo 'testExample2: j ' . $json . "\n";
    echo 'testExample2: e ' . $expectedJSON . "\n";
    
    $this->assertSame( $expectedJSON, $json );
  }

  private $JSONBuilder;

  private $institute;

}

