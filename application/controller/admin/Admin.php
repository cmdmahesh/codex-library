<?php

namespace codx\controller\admin;
/**
 * 	A class to handle the admin's requests,
 * 	-- enque the admin assets for redering the panels
 * 	-- add entry to the admin panel
 */



defined( 'ABSPATH' ) || exit;



class Admin extends Controller {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private function __construct() {
		
	}

	public function init() {

	}
}

