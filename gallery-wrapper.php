<?php
/**
 * Gallery Wrapper
 *
 * Customize the CSS class names within the HTML that is output from the WordPress gallery shortcode
 *
 * @package   Gallery_Wrapper
 * @author    Brad Vincent <bradvin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/fooplugins/gallery-wrapper
 * @copyright 2013 Brad Vincent
 *
 * @wordpress-plugin
 * Plugin Name:       Gallery Wrapper
 * Plugin URI:        https://github.com/fooplugins/gallery-wrapper
 * Description:       Customize the CSS class names within the HTML that is output from the WordPress gallery shortcode
 * Version:           1.0.0
 * Author:            Brad Vincent
 * Author URI:        http://fooplugins.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/fooplugins/gallery-wrapper
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( 'class-gallery-wrapper.php' );

add_action( 'plugins_loaded', array( 'Gallery_Wrapper', 'get_instance' ) );