<?php
/*
Plugin Name: Nicedit For Wordpress
Plugin URI: http://www.4shared.com/file/44141246/29140ec3/nicedit_for_wordpress.html
Description: Replaces the default Wordpress editor with <a href="http://www.nicedit.com/"> Nicedit</a>
Version: 0.1
Author: kalapacengkir
Author URI: http://sekeluarga.net
*/

/* put 2 lines to admin header */
function add_admin_head() {
?>
  <script type="text/javascript" src="<?php echo get_settings('home'); ?>/wp-content/plugins/nicedit_for_wordpress/nicEdit.js"></script>
  <style type="text/css">#quicktags { display: none; }</style>
<?php
}

/* load Nicedit as replacement on editing post/page */
function load_nicedit() {
?>
  <script type="text/javascript">
    bkLib.onDomLoaded(function() {
      new nicEditor({fullPanel : true, iconsPath : '/wp-content/plugins/nicedit_for_wordpress/nicEditorIcons.gif'}).panelInstance('content');
    });
  </script>
<?php
}

/* activation hook */
function deactivate() {
  global $current_user;
  update_user_option($current_user->id, 'rich_editing', 'true', true);
}

/* deactivation hook */
function activate() {
  global $current_user;
  update_user_option($current_user->id, 'rich_editing', 'false', true);
}

/* just do it */
add_action('admin_head', 'add_admin_head');
add_action('edit_form_advanced', 'load_nicedit');
register_activation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), 'activate');
register_deactivation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), 'deactivate');
?>