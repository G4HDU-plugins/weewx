<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Guestbook for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2011
   |
   |		Licenced for the use of the purchaser only. This is not free
   |		software.
   |
   +---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}


if ( !is_object( $weewx_obj ) ) {
    require_once( 'handlers/weewx_data_class.php' );
    $weewx_obj = new weewx_data;
}


$textOut=$weewx_obj->processMain();

if ( $textOut !== null ) {
	require_once( HEADERF );
	$ns->tablerender( LAN_PLUGIN_WEEWX_MAIN, $textOut );
	require_once( FOOTERF );
}
?>