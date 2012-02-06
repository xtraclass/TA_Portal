<script
	src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
<script>

function showTab( which ) {

	$( "#linki1" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linke1" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linkr1" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linku1" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linke2" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linki2" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linkr2" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
	$( "#linku2" ).hide().removeClass( "currenttab").addClass( "noncurrenttab").hide();
  	
	$( "#divi" ).hide();
	$( "#dive" ).hide();
	$( "#divr" ).hide();
	$( "#divu" ).hide();

  $( "#linki2" ).show();
  $( "#linke2" ).show();
  $( "#linkr2" ).show();
  $( "#linku2" ).show();
  
	$( "#link" + which + "2").hide();
	$( "#link" + which + "1").removeClass( "noncurrenttab").addClass( "currenttab").show();

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
jimport('joomla.application.module.helper');

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
	//border-spacing: 2 !important;
	cellspacing: 0 !important;
	cellpadding: 4 !important;
	height: 2em;
}

.seektr2 {
	//border-spacing: 2 !important;
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
}

.seektdbold {
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

.currenttab {
	background: #FFFFDD;
	font-weight: bold;
  font-size: 150%;
	text-decoration: none;
	padding: 5px;
}

.noncurrenttab
	{
	background: #DDDDDD;
	color: #202020;
	font-style: italic;
	text-decoration: none;
	padding: 5px;
}

.noncurrenttab a:hover
	{
	font-style: normal;
	font-weight: bold;
}

.datasearchform {

	  margin-top: 0.5em;
	  margin-bottom: 2em;
    padding-left: 2em;

    padding-top: 0.3em;
    padding-bottom: 0.1em;

    width: 30em;

    background: -moz-linear-gradient(left, #286e9c, #FFFFFF);
    background: -webkit-gradient(linear, left top, right top, from(#286e9c), to(#FFFFFF));
    filter: progid:DXImageTransform.Microsoft.Gradient(StartColorStr='#286e9c', EndColorStr='#FFFFFF', GradientType=1);
}

.nav {
	  padding-top: 0.3em;
	  padding-bottom: 0.2em;
}

.borderAbove {
	border-top: 1px solid #0c5e96;
}

.borderAboveLightGray {
	border-top: 1px solid #CCCCCC;
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



function rowWithTableForInstitute( Institute $institute, $cols, $break = FALSE )
{
  $columns = $cols - 1;
  
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$columns}' border='0'>\n";
  
  makeDivTableForInstitute( $institute );
  
  if ( $break )
  {
    echo "<br>\n";
  }
  echo "</td></tr>\n";
}



function rowWithTableForExpert( Expert $expert, $cols, $break = FALSE )
{
  echo "<tr style='border-width:0%; border-color:#FFFFFF;' ><td style='border-width:0%; border-color:#FFFFFF;' >&nbsp;</td>\n";
  echo "<td style='border-width:0%; border-color:#FFFFFF;' colspan='{$cols}' border='0'>\n";
  
  makeDivTableForExpert( $expert );
  
  if ( $break )
  {
    echo "<br>\n";
  }
  echo "</td></tr>\n";
}



function makeDivTableForInstitute( Institute $x )
{
  echo "<table cellpadding='2' cellspacing='2'>\n";
  
  echo "<tr valign=top class='borderAboveLightGray'>\n";
  echo "<td class='seektd	borderAboveLightGray' colspan='4'>Belongs to institute:</td>\n";
  echo "</tr>\n";
  
  echo "<tr valign=top>\n";
  echo "<td class='seektdsmall'>Abbr.</td>\n";
  echo "<td class='seektdsmall'>Name</td>\n";
  echo "<td class='seektdsmall'>Country</td>\n";
  echo "<td class='seektdsmall'>Web</td>\n";
  echo "</tr>\n";
  
  echo "<tr valign=top>\n";
  echo "<td class='seektdsmall'>{$x->getAbbreviation()}</div></td>\n";
  echo "<td class='seektdsmall'>{$x->getName()}</td>\n";
  echo "<td class='seektdsmall'>{$x->getCountryCode()}</td>\n";
  echo "<td class='seektdsmall'>" . url( $x->getURL() ) . "</td>\n";
  echo "</tr>\n";
  
  echo "</table>\n";
}



function makeDivTableForExpert( Expert $x )
{
  echo "<table cellpadding='2' cellspacing='2'>\n";
  
  echo "<tr valign=top class='borderAboveLightGray'>\n";
  echo "<td class='seektd borderAboveLightGray' colspan='6'>Contact person:</td>\n";
  echo "</tr>\n";
  
  echo "<tr valign=top>\n";
  echo "<td class='seektdsmall'>Surname</td>";
  echo "<td class='seektdsmall'>First name(s)</td>";
  echo "<td class='seektdsmall'>Title</td>";
  echo "<td class='seektdsmall'>E-Mail</td>";
  echo "<td class='seektdsmall'>Phone number</td>";
  echo "<td class='seektdsmall'>Skype ID</td>";
  echo "</tr>\n";
  
  echo "<tr valign=top>\n";
  echo "<td class='seektdsmall'>" . t( $x->getSurname() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getFirstnames() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getExpTitle() ) . "</td>";
  echo "<td class='seektdsmall'>" . email( $x->getEMail() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getPhoneNumber() ) . "</td>";
  echo "<td class='seektdsmall'>" . t( $x->getSkypeID() ) . "</td>";
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

// ===================================================================
// ===================================================================
// ===================================================================
// ===================================================================


try
{
  $prefix = $_SERVER[ 'SERVER_NAME' ] == 'localhost' ? '/joomla' : '';
  
  
  // ----------------------------------------------------------------------
  $showResultsAndTabs = TRUE;
  
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
  else if ( $kind == 'n' )
  {
    $kind = 'i';
    $showI = FALSE;
    $showE = FALSE;
    $showR = FALSE;
    $showU = FALSE;
    $showResultsAndTabs = FALSE;
  }
  else
  {
    $kind = 'a';
    $showI = TRUE;
    $showE = TRUE;
    $showR = TRUE;
    $showU = TRUE;
  }
  
  
  
  $tab = $_GET[ 'tab' ];
  if ( is_null( $tab ) or $tab == '' or  !( $tab === 'i' or $tab === 'e' or $tab === 'r' or $tab === 'u' ) )
  {
    $tab = 'i';
  }


  
  
  
  
  // ===================================================================
  
  if ( ! $showResultsAndTabs ) 
  {
    echo "<div>\n";
    echo "<p><span style='color: #009aca; font-size: 1.4em;'>Welcome to TA Portal!</span>\n";
    echo "<p><b>TA Portal</b> is the first platform which will function "
    ."as <span style='color: #009aca; font-weight: bold;'>the central TA information and training portal in Europe</span>."
    ."<p><b>TA Portal</b> is an important reference for providing information "
    ."about TA activities in Europe and also the European training system.<br><br>\n";
    echo "</div>\n";
  }
  
  

  echo "<div class='datasearchform'>\n";
  
  echo "<form id='searchForm' name='search_form' action='" . JRoute::_('index.php?option=com_seek') . "' method='get'>\n";
  echo "<input type='text' name='x' id='searchField' value='$reqSearchText' size='30' class='input searchies' />\n";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
  echo "<input id='searchButton' type='submit' value='Search' class='button searchies'/>\n";
  //echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
  //echo "<input type='reset' value='Clear' class='button'/>\n";
  echo "</form>\n";
  
  echo "</div>\n\n\n";
  
  $institutes = $this->institutes->search( $reqSearchText );
  $experts = $this->experts->search( $reqSearchText );
  $projects = $this->projects->search( $reqSearchText );
  $publications = $this->publications->search( $reqSearchText );
  
  $experts->addAllOfArray( $institutes->getAllExperts() );
  $projects->addAllOfArray( $experts->getAllProjects() );
  $publications->addAllOfArray( $institutes->getAllPublications() );
  
  
  
  
  
  
  
  
  
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  // ----------------------------------------------------------------------
  
  if ( $showResultsAndTabs )
  {
    if ( $institutes->size() == 1 )
    {
      $institutesText = 'Institute (1)';
    }
    else 
    {
      $institutesText = ' Institutes (' . $institutes->size() . ')';
    }
    
    if ( $experts->size() == 1 )
    {
      $expertsText = 'Expert (1)';
    }
    else 
    {
      $expertsText = ' Experts (' . $experts->size() . ')';
    }
    
    if ( $projects->size() == 1 )
    {
      $projectsText = 'Project (1)';
    }
    else 
    {
      $projectsText = ' Projects (' . $projects->size() . ')';
    }
    
    if ( $publications->size() == 1 )
    {
      $publicationsText = 'Publication (1)';
    }
    else 
    {
      $publicationsText = ' Publications (' . $publications->size() . ')';
    }
  }
  
  
  echo "<div id='data'>\n";
  
  if ( $showResultsAndTabs )
  {
    echo "<div class='nav'>\n";
    if ( $showI )
    {
      echo "<span class='nav-one'   id='linki1'>&nbsp;&nbsp;{$institutesText}&nbsp;&nbsp;&nbsp;</span>\n";
      echo "<span class='nav-one'   id='linki2'>&nbsp;&nbsp;{$institutesText}&nbsp;&nbsp;&nbsp;</span>\n";
    }
    if ( $showE )
    {
      echo "<span class='nav-two'   id='linke1'>&nbsp;&nbsp;{$expertsText}&nbsp;&nbsp;&nbsp;</span>\n";
      echo "<span class='nav-two'   id='linke2'>&nbsp;&nbsp;{$expertsText}&nbsp;&nbsp;&nbsp;</span>\n";
    }
    if ( $showR )
    {
      echo "<span class='nav-three' id='linkr1'>&nbsp;&nbsp;{$projectsText}&nbsp;&nbsp;&nbsp;</span>\n";
      echo "<span class='nav-three' id='linkr2'>&nbsp;&nbsp;{$projectsText}&nbsp;&nbsp;&nbsp;</span>\n";
    }
    if ( $showU )
    {
      echo "<span class='nav-four'  id='linku1'>&nbsp;&nbsp;{$publicationsText}&nbsp;&nbsp;&nbsp;</span>\n";
      echo "<span class='nav-four'  id='linku2'>&nbsp;&nbsp;{$publicationsText}&nbsp;&nbsp;&nbsp;</span>\n";
    }
    echo "</div>\n"; // nav
  }
  
  
  
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
    
    if ( $institutes->size() >= 1 )
    {
      echo "<tr class='seektrlabels' valign=top>";
      echo "<td class='seektdlabels'>Abbr.</td>";
      echo "<td class='seektdlabels'>Name</td>";
      echo "<td class='seektdlabels'>Country</td>";
      echo "<td class='seektdlabels' width=50%>Description</td>";
      echo "<td class='seektdlabels'>Web</td>";
      echo "</tr>\n";
    }
    
    for( $i = 0; $i < $institutes->size(); $i++ )
    {
      $x = $institutes->get( $i );
      if ( !is_null( $x ) )
      {
        if ( $i % 2 == 1 )
          echo "<tr class='seektr2 borderAbove' valign=top>";
        else
          echo "<tr class='seektr borderAbove' valign=top>";
        echo "<td class='seektd borderAbove'>" . t( $x->getAbbreviation() ) . "</td>";
        echo "<td class='seektdbold borderAbove'>" . t( $x->getName() ) . "<br>&nbsp;</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getCountryCode() ) . "</td>";
        echo "<td class='seektd borderAbove' width=50%>" . t( $x->getDescription() ) . "<br>&nbsp;</td>";
        echo "<td class='seektd borderAbove'>" . url( $x->getURL() ) . "<br>&nbsp;</td>";
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
    
    if ( $experts->size() >= 1 )
    {
      echo "<tr class='seektrlabels' valign=top>";
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
          echo "<tr class='seektr2 borderAbove' valign=top>";
        else
          echo "<tr class='seektr borderAbove' valign=top>";
        echo "<td class='seektdbold borderAbove'>" . t( $x->getSurname() ) . "</td>";
        echo "<td class='seektdbold borderAbove'>" . t( $x->getFirstnames() ) . "</td>";
        echo "<td class='seektdbold borderAbove'>" . t( $x->getExpTitle() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . email( $x->getEMail() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getPhoneNumber() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getSkypeID() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getExpertise() ) . "</td>";
        //echo "<td class='seektd'>" . institute( $x->getInstitute() ) . "</td>";
        echo "</tr>\n";
        rowWithTableForInstitute( $x->getInstitute(), 7, TRUE );
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
    
    if ( $projects->size() >= 1 )
    {
      echo "<tr class='seektrlabels' valign=top>";
      echo "<td class='seektdlabels'>Short Title</td>";
      echo "<td class='seektdlabels'>Long Title</td>";
      echo "<td class='seektdlabels' width=50%>Description</td>";
      echo "<td class='seektdlabels' width=40px>Start</td>";
      echo "<td class='seektdlabels' width=40px>End</td>";
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
          echo "<tr class='seektr2 borderAbove' valign=top>";
        else
          echo "<tr class='seektr borderAbove' valign=top>";
        echo "<td class='seektdbold borderAbove'>" . t( $x->getShortTitleE() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getLongTitleE() ) . "</td>";
        echo "<td class='seektd borderAbove' width=50%>" . t( $x->getShortDescriptionE() ) . "</td>";
        echo "<td class='seektd borderAbove' width=40px>" . t( $x->getStartDate() ) . "</td>";
        echo "<td class='seektd borderAbove' width=40px>" . t( $x->getEndDate() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . url( $x->getHomePage() ) . "</td>";
        //echo "<td class='seektd'>" . expert( $x->getContactPerson() ) . "</td>";
        echo "</tr>\n";
        rowWithTableForExpert( $x->getContactPerson(), 6, FALSE );
        rowWithTableForInstitute( $x->getContactPerson()->getInstitute(), 6, TRUE );
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
    
    if ( $publications->size() >= 1 )
    {
      echo "<tr class='seektrlabels' valign=top>";
      echo "<td class='seektdlabels' width=55px>Publ. Date</td>";
      echo "<td class='seektdlabels'>Quotation</td>";
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
          echo "<tr class='seektr2 borderAbove' valign=top>";
        else
          echo "<tr class='seektr borderAbove' valign=top>";
        echo "<td class='seektd borderAbove' width=55px>" . t( $x->getPublDate() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getQuotation() ) . "</td>";
        echo "<td class='seektd borderAbove'>" . t( $x->getPublType()->value() ) . "</td>";
        //      echo "<td class='seektd'>" . institute( $x->getInstitute() ) . "</td>";
        echo "</tr>\n";
        echo rowWithTableForInstitute( $x->getInstitute(), 3, TRUE );
      }
    }
    echo "</table><br><br>\n";
    echo "</div>\n";
  }
  
  echo "</div>\n"; // data


}
catch ( Exception $x )
{
  echo $x->getTraceAsString();
}


if ( $showResultsAndTabs )
{
  ?><script>
  
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
  </script><?php
}
?>
<script>

setTimeout( function() { $('#searchField').focus(); }, 500 );

</script>
