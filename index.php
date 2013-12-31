<?php
/*
  Plugin Name: Sliding Contact Form By Formget
  Plugin URI: http://www.formget.com
  Description:  Sliding Contact Form By Formget is a advance form builder tools. This plugin let you manage your formget account from your wordpress dashboard.
  Version: 1.1
  Author: FormGet
  Author URI: http://www.formget.com
 */
function fg_admin_notice() {
    $fg_iframe_form = get_option('fg_iframe_embed_code');
    $string = "iframe";
    $pos = strpos($fg_iframe_form, $string);
    if ($pos == false) {
        global $current_user;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
        if (!get_user_meta($user_id, 'admin_ignore_notice')) {
            ?>
            <div class="fg_trial-notify">
                <p>
                    <a href='<?php echo admin_url('admin.php?page=fg_page'); ?>'>Click to Create your own Advance Contact Form.</a> You can add your built form to any Page, Post, Sidebar or as a Tabbed Content.<?php printf(__('<a class="fg_hide_notice", href="%1$s">Hide Notice</a>'), '?admin_nag_ignore=0'); ?></p>
            </div>
            <?php
        }
    }
}

add_action('admin_notices', 'fg_admin_notice');

function fg_admin_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if (isset($_GET['admin_nag_ignore']) && '0' == $_GET['admin_nag_ignore']) {
        add_user_meta($user_id, 'admin_ignore_notice', 'true', true);
    }
}

add_action('admin_init', 'fg_admin_nag_ignore');

function fg_delete_user_entry() {
    global $current_user;
    $user_id = $current_user->ID;
    delete_user_meta($user_id, 'admin_ignore_notice', 'true', true);
}

register_deactivation_hook(__FILE__, 'fg_delete_user_entry');

function fg_add_style() {
    wp_enqueue_style('form1_style1_sheet1', plugins_url('css/fgstyle.css', __FILE__));
    wp_enqueue_style('form_style_sheet1', plugins_url('css/formstyle.css', __FILE__));
}

add_action("init", "fg_add_style");


//setting page
add_action('admin_menu', 'fg_menu_page');

function fg_menu_page() {
    add_menu_page('fg', 'Contact Form', 'manage_options', 'fg_page', 'fg_setting_page', plugins_url('image/favicon.ico', __FILE__), 119);
}

function fg_setting_page() {
    $url = plugins_url();
    ?><div id="fg_of_container" class="fg_wrap">
        <form id="fg_ofform" action="" method="POST">
            <div id="fg_header">
                <div class="fg_logo">
                    <h2>Sliding Contact Form By FormGet</h2>                   
                </div>
                <a target="#">
                    <div class="fg_icon-option"> </div>
                </a>
                <div class="clear"></div>
            </div>
            <div id="fg_main">

                <div id="fg_of-nav">
                    <ul>

                        <li> <a class="pn-view-a" href="#pn_content" title="Form Builder">Contact Form Builder </a></li>
                        <li> <a class="pn-view-a" href="#pn_displaysetting" title="Embed Code">Embed Code</a></li>
                        <li> <a class="pn-view-a" href="#pn_template" title="Help">Help</a></li>	
                        <li> <a class="pn-view-a" href="#pn_contactus" title="Help">Plugin Support</a></li>

                    </ul>

                </div>
                <div id="fg_content">
                    <div class="fg_group" id="pn_content">
                        <h2>Contact Form Builder</h2>

                        <div class="fg_section section-text">
                            <h3 class="fg_heading"> Create your custom form by just clicking the fields on left side of the panel. Visibility Problem Click here - <a href="http://www.formget.com/app" target="_blank">Building Contact Form</a></h3>

                            <iframe src="http://www.formget.com/app" name="iframe" id="iframebox" style="width:100%; height:750px; border:1px solid #dfdfdf; align:center;">
                            </iframe>
                        </div>

                    </div>	

                    <div class="fg_group" id="pn_displaysetting">
                        <h2>Embed Code</h2>
                        <div class="fg_section section-text">
                            <h3 class="fg_heading">Click on the tab "Embed Form on Your Site". Copy Iframe code and paste in the below textarea.</h3>
                            <div class="option">
                                <div class="fg_controls">
                                    <textarea name="content[html]" cols="60" rows="10"   class="regular-text"  id="fg_content_html" style="width:900px"><?php embeded_code(); ?></textarea>
                                    <h3 class="fg_heading">Choose the direction to display the tab on your page in the respective direction. </h3>
                                    <div class="direction_box" id="direction_box">
                                        <?php
                                        global $wpdb;
                                        $fg_form_direction = get_option('fg_form_direction');
                                        //echo $fg_form_direction;
                                        echo "</br>";
                                        if ($fg_form_direction == null || $fg_form_direction == "left_side") {
                                            ?>
                                            <label for="fg_leftside">
                                                <input class="directio_value" type="radio" id="fg_leftside" name="fg_form" value="left_side" checked="checked" />Left
                                            </label></br>
                                            <label for="fg_rightside">
                                                <input class="directio_value" type="radio" id="fg_rightside" name="fg_form" value="right_side" />Right
                                            </label></br>
                                            <label for="fg_bottomside">
                                                <input class="directio_value" type="radio" id="fg_bottomside" name="fg_form" value="bottom_side" />Bottom
                                            </label> 

                                        <?php
                                        }
                                        if ($fg_form_direction == "right_side") {
                                            ?>
                                            <label for="fg_leftside">
                                                <input class="directio_value" type="radio" id="fg_leftside" name="fg_form" value="left_side"  />Left
                                            </label></br>
                                            <label for="fg_rightside">
                                                <input class="directio_value" type="radio" id="fg_rightside" name="fg_form" value="right_side" checked="checked" />Right
                                            </label></br>
                                            <label for="fg_bottomside">
                                                <input class="directio_value" type="radio" id="fg_bottomside" name="fg_form" value="bottom_side" />Bottom
                                            </label> 
                                        <?php
                                        }
                                        if ($fg_form_direction == "bottom_side") {
                                            ?>

                                            <label for="fg_leftside">
                                                <input class="directio_value" type="radio" id="fg_leftside" name="fg_form" value="left_side"  />Left
                                            </label></br>
                                            <label for="fg_rightside">
                                                <input class="directio_value" type="radio" id="fg_rightside" name="fg_form" value="right_side"  />Right
                                            </label></br>
                                            <label for="fg_bottomside">
                                                <input class="directio_value" type="radio" id="fg_bottomside" name="fg_form" value="bottom_side" checked="checked" />Bottom
                                            </label> 		

    <?php } ?>
                                    </div></br> </br>
                                    
                                    <div class="color_selector">
                                        <h3 class="fg_heading">Paste or Select the background color that will complement your form</h3>
                                        <?php 
                                          global $wpdb;
        $bg_color_value = get_option('fg_form_bgcolor');
                                        ?>
                                   <input class="color {hash:true,caps:false}" value="<?php echo $bg_color_value; ?>" >
                                   </div><br /><br />
                                    <input id="submit-form" class="fg_embed_code_save button-primary" type="button" value="Save Changes" name="submit_form" style="display:none;"><br />			
                                    <div id="loader_img" align="center" style="margin-left:460px; display:none;">
                                        <img src="<?php echo plugins_url('image/ajax-loader.gif', __FILE__); ?>">
                                    </div>
                                      
                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="fg_group" id="pn_template">
                        <h2>Steps to use FormGet Contact Form Plugin</h2>

                        <div class="fg_section section-text">
                            <h3></h3>
                            <div id="help_txt" style="width:900px;">
                               <img src="<?php echo plugins_url('image/help_img.png', __FILE__); ?>"><br /><br />
                                    <div style="font-size:15px;"> <b> Thanks,</br>
                                            FormGet Team</i></b></div>
                            </div>
                        </div>

                    </div>


                    <div class="fg_group" id="pn_contactus">
                        <iframe height='570' allowTransparency='true' frameborder='0' scrolling='no' style='width:100%;border:none'  src='http://www.formget.com/app/embed/form/qQvs-639'>Your Contact </iframe>

                    </div>	

                </div>
                <div class="clear"></div>
            </div>

            <div class="fg_save_bar_top">



            </div>

        </form>
    </div>


    <?php
}
 function fg_colorpicker_script(){
    wp_enqueue_script('colorpicker_script', plugins_url('jscolor/jscolor.js', __FILE__), array('jquery'));
}
add_action('init', 'fg_colorpicker_script');
function fg_embeded_script() {
    wp_enqueue_script('embeded_script', plugins_url('js/fg_script.js', __FILE__), array('jquery'));
    wp_localize_script('embeded_script', 'script_call', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('init', 'fg_embeded_script');
function fg_text_ajax_process_request() {
    $text_value = $_POST['value'];
    $form_direction = $_POST['direction'];
    $form_background_color = $_POST['color'];
    update_option('fg_iframe_embed_code', $text_value);
    update_option('fg_form_direction', $form_direction);
     update_option('fg_form_bgcolor',  $form_background_color);
    echo 1;
    die();
}
add_action('wp_ajax_master_response', 'fg_text_ajax_process_request');
add_action('wp_ajax_nopriv_master_response', 'fg_text_ajax_process_request');

function fg_toggle_script() {
    wp_enqueue_script('toggle_script', plugins_url('js/toggle_script.js', __FILE__), array('jquery'));
}
add_action('init', 'fg_toggle_script');

if (!function_exists('embeded_code')) {

    function embeded_code() {
        global $wpdb;
        $fg_iframe_form = get_option('fg_iframe_embed_code');
        $string = "iframe";
        $pos = strpos($fg_iframe_form, $string);
        if ($pos == true) {
            echo stripslashes($fg_iframe_form);
        }
    }
}
if (!function_exists('display_iframe_form')) {

    function display_iframe_form() {
        global $wpdb;
        $fg_iframe_form = get_option('fg_iframe_embed_code');
        $fg_form_direction = get_option('fg_form_direction');
        $form_bg_color = get_option('fg_form_bgcolor');
        $string = "iframe";
        $pos = strpos($fg_iframe_form, $string);
        if ($pos == true) {
            if ($fg_form_direction == "right_side") {
                ?>
                <div class="fg_left_form_container">
                    <div class="left_toggle_first">
                        <div class="fg_left_contact_button" id="fg_left_contact_button">
                            <img src="http://www.formget.com/app/code/contact_tab?c=Contact Us&amp;t_color=ffffff&amp;b_color=7d9f2b&amp;f_size=18" alt="Feedback &amp; Support" style="border:0; background-color: transparent; padding-left:7px; margin:0; padding-top: 40px;">
                        </div>
                    </div>   
                    <div class="left_toggle_second">
                        <div class="fg_left_form_display" id="fg_left_form_display" style="overflow-y: scroll; background-color:<?php echo $form_bg_color; ?>">
                <?php
                echo stripslashes($fg_iframe_form);
                ?>

                        </div>
                    </div>
                </div>
                <?php
            }
            if ($fg_form_direction == "left_side") {
                ?>
                <div class="fg_right_form_container">
                    <div class="right_toggle_first">
                        <div class="fg_right_contact_button" id="fg_right_contact_button">
                            <img src="http://www.formget.com/app/code/contact_tab?c=Contact Us&amp;t_color=ffffff&amp;b_color=7d9f2b&amp;f_size=18" alt="Feedback &amp; Support" style="border:0; background-color: transparent; padding-left:4px; margin:0; padding-top: 40px;">
                        </div>
                    </div>   
                    <div class="right_toggle_second">
                        <div class="fg_right_form_display" id="fg_right_form_display" style="overflow-y: scroll; background-color:<?php echo $form_bg_color; ?>" >

                <?php
                echo stripslashes($fg_iframe_form);
                ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            if ($fg_form_direction == "bottom_side") {
                ?>
                <div class="fg_bottom_form_container">
                    <div class="bottom_toggle_first">
                        <div class="fg_bottom_contact_button" id="fg_bottom_contact_button">
                            <img src="<?php echo plugins_url('image/contact_tab.png', __FILE__); ?>" style="border:0; background-color: transparent; padding-left:40px; margin:0; padding-top: 11px; color: ffffff; font-size:18px; ">

                        </div>
                    </div>   
                    <div class="bottom_toggle_second">
                       
                        <div class="fg_bottom_form_display" id="fg_bottom_form_display" style="overflow-y: scroll; background-color:<?php echo $form_bg_color; ?>" >
                <?php
               echo stripslashes($fg_iframe_form);
                
                ?>
                           
                        </div>
                    </div>
                </div> <?php
            }
        }
    }

}
add_action('wp_head', 'display_iframe_form');

//schort code function
if (!function_exists('formget_shortcode')) {

    function formget_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'user' => '',
            'formcode' => '',
            'allowTransparency' => true,
            'height' => '500',
            'tab' => ''
                        ), $atts));
        $iframe_formget = '';
        $url = "http://www.formget.com/app/embed/form/" . $formcode;
        if ($tab == 'page') {
            $iframe_formget .="<iframe height='" . $height . "' allowTransparency='true' frameborder='0' scrolling='no' style='width:100%;border:none'  src='" . $url . "' >";
            $iframe_formget .="</iframe>";
            add_filter('widget_text', 'do_shortcode');
            return $iframe_formget;
        }
        if ($tab == 'tabbed') {
            $tabbed_formget = <<<EOD
<script type="text/javascript">
    var sideBar;
    (function(d, t) {
        var s = d.createElement(t),
                options = {
            'tabKey': '{$formcode}',
            'tabtext':'Contact Us',
            'height': '{$height}',
            'position': "",
            'textColor': 'ffffff',
            'tabColor': '7d9f2b',
            'fontSize': '16',
        };
        s.src = 'http://www.formget.com/app/app_data/user_js/widget.js';
        s.onload = s.onreadystatechange = function() {
            var rs = this.readyState;
            if (rs)
                if (rs != 'complete')
                    if (rs != 'loaded')
                        return;
            try {
                sideBar = new buildTabbed();
                sideBar.initializeOption(options);
                sideBar.loadContent();
                sideBar.buildHtml();
            } catch (e) {
            }
        };
        var scr = d.getElementsByTagName(t)[0], par = scr.parentNode;
        par.insertBefore(s, scr);
    })(document, 'script');
</script>
EOD;
            return $tabbed_formget;
        }
    }

}
add_shortcode('formget', 'formget_shortcode');
?>