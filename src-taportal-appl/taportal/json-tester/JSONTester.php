<?php

error_reporting( E_ERROR );

require_once 'taportal/harvester/_Classes.php';
require_once 'Zend/Json.php';

/**
 * This is used on the web page where institutes can test ob their
 * JSON output is valid.
 */
class JSONTester
{



  /**
   * Main entry of this validator or tester.
   */
  public static function validate()
  {
    try
    {
      $tester = new JSONTester();
      return $tester->test()->asHTML();
    }
    catch ( Exception $x )
    {
      $this->logger->log( NULL, $x );
      return '';
    }
  }



  /**
   * This does all the work, i. e. reads JSON data
   * and converts them to objects.
   */
  private function test()
  {
    try
    {
      $this->logger = Logger::getLoggerForHTMLOutput();
      $objectBuilder = new ObjectBuilder( $this->logger );
    }
    catch ( Exception $x )
    {
      $this->logger->log( NULL, $x );
      return $this;
    }
    
    try
    {
      $jsonObject = $this->readJSON();
    }
    catch ( Exception $x )
    {
      $this->logger->log( NULL, $x );
      return $this;
    }
    
    try
    {
      if ( !is_null( $jsonObject ) )
      {
        list( $institutes, $experts, $projects, $publications ) = $objectBuilder->build( $jsonObject );
      }
    }
    catch ( Exception $x )
    {
      $this->logger->log( NULL, $x );
    }
    
    return $this;
  }



  /**
   * This returns the logger messages as HTML output.
   */
  private function asHTML()
  {
    return $this->logger->getMessagesIfAnyAsHTML();
  }



  /**
   * This reads JSON data: either from a URL, given as a GET request parameter with name 'url',
   * or directly from a POST request parameter with name 'json'; and returns them.
   */
  private function readJSON()
  {
    $jsonObject = NULL;
    
    //$_GET[ 'url' ] = 'http://technology-assessment.info/demo/taportal/institutes/webservice/111';
    if ( !isset( $_GET[ 'url' ] ) or is_null( $_GET[ 'url' ] ) or $_GET[ 'url' ] === '' )
    {
      //$_POST[ 'json' ] = '{"V":8,"I":[{"E1":"A","N2":"IA","O3":"AT","Z":"1010","C":"Vienna","S":"Küniglbergstraße 10","D":"A test institute","U":"www.ia.at"},{"E":"B","N":"BBB","O":"AT","Z":"1020","C":"Vienna","S":"MAriahilferstr. 2","D":"A||||second||||test||||institute","U":"www.bbb.at"}],"E":[{"S":"Huber","F":"Michael","T":"director","E":"expert1@w.com","P":"123123","D":"123","X":"Java, JavaScript","L":"www.e1.com","I":{"E":"A"},"U":"www.yyy.at","J":"www.xxx.at"},{"S":"Meier","F":"Andreas","T":"director","E":"expert2@w.com","P":"444222222","D":"222","X":"php","L":"www.e2.com","I":{"E":"B"},"U":"www.222.at/2","J":"www.222.at"}],"R":[{"S":"B1","L":"bla bla bla","D":"bla","T":"2011-01","N":"2014-12","Y":"Austria","Z":"Austria, Germany","O":{"S":"Huber","F":"Michael"},"H":"www.proj1.com","U":"Books"},{"S":"B2","L":"bla bla bla bla bla","D":"bla2","T":"2012-02","N":"2020-03","Y":"Austria, Germany, Italy","Z":"Austria","O":{"S":"Meier","F":"Andreas"},"H":"www.proj2.com","U":"Papers"}],"U":[{"Q":"php forever","D":"2010-04-01","S":"php introduction","T":"article","I":{"E":"B"}},{"Q":"Java forever","D":"2011","S":"Java for experts","T":"book","I":{"E":"B"}}]}';
      if ( !isset( $_POST[ 'json' ] ) or is_null( $_POST[ 'json' ] ) or $_POST[ 'json' ] === '' )
      {
        $this->logger->log( '<br><br>Please define either a GET request parameter with the name &quot;url&quot; which ' . /***/
        'points to a page on your web site which generates JSON output,<br>or define a POST parameter with the ' . /***/
        'name &quot;json&quot; and some JSON text as input.' );
      }
      else
      {
        $jsonObject = json_decode( utf8_encode( $_POST[ 'json' ] ) );
      }
    }
    else
    {
      $contents = file_get_contents( $_GET[ 'url' ] );
      if ( $contents === FALSE )
      {
        $this->logger->log( "Cannot read contents of web page at " . $_GET[ 'url' ] );
      }
      else
      {
        $jsonObject = json_decode( utf8_encode( $contents ) );
      }
    }
    
    return $jsonObject;
  }

  private $logger;

}

?>