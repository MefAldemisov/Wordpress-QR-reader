<?php
/*
    Plugin Name: Qr-reader
    Description: Button with qr code for user
    Author: MefAldemisov
    Version: 1.0
    */

define('QR_SHORTCODE_NAME', 'qr-reader');


function qr_reader_admin()
{
    include('admin_page.php');
}

function qr_reader_admin_actions()
{
    add_options_page("QR-reader", "QR-reader", 1, "QR-reader", "qr_reader_admin");
}

add_action('admin_menu', 'qr_reader_admin_actions');

function settings_js()
{
    $btn_text =  get_option('qr_reader_btn_text');
    $error_text = get_option('qr_reader_error_text');
    $redirect_text = get_option('qr_reader_redirect_text');

    $js_text = 'const settings = {
        "btn_text": "' . $btn_text . '",
        "error": "' . $error_text . '",
        "redirect_text": "' . $redirect_text . '"
    };';
    // write settings

    $file_name = __DIR__ . '/settings.js';
    $fp = fopen($file_name, 'w');
    fwrite($fp, $js_text);   // here it will print the array pretty
    fclose($fp);
}

//Return string for shortcode
function func_wp_vue()
{
    settings_js();
    $js_settings_src =  plugin_dir_url(__FILE__) . '/settings.js';
    $vendor_src = plugin_dir_url(__FILE__) . './interface/qr_reader/dist/js/chunk-vendors.b52e927d.js';
    $js_src = plugin_dir_url(__FILE__) . './interface/qr_reader/dist/js/app.31ae216a.js';

    wp_enqueue_script('js_settings', $js_settings_src);
    //Add Vue.js
    wp_enqueue_script('wpvue_vuejs',  $vendor_src, array('js_settings'));
    //Add my code to it
    wp_enqueue_script('my_vuecode', $js_src, array('js_settings'));

    //Build String
    $str = '
    <script src=' . $js_settings_src . '></script>
    <script src=' . $vendor_src . '></script>
    <script src=' . $js_src . '></script>
  <div id="app" style="margin-bottom:1.5rem;"></div>';

    //Return to display
    return $str;
} // end function

//Add shortcode to WordPress
add_shortcode(QR_SHORTCODE_NAME, 'func_wp_vue');
