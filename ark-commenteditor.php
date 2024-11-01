<?php
/**
Plugin Name: ark-commenteditor
Author: Александр Каратаев
Plugin URI: https://obg.kz/plagin-kommentariev-dlya-wordpress.html
Description: Visual CommentEditor TinyMce Advanced
Version: 2.15.6
Author URI: https://obg.kz
Text Domain: arkcommenteditor
Domain Path: /lang
License: GPL2
*/
?>
<?php
/*  Copyright 2014  Александр Каратаев  (email : ddw2@yandex.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
register_activation_hook(__FILE__, 'ark_commenteditor_activation');
 
function ark_commenteditor_activation() {
// действие при активации
ark_wce_init_option();
// регистрируем действие при удалении
register_uninstall_hook(__FILE__, 'ark_commenteditor_uninstall');
}
 
function ark_commenteditor_uninstall(){
//действие при удалении
delete_option( 'ark_wce' ); 
}
add_action('plugins_loaded', 'ark_wce_init_lang');
function ark_wce_init_lang() {
	 load_plugin_textdomain( 'arkcommenteditor', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

// Админ панель
//Опции по умолчанию
function ark_wce_init_option() {
$ark_wce_option = array(
'btn_undo' => '1',
'btn_redo' => '1',
'btn_bold' => '1',
'btn_italic' => '1',
'btn_underline' => '0',
'btn_strikethrough' => '0',
'btn_forecolor' => '0',
'btn_backcolor' => '0',
'btn_link' => '0',
'btn_image' => '0',
'btn_blockquote' => '1',
'btn_bullist' => '0',
'btn_numlist' => '0',
'btn_table' => '0',
'btn_emoticons' => '1',
'btn_arkemoticons' => '0',
'btn_arkemoticonssk' => '0',
'btn_arkkbabe' => '0',
'btn_preview' => '1',
'wce_lang' => 'русский',
'wce_width' => '600',
'wce_widthfix' => '0',
'btn_arkbquote' => '0',
'wce_addbquotestyle' => '0',
'wce_edtbquotestyle' => '0',
'box_font' => '0',
'box_fontsize' => '0',
'wce_editor' => 'ckeditor',
'btn_codesnippet' => '0',
'codesnippet_css' => 'idea',
'btn_pastetext' => '0',
'btn_pasteword' => '0',
'btn_hr' => '0',
'btn_justifyleft' => '0',
'btn_justifycenter' => '0',
'btn_justifyright' => '0',
'btn_justifyblock' => '0',
'wce_smileycolumns' => '8',
'tiny_skin' => '0',
'cke_skin' => '0',
'cke_css' => '0',
'btn_video' => '0',
'url_terms_of_privacy' => '',
'url_user_agreements' => '',
'txt_before_terms' => '',
'txt_link_terms' => '',
'txt_and_link' => '',
'txt_link_agreements' => '',
);
add_option('ark_wce', $ark_wce_option,'','no');
}
// Хук вставки в админ меню
add_action('admin_menu', 'ark_wce_add_pages');
// Акция предыдущено хука
function ark_wce_add_pages() {
    // Добавляем новое субменю в Options:
    add_options_page('ark_commenteditor', 'ark-commenteditor', 'manage_options', 'ark_wce_ostoptions', 'ark_wce_options_page');
}
// Вывод страницы опций в субменю
function ark_wce_options_page() {
	//echo'<h2 style="color:navy;">';
    echo '<h2 style="color:navy;">'.esc_html__('Settings visual editor comments','arkcommenteditor').'</h2><hr><div style="clear: both;float:right; 
	padding-right:20px;"><noindex><a rel="nofollow" href="https://obg.kz/podderzhka-proektov-avtora-etogo-bloga
" target="_blank"><img align="right" src="' . esc_url(plugins_url( '/img/donate.png', __FILE__ )) . '" alt="Пожертвовать" border="0" /></a></noindex></div>';
?>	
<div class="wrap">
<?php // Проверка прав пользователя
$nonce = wp_create_nonce('arkwce-edit-options');
if (!wp_verify_nonce($nonce, 'arkwce-edit-options') || !current_user_can('manage_options')) 
{ 
	exit(esc_html_e("Sorry, but you don't have the rights for this action. You may need to log in again.","arkcommenteditor"));  
} 
// Пошла обработка запроса
if (isset($_POST['save'])) {
$ark_wce_option = array(
'btn_undo' => sanitize_text_field($_POST['btn_undo']),
'btn_redo' => sanitize_text_field($_POST['btn_redo']),
'btn_bold' => sanitize_text_field($_POST['btn_bold']),
'btn_italic' => sanitize_text_field($_POST['btn_italic']),
'btn_underline' => sanitize_text_field($_POST['btn_underline']),
'btn_strikethrough' => sanitize_text_field($_POST['btn_strikethrough']),
'btn_forecolor' => sanitize_text_field($_POST['btn_forecolor']),
'btn_backcolor' => sanitize_text_field($_POST['btn_backcolor']),
'btn_link' => sanitize_text_field($_POST['btn_link']),
'btn_image' => sanitize_text_field($_POST['btn_image']),
'btn_blockquote' => sanitize_text_field($_POST['btn_blockquote']),
'btn_bullist' => sanitize_text_field($_POST['btn_bullist']),
'btn_numlist' => sanitize_text_field($_POST['btn_numlist']),
'btn_table' => sanitize_text_field($_POST['btn_table']),
'btn_emoticons' => sanitize_text_field($_POST['btn_emoticons']),
'btn_arkemoticons' => sanitize_text_field($_POST['btn_arkemoticons']),
'btn_arkemoticonssk' => sanitize_text_field($_POST['btn_arkemoticonssk']),
'btn_arkkbabe' => sanitize_text_field($_POST['btn_arkkbabe']),
'btn_preview' => sanitize_text_field($_POST['btn_preview']),
'wce_lang' => sanitize_text_field($_POST['wce_lang']),
'wce_width' => sanitize_text_field($_POST['wce_width']),
'wce_widthfix' => sanitize_text_field($_POST['wce_widthfix']),
'btn_arkbquote' => sanitize_text_field($_POST['btn_arkbquote']),
'wce_addbquotestyle' => sanitize_text_field($_POST['wce_addbquotestyle']),
'wce_edtbquotestyle' => sanitize_text_field($_POST['wce_edtbquotestyle']),
'box_font' => sanitize_text_field($_POST['box_font']),
'box_fontsize' => sanitize_text_field($_POST['box_fontsize']),
'wce_editor' => sanitize_text_field($_POST['wce_editor']),
'btn_codesnippet' => sanitize_text_field($_POST['btn_codesnippet']),
'codesnippet_css' => sanitize_text_field($_POST['codesnippet_css']),
'btn_pastetext' => sanitize_text_field($_POST['btn_pastetext']),
'btn_pasteword' => sanitize_text_field($_POST['btn_pasteword']),
'btn_hr' => sanitize_text_field($_POST['btn_hr']),
'btn_justifyleft' => sanitize_text_field($_POST['btn_justifyleft']),
'btn_justifycenter' => sanitize_text_field($_POST['btn_justifycenter']),
'btn_justifyright' => sanitize_text_field($_POST['btn_justifyright']),
'btn_justifyblock' => sanitize_text_field($_POST['btn_justifyblock']),
'wce_smileycolumns' => sanitize_text_field($_POST['wce_smileycolumns']),
'tiny_skin' => sanitize_text_field($_POST['tiny_skin']),
'cke_skin' => sanitize_text_field($_POST['cke_skin']),
'cke_css' => sanitize_text_field($_POST['cke_css']),
'btn_video' => sanitize_text_field($_POST['btn_video']),
'url_terms_of_privacy' => sanitize_text_field($_POST['url_terms_of_privacy']),
'url_user_agreements' => sanitize_text_field($_POST['url_user_agreements']),
'txt_before_terms' => sanitize_text_field($_POST['txt_before_terms']),
'txt_link_terms' => sanitize_text_field($_POST['txt_link_terms']),
'txt_and_link' => sanitize_text_field($_POST['txt_and_link']),
'txt_link_agreements' => sanitize_text_field($_POST['txt_link_agreements']),
);

update_option('ark_wce', $ark_wce_option);
echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><b>'.esc_html__('Settings saved.','arkcommenteditor').'</b></p></div>';
	
} else if ( isset($_POST['reset'])) {   
      // При сбросе: удаляем записи опций из БД  
 	     delete_option( 'ark_wce' ); 
		 ark_wce_init_option();
  	  echo '<div id="message" class="updated fade"><p><strong>' . esc_html__('Settings successfully restored the default.','arkcommenteditor') .
               '</strong></p></div>';
       } 
?>
<form method="post">
<?php 
//wp_nonce_field('update-options'); 
$result = get_option('ark_wce');
?>
<h3><?php esc_html_e('Editor Options','arkcommenteditor'); ?></h3>
<table>
<tr>
<td>
<?php esc_html_e('Select Editor','arkcommenteditor'); ?>
&nbsp;<select size="1" name="wce_editor">
    <option <?php if (sanitize_text_field($result['wce_editor']) == "ckeditor") { echo "selected"; } ?> value="ckeditor">CkEditor</option>
    <option <?php if (sanitize_text_field($result['wce_editor']) == "tinymce") { echo "selected"; } ?> value="tinymce">TinyMCE</option>
</select>
&nbsp;<?php esc_html_e('When not working TinyMCE - select CkEditor','arkcommenteditor'); ?>
</td></tr>
<tr><td><font style="color:red; font-weight:bold;"><?php esc_html_e('Under the laws of some countries, it is required to establish a checkbox to confirm consent to the terms of confidentiality and user agreements of the site. Without such a confirmation, sending a comment should be inaccessible. If at least one URL is below specified, then such checkbox will appear in the form of comments.','arkcommenteditor'); ?></font>
</td></tr>
<tr><td><?php esc_html_e('The text of the checkbox (before the links)','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="txt_before_terms" size="50" value="<?php echo esc_attr($result['txt_before_terms']); ?>" placeholder="<?php esc_html_e('I agree to the','arkcommenteditor'); ?>"/> 
</td></tr>
<tr><td><?php esc_html_e('Full URL to privacy conditions','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="url_terms_of_privacy" size="60" value="<?php echo esc_attr($result['url_terms_of_privacy']); ?>" placeholder="https://mydomain.com/privacy.html"/> 
&nbsp;&nbsp;<?php esc_html_e('Link text','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="txt_link_terms" size="50" value="<?php echo esc_attr($result['txt_link_terms']); ?>" placeholder="<?php esc_html_e('terms of privacy','arkcommenteditor'); ?>"/> 
</td></tr>
<tr><td>
<?php esc_html_e('Text between links','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="txt_and_link" size="20" value="<?php echo esc_attr($result['txt_and_link']); ?>" placeholder="<?php esc_html_e('and','arkcommenteditor'); ?>"/> 
</td></tr>
<tr><td><?php esc_html_e('Full URL to the user agreement','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="url_user_agreements" size="60" value="<?php echo esc_attr($result['url_user_agreements']); ?>" placeholder="https://mydomain.com/agreements.html"/> 
&nbsp;&nbsp;<?php esc_html_e('Link text','arkcommenteditor'); ?>:&nbsp;
<input type="text" name="txt_link_agreements" size="50" value="<?php echo esc_attr($result['txt_link_agreements']); ?>" placeholder="<?php esc_html_e('and user agreement','arkcommenteditor'); ?>"/> </td></tr>
</table>


<hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<h3><?php esc_html_e('General Settings buttons','arkcommenteditor'); ?></h3>
<table>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/undo.png', __FILE__ )); ?>" title="<?php esc_html_e('Undo','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_undo" value="1" <?php if ((int)($result['btn_undo']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td><td>
<img src="<?php echo esc_url(plugins_url( '/img/redo.png', __FILE__ )); ?>" title="<?php esc_html_e('Redo','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_redo" value="1" <?php if ((int)($result['btn_redo']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/bold.png', __FILE__ )); ?>" title="<?php esc_html_e('Bold','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_bold" value="1" <?php if ((int)($result['btn_bold']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/italic.png', __FILE__ )); ?>" title="<?php esc_html_e('Italic','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_italic" value="1" <?php if ((int)($result['btn_italic']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/underline.png', __FILE__ )); ?>" title="<?php esc_html_e('Underline','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_underline" value="1" <?php if ((int)($result['btn_underline']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/strikethrough.png', __FILE__ )); ?>" title="<?php esc_html_e('Strikethrough','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_strikethrough" value="1" <?php if ((int)($result['btn_strikethrough']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/forecolor.png', __FILE__ )); ?>" title="<?php esc_html_e('Forecolor','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_forecolor" value="1" <?php if ((int)($result['btn_forecolor']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/backcolor.png', __FILE__ )); ?>" title="<?php esc_html_e('Backcolor','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_backcolor" value="1" <?php if ((int)($result['btn_backcolor']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
</tr></table><br><hr>
<table>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/fontsize.png', __FILE__ )); ?>" title="<?php esc_html_e('FontSize','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="box_fontsize" value="1" <?php if ((int)($result['box_fontsize']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td><td>
<img src="<?php echo esc_url(plugins_url( '/img/font.png', __FILE__ )); ?>" title="<?php esc_html_e('Font','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="box_font" value="1" <?php if ((int)($result['box_font']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
</tr></table><br><hr>
<table><tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/link.png', __FILE__ )); ?>" title="<?php esc_html_e('Link','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_link" value="1" <?php if ((int)($result['btn_link']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/image.png', __FILE__ )); ?>" title="<?php esc_html_e('Image','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_image" value="1" <?php if ((int)($result['btn_image']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/blockquote.png', __FILE__ )); ?>" title="<?php esc_html_e('Blockquote','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_blockquote" value="1" <?php if ((int)($result['btn_blockquote']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/bullist.png', __FILE__ )); ?>" title="<?php esc_html_e('Bullist','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_bullist" value="1" <?php if ((int)($result['btn_bullist']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/numlist.png', __FILE__ )); ?>" title="<?php esc_html_e('Numlist','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_numlist" value="1" <?php if ((int)($result['btn_numlist']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/table.png', __FILE__ )); ?>" title="<?php esc_html_e('Table','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_table" value="1" <?php if ((int)($result['btn_table']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/emoticons.png', __FILE__ )); ?>" title="<?php esc_html_e('Emoticons','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_emoticons" value="1" <?php if ((int)($result['btn_emoticons']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
</tr>
</table><hr style='border : 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>
<b><?php esc_html_e('Additional set of smileys','arkcommenteditor'); ?></b>
<br><font style="color:blue; font-weight:bold;"><?php esc_html_e('For TinyMCE will be added to the individual buttons for each set. For SKEditor default smileys will be replaced with the selected set.','arkcommenteditor'); ?></font>
<table>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/qip.png', __FILE__ )); ?>" title="qip" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/skype.png', __FILE__ )); ?>" title="skype" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/k-babe.png', __FILE__ )); ?>" title="k-babe" valign="top">
</td>
</tr>
<tr>
<td>
<?php esc_html_e('From a set of emoticons QIP','arkcommenteditor'); ?> <input type="checkbox" name="btn_arkemoticons" value="1" <?php if ((int)($result['btn_arkemoticons']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<?php esc_html_e('From a set of emoticons Skype','arkcommenteditor'); ?> <input type="checkbox" name="btn_arkemoticonssk" value="1" <?php if ((int)($result['btn_arkemoticonssk']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<?php esc_html_e('From a set of emoticons k-babe','arkcommenteditor'); ?><input type="checkbox" name="btn_arkkbabe" value="1" <?php if ((int)($result['btn_arkkbabe']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
</tr>
</table>
<hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<h3><?php esc_html_e('Advanced settings CKEditor','arkcommenteditor'); ?></h3>
<table>
<tr>
<td colspan="2">
<img src="<?php echo esc_url(plugins_url( '/img/pastetext.png', __FILE__ )); ?>" title="<?php esc_html_e('Paste As Text','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_pastetext" value="1" <?php if ((int)($result['btn_pastetext']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/pastefromword.png', __FILE__ )); ?>" title="<?php esc_html_e('Paste from Word','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_pasteword" value="1" <?php if ((int)($result['btn_pasteword']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/horizontalrule.png', __FILE__ )); ?>" title="<?php esc_html_e('HorizontalRule','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_hr" value="1" <?php if ((int)($result['btn_hr']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/justifyleft.png', __FILE__ )); ?>" title="<?php esc_html_e('JustifyLeft','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_justifyleft" value="1" <?php if ((int)($result['btn_justifyleft']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/justifycenter.png', __FILE__ )); ?>" title="<?php esc_html_e('JustifyCenter','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_justifycenter" value="1" <?php if ((int)($result['btn_justifycenter']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/justifyright.png', __FILE__ )); ?>" title="<?php esc_html_e('JustifyRight','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_justifyright" value="1" <?php if ((int)($result['btn_justifyright']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/img/justifyblock.png', __FILE__ )); ?>" title="<?php esc_html_e('JustifyBlock','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_justifyblock" value="1" <?php if ((int)($result['btn_justifyblock']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;

<img src="<?php echo esc_url(plugins_url( '/plugins/videoembed/icons/videoembed.png', __FILE__ )); ?>" title="<?php esc_html_e('Video Embed','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_video" value="1" <?php if ((int)($result['btn_video']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td></tr>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/img/codesnippet.png', __FILE__ )); ?>" title="<?php esc_html_e('CodeSnippet','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_codesnippet" value="1" <?php if ((int)($result['btn_codesnippet']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<?php esc_html_e('Styles for snippets of code','arkcommenteditor'); ?>
&nbsp;<select size="1" name="codesnippet_css">
    <option <?php if (sanitize_text_field($result['codesnippet_css']) == "school_book") { echo "selected"; } ?> value="school_book">school_book</option>
    <option <?php if (sanitize_text_field($result['codesnippet_css']) == "idea") { echo "selected"; } ?> value="idea">idea</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "ir_black") { echo "selected"; } ?> value="ir_black">ir_black</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "magula") { echo "selected"; } ?> value="magula">magula</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "sunburst") { echo "selected"; } ?> value="sunburst">sunburst</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "agate") { echo "selected"; } ?> value="agate">agate</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "vs") { echo "selected"; } ?> value="vs">Visual Studio</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "googlecode") { echo "selected"; } ?> value="googlecode">googlecode</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "monokai_sublime") { echo "selected"; } ?> value="monokai_sublime">monokai_sublime</option>
	<option <?php if (sanitize_text_field($result['codesnippet_css']) == "obsidian") { echo "selected"; } ?> value="obsidian">obsidian</option>
</select>&nbsp;&nbsp;<?php esc_html_e('Demonstration styles','arkcommenteditor'); ?>&nbsp;&nbsp;<noindex><a rel="nofollow" href="https://highlightjs.org/static/demo/
" target="_blank">highlight.js demo</a></noindex>
</td></tr><tr><td colspan="2">
<?php esc_html_e('The number of columns with smiles','arkcommenteditor'); ?>&nbsp;<input type="number" min="6" max="16" name="wce_smileycolumns" value="<?php echo sanitize_text_field($result['wce_smileycolumns']); ?>" />&nbsp;
</td></tr></table>
<hr style='border : 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>
<b><?php esc_html_e('Choosing skin for CkEditor','arkcommenteditor'); ?></b>
<table>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/skin.png', __FILE__ )); ?>" title="default" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/icy_orange/skin.png', __FILE__ )); ?>" title="icy_orange" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/kama/skin.png', __FILE__ )); ?>" title="kama" valign="top">
</td>
</tr>
<tr>
<td>
default&nbsp;<input type="radio" name="cke_skin" value="0" <?php if ((int)($result['cke_skin']) == 0) { echo "checked"; } ?> > 
</td>
<td>
icy_orange&nbsp;<input type="radio" name="cke_skin" value="1" <?php if ((int)($result['cke_skin']) == 1) { echo "checked"; } ?> > 
</td>
<td>
kama&nbsp;<input type="radio" name="cke_skin" value="2" <?php if ((int)($result['cke_skin']) == 2) { echo "checked"; } ?> > 
</td>
</tr>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/moonocolor/skin.png', __FILE__ )); ?>" title="moonocolor" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/moono-dark/skin.png', __FILE__ )); ?>" title="moono-dark" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/ckeditor/skins/office2013/skin.png', __FILE__ )); ?>" title="office2013" valign="top">
</td>
</tr>
<tr>
<td>
moonocolor&nbsp;<input type="radio" name="cke_skin" value="3" <?php if ((int)($result['cke_skin']) == 3) { echo "checked"; } ?> > 
</td>
<td>
moono-dark&nbsp;<input type="radio" name="cke_skin" value="4" <?php if ((int)($result['cke_skin']) == 4) { echo "checked"; } ?> > 
</td>
<td>
office2013&nbsp;<input type="radio" name="cke_skin" value="5" <?php if ((int)($result['cke_skin']) == 5) { echo "checked"; } ?> > 
</td>
</tr>
</table>
<hr style='border : 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>
<b><?php esc_html_e('For advanced users','arkcommenteditor'); ?></b>
<table>
<tr>
<td>
<input type="checkbox" name="cke_css" value="1" <?php if ((int)($result['cke_css']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
<?php esc_html_e('Use your CSS. Style file myckeditor.css is in the folder wp-content\plugins\ark-wysiwyg-comment-editor\css.','arkcommenteditor'); ?>&nbsp;&nbsp;<?php esc_html_e('Correcting this file allows you to change the display of some elements of the editor text area.','arkcommenteditor'); ?>&nbsp;&nbsp;<?php esc_html_e('When you upgrade the plugin changes to the file may be lost.','arkcommenteditor'); ?>&nbsp;&nbsp;<?php esc_html_e('It is recommended after setting the copy file to your computer, then to restore your settings.','arkcommenteditor'); ?>
</td>
</tr>
</table>
<hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<h3><?php esc_html_e('Advanced settings TinyMCE','arkcommenteditor'); ?></h3>
<table>
<tr>
<td>
<?php esc_html_e('Language frontend Editor','arkcommenteditor'); ?>
&nbsp;<select size="1" name="wce_lang">
    <option <?php if (sanitize_text_field($result['wce_lang']) == "русский") { echo "selected"; } ?> value="русский">Русский</option>
    <option <?php if (sanitize_text_field($result['wce_lang']) == "english") { echo "selected"; } ?> value="english">English</option>
	<option <?php if (sanitize_text_field($result['wce_lang']) == "deutsch") { echo "selected"; } ?> value="deutsch">Deutsch</option>
	<option <?php if (sanitize_text_field($result['wce_lang']) == "french") { echo "selected"; } ?> value="french">French</option>
</select>
</td>
<td>
<?php esc_html_e('Fixed width Editor','arkcommenteditor'); ?>&nbsp;<input type="checkbox" name="wce_widthfix" value="1" <?php if ((int)($result['wce_widthfix']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td>
<td>
<?php esc_html_e('Editor Width','arkcommenteditor'); ?>&nbsp;<input type="number" step="50" min="300" max="1000" name="wce_width" value="<?php echo (int)($result['wce_width']); ?>" />&nbsp;px
</td>
<tr></table>
<b><?php esc_html_e('Additional buttons','arkcommenteditor'); ?></b>
<table><tr><td>
<img src="<?php echo esc_url(plugins_url( '/img/preview.png', __FILE__ )); ?>" title="<?php esc_html_e('Preview','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_preview" value="1" <?php if ((int)($result['btn_preview']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
</td></tr></table>
<hr style='border : 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));'>
<b><?php esc_html_e('Choosing skin for TinyMCE','arkcommenteditor'); ?></b>
<table>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/tinymce/skins/skin.png', __FILE__ )); ?>" title="default" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/tinymce/skins/1/img/skin.png', __FILE__ )); ?>" title="charcoal" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/tinymce/skins/2/img/skin.png', __FILE__ )); ?>" title="pepper-grinder" valign="top">
</td>
</tr>
<tr>
<td>
default&nbsp;<input type="radio" name="tiny_skin" value="0" <?php if ((int)($result['tiny_skin']) == 0) { echo "checked"; } ?> > 
</td>
<td>
charcoal&nbsp;<input type="radio" name="tiny_skin" value="1" <?php if ((int)($result['tiny_skin']) == 1) { echo "checked"; } ?> > 
</td>
<td>
pepper-grinder&nbsp;<input type="radio" name="tiny_skin" value="2" <?php if ((int)($result['tiny_skin']) == 2) { echo "checked"; } ?> > 
</td>
</tr>
<tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/tinymce/skins/3/img/skin.png', __FILE__ )); ?>" title="xenmce" valign="top">
</td>
<td>
<img src="<?php echo esc_url(plugins_url( '/tinymce/skins/4/img/skin.png', __FILE__ )); ?>" title="tundora" valign="top">
</td>
</tr>
<tr>
<td>
xenmce&nbsp;<input type="radio" name="tiny_skin" value="3" <?php if ((int)($result['tiny_skin']) == 3) { echo "checked"; } ?> > 
</td>
<td>
tundora&nbsp;<input type="radio" name="tiny_skin" value="4" <?php if ((int)($result['tiny_skin']) == 4) { echo "checked"; } ?> > 
</td>
</tr>
</table>
<hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<h3><?php esc_html_e('Experimental options','arkcommenteditor'); ?></h3>
<font style="color:red; font-weight:bold;"><?php esc_html_e('These options and their experimental use of a matter of personal preference. Try it - you may like it. If not - at any time, deselect options.','arkcommenteditor'); ?></font>
<table><tr>
<td>
<img src="<?php echo esc_url(plugins_url( '/plugins/arkbquote/img/cite-24.png', __FILE__ )); ?>" title="<?php esc_html_e('Improved button quotes','arkcommenteditor'); ?>" valign="top">  <input type="checkbox" name="btn_arkbquote" value="1" <?php if ((int)($result['btn_arkbquote']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
<?php esc_html_e('This button is in contrast to the standard, put quotes and performs a line feed. This functionality greatly simplifies the insertion of citations and the writing of the text after it.','arkcommenteditor'); ?>
</td>
</tr><tr>
<td>
<b><?php esc_html_e('Use the citation style plugin','arkcommenteditor'); ?></b>&nbsp;<input type="checkbox" name="wce_addbquotestyle" value="1" <?php if ((int)($result['wce_addbquotestyle']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
<?php esc_html_e('The default style quotes of your template. Selecting this option will replace this style style plug. He is such what is there and can not be adjusted. If not work, or just do not like it - deselect.','arkcommenteditor'); ?>
</td>
</tr><tr>
<td><table><tr><td>
<img src="<?php echo esc_url(plugins_url( '/img/sample-quote.png', __FILE__ )); ?>" title="<?php esc_html_e('Sample quote','arkcommenteditor'); ?>" align="left" valign="top"> 
</td><td>&nbsp;&nbsp;<?php esc_html_e('This is just a sample quote.','arkcommenteditor'); ?>
</td></tr></table>
</td>
</tr><tr>
<td>
<b><?php esc_html_e('Use the citation style plug-in editor','arkcommenteditor'); ?></b>&nbsp;<input type="checkbox" name="wce_edtbquotestyle" value="1" <?php if ((int)($result['wce_edtbquotestyle']) == 1) { echo "checked"; } ?>/> &nbsp;&nbsp;
<?php esc_html_e('Selecting this option will allow you to see the formatted quote directly when editing. Valid only on the built-in style plugin.','arkcommenteditor'); ?>
</td>
</tr></table><hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<p class="submit">
<input type="submit" name="save" class="button-primary" value="<?php esc_html_e('Save Changes','arkcommenteditor') ?>" />
<input name="reset" type="submit" class="button-primary" value="<?php esc_html_e('Restore Default Settings','arkcommenteditor') ?>" />
</p>
</form>
<hr style='height: 6px; border: 0; box-shadow: inset 0 6px 6px -6px rgba(0,0,0,0.5);'>
<h3><?php esc_html_e('Thanks','arkcommenteditor'); ?></h3>
<table bgcolor="#fff"><tr>
<td><b>French translation - Laurent</b>&nbsp;&nbsp; </td></tr>
<tr><td><b>Deutsch-Übersetzung - Marcus Brindoepke</b>&nbsp;&nbsp; 
</td></tr></table>
<hr>
</div>	
<?php
}
// Функции плагина
/*Tiny MCE for comment*/
add_action( 'comment_form', 'ark_comment_form');
function ark_comment_form() {
	wp_reset_query();
	$result = get_option('ark_wce');
	if (sanitize_text_field($result['wce_editor']) == 'tinymce') { 
	require_once( 'tinymce_set.php'); 
	} else {
	require_once ('ckeditor_set.php');	
	}
}
function ark_pre_kses( $string ) {
   global $allowedtags;
	$allowedtags['img'] = array( 'src' => true, 'height' => true,'width' => true, 'alt' => true, 'title' => true, );
	$allowedtags['table'] = array( 'border' => true, 'style' => array() );
	$allowedtags['iframe'] = array( 'frameborder' => true, 'allowfullscreen' => true, 'src' => true, 'width' => true, 'height' => true);
	$allowedtags['div'] = array('class' => true);	
	$allowedtags['tbody'] = array('style' => array() );
	$allowedtags['tr'] = array('style' => array() );
	$allowedtags['td'] = array('style' => array() );
	$allowedtags['sub'] = array( );
	$allowedtags['sup'] = array();
	$allowedtags['pre'] = array('lang'  =>  true, 'line'  =>  true );	
	$allowedtags['ul'] = array('style' => array());
	$allowedtags['ol'] = array('style' => array());
	$allowedtags['li'] = array('style' => array());
	$allowedtags['span'] = array('class' => true, 'style' => array() );
	$allowedtags['noindex'] = array();
	$allowedtags['strong'] = array(); 
	$allowedtags['a'] = array('target' => true, 'href' => true, 'title' => true, ); 	
	return $string;
}
add_filter('pre_kses', 'ark_pre_kses');

// Стили
function set_style_arkwce() {
    // Регистрация стилей для плагина:
    wp_register_style( 'ark-commenteditor', esc_url(plugins_url( '/plugins/arkbquote/css/arkbquote.css', __FILE__ )), array(), '20131003', 'all' );
    wp_enqueue_style( 'ark-commenteditor' ); 
} 
$result = get_option('ark_wce');
if ((int)($result['wce_addbquotestyle']) == 1) {
	add_action( 'wp_enqueue_scripts', 'set_style_arkwce' );
}
add_action( 'wp_enqueue_scripts', 'ark_scripts' );
function ark_scripts() {
	wp_enqueue_script('jquery');
}

add_filter( 'comment_reply_link', 'ark_comment_reply_link' );
function ark_comment_reply_link($link) {
	return str_replace( 'onclick=', 'data-onclick=', $link );
}
if (sanitize_text_field($result['wce_editor']) == 'ckeditor') {
	add_action( 'wp_head', 'ark_wp_head_ckeditor' );
}else{
	add_action( 'wp_head', 'ark_wp_head_tiny' );
}	

function ark_wp_head_tiny() {
	?>
		<script type="text/javascript">
			jQuery(function($){
				$('.comment-reply-link').click(function(e){
				e.preventDefault();
 				tinymce.EditorManager.execCommand('mceRemoveEditor', true, 'comment');
				addComment.moveForm.apply( addComment ); 
				tinymce.EditorManager.execCommand('mceAddEditor', true, 'comment');
				});
			});	
		</script>
	<?php
}
function ark_wp_head_ckeditor() {
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('.comment-reply-link').click(function(e){
				e.preventDefault();
				CKEDITOR.instances.comment.destroy();
				addComment.moveForm.apply( addComment );
				CKEDITOR.replace( "comment" );
			});
		});
	</script>
	<?php
}

function ark_wce_set_style_ckeditor() {
	global $snippetcss;
    // Регистрация стилей для плагина:
    wp_register_style( 'codesnippet', esc_url(plugins_url( '/ckeditor/plugins/codesnippet/lib/highlight/styles/'.$snippetcss.'.css', __FILE__ )), array(), '20131003', 'all' );
    wp_enqueue_style( 'codesnippet' ); 
	wp_register_script( 'ark-highlight', esc_url(plugins_url('/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js', __FILE__)) );
    wp_enqueue_script( 'ark-highlight' ); 
} 
if ((int)($result['btn_codesnippet']) == 1) {
	
$snippetcss = $result['codesnippet_css'];
add_action( 'wp_enqueue_scripts', 'ark_wce_set_style_ckeditor' ); 
}
//Remove comment form HTML tags and attributes
$urlterm = esc_url($result['url_terms_of_privacy']);
$urluser = esc_url($result['url_user_agreements']);
$txtbeforeterms = sanitize_text_field($result['txt_before_terms']);
$txtlinkprivacy =sanitize_text_field($result['txt_link_terms']);
$txtagreements = sanitize_text_field($result['txt_link_agreements']);
$txtbetweenlinks = sanitize_text_field($result['txt_and_link']);
if (!empty($urlterm)) {$txtlinkprivacy ='<a href="'.$urlterm.'" target="_blank">'.$txtlinkprivacy.'</a>'; } else {$txtlinkprivacy='';}
if (!empty($urluser)) {$txtagreements ='<a href="'.$urluser.'" target="_blank">'.$txtagreements.'</a>'; } else {$txtagreements='';}
if (!empty($urlterm) || !empty($urluser)){$texturl = '<input type="checkbox" style="width:unset;" checked onchange="document.getElementById('."'submit'".').disabled = !this.checked" />'.$txtbeforeterms.' '.$txtlinkprivacy.' '.$txtbetweenlinks.' '.$txtagreements.'<br>';}else{$texturl='';}
add_filter( 'comment_form_defaults', 'ark_remove_comment_form_allowed_tags' );
function ark_remove_comment_form_allowed_tags( $defaults ) {
global $texturl;
$defaults['comment_notes_after'] = $texturl;
return $defaults;
}
?>