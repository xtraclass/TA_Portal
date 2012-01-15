<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';

//
//
//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";

if ( $this->institutes->size() >= 2 )
{
  echo "<tr>";
  echo "<td colspan='5'>" . $this->institutes->size() . " institutes</td>";
  echo "</tr>";
}
else if ( $this->institutes->size() == 1 )
{
  echo "<tr>";
  echo "<td colspan='5'>1 institute</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->institutes->size(); $i++ )
{
  $x = $this->institutes->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<tr>";
    echo "<td>" . $x->getAbbreviation() . "</td>";
    echo "<td><b>" . $x->getName() . "</b></td>";
    echo "<td>" . $x->getCountryCode() . "</td>";
    echo "<td>" . $x->getDescription() . "</td>";
    echo "<td>" . $x->getURL() . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";

if ( $this->experts->size() >= 2 )
{
  echo "<tr>";
  echo "<td colspan='5'>" . $this->experts->size() . " experts</td>";
  echo "</tr>";
}
else if ( $this->experts->size() == 1 )
{
  echo "<tr>";
  echo "<td colspan='5'>1 expert</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->experts->size(); $i++ )
{
  $x = $this->experts->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<tr>";
    echo "<td><b>" . $x->getSurname() . "</b></td>";
    echo "<td><b>" . $x->getFirstnames() . "</b></td>";
    echo "<td>" . $x->getExpTitle() . "</td>";
    echo "<td>" . $x->getEMail() . "</td>";
    echo "<td>" . $x->getPhoneNumber() . "</td>";
    echo "<td>" . $x->getSkypeID() . "</td>";
    echo "<td>" . $x->getExpertise() . "</td>";
    echo "<td>" . $x->getInstitute() . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";

if ( $this->projects->size() >= 2 )
{
  echo "<tr>";
  echo "<td colspan='5'>" . $this->projects->size() . " projects</td>";
  echo "</tr>";
}
else if ( $this->projects->size() == 1 )
{
  echo "<tr>";
  echo "<td colspan='5'>1 project</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->projects->size(); $i++ )
{
  $x = $this->projects->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<tr>";
    echo "<td><b>" . $x->getShortTitleE() . "</b></td>";
    echo "<td><b>" . $x->getLongTitleE() . "</b></td>";
    echo "<td>" . $x->getShortDescriptionE() . "</td>";
    echo "<td>" . $x->getStartDate() . "</td>";
    echo "<td>" . $x->getEndDate() . "</td>";
    echo "<td>" . $x->getHomePage() . "</td>";
    echo "<td>" . $x->getContactPerson() . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";

if ( $this->publications->size() >= 2 )
{
  echo "<tr>";
  echo "<td colspan='5'>" . $this->publications->size() . " publications</td>";
  echo "</tr>";
}
else if ( $this->publications->size() == 1 )
{
  echo "<tr>";
  echo "<td colspan='5'>1 publication</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->publications->size(); $i++ )
{
  $x = $this->publications->get( $i );
  if ( !is_null( $x ) )
  {
    echo "<tr>";
    echo "<td><b>" . $x->getQuotation() . "</b></td>";
    echo "<td>" . $x->getPublDate() . "</td>";
    echo "<td>" . $x->getPublType() . "</td>";
    echo "<td>" . $x->getInstitute() . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

?>
