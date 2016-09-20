<?php

/*
* e107 website system
*
* Copyright (C) 2008-2014 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Related configuration module - News
*
*
*/

if ( !defined( 'e107_INIT' ) )
{
    exit;
}


if ( USER_AREA ) // do not include JS in the admin area.
{
    e107::js( 'weewx', 'js/weewx.js' ); // loads e107_plugins/weewx/js/weewx.js
    e107::css( 'weewx', 'css/weewx.css' );
}

?>