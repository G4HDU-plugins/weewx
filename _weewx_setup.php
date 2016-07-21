<?php
/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom install/uninstall/update routines for weewx plugin
**
*/

class _weewx_setup
{
	
 	function install_pre($var)
	{
		// print_a($var);
		// echo "custom install 'pre' function<br /><br />";
	}

	/**
	 * For inserting default database content during install after table has been created by the weewx_sql.php file. 
	 */
	function install_post($var)
	{
		$sql = e107::getDb();
		$mes = e107::getMessage();
		
		$e107_weewx = array(
			'weewx_id'				=>'1',
			'weewx_icon'			=>'{e_PLUGIN}_weewx/images/weewx_32.png',
			'weewx_type'			=>'type_1',
			'weewx_name'			=>'My Name',
			'weewx_folder'			=>'Folder Value',
			'weewx_version'			=>'1',
			'weewx_author'			=>'bill',
			'weewx_authorURL'		=>'http://e107.org',
			'weewx_date'			=>'1352871240',
			'weewx_compatibility'	=>'2',
			'weewx_url'				=>'http://e107.org'
		);
		
		if($sql->insert('weewx',$e107_weewx))
		{
			$mes->add("Custom - Install Message.", E_MESSAGE_SUCCESS);
		}
		else
		{
			$mes->add("Custom - Failed to add default table data.", E_MESSAGE_ERROR);	
		}

	}
	
	function uninstall_options()
	{
	
		$listoptions = array(0=>'option 1',1=>'option 2');
		
		$options = array();
		$options['mypref'] = array(
				'label'		=> 'Custom Uninstall Label',
				'preview'	=> 'Preview Area',
				'helpText'	=> 'Custom Help Text',
				'itemList'	=> $listoptions,
				'itemDefault'	=> 1
		);
		
		return $options;
	}
	

	function uninstall_post($var)
	{
		// print_a($var);
	}

	function upgrade_post($var)
	{
		// $sql = e107::getDb();
	}
	
}
?>