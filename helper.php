<?php

/**
 * Helper class for flexheader3 module 
 * 
 * @package  Joomla
 * @subpackage Modules
 * @link http://www.andrehotzler.de (with help from Henry Schorradt)
 * @license        GNU/GPL, see license_gpl.txt
 * mod_flexheader is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

class modflexheader3Helper{
	public static function  flexheader3(
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
		){
				//Debug
				if ($fl_showebugtoguest OR !$fl_userisguest) {
				if ($fl_debug OR $fl_dev_debug ) {
				
					echo '<script>jQuery(function() {jQuery( "#flexheaderdebugwindow" ).resizable();});</script>';
					echo '<script>jQuery(function() {jQuery( "#flexheaderdebugwindow" ).draggable();});</script>';
					HTMLHelper::_('script', '//code.jquery.com/ui/1.11.3/jquery-ui.min.js');
					HTMLHelper::_('stylesheet', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
					HTMLHelper::_('stylesheet', Uri::root() .'/modules/mod_flexheader3/flexheader3_backend.css');
						echo '<div id="flexheaderdebugwindow" style="
															filter:alpha(opacity='.$fl_debug_opac.');
															-moz-opacity:.'.$fl_debug_opac.';
															opacity:.'.$fl_debug_opac.';
															'.$fl_debug_position.':0;
															background-color:'.$fl_debug_color.';
														  ">
														  <img id="flexheaderdebugwindowlogo" alt="flexheader3" src="'.$fl_webdirname.'modules/mod_flexheader3/flexheader3.png" />';
															
						echo '<div class="ui-icon ui-icon-arrow-4" style="z-index: 90; margin-bottom: 5px;"></div>';
						echo '<strong>'.Text::_("FLDEBUGINTRO").'</strong><br /><br />';
						echo Text::_("FLPACEIMAGESHERE").'<strong> '.$fl_web_image_location.'</strong><br />'.Text::_("FLPACEIMAGESHEREFULLPATH").'<strong> '.$fl_fs_image_location.'</strong><br /><br />';
						echo Text::_("FLIMAGENAME").'<strong> '.$fl_image_contentmenu_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo  Text::_("FLIMAGEMNAME").'<strong> '.$fl_image_content_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo  Text::_("FLIMAGEPARENTNAME").'<strong> '.$fl_image_parent_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo  Text::_("FLIMAGECATEGORYNAME").'<strong> '.$fl_image_category_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo  Text::_("FLIMAGEPARENTCATEGORYNAME").'<strong> '.$fl_image_parentcategory_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo  Text::_("FLIMAGECOMPONENTNAME").'<strong> '.$fl_image_component_name.$fl_jflang.'</strong>'.$fl_file_type.'<br />';
						echo '<br />';
						echo Text::_("FLUSEDIMAGE").'<strong> ';if ($fl_output_image) {echo $fl_output_image.$fl_jflang.$fl_file_type; } else {echo Text::_("FLNOIMAGEFOUND").'<br />'.$fl_image_default_name.$fl_jflang.$fl_file_type;}; echo '</strong><br />';
						if ($fl_cssfilesupport == "1") {
							echo Text::_("FLUSEDCSS").'<strong> ';if ($fl_web_output_css) {echo $fl_output_css.$fl_jflang.'.css'; } else {echo Text::_("FLNOCSSFOUND").'<br />'.$fl_image_default_name.$fl_jflang.".css";}; echo '</strong><br />';	
							};
							if ($fl_dev_debug) {
									echo '<br /><strong>Developer Debug Information</strong><br /><br />';
									echo '<div style="float: left; width: 49%">';
										echo '<strong>Main information</strong><br /><br />';
										echo 'flexheader3 Version (mostly wrong): '.$fl_cversion.'<br />';
										echo 'Template: '.$fl_template.'<br />';		
										echo 'User is Guest?: '.$fl_userisguest.'<br />';		
										echo '<br /><strong>Settings</strong><br /><br />';								
										echo 'flexheader3 CSS Class: '.$fl_css_class.'<br />';									
										echo 'Folder Location: '.$fl_folder_location.'<br />';
										echo 'Real Folder Location: '.$fl_rl_folder_location.'<br />';
										echo 'Folder Name: '.$fl_folder_name.'<br />';
										echo 'Default Image: '.$fl_default_image.'<br />';
										echo 'File Type: '.$fl_file_type.'<br />';
										echo 'Specify Dimensions: '.$fl_specifydimensions.'<br />';							
										echo 'Height: '.$fl_height.'<br />';
										echo 'Width: '.$fl_width.'<br />';
										echo 'Indication of Dimensions: '.$fl_dimensionstype.'<br />';						
										echo 'Display_Mode: '.$fl_display_type.'<br />';
										echo 'DIV Content: <pre class="divcontent">'.$fl_div_content.'</pre><br />';
										echo 'ALT TEXT TYPE: '.$flalttexttype.'<br />';
										echo 'ALT Text: '.$fl_alt_text.'<br />';
										echo '<br /><strong>components</strong><br /><br />';		
										echo 'Language Support in FL enabled: '.$fl_jfsupport.'<br />';					
										echo 'Language: '.$fl_jflang.'<br />';	
										echo 'LinkSupport: '.$lf_linksupport.'<br />';
										echo 'LinkTarget: '.$fl_linktarget.'<br />';
										echo 'Load CSS File: '.$fl_cssfilesupport.'<br />';
									echo '</div>';
									echo '<div style="float: left; width: 49%;">';
										echo '<strong>IDs</strong><br /><br />';
										echo 'Module-ID: '.$fl_module_id.'<br />';
										echo 'Module-Title: '.$fl_module_title.'<br />';
										echo 'ID: '.$fl_id.'<br />';
										echo 'ItemID: '.$fl_itemid.'<br />';
										echo 'parentcategory: '.$parentcategoryid.'<br />';
										echo 'Category: '.$categoryid.'<br />';
										echo 'ParentID: '.$fl_parentid.'<br />';
										echo 'View: '.$fl_view.'<br />';
										echo 'Layout: '.$fl_layout.'<br />';					 
										echo '<br /><strong>Debugging</strong><br /><br />';
										echo 'Show debug to guests: '.$fl_showebugtoguest.'<br />';   
										echo 'Add Border=0 to fl object: '.$fl_addborderzerotoimage.'<br />';												  
										echo 'Debug_opac: '.$fl_debug_opac.'%<br />';        
										echo 'Developer_Debug: '.$fl_dev_debug.'<br />';     	
										echo 'Debug_postion: '.$fl_debug_position.'<br />';
										echo 'Debug: '.$fl_debug.'<br />';
										echo 'Debug_BG_Color: '.$fl_debug_color.'<br />';		 									
									echo '</div>';                                  
									echo '<div style="clear: both; width: 100%">'; 
										echo '<strong>Paths</strong><br /><br />';		
										echo 'Web Image Location: '.$fl_web_image_location.'<br />';		
										echo 'Web Content Name : '.$fl_web_image_content_name.'<br />';
										echo 'Web ContentMenu Name : '.$fl_web_image_contentmenu_name.'<br />';
										echo 'Web ParentMenu Name : '.$fl_web_image_parent_name.'<br />';
										echo 'Web Category Name : '.$fl_web_image_category_name.'<br />';
										echo 'Web parentcategory Name : '.$fl_web_image_parentcategory_name.'<br />';	
										echo 'Web Component Name : '.$fl_web_image_component_name.'<br />';	
										echo 'Default Web Image: '.$fl_web_image_default_name.'<br />';													
										echo 'WebDirName: '.$fl_webdirname.'<br />';
										echo 'Joomla Root on Server: '.$fl_jroot.'<br />';
										echo 'Filesystem Image Location: '.$fl_fs_image_location.'<br />';		
										echo 'Default FS Image: '.$fl_fs_image_default_name.'<br />';
										echo 'Default Web Image: '.$fl_web_image_default_name.'<br />';			
										echo 'Web CSS Content Name : '.$fl_web_css_content_name.'<br />';
										echo 'Web CSS ContentMenu Name : '.$fl_web_css_contentmenu_name.'<br />';
										echo 'Web CSS ParentMenu Name : '.$fl_web_css_parent_name.'<br />';
										echo 'Web CSS Category Name : '.$fl_web_css_category_name.'<br />';
										echo 'Web CSS parentcategory Name : '.$fl_web_css_parentcategory_name.'<br />';	
										echo 'Web CSS Component Name : '.$fl_web_css_component_name.'<br />';	
										echo 'Default Web CSS: '.$fl_web_css_default_name.'<br />';													
										echo 'Default FS CSS: '.$fl_fs_css_default_name.'<br />';
										echo 'Default Web CSS: '.$fl_web_css_default_name.'<br />';											
										echo 'Web Output  CSS: '.$fl_web_output_css.'<br />';	
										echo 'Output CSS: '.$fl_output_css.'<br />';
										
										echo 'itemid prefix: '.$fl_namederintemid.'<br />';	
										echo 'parentid prefix: '.$fl_namederparentid.'<br />';	
										echo 'categoryid prefix: '.$fl_namedercategory.'<br />';	
										echo 'parentcategoryid prefix: '.$fl_namederparentcategory.'<br />';	
										echo '</div>';				
								}
						echo '</div>';
						}
					}
						
				//CSS
				if ($fl_output_css)  {
					$document  = JFactory::getDocument();
					$attribs = array('type' => 'text/css', 'media' => 'screen');
				  $flcssfilecrc = crc32(filemtime($fl_fs_image_location.$fl_output_css.$fl_jflang.'.css'));
					$document->addHeadLink(JRoute::_($fl_web_output_css."?".$flcssfilecrc), 'stylesheet', 'rel', $attribs);
					};
						
				//Web/HTML Output
				$out = "<!-- Flexheader3 Output starts here -->";
				$out.= "<!-- copyright Andre Hotzler, released under the GPL -->";				
				$out.= "<!-- visit http://www.flexheader.andrehotzler.de for more information -->";
				if ($fl_web_output_image) {
					$flimgfilecrc = crc32(filemtime($fl_fs_image_location.$fl_output_image.$fl_jflang.$fl_file_type));
					if ($lf_linksupport) {
						$out.= '<a href="'.$fl_linktarget.'"';
						$out.= ' title="'.$fl_alt_text.'"' ;
						$out.= ' >';
						};
				
					if ($fl_display_type == "div") {
						//DIV
						$out.= '<div ';
						if ($fl_css_class) $out.= 'class="'.$fl_module_id.' '.$fl_css_class.'"';
						$out.= ' style="';
						if ($fl_specifydimensions) {						
						$out.= ' width:'.$fl_width.$fl_dimensionstype.'; height:'.$fl_height.$fl_dimensionstype.';';
						};	
						$out.= ' background-image:url('.$fl_web_output_image."?".$flimgfilecrc.');';
						$out.= ' "';
						$out.= '>';
						$out.= $fl_div_content;
						$out.= '</div>';
						}
					elseif ($fl_display_type == "img") {
						$out.= '<img ';
						if ($fl_css_class) $out.= 'class="'.$fl_module_id.' '.$fl_css_class.'"';
						$out.= ' style="';
						if ($fl_addborderzerotoimage)   $out.= ' border: 0; ';
						if ($fl_specifydimensions) {
						$out.= ' width:'.$fl_width.$fl_dimensionstype.'; height:'.$fl_height.$fl_dimensionstype.';';
						};	
						$out.= ' "';
						$out.= ' alt="'.$fl_alt_text.'" title="'.$fl_alt_text.'" src="'.$fl_web_output_image."?".$flimgfilecrc.'" />';	
						}
					if ($lf_linksupport) {
						$out.= '</a>';
						};						
						
				} else {
					//DIV
					$out.= '<div class="flexheader3';
					if ($fl_css_class) $out.= '-'.$fl_css_class;
					$out.= '" style="background-color: red; color: white; width:'.$fl_width.$fl_dimensionstype.'; height:'.$fl_height.$fl_dimensionstype.';';
					$out.= '">';
					$out.= Text::_("FLNODEFAULTIMAGEFOUND").'<br />'.$fl_fs_image_default_name;
					$out.= '</div>';
				};
				$out.= "<!-- flexheader3 end -->";
				return $out;
		}//flexheader3
	}//class
?>