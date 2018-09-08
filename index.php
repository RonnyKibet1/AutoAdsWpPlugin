<?php
/*
Plugin Name: Auto Ads
Plugin URI: http://codedeveloped.blogspot.com/2018/09/adsense-auto-ads-wordpress-plugin.html
Description: Add Google Adsense Auto Ads To All Pages.
Version: 0.1.0
Author: Ronny K
Author URI: http://codedeveloped.blogspot.com/2018/09/adsense-auto-ads-wordpress-plugin.html
*/


//add google adsense auto ads to wp_head
function add_auto_ads() {
    ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({
                  google_ad_client: "<?php echo esc_attr( get_option('auto_ads_code')); ?>",
                  enable_page_level_ads: true
             });
        </script>
    <?php
}
add_action('wp_head', 'add_auto_ads');

// create custom plugin settings menu
add_action('admin_menu', 'auto_ads_create_menu');

function auto_ads_create_menu() {

  //create new top-level menu
  add_menu_page('Auto Ads', 'Auto Ads', 'administrator', __FILE__, 'auto_ads_settings_page' , plugins_url('/images/money.png', __FILE__) );

  //call register settings function
  add_action( 'admin_init', 'register_auto_ads_settings' );
}


function register_auto_ads_settings() {
  //register our settings
  register_setting( 'auto_ads-settings-group', 'auto_ads_code' );
  register_setting( 'auto_ads-settings-group', 'some_other_option' );
  register_setting( 'auto_ads-settings-group', 'option_etc' );
}

function auto_ads_settings_page() {
?>
<div class="wrap">
<h1>Auto Ads</h1>
<h4>Note: It may take 10 to 20 minutes for Adsense Auto Ads to display on your site.</h4>

<form method="post" action="options.php">
    <?php settings_fields( 'auto_ads-settings-group' ); ?>
    <?php do_settings_sections( 'auto_ads-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Adsense Auto Ads</th>
        <td><input type="text" style="background: black; color: orange; width: 20%;" name="auto_ads_code" value="<?php echo esc_attr( get_option('auto_ads_code') ); ?>"/>
        </tr>
         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>