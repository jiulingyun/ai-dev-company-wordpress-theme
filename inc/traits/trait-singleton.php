<?php
/**
 * Singleton Trait
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Inc\Traits;

trait Singleton {
	public function __construct() {
	}

	public function __clone() {
	}

	final public static function get_instance() {
		static $instance = null;

		if ( null === $instance ) {
			$instance = new static();
		}

		return $instance;
	}
}
