<?php

/**
 * G4HDU WeeWX Menu plugin
 *
 * Copyright (C) 2008-2016 Barry Keal G4HDU http://e107.keal.me.uk
 * blankd under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * @author Barry Keal e107@keal.me.uk>
 * @copyright Copyright (C) 2008-2016 Barry Keal G4HDU
 * @license GPL
 * @version 1.0.0
 *
 * @todo
 */


// ***************************************************************
// *
// *		Plugin		:	Weewx Menu (e107 v2)
// *
// ***************************************************************
require_once ("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
e107::lan('weewx', 'admin', true);
//require_once ("e_version.php");
/**
 * plugin_weewx_admin
 * 
 * @package   
 * @author Weewx
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class plugin_weewx_admin extends e_admin_dispatcher
{
    protected $modes = array('main' => array(
            'controller' => 'plugin_weewx_admin_ui',
            'path' => null,
            'ui' => 'plugin_weewx_admin_form_ui',
            'uipath' => null));

    /**
     *
     * @var array
     */
    protected $adminMenu = array('main/prefs' => array('caption' => 'Settings',
                'perm' => '0'));

    /**
     * Optional, mode/action aliases, related with 'selected' menu CSS class
     * Format: 'MODE/ACTION' => 'MODE ALIAS/ACTION ALIAS';
     * This will mark active main/list menu item, when current page is main/edit
     * @var array
     */
    protected $adminMenuAliases = array('main/edit' => 'main/list');

    /**
     * Navigation menu title
     * @var string
     */
    protected $menuTitle = LAN_PLUGIN_WEEWX_ADMIN_NAME;
}


/**
 * plugin_weewx_admin_ui
 * 
 * @package   
 * @author Weewx
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class plugin_weewx_admin_ui extends e_admin_ui
{

    protected $pluginTitle = LAN_PLUGIN_WEEWX_ADMIN_NAME;

    /**
     * plugin name
     *
     * @var string
     */
    protected $pluginName = 'weewx';
    /**
     * Array containing a list of tabs to be displayed on the page
     *
     * @var array of strings
     * @since 1.0.0
     *
     */
    protected $preftabs = array(
        0 => LAN_PLUGIN_WEEWX_ADMIN_TAB0,
        1 => LAN_PLUGIN_WEEWX_ADMIN_TAB1,
        2 => LAN_PLUGIN_WEEWX_ADMIN_TAB2,
        3 => LAN_PLUGIN_WEEWX_ADMIN_TAB3,
        4 => LAN_PLUGIN_WEEWX_ADMIN_TAB4
        );

    protected $prefs = array(
        'weewx_cupdate' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_CUPDATE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_CUPDATE_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 30, 'min' => 1),
            ),
        'weewx_showtemp' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_TEMP,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_TEMP_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showhum' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_HUM,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_HUM_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showfeels' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FEELS,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FEELS_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showwind' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_WIND,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_WIND_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showdirn' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_DIRN,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_DIRN_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showbaro' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_BARO,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_BARO_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showrain' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_RAIN,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_RAIN_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showuv' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_UV,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_UV_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_wdpath' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_WDPATH,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_WDPATH_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_chartpath' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_DATAPATH,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_DATAPATH_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_noaapath' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_NOAAPATH,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_NOAAPATH_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            ),            
        /*
        'weewx_numdue' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_WDPATH,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_WDPATH_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            'writeParms' => array('max' => 20, 'min' => 1)),
            
        'weewx_dformat' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FORMAT,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FORMAT_HELP,
            'tab' => 0,
            'type' => 'dropdown',
            'data' => 'int',
            'writeParms' => array(
                '0' => LAN_PLUGIN_WEEWX_ADMIN_FORMAT_LONG,
                '1' => LAN_PLUGIN_WEEWX_ADMIN_FORMAT_SHORT)),

        'weewx_showAge' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_AGE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_AGE_HELP,
            'tab' => 3,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_linkUser' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_LINK,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_LINK_HELP,
            'tab' => 3,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_sendEmail' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_EMAIL,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_EMAIL_HELP,
            'tab' => 3,
            'type' => 'boolean',
            'data' => 'int'),
            */
        'weewx_fupdate' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FUPDATE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FUPDATE_HELP,
            'tab' => 2,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 1440, 'min' => 30),
            ),
        'weewx_apikey' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FORECASTAPIKEY,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FORECASTAPIKEY_HELP,
            'tab' => 2,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_location' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_LOCATION_NAME,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_LOCATION_NAME_HELP,
            'tab' => 2,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_fLatitude' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FLATITUDE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FLATITUDE_HELP,
            'tab' => 2,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_fLongitude' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FLONGITUDE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FLONGITUDE_HELP,
            'tab' => 2,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_flocalStation' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FSTATION,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FSTATION_HELP,
            'tab' => 2,
            'type' => 'text',
            'data' => 'str',
            ),
        'weewx_aupdate' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_AUPDATE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_AUPDATE_HELP,
            'tab' => 3,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 1440, 'min' => 60)
            ),
            'weewx_floodupdate' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_FLOOD_UPDATE,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_FLOOD_UPDATE_HELP,
            'tab' => 4,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 60, 'min' => 10)
            ),
            /*
        'weewx_usecss' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_CSS,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_CSS_HELP,
            'tab' => 3,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_showAvatar' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_AVATAR,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_AVATAR_HELP,
            'tab' => 3,
            'type' => 'boolean',
            'data' => 'int'),
        'weewx_avwidth' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_WIDTH,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_WIDTH_HELP,
            'tab' => 3,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('min' => '1', 'max' => '20')),

        'weewx_greeting' => array(
            'title' => LAN_PLUGIN_WEEWX_ADMIN_CONTENT,
            'help' => LAN_PLUGIN_WEEWX_ADMIN_CONTENT_HELP,
            'tab' => 3,
            'type' => 'textarea',
            'data' => 'str',
            )
        */
            );

}

new plugin_weewx_admin();

require_once (e_ADMIN . "auth.php");
e107::getAdminUI()->runPage(); // Send page content
require_once (e_ADMIN . "footer.php");


/**
 * e_help()
 * 
 * @return
 */

function e_help()
{
   // $helpArray = e_version::genUpdate('weewx');
  //  return $helpArray;
}

?>