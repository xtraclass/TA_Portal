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
	height: 2em;
}

.seektr2 {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
	background-color: #F6F6FF;
	height: 2em;
}

.seektrlabels {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
	background-color: #F6F6FF;
	height: 2.5em;
	font-weight: bold;
	color: #0c5e96;
}

.seektd {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
}

.seektdlabels {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
	font-weight: bold;
}

.seektdhead {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
	background-color: #FFFFE0;
	font-weight: bold;
	height: 3em;
}
-->
</style><?php

$prefix = $_SERVER[ 'SERVER_NAME' ] == 'localhost' ? '/joomla' : '';

?>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script
	src="<?php
echo $prefix;
?>/media/media/js/jquery.colorbox-min.js"></script>
<link rel="stylesheet"
	href="<?php
echo $prefix;
?>/media/media/css/colorbox.css" />



<p><a class='inline' href="#inline_content">Inline HTML</a></p>
<div style='display: none'>
<div id='inline_content' style='padding: 10px; background: #FFFFEE;'>
<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej


<p>jefd jsöjfös djfj pwi4ejfh ksdjöc ejf089euw ifjlkösdj öklsjf ösjd
fiowej

</div>
</div>



<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';

// Counter for DIVs with additional information which are shown by colorbox/lightbox/jQuery
$lightbox = 0;

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

if ( $this->institutes->size() >= 1 )
{
  echo "<tr class='seektrlabels'>";
  echo "<td class='seektdlabels'>Abbr.</td>";
  echo "<td class='seektdlabels'>Name</td>";
  echo "<td class='seektdlabels'>Country</td>";
  echo "<td class='seektdlabels'>Description</td>";
  echo "<td class='seektdlabels'>Web</td>";
  echo "</tr>\n";
}

for( $i = 0; $i < $this->institutes->size(); $i++ )
{
  $x = $this->institutes->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1 )
      echo "<tr class='seektr2'>";
    else
      echo "<tr class='seektr'>";
    echo "<td class='seektd'>" . t( $x->getAbbreviation() ) . "</td>";
    echo "<td class='seektd'><b>" . t( $x->getName() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getCountryCode() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getDescription() ) . "</td>";
    echo "<td class='seektd'>" . url( $x->getURL() ) . "</td>";
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

if ( $this->experts->size() >= 1 )
{
  echo "<tr class='seektrlabels'>";
  echo "<td class='seektdlabels'>Surname</td>";
  echo "<td class='seektdlabels'>First name(s)</td>";
  echo "<td class='seektdlabels'>Title</td>";
  echo "<td class='seektdlabels'>E-Mail</td>";
  echo "<td class='seektdlabels'>Phone number</td>";
  echo "<td class='seektdlabels'>Skype ID</td>";
  echo "<td class='seektdlabels'>Expertise</td>";
  echo "<td class='seektdlabels'>Institute</td>";
  echo "</tr>\n";
}

for( $i = 0; $i < $this->experts->size(); $i++ )
{
  $x = $this->experts->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1 )
      echo "<tr class='seektr2'>";
    else
      echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getSurname() ) . "</b></td>";
    echo "<td class='seektd'><b>" . t( $x->getFirstnames() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getExpTitle() ) . "</td>";
    echo "<td class='seektd'>" . email( $x->getEMail() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getPhoneNumber() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getSkypeID() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getExpertise() ) . "</td>";
    echo "<td class='seektd'>" . institute( $x->getInstitute() ) . "</td>";
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

if ( $this->projects->size() >= 1 )
{
  echo "<tr class='seektrlabels'>";
  echo "<td class='seektdlabels'>Short Title</td>";
  echo "<td class='seektdlabels'>Long Title</td>";
  echo "<td class='seektdlabels'>Description</td>";
  echo "<td class='seektdlabels'>Start</td>";
  echo "<td class='seektdlabels'>End</td>";
  echo "<td class='seektdlabels'>Home Page</td>";
  echo "<td class='seektdlabels'>Contact Person</td>";
  echo "</tr>\n";
}

for( $i = 0; $i < $this->projects->size(); $i++ )
{
  $x = $this->projects->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1 )
      echo "<tr class='seektr2'>";
    else
      echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getShortTitleE() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getLongTitleE() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getShortDescriptionE() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getStartDate() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getEndDate() ) . "</td>";
    echo "<td class='seektd'>" . url( $x->getHomePage() ) . "</td>";
    echo "<td class='seektd'>" . expert( $x->getContactPerson() ) . "</td>";
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

if ( $this->publications->size() >= 1 )
{
  echo "<tr class='seektrlabels'>";
  echo "<td class='seektdlabels'>Quotation</td>";
  echo "<td class='seektdlabels'>Publ. Date</td>";
  echo "<td class='seektdlabels'>Type</td>";
  echo "<td class='seektdlabels'>Institute</td>";
  echo "</tr>\n";
}

for( $i = 0; $i < $this->publications->size(); $i++ )
{
  $x = $this->publications->get( $i );
  if ( !is_null( $x ) )
  {
    if ( $i % 2 == 1 )
      echo "<tr class='seektr2'>";
    else
      echo "<tr class='seektr'>";
    echo "<td class='seektd'><b>" . t( $x->getQuotation() ) . "</b></td>";
    echo "<td class='seektd'>" . t( $x->getPublDate() ) . "</td>";
    echo "<td class='seektd'>" . t( $x->getPublType()->value() ) . "</td>";
    echo "<td class='seektd'>" . institute( $x->getInstitute(), &$lightbox ) . "</td>";
    echo "</tr>\n";
  }
}
echo "</table><br><br>\n";



function institute( Institute $institute, $lightbox )
{
  return lightboxForInstitute( $institute, $lightbox );
}



function expert( Expert $expert )
{
  return $expert->getSurname();
}



function email( $email )
{
  if ( is_null( $email ) )
  {
    return '&nbsp;';
  }
  else
  {
    $short = shortenEmail( $email );
    return "<a href='mailto:$short'>$short</a>";
  }
}



function shortenEmail( $email )
{
  $max = 25;
  
  if ( strlen( $email ) > $max )
  {
    return substr( $email, 0, $max );
  }
  return $email;
}



function url( $url )
{
  if ( is_null( $url ) )
  {
    return '&nbsp;';
  }
  else
  {
    $short = shortenURL( $url );
    return "<a href='http://$short' target='TA2'>$short</a>";
  }
}



function shortenURL( $url )
{
  $pos = strpos( $url, "http://" );
  if ( $pos === 0 )
  {
    $url2 = substr( $url, 7 );
  }
  else
  {
    $url2 = $url;
  }
  
  $max = 25;
  
  if ( strlen( $url2 ) > $max )
  {
    return substr( $url2, 0, $max );
  }
  return $url2;
}



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



function lightboxForInstitute( $institute, &$lightbox )
{
  if ( is_null( $institute ) )
  {
    return '&nbsp;';
  }
  else
  {
    $html = '<a class="lightboxlink' . $lightbox . '" href="#lightboxdiv' . $lightbox . '">' . $institute->getAbbreviation() . '</a>';
    $html = $html . divForInstitute( $institute, $lightbox );
    $lightbox++;
    return $html;
  }
}



function divForInstitute( $institute, $lightbox )
{
  if ( is_null( $institute ) )
  {
    return '';
  }
  else
  {
    $html = "<div style='display:none'>" . /***/
    "<div id='lightboxdiv" . $lightbox . "' style='padding:10px; background:#FFFFEE;'>" . /***/
    '<p>' . $institute->getName() . /***/
    "</div>" . /***/
    "</div>";
    
    return $html;
  }
}

?>
<script>
	$( function() {
  	try {
  		$(".lightboxlink0").colorbox( { inline:true, width:'70%', opacity:'50%' } );
  		$(".lightboxlink1").colorbox( { inline:true, width:'70%', opacity:'50%' } );
  		$(".lightboxlink2").colorbox( { inline:true, width:'70%', opacity:'50%' } );
  	}
  	catch ( error ) {
  		alert( "Error: " + error );
  	}
	} );
</script>