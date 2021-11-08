<?php
/**
* @version		$Id: mod_flexheader3.php 2015 Andre Hotzler $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2016 Andre Hotzler. All rights reserved.
* @license		GNU/GPL, see license_gpl.txt
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die;


//Vars

$user = JFactory::getUser();
if (!$user->guest) {
	$fl_userisguest = '0';
} else {
	$fl_userisguest = '1';
}
$fl_namederintemid = trim( $params->get( 'name_of_itemid' ) );
$fl_namederparentid = trim( $params->get( 'name_of_parent' ) );
$fl_namedercategory  = trim( $params->get( 'name_of_category' ) );
$fl_namederparentcategory = trim( $params->get( 'name_of_parentcategory' ) );
$fl_module_id = "moduleid".$module->id;
$fl_module_title = $module->title;
$fl_showebugtoguest = trim( $params->get( 'showebugtoguest' ) );
$jinput = JFactory::getApplication()->input;
$fl_component =  $jinput->get('option');
$fl_cversion = trim( $params->get( 'cversion' ) );
$fl_folder_location	= trim( $params->get( 'folder_location' ) );
$fl_folder_name = trim( $params->get( 'folder_name' ) );
$fl_default_image = trim( $params->get( 'default_image' ) );
$fl_file_type = '.'.trim( $params->get( 'file_type' ) );
$fl_height = trim( $params->get( 'height' ) );
$fl_width = trim( $params->get( 'width' ) );
$fl_specifydimensions = trim( $params->get( 'specifydimensions' ) );
$fl_addborderzerotoimage = trim( $params->get( 'addborderzerotoimage' ) );
$fl_dimensionstype = trim( $params->get( 'dimensionstype' ) );
if ($params->get( 'css_class')) {
	$fl_css_class = trim( $params->get( 'css_class' ) );}
	else { $fl_css_class = ""; };;
$fl_debug_opac = trim( $params->get( 'debug_opac' ) );
$fl_debug_position = trim( $params->get( 'debug_position' ) );
$fl_debug_color = trim( $params->get( 'debug_bg_color' ) );
if ($params->get( 'debug') == "no") {
		$fl_dev_debug = "";
		$fl_debug = "";
	} elseif ($params->get( 'debug') == "normal") {
		$fl_dev_debug = "";
		$fl_debug = "1";
	} elseif ($params->get( 'debug') == "dev") {
		$fl_dev_debug = "1";
		$fl_debug = "1";};
$fl_display_type = trim( $params->get( 'display_type' ) );
if ($fl_display_type == "swf") {
$fl_file_type ='.swf'; };
if ($params->get( 'div_content' )) {
	$fl_div_content= trim( $params->get( 'div_content' ) ); }
	else { $fl_div_content= ""; };
$fl_document = JFactory::getDocument();
$fl_pagetitle = $fl_document->getTitle();
$flalttexttype = ( $params->get( 'alt_text_type' ) );
if ( $flalttexttype  == "pagetitle" ) {
	$fl_alt_text = $fl_pagetitle ;
} elseif ( $flalttexttype  == "owntext" ) {
		if ($params->get( 'alt_text' )) {
			$fl_alt_text= trim($params->get( 'alt_text' )); }
		else { $fl_alt_text= ""; };
	} else { $fl_alt_text= ""; };
		
$fl_jfsupport = trim( $params->get( 'jfsupport' ) );

$fl_jflang = "";
if ($fl_jfsupport) { 
	$lang = JFactory::getLanguage();
 $fl_jflang = "-".$lang->getTag();
}


$fl_template = $app->getTemplate();

$fl_view = trim($jinput->get('view', 0));
if ($fl_view=='article' || $fl_view=='contact') {
	if (intval($jinput->get('id', 0) )) {
		
		$fl_id = '-id'.intval($jinput->get('id', 0) );
		}
	else {
		$fl_id ="";
	};
}
else {
		$fl_id ="";
	};

$fl_itemid = $fl_namederintemid.intval($jinput->get('Itemid', 0) );
if ($jinput->get('catid', 0)) {
$fl_catid = intval($jinput->get('catid', 0) ); }
	else { $fl_catid = ""; };
$fl_layout = trim($jinput->get('layout', 0) );
$fl_webdirname = JURI::base($pathonly=true).'/';
$fl_jroot = JPATH_ROOT.'/';
$lf_linksupport = $params->get( 'linksupport' );
$fl_cssfilesupport = $params->get( 'cssfilesupport' );
$fl_linktarget = trim( $params->get( 'linktarget' ) );
$fl_vmartsupport = trim( $params->get( 'vmartsupport' ) );
$help_menu = JFactory::getApplication()->getMenu();
$active_help = $help_menu->getActive();
if (is_object($active_help)) {
	$fl_parentmenu = intval($active_help->parent_id);
	$fl_parentid = $fl_namederparentid.$fl_parentmenu ;
} else {
        $fl_parentid = JText::_("FLNOPARENT");
}
if (isset($fl_parentmenu)) {
if ($fl_parentmenu=='1') {
	        $fl_parentid = JText::_("FLNOPARENT");
	      }
		  }
		
//combined vars    

//Category and parentcategory
$input=JFactory::getApplication()->input;
$categoryid = JText::_("FLNOCATEGORY");
$parentcategoryid = JText::_("FLNOPARENTCATEGORY");
$content_id = $input->getInt( 'id', 0);
$database = JFactory::getDBO();
if($fl_view=='article') {
	$query = "SELECT catid FROM #__content WHERE id=".(int)$content_id;
	$database->setQuery($query);
	$row = $database->loadObject();
	$category = $row->catid;
	$categoryid = $fl_namedercategory.$category;
	$query = "SELECT parent_id FROM #__categories WHERE id=".(int)$category ;
	$database->setQuery($query);
	$row = $database->loadObject();
	$parentcategory = $row->parent_id;
	if ($parentcategory=='1') {
		$parentcategoryid = JText::_("FLNOPARENTCATEGORY");		
	}
	else {
		$parentcategoryid = $fl_namederparentcategory.$parentcategory;
	}
}
if($fl_view=='category') {
	$category = $input->getInt( 'id', 0  );
	$categoryid = $fl_namedercategory.$category;
	$query = "SELECT parent_id FROM #__categories WHERE id=".(int)$category;
	$database->setQuery($query);
	$row = $database->loadObject();
	if (isset($row->parent_id)) {
	$parentcategory = $row->parent_id;
	
	if ($parentcategory=='1') {
		$parentcategoryid = JText::_("FLNOPARENTCATEGORY");		
	}
	else {
		$parentcategoryid = $fl_namederparentcategory.$parentcategory;
	}
	} else {
		$parentcategory = '0';
	}
};



//image location
if ($fl_folder_location=='images') {
	$fl_rl_folder_location = 'images/'; 
	} elseif 	($fl_folder_location=='template') {
	$fl_rl_folder_location = 'templates/'.$fl_template.'/';
	} elseif 	($fl_folder_location=='root') {
	$fl_rl_folder_location = ''; 
	}
$fl_fs_image_location = $fl_jroot.$fl_rl_folder_location.$fl_folder_name.'/';
$fl_web_image_location = $fl_webdirname.$fl_rl_folder_location.$fl_folder_name.'/';

//build a name from type of view and ids

	
	$fl_image_default_name = $fl_default_image; 
	$fl_fs_image_default_name = $fl_fs_image_location.$fl_image_default_name.$fl_jflang.$fl_file_type;
	$fl_web_image_default_name = $fl_web_image_location.$fl_image_default_name.$fl_jflang.$fl_file_type;
	$fl_fs_css_default_name = $fl_fs_image_location.$fl_image_default_name.$fl_jflang.'.css';
	$fl_web_css_default_name = $fl_web_image_location.$fl_image_default_name.$fl_jflang.'.css';
	
	$fl_image_content_name = $fl_itemid; 
	$fl_fs_image_content_name = $fl_fs_image_location.$fl_image_content_name.$fl_jflang.$fl_file_type;
	$fl_web_image_content_name = $fl_web_image_location.$fl_image_content_name.$fl_jflang.$fl_file_type;
	$fl_fs_css_content_name = $fl_fs_image_location.$fl_image_content_name.$fl_jflang.'.css';
	$fl_web_css_content_name = $fl_web_image_location.$fl_image_content_name.$fl_jflang.'.css';	

	$fl_image_parent_name = $fl_parentid;
	$fl_fs_image_parent_name = $fl_fs_image_location.$fl_image_parent_name.$fl_jflang.$fl_file_type;
	$fl_web_image_parent_name = $fl_web_image_location.$fl_image_parent_name.$fl_jflang.$fl_file_type; 	
	$fl_fs_css_parent_name = $fl_fs_image_location.$fl_image_parent_name.$fl_jflang.'.css';
	$fl_web_css_parent_name = $fl_web_image_location.$fl_image_parent_name.$fl_jflang.'.css'; 	
	
	$fl_image_contentmenu_name = $fl_itemid.$fl_id;
	$fl_fs_image_contentmenu_name = $fl_fs_image_location.$fl_image_contentmenu_name.$fl_jflang.$fl_file_type;
	$fl_web_image_contentmenu_name = $fl_web_image_location.$fl_image_contentmenu_name.$fl_jflang.$fl_file_type;
	$fl_fs_css_contentmenu_name = $fl_fs_image_location.$fl_image_contentmenu_name.$fl_jflang.'.css';
	$fl_web_css_contentmenu_name = $fl_web_image_location.$fl_image_contentmenu_name.$fl_jflang.'.css';	
	
	$fl_image_category_name = $categoryid;
	$fl_fs_image_category_name = $fl_fs_image_location.$fl_image_category_name.$fl_jflang.$fl_file_type;
	$fl_web_image_category_name = $fl_web_image_location.$fl_image_category_name.$fl_jflang.$fl_file_type;
	$fl_fs_css_category_name = $fl_fs_image_location.$fl_image_category_name.$fl_jflang.'.css';
	$fl_web_css_category_name = $fl_web_image_location.$fl_image_category_name.$fl_jflang.'.css';	
	
	$fl_image_parentcategory_name = $parentcategoryid;
	$fl_fs_image_parentcategory_name = $fl_fs_image_location.$fl_image_parentcategory_name.$fl_jflang.$fl_file_type;
	$fl_web_image_parentcategory_name = $fl_web_image_location.$fl_image_parentcategory_name.$fl_jflang.$fl_file_type;
	$fl_fs_css_parentcategory_name = $fl_fs_image_location.$fl_image_parentcategory_name.$fl_jflang.'.css';
	$fl_web_css_parentcategory_name = $fl_web_image_location.$fl_image_parentcategory_name.$fl_jflang.'.css';
	
	$fl_image_component_name = $fl_component;
	$fl_fs_image_component_name = $fl_fs_image_location.$fl_image_component_name.$fl_jflang.$fl_file_type;
	$fl_web_image_component_name = $fl_web_image_location.$fl_image_component_name.$fl_jflang.$fl_file_type;	
	$fl_fs_css_component_name = $fl_fs_image_location.$fl_image_component_name.$fl_jflang.'.css';
	$fl_web_css_component_name = $fl_web_image_location.$fl_image_component_name.$fl_jflang.'.css';	
		
//Find image file
if (file_exists($fl_fs_image_contentmenu_name)) {
	$fl_web_output_image = $fl_web_image_contentmenu_name;
	$fl_output_image = $fl_image_contentmenu_name;
	}
elseif (file_exists($fl_fs_image_content_name))	{
	$fl_web_output_image = $fl_web_image_content_name;
	$fl_output_image = $fl_image_content_name;
	}
elseif (file_exists($fl_fs_image_parent_name))	{
	$fl_web_output_image = $fl_web_image_parent_name;
	$fl_output_image = $fl_image_parent_name;
	}	
elseif (file_exists($fl_fs_image_category_name))	{
	$fl_web_output_image = $fl_web_image_category_name;
	$fl_output_image = $fl_image_category_name;
	}
elseif (file_exists($fl_fs_image_parentcategory_name))	{
	$fl_web_output_image = $fl_web_image_parentcategory_name;
	$fl_output_image = $fl_image_parentcategory_name;
	}
elseif (file_exists($fl_fs_image_component_name))	{
	$fl_web_output_image = $fl_web_image_component_name;
	$fl_output_image = $fl_image_component_name;
	}	
elseif (file_exists($fl_fs_image_default_name))	{
	$fl_web_output_image = $fl_web_image_default_name;
	$fl_output_image = $fl_image_default_name;
	}
else {
	$fl_web_output_image = "";
	$fl_output_image = "";
	};
	
//Find css file



if ($fl_cssfilesupport == '1') {
	
if (file_exists($fl_fs_css_contentmenu_name)) {
	$fl_web_output_css = $fl_web_css_contentmenu_name;
	$fl_output_css = $fl_image_contentmenu_name;
	}
elseif (file_exists($fl_fs_css_parent_name))	{
	$fl_web_output_css = $fl_web_css_parent_name;
	$fl_output_css = $fl_image_parent_name;
	}	
elseif (file_exists($fl_fs_css_content_name))	{
	$fl_web_output_css = $fl_web_css_content_name;
	$fl_output_css = $fl_image_content_name;
	}
elseif (file_exists($fl_fs_css_category_name))	{
	$fl_web_output_css = $fl_web_css_category_name;
	$fl_output_css = $fl_image_category_name;
	}
elseif (file_exists($fl_fs_css_parentcategory_name))	{
	$fl_web_output_css = $fl_web_css_parentcategory_name;
	$fl_output_css = $fl_image_parentcategory_name;
	}
elseif (file_exists($fl_fs_css_component_name))	{
	$fl_web_output_css = $fl_web_css_component_name;
	$fl_output_css = $fl_image_component_name;
	}	
elseif (file_exists($fl_fs_css_default_name))	{
	$fl_web_output_css = $fl_web_css_default_name;
	$fl_output_css = $fl_image_default_name;
	}
else {
	$fl_web_output_css = "";
	$fl_output_css = "";
	};	
} else {
	$fl_web_output_css = "";
	$fl_output_css = "";
}
	
// Include the syndicate functions only once
require_once( dirname(__FILE__).'/helper.php' );

$flexheader3 = modflexheader3Helper::flexheader3 (
	$fl_cversion,
	$fl_folder_location,
	$fl_folder_name,
	$fl_default_image,
	$fl_file_type,
	$fl_height,
	$fl_debug_opac,
	$fl_width,
	$fl_debug_position,
	$fl_debug,
	$fl_dev_debug,
	$fl_display_type,
	$fl_div_content,
	$fl_template,
	$fl_itemid,
	$fl_id,
	$fl_webdirname,
	$fl_jroot,
	$fl_fs_image_location,
	$fl_rl_folder_location,
	$fl_web_image_location,
	$fl_debug_color,
	$fl_web_image_content_name,
	$fl_catid,
	$fl_web_image_contentmenu_name,
	$fl_view,
	$fl_layout,
	$fl_fs_image_content_name,
	$fl_fs_image_contentmenu_name,
	$fl_web_output_image,
	$fl_web_image_default_name,
	$fl_fs_image_default_name,
	$fl_css_class,
	$fl_jflang,
	$fl_alt_text,
	$fl_jfsupport,
	$fl_dimensionstype,
	$lf_linksupport,
	$fl_linktarget,
	$fl_parentid,
	$fl_web_image_parent_name,
	$fl_fs_image_parent_name,
	$parentcategoryid,
	$categoryid,
	$fl_fs_image_category_name,
	$fl_web_image_category_name,
	$fl_fs_image_parentcategory_name,
	$fl_web_image_parentcategory_name,
	$fl_fs_image_component_name,
	$fl_web_image_component_name, 
	$fl_component,
	$fl_image_default_name,
	$fl_image_content_name,
	$fl_image_parent_name,
	$fl_image_contentmenu_name,
	$fl_image_category_name,
	$fl_image_parentcategory_name,
	$fl_image_component_name,
	$fl_output_image,
	$fl_cssfilesupport,
	$fl_fs_css_default_name,
	$fl_web_css_default_name,
	$fl_fs_css_content_name,
	$fl_web_css_content_name,
	$fl_fs_css_parent_name,
	$fl_web_css_parent_name,
	$fl_fs_css_contentmenu_name,
	$fl_web_css_contentmenu_name,
	$fl_fs_css_category_name,
	$fl_web_css_category_name,
	$fl_fs_css_parentcategory_name,
	$fl_web_css_parentcategory_name,
	$fl_fs_css_component_name,
	$fl_web_css_component_name,
	$fl_web_output_css,
	$fl_output_css,
	$fl_pagetitle,
	$flalttexttype,
	$fl_specifydimensions,
	$fl_userisguest,
	$fl_showebugtoguest,
	$fl_module_id,
	$fl_addborderzerotoimage,
	$fl_module_title,
	$fl_namederintemid,
	$fl_namederparentid,
	$fl_namedercategory,
	$fl_namederparentcategory
	);
	
require JModuleHelper::getLayoutPath( 'mod_flexheader3', $params->get('layout', 'default') );

//unset all vars
unset (
	$fl_cversion,
	$fl_folder_location,
	$fl_folder_name,
	$fl_default_image,
	$fl_file_type,
	$fl_height,
	$fl_debug_opac,
	$fl_width,
	$fl_debug_position,
	$fl_debug,
	$fl_dev_debug,
	$fl_display_type,
	$fl_div_content,
	$fl_template,
	$fl_itemid,
	$fl_id,
	$fl_webdirname,
	$fl_jroot,
	$fl_fs_image_location,
	$fl_rl_folder_location,
	$fl_web_image_location,
	$fl_debug_color,
	$fl_web_image_content_name,
	$fl_catid,
	$fl_web_image_contentmenu_name,
	$fl_view,
	$fl_layout,
	$fl_fs_image_content_name,
	$fl_fs_image_content_name,
	$fl_fs_image_contentmenu_name,
	$fl_web_output_image,
	$fl_web_image_default_name,
	$fl_fs_image_default_name,
	$fl_css_class,
	$fl_jflang,
	$fl_jflangc,
	$fl_alt_text,
	$fl_jfsupport,
	$fl_docroot,
	$fl_dimensionstype,
	$lf_linksupport,
	$fl_linktarget,
	$fl_parentid,
	$fl_web_image_parent_name,
	$fl_fs_image_parent_name,
	$parentcategoryid,
	$categoryid,
	$fl_fs_image_category_name,
	$fl_web_image_category_name,
	$fl_fs_image_component_name,
	$fl_web_image_component_name, 
	$fl_component,
	$fl_image_default_name,
	$fl_image_content_name,
	$fl_image_parent_name,
	$fl_image_contentmenu_name,
	$fl_image_category_name,
	$fl_image_parentcategory_name,
	$fl_image_component_name,
	$fl_output_image,
	$fl_cssfilesupport,
	$fl_fs_css_default_name,
	$fl_web_css_default_name,
	$fl_fs_css_content_name,
	$fl_web_css_content_name,
	$fl_fs_css_parent_name,
	$fl_web_css_parent_name,
	$fl_fs_css_contentmenu_name,
	$fl_web_css_contentmenu_name,
	$fl_fs_css_category_name,
	$fl_web_css_category_name,
	$fl_fs_css_parentcategory_name,
	$fl_web_css_parentcategory_name,
	$fl_fs_css_component_name,
	$fl_web_css_component_name,
	$fl_web_output_css,
	$fl_fs_output_css,
	$fl_pagetitle,
	$flalttexttype,
	$fl_specifydimensions,
	$fl_userisguest,
	$fl_showebugtoguest,
	$fl_module_id,
	$fl_addborderzerotoimage,
	$fl_module_title,
	$fl_namederintemid,
	$fl_namederparentid,
	$fl_namedercategory,
	$fl_namederparentcategory
	);
?>
