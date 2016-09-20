<?php

if (!defined('e107_INIT')) {
    exit;
}
//error_reporting(E_ALL);
require_once (e_PLUGIN . "weewx/handlers/weewx_menu_class.php");
if (!is_object($weewx_obj)) {
    $weewx_obj = new weewx_menu;
}

require_once (e_HANDLER . "cache_handler.php");
$weewxcache = new ecache;
$cString = 'nomd5_menu_weewx_current';
$cached = $weewxcache->retrieve($cString, $weewx_obj->prefs['weewx_cupdate'], true, false);
//$cached = false;

if (false === $cached) {

    $menu = $weewx_obj->getCurrent();
    $caption = "Current conditions in " . $weewx_obj->prefs['weewx_location'];
    $cached = $ns->tablerender($caption, $menu, 'weewxcurrent', true);
    $weewxcache->set($cString, $cached, true);
}

echo $cached;
?>
