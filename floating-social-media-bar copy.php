<?php
/*
Plugin Name: Social Media Floating Plugin
Description: A simple floating social media icon (Facebook, Twitter, Instagram, YouTube, WhatsApp, Email, LinkedIn, Pinterest) on every page with customizable.
Version: 1.0
Author: Sujoy Sen
*/

// Register settings page
function floating_plugin_menu() {
    add_options_page('Floating Plugin Settings', 'Floating Plugin', 'manage_options', 'floating-plugin-settings', 'floating_plugin_settings_page');
}
add_action('admin_menu', 'floating_plugin_menu');

// Register settings
function floating_plugin_settings() {
    register_setting('floating-plugin-settings-group', 'facebook_link');
    register_setting('floating-plugin-settings-group', 'facebook_color', array(
        'default' => '#3b5998',
    ));
    register_setting('floating-plugin-settings-group', 'twitter_link');
    register_setting('floating-plugin-settings-group', 'twitter_color', array(
        'default' => '#1da1f2',
    ));
    register_setting('floating-plugin-settings-group', 'instagram_link');
    register_setting('floating-plugin-settings-group', 'instagram_color', array(
        'default' => '#c13584',
    ));
    // Add more social media links or customize settings as needed
    register_setting('floating-plugin-settings-group', 'youtube_link');
    register_setting('floating-plugin-settings-group', 'youtube_color', array(
        'default' => '#ff0000',
    ));
    register_setting('floating-plugin-settings-group', 'whatsapp_link');
    register_setting('floating-plugin-settings-group', 'whatsapp_color', array(
        'default' => '#25D366',
    ));
    register_setting('floating-plugin-settings-group', 'email_link');
    register_setting('floating-plugin-settings-group', 'email_color', array(
        'default' => '#f30200',
    ));
    register_setting('floating-plugin-settings-group', 'linkedin_link');
    register_setting('floating-plugin-settings-group', 'linkedin_color', array(
        'default' => '#0077B5',
    ));
    register_setting('floating-plugin-settings-group', 'pinterest_link');
    register_setting('floating-plugin-settings-group', 'pinterest_color', array(
        'default' => '#BD081C',
    ));

    // New settings for position
    register_setting('floating-plugin-settings-group', 'floating_vertical_position', array(
        'default' => 'bottom',
    ));
    register_setting('floating-plugin-settings-group', 'floating_horizontal_position', array(
        'default' => 'right',
    ));

    // New setting for icon size
    register_setting('floating-plugin-settings-group', 'floating_icon_size', array(
        'default' => '20',
    ));
}
add_action('admin_init', 'floating_plugin_settings');

// Settings page content
function floating_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1 style="text-align:center;">Floating Plugin Settings</h1>

        <form method="post" action="options.php">
            <?php settings_fields('floating-plugin-settings-group'); ?>
            <?php do_settings_sections('floating-plugin-settings-group'); ?>

            <hr />

            <table class="form-table">
                <!-- Existing settings -->
                <h2>Social Media Links</h2>
                <tr valign="top">
                    <th scope="row">Facebook Link</th>
                    <td><input type="text" name="facebook_link" value="<?php echo esc_attr(get_option('facebook_link')); ?>" /></td>
                    <td><input type="color" name="facebook_color" value="<?php echo esc_attr(get_option('facebook_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Twitter Link</th>
                    <td><input type="text" name="twitter_link" value="<?php echo esc_attr(get_option('twitter_link')); ?>" /></td>
                    <td><input type="color" name="twitter_color" value="<?php echo esc_attr(get_option('twitter_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Instagram Link</th>
                    <td><input type="text" name="instagram_link" value="<?php echo esc_attr(get_option('instagram_link')); ?>" /></td>
                    <td><input type="color" name="instagram_color" value="<?php echo esc_attr(get_option('instagram_color')); ?>" /></td>
                </tr>
                <!-- Add more social media links and color settings as needed -->
                <tr valign="top">
                    <th scope="row">YouTube Link</th>
                    <td><input type="text" name="youtube_link" value="<?php echo esc_attr(get_option('youtube_link')); ?>" /></td>
                    <td><input type="color" name="youtube_color" value="<?php echo esc_attr(get_option('youtube_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">WhatsApp Link</th>
                    <td><input type="text" name="whatsapp_link" value="<?php echo esc_attr(get_option('whatsapp_link')); ?>" /></td>
                    <td><input type="color" name="whatsapp_color" value="<?php echo esc_attr(get_option('whatsapp_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email Link</th>
                    <td><input type="text" name="email_link" value="<?php echo esc_attr(get_option('email_link')); ?>" /></td>
                    <td><input type="color" name="email_color" value="<?php echo esc_attr(get_option('email_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">LinkedIn Link</th>
                    <td><input type="text" name="linkedin_link" value="<?php echo esc_attr(get_option('linkedin_link')); ?>" /></td>
                    <td><input type="color" name="linkedin_color" value="<?php echo esc_attr(get_option('linkedin_color')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Pinterest Link</th>
                    <td><input type="text" name="pinterest_link" value="<?php echo esc_attr(get_option('pinterest_link')); ?>" /></td>
                    <td><input type="color" name="pinterest_color" value="<?php echo esc_attr(get_option('pinterest_color')); ?>" /></td>
                </tr>
            </table>

            <hr />

            <table class="form-table">
                 <!-- New settings for position -->
                 <h2>Display Options</h2>
                 <tr valign="top">
                    <th scope="row">Vertical Position</th>
                    <td>
                        <select name="floating_vertical_position">
                            <option value="top" <?php selected(get_option('floating_vertical_position'), 'top'); ?>>Top</option>
                            <option value="center" <?php selected(get_option('floating_vertical_position'), 'center'); ?>>Center</option>
                            <option value="bottom" <?php selected(get_option('floating_vertical_position'), 'bottom'); ?>>Bottom</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Horizontal Position</th>
                    <td>
                        <select name="floating_horizontal_position">
                            <option value="left" <?php selected(get_option('floating_horizontal_position'), 'left'); ?>>Left</option>
                            <option value="right" <?php selected(get_option('floating_horizontal_position'), 'right'); ?>>Right</option>
                        </select>
                    </td>
                </tr>

                <!-- New setting for icon size -->
                <tr valign="top">
                    <th scope="row">Icon Size</th>
                    <td><input type="number" name="floating_icon_size" value="<?php echo esc_attr(get_option('floating_icon_size', '20')); ?>" /></td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Your plugin code goes here

function enqueue_floating_scripts() {
    // Enqueue Font Awesome CSS
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_floating_scripts');

function add_floating_element() {
    ?>
    <style>
        #floating-element {
            position: fixed;
            <?php
            $vertical_position = get_option('floating_vertical_position', 'bottom');
            $horizontal_position = get_option('floating_horizontal_position', 'right');
            if ($vertical_position === 'center') {
                echo 'top: 50%;';
                echo 'transform: translateY(-50%);';
            } else {
                echo $vertical_position . ': 20px;';
            }
            echo $horizontal_position . ': 20px;';
            ?>
        }
        #floating-element .social-icons a i {
            font-size: <?php echo esc_attr(get_option('floating_icon_size', '20')); ?>px;
        }
        #floating-element .social-icons a i.fa-facebook {
            color: <?php echo esc_attr(get_option('facebook_color')); ?>;
        }
        #floating-element .social-icons a i.fa-instagram {
            color: <?php echo esc_attr(get_option('instagram_color')); ?>;
        }
        #floating-element .social-icons a i.fa-twitter {
            color: <?php echo esc_attr(get_option('twitter_color')); ?>;
        }
        #floating-element .social-icons a i.fa-youtube {
            color: <?php echo esc_attr(get_option('youtube_color')); ?>;
        }
        #floating-element .social-icons a i.fa-whatsapp {
            color: <?php echo esc_attr(get_option('whatsapp_color')); ?>;
        }
        #floating-element .social-icons a i.fa-envelope {
            color: <?php echo esc_attr(get_option('email_color')); ?>;
        }
        #floating-element .social-icons a i.fa-linkedin {
            color: <?php echo esc_attr(get_option('linkedin_color')); ?>;
        }
        #floating-element .social-icons a i.fa-pinterest {
            color: <?php echo esc_attr(get_option('pinterest_color')); ?>;
        }
        /* Add more styles for other social media icons as needed */
    </style>
    <div id="floating-element">
        <!-- Social Media Icons with Font Awesome -->
        <div class="social-icons" style="margin-bottom:5px;">
            <?php if (get_option('facebook_link')) : ?>
                <a href="<?php echo esc_url(get_option('facebook_link')); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">
            <?php if (get_option('instagram_link')) : ?>
                <a href="<?php echo esc_url(get_option('instagram_link')); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>
        </div>  
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('twitter_link')) : ?>
                <a href="<?php echo esc_url(get_option('twitter_link')); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('youtube_link')) : ?>
                <a href="<?php echo esc_url(get_option('youtube_link')); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('whatsapp_link')) : ?>
                <a href="https://wa.me/<?php echo esc_attr(get_option('whatsapp_link')); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('email_link')) : ?>
                <a href="mailto:<?php echo esc_attr(get_option('email_link')); ?>" target="_blank"><i class="far fa-envelope"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('linkedin_link')) : ?>
                <a href="<?php echo esc_url(get_option('linkedin_link')); ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
            <?php endif; ?>
        </div>
        <div class="social-icons" style="margin-bottom:5px;">  
            <?php if (get_option('pinterest_link')) : ?>
                <a href="<?php echo esc_url(get_option('pinterest_link')); ?>" target="_blank"><i class="fab fa-pinterest"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

add_action('wp_footer', 'add_floating_element');
?>
