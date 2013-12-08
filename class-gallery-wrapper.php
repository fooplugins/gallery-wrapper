<?php
/**
 * Gallery_Wrapper
 *
 * @package   Gallery_Wrapper
 * @author    Brad Vincent <bradvin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/fooplugins/gallery-wrapper
 * @copyright 2013 Brad Vincent
 */

/**
 * Gallery_Wrapper class
 *
 * @package Gallery_Wrapper
 * @author  Brad Vincent <bradvin@gmail.com>
 */
class Gallery_Wrapper {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'gallery-wrapper';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;


	/**
	 * Class constructor. Init the class
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


	private function init() {
		//add a new shortcode that can wrap your galleries
		add_shortcode('gallery-wrap', array($this, 'render_shortcode_output'));
	}

	public function render_shortcode_output($attr, $content) {
		if (!class_exists('')) {
			require_once( 'class-gallery-wrapper-instance.php' );
		}

		$gallery_wrapper = new Gallery_Wrapper_Instance($attr, $content);
		return $gallery_wrapper->render();
	}
}
