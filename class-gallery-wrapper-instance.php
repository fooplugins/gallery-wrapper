<?php
/**
 * Gallery_Wrapper_Instance
 *
 * @package   Gallery_Wrapper
 * @author    Brad Vincent <bradvin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/fooplugins/gallery-wrapper
 * @copyright 2013 Brad Vincent
 */

/**
 * Gallery_Wrapper_Instance class
 *
 * @package Gallery_Wrapper
 * @author  Brad Vincent <bradvin@gmail.com>
 */
if ( !class_exists( 'Gallery_Wrapper_Instance' ) ) {

	class Gallery_Wrapper_Instance {

		protected $_attr;
		protected $_content;
		protected $_class;
		protected $_aclass;
		protected $_imgclass;
		protected $_extra_attributes;

		function __construct($attr, $content) {
			$this->_attr    = $attr;
			$this->_content = $content;

			$defaults = array(
				'class'     => false,
				'a_class'   => false,
				'img_class' => false
			);

			$attr_merged = shortcode_atts($defaults , $attr, 'gallery-wrap' );

			//this class name will be appended to the surrounding div
			$this->_class    = $attr_merged['class'];

			//this class name will be appended to each anchor's class
			$this->_aclass   = $attr_merged['a_class'];

			//this class name will be appended to each img tag's class
			$this->_imgclass = $attr_merged['img_class'];

			//extra attributes are any extra attributes that were added to the shortcode. These will be appended to the surrounding div as-is
			$this->_extra_attributes = array();

			foreach($attr as $name => $value) {
				if (!array_key_exists($name, $defaults)) {
					//check for attributes that had hyphens in their names, e.g. data-foo="bar"
					if (is_numeric($name)) {
						$this->_extra_attributes[] = $value;
					} else {
						$this->_extra_attributes[] = "{$name}=\"{$value}\"";
					}
				}
			}
		}

		function render() {
			if ( $this->_aclass != false || $this->_imgclass != false ) {
				//attach the filter to include class names on the anchors and image elements
				add_filter( 'wp_get_attachment_link', array($this, 'alter_link') );
			}

			//do everything a normal gallery shortcode would do here
			$html = do_shortcode( $this->_content );

			if ( $this->_aclass != false ) {
				//remove the filter for adding class names
				remove_filter( 'wp_get_attachment_link', array($this, 'alter_link') );
			}

			//add a class name to the surrounding gallery div element
			if ( $this->_class != false ) {
				$html = str_replace( " class='gallery ", " class='{$this->_class} gallery ", $html );
			}

			//add extra attributes to the surrounding gallery div
			foreach($this->_extra_attributes as $attribute) {
				$html = str_replace( "<div ", "<div {$attribute} ", $html );
			}

			return $html;
		}

		function alter_link($link) {
			//include class name on anchor tag
			if ( $this->_aclass != false ) {
				$link = str_replace( '<a ', "<a class=\"{$this->_aclass}\" ", $link );
			}

			//include class name on img tag
			if ( $this->_imgclass != false ) {
				$link = str_replace( 'class="attachment', "class=\"{$this->_imgclass} attachment", $link );
			}

			return $link;
		}
	}
}