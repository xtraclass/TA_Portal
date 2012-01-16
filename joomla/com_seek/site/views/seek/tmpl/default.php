<style> 
<!--

.seektable {
	border-width: 0;
	border-color: #FFFFFF;
  cellspacing: 0 ! important;
  cellpadding: 4 ! important;
}

.seektr {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
  cellspacing: 0 ! important;
  cellpadding: 4 ! important;
}

.seektr2 {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
  cellspacing: 0 ! important;
  cellpadding: 4 ! important;
  background-color: #F6F6FF;	
}

.seektd {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
  cellspacing: 0 ! important;
  cellpadding: 4 ! important;
}

.seektdhead {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
  cellspacing: 0 ! important;
  cellpadding: 4 ! important;
  background-color: #FFFFE0;	
	font-weight: bold;
}

-->
</style>    
<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';

//
//
//
echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";

if ( $this->institutes->size() >= 2 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='5'>" . $this->institutes->size() . " institutes</td>";
  echo "</tr>";
}
else if ( $this->institutes->size() == 1 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='5'>1 institute</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->institutes->size(); $i++ )
{
  $x = $this->institutes->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1) echo "<tr class='seektr2'>";
    else echo "<tr class='seektr'>";
    echo "<td class='seektd'>" . t( $x->getAbbreviation() ) . "</td>";
    echo "<td class='seektd'><b>" . t( $x->getName() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getCountryCode() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getDescription() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getURL() ) . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";

if ( $this->experts->size() >= 2 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='8'>" . $this->experts->size() . " experts</td>";
  echo "</tr>";
}
else if ( $this->experts->size() == 1 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='8'>1 expert</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->experts->size(); $i++ )
{
  $x = $this->experts->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1) echo "<tr class='seektr2'>";
    else echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getSurname() ) . "</b></td>";
    echo "<td class='seektd'><b>" . t( $x->getFirstnames() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getExpTitle() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getEMail() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getPhoneNumber() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getSkypeID() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getExpertise() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getInstitute() ) . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";

if ( $this->projects->size() >= 2 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='7'>" . $this->projects->size() . " projects</td>";
  echo "</tr>";
}
else if ( $this->projects->size() == 1 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='7'>1 project</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->projects->size(); $i++ )
{
  $x = $this->projects->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1) echo "<tr class='seektr2'>";
    else echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getShortTitleE() ) . "</b></td>";
    echo "<td class='seektd'><b>" . t( $x->getLongTitleE() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getShortDescriptionE() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getStartDate() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getEndDate() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getHomePage() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getContactPerson() ) . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

//
//
//
echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";

if ( $this->publications->size() >= 2 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='4'>" . $this->publications->size() . " publications</td>";
  echo "</tr>";
}
else if ( $this->publications->size() == 1 )
{
  echo "<tr class='seektr'>";
  echo "<td class='seektdhead' colspan='4'>1 publication</td>";
  echo "</tr>";
}

for( $i = 0; $i < $this->publications->size(); $i++ )
{
  $x = $this->publications->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1) echo "<tr class='seektr2'>";
    else echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getQuotation() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getPublDate() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getPublType() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getInstitute() ) . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";

function t( $value ) 
{
  if ( is_null( $value ) ) 
  {
    return '&nbsp;';
  }
  else 
  {
    return $value;
  }
}

?>
