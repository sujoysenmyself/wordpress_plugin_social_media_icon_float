<?php
/*
Plugin Name: Social Media Floating Plugin
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
    register_setting('floating-plugin-settings-group', 'facebook_icon_size', array(
        'default' => '20',
    ));
    register_setting('floating-plugin-settings-group', 'facebook_icon_shape', array(
        'default' => 'square',
    ));
    register_setting('floating-plugin-settings-group', 'instagram_link');
    register_setting('floating-plugin-settings-group', 'instagram_color', array(
        'default' => '#c13584',
    ));
    register_setting('floating-plugin-settings-group', 'instagram_icon_size', array(
        'default' => '20',
    ));
    register_setting('floating-plugin-settings-group', 'instagram_icon_shape', array(
        'default' => 'square',
    ));

    // test start

    register_setting('floating-plugin-settings-group', 'twitter_link');
    register_setting('floating-plugin-settings-group', 'twitter_color', array(
        'default' => '#3b5998',
    ));
    register_setting('floating-plugin-settings-group', 'twitter_icon_size', array(
        'default' => '20',
    ));
    register_setting('floating-plugin-settings-group', 'twitter_icon_shape', array(
        'default' => 'square',
    ));

    // test end


    // New settings for position
    register_setting('floating-plugin-settings-group', 'floating_vertical_position', array(
        'default' => 'bottom',
    ));
    register_setting('floating-plugin-settings-group', 'floating_horizontal_position', array(
        'default' => 'right',
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
                    <td><input type="number" name="facebook_icon_size" value="<?php echo esc_attr(get_option('facebook_icon_size', '20')); ?>" /></td>
                    <td>
                        <select name="facebook_icon_shape">
                            <option value="square" <?php selected(get_option('facebook_icon_shape'), 'square'); ?>>Square</option>
                            <option value="circle" <?php selected(get_option('facebook_icon_shape'), 'circle'); ?>>Circle</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Instagram Link</th>
                    <td><input type="text" name="instagram_link" value="<?php echo esc_attr(get_option('instagram_link')); ?>" /></td>
                    <td><input type="color" name="instagram_color" value="<?php echo esc_attr(get_option('instagram_color')); ?>" /></td>
                    <td><input type="number" name="instagram_icon_size" value="<?php echo esc_attr(get_option('instagram_icon_size', '20')); ?>" /></td>
                    <td>
                        <select name="instagram_icon_shape">
                            <option value="square" <?php selected(get_option('instagram_icon_shape'), 'square'); ?>>Square</option>
                            <option value="circle" <?php selected(get_option('instagram_icon_shape'), 'circle'); ?>>Circle</option>
                        </select>
                    </td>
                </tr>


<!-- test start -->

<tr valign="top">
                    <th scope="row">Twitter Link</th>
                    <td><input type="text" name="twitter_link" value="<?php echo esc_attr(get_option('twitter_link')); ?>" /></td>
                    <td><input type="color" name="twitter_color" value="<?php echo esc_attr(get_option('twitter_color')); ?>" /></td>
                    <td><input type="number" name="twitter_icon_size" value="<?php echo esc_attr(get_option('twitter_icon_size', '20')); ?>" /></td>
                    <td>
                        <select name="twitter_icon_shape">
                            <option value="square" <?php selected(get_option('instagram_icon_shape'), 'square'); ?>>Square</option>
                            <option value="circle" <?php selected(get_option('instagram_icon_shape'), 'circle'); ?>>Circle</option>
                        </select>
                    </td>
                </tr>

<!-- test end -->




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
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Your plugin code goes here

function enqueue_floating_scripts() {
    // Enqueue Font Awesome CSS
    wp_enqueue_style('font-awesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css');
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
            font-size: <?php echo esc_attr(get_option('facebook_icon_size', '20')); ?>px;
            <?php
            // Check if shape is set to circle, then apply border-radius
            if (get_option('facebook_icon_shape') === 'circle') {
                echo 'border-radius: 50%;';
            }
            ?>
        }
        #floating-element .social-icons a i.fab.fa-facebook,
#floating-element .social-icons a i.fab.fa-facebook-square {
    color: <?php echo esc_attr(get_option('facebook_color')); ?>;
}
#floating-element .social-icons a i.fab.fa-instagram,
#floating-element .social-icons a i.fab.fa-instagram-square {
    color: <?php echo esc_attr(get_option('instagram_color')); ?>;
}


/* test start */
#floating-element .social-icons a i.fab.fa-x-twitter,
#floating-element .social-icons a i.fab.fa-square-x-twitter {
    color: <?php echo esc_attr(get_option('twitter_color')); ?>;
}
/* test end */




        /* Add more styles for other social media icons */

    </style>
    <div id="floating-element">
       <!-- Social Media Icons with Font Awesome -->
<div class="social-icons" style="margin-bottom:5px;">
    <?php if (get_option('facebook_link')) : ?>
        <a href="<?php echo esc_url(get_option('facebook_link')); ?>" target="_blank">
            <?php
            $facebook_icon_class = (get_option('facebook_icon_shape') === 'circle') ? 'fab fa-facebook' : 'fab fa-facebook-square';
            ?>
            <i class="<?php echo esc_attr($facebook_icon_class); ?>" style="font-size: <?php echo esc_attr(get_option('facebook_icon_size', '20')); ?>px;"></i>
        </a>
    <?php endif; ?>
</div>
<div class="social-icons" style="margin-bottom:5px;">
    <?php if (get_option('instagram_link')) : ?>
        <a href="<?php echo esc_url(get_option('instagram_link')); ?>" target="_blank">
            <?php
            $instagram_icon_class = (get_option('instagram_icon_shape') === 'circle') ? 'fab fa-instagram' : 'fab fa-instagram-square';
            ?>
            <i class="<?php echo esc_attr($instagram_icon_class); ?>" style="font-size: <?php echo esc_attr(get_option('instagram_icon_size', '20')); ?>px;"></i>
        </a>
    <?php endif; ?>
</div>

<!-- test start -->
<div class="social-icons" style="margin-bottom:5px;">
    <?php if (get_option('twitter_link')) : ?>
        <a href="<?php echo esc_url(get_option('twitter_link')); ?>" target="_blank">
            <?php
            $twitter_icon_class = (get_option('twitter_icon_shape') === 'circle') ? 'fab fa-brands fa-x-twitter' : 'fab fa-brands fa-square-x-twitter';
            ?>
            <i class="<?php echo esc_attr($twitter_icon_class); ?>" style="font-size: <?php echo esc_attr(get_option('twitter_icon_size', '20')); ?>px;"></i>
        </a>
    <?php endif; ?>
</div>
<!-- test end -->

    </div>
    <?php
}

add_action('wp_footer', 'add_floating_element');
?>
