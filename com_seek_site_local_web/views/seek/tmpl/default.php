<link rel="stylesheet" href="organictabs.css">
<script
	src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
<script>

function showTab( which ) {

	$( "#linki1" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linke1" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linkr1" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linku1" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linke2" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linki2" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linkr2" ).hide().removeClass( "current").addClass( "noncurrent").hide();
	$( "#linku2" ).hide().removeClass( "current").addClass( "noncurrent").hide();
  	
	$( "#divi" ).hide();
	$( "#dive" ).hide();
	$( "#divr" ).hide();
	$( "#divu" ).hide();

  $( "#linki2" ).show();
  $( "#linke2" ).show();
  $( "#linkr2" ).show();
  $( "#linku2" ).show();
  
	$( "#link" + which + "2").hide();
	$( "#link" + which + "1").removeClass( "noncurrent").addClass( "current").show();

	$( "#div" + which ).fadeIn();
}

function changeCursorToLink() {
	$(this).css('cursor','pointer');
}

function changeCursorToAuto() {
  $(this).css('cursor','auto');
}
</script>
<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'taportal/harvester/_Classes.php';

$reqSearchText = $_GET[ 'x' ];
if ( isset( $reqSearchText ) )
{
  $reqSearchText = strtolower( $reqSearchText );
}

$showResultsWanted = isset( $reqSearchText );

//echo "<p>reqSearchText = $reqSearchText, showResultsWanted = $showResultsWanted\n";

?><style>
<!--
.seektable {
	border-width: 0;
	border-color: #FFFFFF;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
}

.seektr {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	height: 2em;
}

.seektr2 {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	background-color: #F6F6FF;
	height: 2em;
}

.seektrlabels {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	background-color: #F6F6FF;
	height: 2.5em;
	font-weight: bold;
	color: #0c5e96;
}

.seektd {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	font-weight: bold;
}

.seektdsmall {
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	font-size: 80%;
}

.seektdlabels {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	font-weight: bold;
}

.seektdhead {
	border-width: 0;
	border-color: #FFFFFF;
	border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	background-color: #FFFFE0;
	font-weight: bold;
	height: 3em;
}

#linki a,#linke a,#linkr a,#linku a {
	text-decoration: none;
}

.current {
	background: #FFFFDD;
	font-weight: bold;
  font-size: 150%;
	text-decoration: none;
}

.noncurrent
	{
	background: #DDDDDD;
	text-decoration: none;
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
  
  // ===================================================================
  

  echo "<blockquote>\n";
  
  echo "<form name='search_form' action='" . JRoute::_('index.php?option=com_seek') . "' method='get'>\n";
  echo "<input type='text' name='x' value='$reqSearchText' size='30' class='input ' />\n";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
  echo "<input type='submit' value='Submit' class='button'/>\n";
  //echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
  //echo "<input type='reset' value='Clear' class='button'/>\n";
  echo "</form>\n";
  echo "<br><br>\n";
  
  echo "</blockquote>\n\n\n";
  
  $institutes = $this->institutes->search( $reqSearchText );
  $experts = $this->experts->search( $reqSearchText );
  $projects = $this->projects->search( $reqSearchText );
  $publications = $this->publications->search( $reqSearchText );
  
  if ( $institutes->isEmpty() and $experts->isEmpty() and $projects->isEmpty() and $publications->isEmpty() )
  {
    echo "<p>No data found.\n";
  }
  
  // ----------------------------------------------------------------------
  $kind = $_GET[ 'kind' ];
  if ( is_null( $kind ) or $kind == '' )
  {
    $kind = 'a';
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
  else
  {
    $kind = 'a';
    $showI = TRUE;
    $showE = TRUE;
    $showR = TRUE;
    $showU = TRUE;
  }
  echo "<H3>showI $showI showE $showE showR $showR showU $showU</h3>";
  
  
  $tab = $_GET[ 'tab' ];
  if ( is_null( $tab ) or $tab == '' or  !( $tab === 'i' or $tab === 'e' or $tab === 'r' or $tab === 'u' ) )
  {
    $tab = 'i';
  }
  
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  
  echo "<div id='data>\n";
  
  echo "<div class='nav'>\n";
  if ( $showI )
  {
    echo "<span class='nav-one'   id='linki1'>Institutes&nbsp;</span>\n";
    echo "<span class='nav-one'   id='linki2'>Institutes&nbsp;</span>\n";
  }
  if ( $showE )
  {
    echo "<span class='nav-two'   id='linke1'>Experts&nbsp;</span>\n";
    echo "<span class='nav-two'   id='linke2'>Experts&nbsp;</span>\n";
  }
  if ( $showR )
  {
    echo "<span class='nav-three' id='linkr1'>Projects&nbsp;</span>\n";
    echo "<span class='nav-three' id='linkr2'>Projects&nbsp;</span>\n";
  }
  if ( $showU )
  {
    echo "<span class='nav-four'  id='linku1'>Publications&nbsp;</span>\n";
    echo "<span class='nav-four'  id='linku2'>Publications&nbsp;</span>\n";
  }
  echo "</div>\n";
  
  echo "<div class='list-wrap'>\n";

  
  
  
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  //
  //
  //
  if ( $showI )
  {
    echo "<div id='divi'>\n";
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $institutes->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='5'>" . $institutes->size() . " institutes</td>";
      echo "</tr>";
    }
    else if ( $institutes->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='5'>1 institute</td>";
      echo "</tr>";
    }
    
    if ( $institutes->size() >= 1 )
    {
      echo "<tr class='seektrlabels'>";
      echo "<td class='seektdlabels'>Abbr.</td>";
      echo "<td class='seektdlabels'>Name</td>";
      echo "<td class='seektdlabels'>Country</td>";
      echo "<td class='seektdlabels'>Description</td>";
      echo "<td class='seektdlabels'>Web</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $institutes->size(); $i++ )
    {
      $x = $institutes->get( $i );
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
    echo "</div>\n";
  }
  
  //
  //
  //
  if ( $showE )
  {
    echo "<div id='dive'>\n";
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $experts->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='7'>" . $experts->size() . " experts</td>";
      echo "</tr>";
    }
    else if ( $experts->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='7'>1 expert</td>";
      echo "</tr>";
    }
    
    if ( $experts->size() >= 1 )
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
    
    for( $i = 0; $i < $experts->size(); $i++ )
    {
      $x = $experts->get( $i );
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
    echo "</div>\n";
  }
  
  //
  //
  //
  if ( $showR )
  {
    echo "<div id='divr'>\n";
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $projects->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='6'>" . $projects->size() . " projects</td>";
      echo "</tr>";
    }
    else if ( $projects->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='6'>1 project</td>";
      echo "</tr>";
    }
    
    if ( $projects->size() >= 1 )
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
    
    for( $i = 0; $i < $projects->size(); $i++ )
    {
      $x = $projects->get( $i );
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
    echo "</div>\n";
  }
  
  //
  //
  //
  if ( $showU )
  {
    echo "<div id='divu'>\n";
    echo "<table class='seektable' border='0' cellpadding='1' cellspacing='1' width='100%'>\n";
    
    if ( $publications->size() >= 2 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='3'>" . $publications->size() . " publications</td>";
      echo "</tr>";
    }
    else if ( $publications->size() == 1 )
    {
      echo "<tr class='seektr'>";
      echo "<td class='seektdhead' colspan='3'>1 publication</td>";
      echo "</tr>";
    }
    
    if ( $publications->size() >= 1 )
    {
      echo "<tr class='seektrlabels'>";
      echo "<td class='seektdlabels'>Quotation</td>";
      echo "<td class='seektdlabels'>Publ. Date</td>";
      echo "<td class='seektdlabels'>Type</td>";
      //echo "<td class='seektdlabels'>Institute</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $publications->size(); $i++ )
    {
      $x = $publications->get( $i );
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
    echo "</div>\n";
  }
  
  echo "</div>\n"; // list-wrap
  echo "</div>\n"; // data


}
catch ( Exception $x )
{
  echo $x->getTraceAsString();
}


?>
<script>

$( "#linki1" ).click( function() { showTab( "i" )} );
$( "#linke1" ).click( function() { showTab( "e" )} );
$( "#linkr1" ).click( function() { showTab( "r" )} );
$( "#linku1" ).click( function() { showTab( "u" )} );
$( "#linki2" ).click( function() { showTab( "i" )} );
$( "#linke2" ).click( function() { showTab( "e" )} );
$( "#linkr2" ).click( function() { showTab( "r" )} );
$( "#linku2" ).click( function() { showTab( "u" )} );

$( "#linki1" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linki2" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linke1" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linke2" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linkr1" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linkr2" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linku1" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );
$( "#linku2" ).hover( function() { changeCursorToLink(); }, function() { changeCursorToAuto(); } );

showTab( "<?php echo $tab; ?>" );
</script>