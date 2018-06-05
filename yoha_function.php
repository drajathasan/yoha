<?php
/**
 * Yoha function
 *
 * Copyright (C) 2018  Drajat Hasan (drajathasan20@gmail.com)
 * Some code taken and modified from SLiMS default template function.php
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

/* List of icon */
function getIcon($iconName) {
	$icon           = array(
	    'home'           => 'fa fa-home',
	    'bibliography'   => 'fa fa-bookmark',
	    'circulation'    => 'fa fa-clock-o',
	    'membership'     => 'fa fa-user',
	    'master_file'    => 'fa fa-pencil',
	    'stock_take'     => 'fa fa-suitcase',
	    'system'         => 'fa fa-keyboard-o',
	    'reporting'      => 'fa fa-file-text-o',
	    'serial_control' => 'fa fa-barcode',
	    'logout'         => 'fa fa-close',
	    'opac'           => 'fa fa-desktop'
	);

	if (isset($icon[$iconName])) {
		return $icon[$iconName];
	}
	return 'fa fa-align-justify';
}

// Call Module
function getModule() {
	global $dbs;
	$getModule_q = $dbs->query('SELECT module_name, module_path, module_desc FROM mst_module');
	$mod = '';
	$numMod = 0;
	// Checking
	$mod .= '<li><a class="home click" submenu="home" href="#" show="0"><i style="inline-block" class="fa fa-home"></i></a></li>';
	$mod .= '<li><a class="dashboard notAJAX" href="index.php"><i style="inline-block" class="fa fa-dashboard"></i></a></li>';
	$mod .= '<li><a class="opac notAJAX" href="../index.php"><i style="inline-block" class="fa '.getIcon('opac').'"></i> Opac</a></li>';
	if ($getModule_q->num_rows > 0) {
		while($getModule_d = $getModule_q->fetch_assoc()) {
			if (isset($_SESSION['priv'][$getModule_d['module_path']]['r']) && $_SESSION['priv'][$getModule_d['module_path']]['r'] && file_exists('modules'.DS.$getModule_d['module_path'])) {
				$mod .= '<li class="men"><a class="click" submenu="'.$getModule_d['module_name'].'" href="#" show="0"><i style="inline-block" class="fa '.getIcon($getModule_d['module_name']).'"></i> '.ucwords(str_replace('_',' ', $getModule_d['module_name'])).'</a></li>';
			}
		}
		$numMod = $getModule_q->num_rows;
	}
	// Height
	$numMod = ($numMod > 8)?'style="height: 68px;"':NULL;
	// Set Array
	$arrayData = array($numMod, $mod);
	return $arrayData;
}

// Set menu
function yoha_menu() {
	global $dbs;
	// Set query
	$getModule = $dbs->query("SELECT module_name, module_path, module_desc FROM mst_module");
	$array_module = array();
	
	// set Array
	while ($mod = $getModule->fetch_assoc()) {
		$array_module[] = $mod;
	}

	// Chunk
	$array_mod_chunk = array_chunk($array_module, 1);

	// Mod
	$menu = '';
	foreach ($array_mod_chunk as $array_mod) {
		foreach ($array_mod as $module) {
			// Call icon function
			if (isset($_SESSION['priv'][$module['module_path']]['r']) && $_SESSION['priv'][$module['module_path']]['r'] && file_exists('modules'.DS.$module['module_path'])) {
				$menu .= getSubmenu($module['module_path']);
			}
		}
	}
	$menu .= getShortcut();
	return $menu;
}

// Set submenu
function getSubmenu($module_dir) {
	global $dbs;
	require MDLBS.$module_dir."/submenu.php";
	$menu = array_chunk($menu,4);
	$men  = '<div id="sidepan" class="submenu '.$module_dir.'" style="display: none;">';
	// $men .= '<ul class="nav main_menu">';
	$men .= '<table width="100%">';
	$men .= '<tr style="padding: 5px;"><td colspan="4" style="color: white;font-weight: bold;padding: 5px;margin-bottom: 5px;border-bottom: 2px solid white;">Sub menu '.ucwords(str_replace('_',' ', $module_dir)).'</td></tr>';
	foreach ($menu as $value) {
		$men .= '<tr>';
		foreach ($value as $val) {	
			if ($val[0] != 'Header') {
				$men .= '<td style="padding-top: 5px !important;">';
				$men .= '<ul class="sub">';
				$men .= '<li><a class="menu s-current-child" style="text-decoration: none; color: white;" href="'.$val[1].'"><i class="fa fa-align-justify"></i>&nbsp;'.$val[0].'</a></li>';
				$men .= '</ul>';
				$men .= '</td>';
			}
		}
		$men .= '</tr>';
	}
	$men .= '</table>';
	$men .= '</div>';
	return $men;
}

// Set shorcut
function getShortcut()
{
	global $dbs;
	// Query
	$_short_cut_q = $dbs->query('SELECT * FROM setting WHERE setting_name LIKE \'shortcuts_'.$dbs->escape_string($_SESSION['uid']).'\'');
	$_short_cut_d = $_short_cut_q->fetch_assoc();

	// Checking 
	if ($_short_cut_q->num_rows > 0) {
		$shortcuts = unserialize($_short_cut_d['setting_value']);
	}

	// Set Shorcut
	include 'default/submenu.php';
	// Set for user profil
	$user_profil = '';
	if (is_array($menu['user-profile'])) {
		$user_profil = 'u-profil';
	}

	// Checking for zero value
	if ($shortcuts) {
		foreach ($shortcuts as $val) {
		  $path = preg_replace('@^.+?\|/@i', '', $val);
		  $label = preg_replace('@\|.+$@i', '', $val);
		  $menu[] = array($label, MWB.$path, $label);
		}
	}

	$menu = array_chunk($menu,4);
	$men  = '<div id="sidepan" class="submenu home" style="display: none;">';
	// $men .= '<ul class="nav main_menu">';
	$men .= '<table width="100%">';
	$men .= '<tr style="padding: 5px;"><td colspan="4" style="color: white;font-weight: bold;padding: 5px;margin-bottom: 5px;border-bottom: 2px solid white;">Sub menu shortcut</td></tr>';
	foreach ($menu as $value) {
		$men .= '<tr>';
		foreach ($value as $val) {	
			if ($val[0] != 'Header') {
				$men .= '<td style="padding-top: 5px !important;">';
				$men .= '<ul class="sub">';
				$men .= '<li><a class="menu s-current-child '.$user_profil.'" style="text-decoration: none; color: white;" href="'.$val[1].'"><i class="fa fa-align-justify"></i>&nbsp;'.$val[0].'</a></li>';
				$men .= '</ul>';
				$men .= '</td>';
			}
		}
		$user_profil = '';
		$men .= '</tr>';
	}
	$men .= '</table>';
	$men .= '</div>';
	// PrintOut
	return $men;
}

?>
