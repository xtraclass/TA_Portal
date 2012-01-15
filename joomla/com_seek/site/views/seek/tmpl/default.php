<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';

//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";
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
echo "</table>\n";

//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";
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
echo "</table>\n";

//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";
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
echo "</table>\n";

//
echo "<table border='0' cellpadding='1' cellspacing='1'>\n";
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
echo "</table>\n";

?>
