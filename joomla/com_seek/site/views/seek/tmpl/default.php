<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';


//
for( $i = 0; $i < $this->institutes->size(); $i++ )
{
  $x = $this->institutes->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<div>" . $x->getAbbreviation() . ", " . $x->getName() . ", " . $x->getCountryCode() . ", " . $x->getDescription() . ", " . $x->getURL() . "</div>";
  }
}

//
for( $i = 0; $i < $this->experts->size(); $i++ )
{
  $x = $this->experts->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<div>" . $x->getSurname() . ", " . $x->getFirstnames() . ", " . $x->getExpTitle() . ", " . $x->getEMail() . ", " . $x->getPhoneNumber() . ", " . $x->getSkypeID() . ", " . $x->getExpertise() . ", " . $x->getInstitute() . "</div>";
  }
}

//
for( $i = 0; $i < $this->projects->size(); $i++ )
{
  $x = $this->projects->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<div>" . $x->getShortTitleE() . ", " . $x->getLongTitleE() . ", " . $x->getShortDescriptionE() . ", " . $x->getStartDate() . ", " . $x->getEndDate() . ", " . $x->getHomePage() . ", " . $x->getContactPerson() . "</div>";
  }
}

//
for( $i = 0; $i < $this->publications->size(); $i++ )
{
  $x = $this->publications->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<div>" . $x->getQuotation() . ", " . $x->getPublDate() . ", " . $x->getPublType() . ", " . $x->getInstitute() . "</div>";
  }
}

?>
