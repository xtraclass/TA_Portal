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
	font-weight: bold;
}

.seektdsmall {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 ! important;
	cellspacing: 0 ! important;
	cellpadding: 4 ! important;
	font-size: 80%;
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



function rowWithTableForInstitute( Institute $institute, $cols )
{
  $columns = $cols - 1;
  
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$columns}' border='0'>\n";
  
  makeDivTableForInstitute( $institute );
  
  echo "</td></tr>\n";
  
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$columns}' border='0'>\n";
  echo "</td></tr>\n";
}



function rowWithTableForExpert( Expert $expert, $cols )
{
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$cols}' border='0'>\n";
  
  makeDivTableForExpert( $expert );
  
  echo "</td></tr>\n";
  
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$cols}' border='0'>\n";
  echo "</td></tr>\n";
}



function makeDivTableForInstitute( Institute $x )
{
  echo "<table style='border-width:0%; border-color:#FFFFFF;'' width='100%' cellpadding='2' cellspacing='2'>\n";
  
  echo "<tr>\n";
  echo "<td class='seektdsmall' colspan='5'>Belongs to institute:</td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "<td class='seektdsmall'>Abbr.</td>\n";
  echo "<td class='seektdsmall'>Name</td>\n";
  echo "<td class='seektdsmall'>Country</td>\n";
  echo "<td class='seektdsmall'>Description</td>\n";
  echo "<td class='seektdsmall'>Web</td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "<td class='seektdsmall'>{$x->getAbbreviation()}</div></td>\n";
  echo "<td class='seektdsmall'>{$x->getName()}</td>\n";
  echo "<td class='seektdsmall'>{$x->getCountryCode()}</td>\n";
  echo "<td class='seektdsmall'>{$x->getDescription()}</td>\n";
  echo "<td class='seektdsmall'>{$x->getURL()}</td>\n";
  echo "</tr>\n";
  
  echo "</table>\n";
}



function makeDivTableForExpert( Expert $x )
{
  echo "<table style='border-width:0%; border-color:#FFFFFF;'' width='100%' cellpadding='2' cellspacing='2'>\n";
 
  echo "<tr>\n";
  echo "<td class='seektdsmall' colspan='7'>Contact person:</td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "<td class='seektdsmall'>Surname</td>";
  echo "<td class='seektdsmall'>First name(s)</td>";
  echo "<td class='seektdsmall'>Title</td>";
  echo "<td class='seektdsmall'>E-Mail</td>";
  echo "<td class='seektdsmall'>Phone number</td>";
  echo "<td class='seektdsmall'>Skype ID</td>";
  echo "<td class='seektdsmall'>Expertise</td>";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "<td class='seektdsmall'>" . t( $x->getSurname() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getFirstnames() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getExpTitle() ) . "</td>";
  echo "<td class='seektdsmall'>" . email( $x->getEMail() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getPhoneNumber() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getSkypeID() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getExpertise() ) . "</td>";
  echo "</tr>\n";
  
  echo "</table>\n";
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
  $pos = strpos( $url, "
  http: //" );
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

// ===================================================================
// ===================================================================
// ===================================================================
// ===================================================================


try
{
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




<?php
  // No direct access to this file
  defined( '_JEXEC' ) or die( 'Restricted access' );
  require_once 'taportal/harvester/_Classes.php';
  
  // ----------------------------------------------------------------------
  // Counter for DIVs with additional information which are shown by colorbox/lightbox/jQuery
  //$lightbox = 0;
  

  // ----------------------------------------------------------------------
  $kind = $_GET[ 'kind' ];
  if ( is_null( $kind ) or $kind == '' or $kind == 'a' )
  {
    $showI = TRUE;
    $showE = TRUE;
    $showR = TRUE;
    $showU = TRUE;
  }
  else if ( $kind == 'i' )
  {
    $showI = TRUE;
    $showE = FALSE;
    $showR = FALSE;
    $showU = FALSE;
  }
  else if ( $kind == 'e' )
  {
    $showI = FALSE;
    $showE = TRUE;
    $showR = FALSE;
    $showU = FALSE;
  }
  else if ( $kind == 'r' )
  {
    $showI = FALSE;
    $showE = FALSE;
    $showR = TRUE;
    $showU = FALSE;
  }
  else if ( $kind == 'u' )
  {
    $showI = FALSE;
    $showE = FALSE;
    $showR = FALSE;
    $showU = TRUE;
  }
  
  // ----------------------------------------------------------------------
  //
  //
  //
  if ( $showI )
  {
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
        echo "<td class='seektd'>" . t( $x->getName() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getCountryCode() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getDescription() ) . "</td>";
        echo "<td class='seektd'>" . url( $x->getURL() ) . "</td>";
        echo "</tr>\n";
      }
    }
    echo "</table><br><br>\n";
  }
  
  //
  //
  //
  if ( $showE )
  {
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $this->experts->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='7'>" . $this->experts->size() . " experts</td>";
      echo "</tr>";
    }
    else if ( $this->experts->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='7'>1 expert</td>";
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
      //echo "<td class='seektdlabels'>Institute</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $this->experts->size(); $i++ )
    {
      $x = $this->experts->get( $i );
      if ( !is_null( $x ) )
      {
        if ( $i % 1 == 0 )
          echo "<tr class='seektr2'>";
        else
          echo "<tr class='seektr'>";
        echo "<td class='seektd'>" . t( $x->getSurname() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getFirstnames() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getExpTitle() ) . "</td>";
        echo "<td class='seektd'>" . email( $x->getEMail() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getPhoneNumber() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getSkypeID() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getExpertise() ) . "</td>";
        //echo "<td class='seektd'>" . institute( $x->getInstitute() ) . "</td>";
        echo "</tr>\n";
        rowWithTableForInstitute( $x->getInstitute(), 7 );
      }
    }
    echo "</table><br><br>\n";
  }
  
  //
  //
  //
  if ( $showR )
  {
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $this->projects->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='6'>" . $this->projects->size() . " projects</td>";
      echo "</tr>";
    }
    else if ( $this->projects->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='6'>1 project</td>";
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
      //echo "<td class='seektdlabels'>Contact Person</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $this->projects->size(); $i++ )
    {
      $x = $this->projects->get( $i );
      if ( !is_null( $x ) )
      {
        if ( $i % 1 == 0 )
          echo "<tr class='seektr2'>";
        else
          echo "<tr class='seektr'>";
        echo "<td class='seektd'>" . t( $x->getShortTitleE() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getLongTitleE() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getShortDescriptionE() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getStartDate() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getEndDate() ) . "</td>";
        echo "<td class='seektd'>" . url( $x->getHomePage() ) . "</td>";
        //echo "<td class='seektd'>" . expert( $x->getContactPerson() ) . "</td>";
        echo "</tr>\n";
        rowWithTableForExpert( $x->getContactPerson(), 6 );
      }
    }
    echo "</table><br><br>\n";
  }
  
  //
  //
  //
  if ( $showU )
  {
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $this->publications->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='3'>" . $this->publications->size() . " publications</td>";
      echo "</tr>";
    }
    else if ( $this->publications->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='3'>1 publication</td>";
      echo "</tr>";
    }
    
    if ( $this->publications->size() >= 1 )
    {
      echo "<tr class='seektrlabels'>";
      echo "<td class='seektdlabels'>Quotation</td>";
      echo "<td class='seektdlabels'>Publ. Date</td>";
      echo "<td class='seektdlabels'>Type</td>";
      //echo "<td class='seektdlabels'>Institute</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $this->publications->size(); $i++ )
    {
      $x = $this->publications->get( $i );
      if ( !is_null( $x ) )
      {
        if ( $i % 1 == 0 )
          echo "<tr class='seektr2'>";
        else
          echo "<tr class='seektr'>";
        echo "<td class='seektd'>" . t( $x->getQuotation() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getPublDate() ) . "</td>";
        echo "<td class='seektd'>" . t( $x->getPublType()->value() ) . "</td>";
        //      echo "<td class='seektd'>" . institute( $x->getInstitute() ) . "</td>";
        echo "</tr>\n";
        echo rowWithTableForInstitute( $x->getInstitute(), 3 );
      }
    }
    echo "</table><br><br>\n";
  }

  //function institute( Institute $institute/*, $lightbox */)
//{
//  return lightboxForInstitute( $institute, $lightbox );
//}


//function lightboxForInstitute( $institute, &$lightbox )
//{
//  if ( is_null( $institute ) )
//  {
//    return '&nbsp;';
//  }
//  else
//  {
//    $html = '<a class="lightboxlink' . $lightbox . '" href="#lightboxdiv' . $lightbox . '">' . $institute->getAbbreviation() . '</a>';
//    $html = $html . lightboxDivForInstitute( $institute, $lightbox );
//    $lightbox++;
//    return $html;
//  }
//}


//function lightboxDivForInstitute( $institute, $lightbox )
//{
//  if ( is_null( $institute ) )
//  {
//    return '';
//  }
//  else
//  {
//    $html = "<div style='display:none'>" . /***/
//    "<div id='lightboxdiv" . $lightbox . "' style='font-size:90%, padding:10px; background:#E0E0E0; border-width:2px; border-style:solid; border-color:#000000;'>" . /***/
//    '<table border="1" width="100%" cellpadding="2" cellspacing="2">' . /***/
//    '<tr>' . /***/
//    '<td valign="top" colspan="2"><div style="text-align:center;text-weight:bold;">' . 'Institute' . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Abbreviation' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getAbbreviation() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Name' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getName() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Country Code' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getCountryCode() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Zip Code' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getZipCode() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'City' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getCity() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Street' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getStreet() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'Description' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getDescription() . '</div></td>' . /***/
//    '</tr>' . /***/
//    '<tr>' . /***/
//    '<td valign="top"><div style="text-align:right;">' . 'URL' . '</div></td>' . /***/
//    '<td valign="top"><div style="text-align:left;">' . $institute->getURL() . '</div></td>' . /***/
//    '</tr>' . /***/
//    "</table>" . /***/
//    "</div>" . /***/
//    "</div>";
//    
//    return $html;
//  }
//}


/*
<script>
	$( function() {
  	try {
  		$(".lightboxlink0").colorbox( { inline:true, width:'80%', opacity:'10%' } );
  		$(".lightboxlink1").colorbox( { inline:true, width:'80%', opacity:'10%' } );
  		$(".lightboxlink2").colorbox( { inline:true, width:'80%', opacity:'10%' } );
  	}
  	catch ( error ) {
  		alert( "Error: " + error );
  	}
	} );
</script>
*/

}
catch ( Exception $x )
{
  echo $x->getTraceAsString();
}
?>