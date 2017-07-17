<?php
/*

Plugin Name: Dashboard Links v2
Plugin URI: http://www.trottyzone.com/wordpress-dashboard-links-terminator/
Description: Simply tool that Replaces the WordPress logo image with Your own Content or remove links totally.
Version: 2.2
Author: Ephrain Marchan
Author URI: http://www.trottyzone.com
License: GPL2 or Later
*/

/*

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

if ( ! defined( 'ABSPATH' ) ) die();

// Hook for adding admin menus
if ( is_admin() ){ // admin actions and filters

  // Hook for adding admin menu
  add_action( 'admin_menu', 'dl_op_page' );

// Hook to fire farbtastic includes for using built in WordPress color picker functionality
	add_action('admin_enqueue_scripts', 'dl_farbtastic_script');

} else { // non-admin enqueues, actions, and filters

}
// Include WordPress color picker functionality
function dl_farbtastic_script($hook) {

	// only enqueue farbtastic on the plugin settings page
	if( $hook != 'settings_page_dlsettings' ) 
		return;


	// load the style and script for farbtastic
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
        wp_enqueue_media();

}

// action function for above hook
function dl_op_page() {

    // Add a new submenu under Settings:
    add_options_page('Dashboard Links v2 Settings','Dashboard Links v2', 'manage_options', 'dlsettings', 'dl_settings_page');

// settings page
function dl_settings_page() {

    //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }


// variables
$dl_hidden_field_name = 'dl_hidden_ting';
$hidden_name_dl = 'hidden_name_d';
$hidden_link_dl = 'hidden_link_d';
$new_name_dl = 'call_name_dl';
$new_link_dl = 'call_link_dl';
$new_bc_color_dl = 'call_bc_color_dl';
$new_tx_color_dl = 'call_tx_color_dl';
$new_bc_image_dl = 'call_bc_image_dl';
$hidden_bc_color_dl = 'hidden_color_d';
$hidden_tx_color_dl = 'hidden_tx_d';
$hidden_bc_image_dl = 'hidden_image_d';
$hidden_ho_color_dl = 'hidden_color_ho_d';
$new_ho_color_dl = 'ho_color_d';
$new_ho_bg_dl = 'ho_bg_d';
$hidden_ho_bg_dl = 'hidden_bg_ho_d';



// read existing values
$name_dl = get_option( $new_name_dl );
$link_dl = get_option( $new_link_dl );
$bc_color_dl = get_option( $new_bc_color_dl );
$tx_color_dl = get_option( $new_tx_color_dl );
$bc_image_dl = get_option( $new_bc_image_dl );
$ho_color_dl = get_option( $new_ho_color_dl );
$ho_bg_dl = get_option( $new_ho_bg_dl );

// populate fields
if (empty ($bc_color_dl) ) {
$bc_color_dl = '#222';
}
if (empty ($tx_color_dl) ) {
$tx_color_dl = '#ccc';
}
if (empty ($ho_bg_dl) ) {
$ho_bg_dl = '#222';
}
if (empty ($ho_color_dl) ) {
$ho_color_dl = '#fafafa';
}

// See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'

    if( isset($_POST[ $dl_hidden_field_name ]) && $_POST[ $dl_hidden_field_name ] == 'Y' ) {

// Read their posted value
       $name_dl = $_POST[ $hidden_name_dl ];
       $link_dl = $_POST[ $hidden_link_dl ];
       $bc_color_dl = $_POST[ $hidden_bc_color_dl ];
       $tx_color_dl = $_POST[ $hidden_tx_color_dl ];
       $bc_image_dl = $_POST[ $hidden_bc_image_dl ];
       $ho_color_dl = $_POST[ $hidden_ho_color_dl ];
       $ho_bg_dl = $_POST[ $hidden_ho_bg_dl ];
        add_option('checkboxhf', TRUE);

// Save the posted value in the database
        update_option( $new_name_dl, $name_dl );  
        update_option($new_link_dl, $link_dl ); 
        update_option($new_bc_color_dl, $bc_color_dl );
        update_option($new_tx_color_dl, $tx_color_dl );
        update_option($new_bc_image_dl, $bc_image_dl );
        update_option($new_ho_color_dl, $ho_color_dl );
        update_option($new_ho_bg_dl, $ho_bg_dl );
        update_option('dl_checkboxhf', (bool) $_POST["dl_checkboxhf"]); 

    
?>

<div class="updated"><p><strong><?php _e('Settings Saved. Please go to site or navigate away from this screen for effects to place.' ); ?></strong></p></div>

<?php 

    }


    // Now display the settings editing screen

    echo '<div class="wrap">';
    
    // icon for settings
       echo '<div id="icon-plugins" class="icon32"></div>'; 

    // header

    echo "<h2>" . __( 'Dashboard Links v2 Settings' ) . "</h2>";

    
    ?>

<form name="form1" method="post" action="">

<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#colorpicker1').hide();
			jQuery('#colorpicker1').farbtastic("#color1");
			jQuery("#color1").click(function(){jQuery('#colorpicker1').slideToggle()});
		});

		jQuery(document).ready(function() {
			jQuery('#colorpicker2').hide();
			jQuery('#colorpicker2').farbtastic("#color2");
			jQuery("#color2").click(function(){jQuery('#colorpicker2').slideToggle()});
		});     
                jQuery(document).ready(function() {
			jQuery('#colorpicker3').hide();
			jQuery('#colorpicker3').farbtastic("#color3");
			jQuery("#color3").click(function(){jQuery('#colorpicker3').slideToggle()});
		});

		jQuery(document).ready(function() {
			jQuery('#colorpicker4').hide();
			jQuery('#colorpicker4').farbtastic("#color4");
			jQuery("#color4").click(function(){jQuery('#colorpicker4').slideToggle()});
		}); 
 
 
   jQuery(document).ready(function($){
 
 
    var custom_uploader;
 
 
    $('#upload_image_button1').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image1').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
 
 
});
                  
	</script>



<table class="widefat" border="1">

<tr valign="top">
			<th scope="row" colspan="2" width="33%">
<h4>WordPress Themes and Plugins Support: <a href="http://www.trottyzone.com/forums/forum/website-support/">Visit Our Forum</a>.</h4>
</th>
			<td width="33%">

			</td>
		</tr>
			                           
<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Name :</th>
			<td width="39%"><input class="widefat" type="text" value="<?php echo esc_attr( $name_dl ); ?>" name="<?php echo $hidden_name_dl; ?>"></td>
		</tr>


<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Link :</th>
			<td width="33%"><input class="widefat" type="text" value="<?php echo esc_attr( $link_dl ); ?>" name="<?php echo $hidden_link_dl; ?>">
<br>URL Address. Example of link <code>http://www.trottyzone.com</code></td>
		</tr>

<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
<th scope="row">Choose Image</th>
<td><label for="upload_image">
<input id="upload_image1" type="text" size="36" name="<?php echo $hidden_bc_image_dl; ?>" value="<?php echo $bc_image_dl; ?>" /> 
<input id="upload_image_button1" class="button" type="button" value="Upload Image" />
<br />Enter an URL, upload or select an existing image for the logo. Image Size 31 x 27 .
</label></td>
</tr>


	<table class="widefat" border="1">
<tr valign="top">
<th scope="row" colspan="2" width="33%">
<td width="33%" rowspan="4" >
                                <div id="colorpicker1"></div>
				<div id="colorpicker2"></div>
				<div id="colorpicker3"></div>
                                <div id="colorpicker4"></div>	
</td>
</tr>	
<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Color :</th>
			<td width="100%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $tx_color_dl ); ?>" name="<?php echo $hidden_tx_color_dl; ?>"  id="color1" /></td>
		</tr>

<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Background color :</th>
			<td width="100%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $bc_color_dl ); ?>" name="<?php echo $hidden_bc_color_dl; ?>" id="color2" /> </td>
		</tr>

<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Hover over color effect:</th>
			<td width="100%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $ho_color_dl ); ?>" name="<?php echo $hidden_ho_color_dl; ?>" id="color3" /> </td>
		</tr>

<tr valign="top">
<input type="hidden" name="<?php echo $dl_hidden_field_name; ?>" value="Y">
			<th scope="row">Hover over background effect:</th>
			<td width="100%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $ho_bg_dl ); ?>" name="<?php echo $hidden_ho_bg_dl; ?>" id="color4" /> </td>
		</tr>


<tr valign="top">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<td width="33%"><?php _e("Check to Disable Links completely: " ); ?>
<input type="checkbox" name="dl_checkboxhf" value="dl_checkbox" <?php if (get_option('dl_checkboxhf')) echo "checked='checked'"; ?> /></td>


<td width="33%"><div style="float:left;"><?php submit_button(); ?></div>
</form>

<div style="display:block;float:left;font-weight:700;color:red;">
PLEASE <a href="http://www.trottyzone.com/donate/">DONATE </a><3 HAVE A HEART :)
<form style="margin-bottom:-10px;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5TFAJB5686N8L">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</td></tr>

</table>
<?php }}

function dashboard_links_removal() {

echo '<style type="text/css">
#wp-admin-bar-wp-logo div.ab-sub-wrapper {
display: none !important;
}
#wp-admin-bar-wp-logo .ab-item:hover, #wp-admin-bar-wp-logo .ab-item.ab-empty-item:hover{
color: '.get_option('ho_color_d').' !important;
background: '.get_option('ho_bg_d').' !important;
background-position: 1px 0 !important;
border-right: solid 1px #333 !important;
color: #fafafa;
background: #222;
background-image: -webkit-gradient(linear,left bottom,left top,from(#3a3a3a),to(#222));
background-image: -webkit-linear-gradient(bottom,#3a3a3a,#222);
background-image: -moz-linear-gradient(bottom,#3a3a3a,#222);
background-image: -o-linear-gradient(bottom,#3a3a3a,#222);
background-image: linear-gradient(to top,#3a3a3a,#222);
}
#wp-admin-bar-wp-logo a, #wp-admin-bar-wp-logo .ab-item.ab-empty-item {
color: '.get_option('call_tx_color_dl').' !important;
background-color: '.get_option('call_bc_color_dl').' !important;
background-image: url("'.get_option('call_bc_image_dl').'") !important;
background-position: 1px 0 !important;
border-right: solid 1px #333 !important;
}
</style>';

$dl_str = <<<enjoy_hold_dl
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery("#wp-admin-bar-wp-logo a").attr('title', '');
jQuery("#wp-admin-bar-wp-logo .ab-item.ab-empty-item").attr('title', '');
});
</script>
enjoy_hold_dl;

echo $dl_str;

        global $wp_admin_bar;

if(True== get_option('dl_checkboxhf')) {
        $wp_admin_bar->remove_menu('wp-logo');
}
else 
{
        $wp_admin_bar->add_menu( array(
            'id'    => 'wp-logo',
            'title' => get_option('call_name_dl'),
            'href'  => get_option('call_link_dl')

        ));  
        $wp_admin_bar->remove_menu('about');
        $wp_admin_bar->remove_menu('wporg');
        $wp_admin_bar->remove_menu('documentation');
        $wp_admin_bar->remove_menu('support-forums');
        $wp_admin_bar->remove_menu('feedback');
        $wp_admin_bar->remove_menu('view-site');

    }}
add_action( 'wp_before_admin_bar_render', 'dashboard_links_removal');
add_action( 'wp_before_admin_bar_render', 'strip_tags');