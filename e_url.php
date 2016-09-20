<?php

/*
* e107 Bootstrap CMS
*
* Copyright (C) 2008-2015 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
* 
* IMPORTANT: Make sure the redirect script uses the following code to load class2.php: 
* 
* 	if (!defined('e107_INIT'))
* 	{
* 		require_once("../../class2.php");
* 	}
* 
*/

if ( !defined( 'e107_INIT' ) )
{
    exit;
}

// v2.x Standard  - Simple mod-rewrite module.

class weewx_url // plugin-folder + '_url'
{
    function weewx_url(){
        

    }
    function config()
    {
                
        $config = array();
        
		$config['index'] = array(
			'alias'         => 'weewx',
			'regex'			=> '^{alias}/?$', 						// matched against url, and if true, redirected to 'redirect' below.
			'sef'			=> '{alias}', 							// used by e107::url(); to create a url from the db table.
			'redirect'		=> '{e_PLUGIN}weewx/charts.php', 		// file-path of what to load when the regex returns true. 
			
		);
        $config['charts'] = array(
            'alias' => 'weewx', // default alias 'weewx'. {alias} is substituted with this value below. Allows for customization within the admin area.
            'regex' => '^{alias}/charts/?$', // matched against url, and if true, redirected to 'redirect' below.
            'sef' => '{alias}/charts', // used by e107::url(); to create a url from the db table.
            'redirect' => '{e_PLUGIN}weewx/charts.php', // file-path of what to load when the regex returns true.

            );


        $config['data'] = array(
            'alias' => 'weewx', // default alias 'weewx'. {alias} is substituted with this value below. Allows for customization within the admin area.
            'regex' => '^{alias}/data/?$', // matched against url, and if true, redirected to 'redirect' below.
            'sef' => '{alias}/data', // used by e107::url(); to create a url from the db table.
            'redirect' => '{e_PLUGIN}weewx/data.php', // file-path of what to load when the regex returns true.

            );
        $config['records'] = array(
            'alias' => 'weewx', // default alias 'weewx'. {alias} is substituted with this value below. Allows for customization within the admin area.
            'regex' => '^{alias}/records/?$', // matched against url, and if true, redirected to 'redirect' below.
            'sef' => '{alias}/records', // used by e107::url(); to create a url from the db table.
            'redirect' => '{e_PLUGIN}weewx/records.php', // file-path of what to load when the regex returns true.

            );
        return $config;
    }


}
