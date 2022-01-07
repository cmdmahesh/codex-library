<?php
/**
 * Plugin Name: CodX Library
 * Description: Wordpress common coding library 
 * Author: Mahesh 
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: codx
 * Domain Path: /language 
 */

defined( 'ABSPATH' ) || exit;

class CodX_Library {

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

		\codx\controller\Requests::instance()->init();

	}

	public static function do_activate( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );
	}

	public static function do_deactivate( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );
	}

	public static function do_uninstall( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		check_admin_referer( 'bulk-plugins' );

		if ( __FILE__ != WP_UNINSTALL_PLUGIN  )
			return;
	}
}


function codx() {	
	return CodX_Library::instance();
}


add_action( 'plugins_loaded',function(){
	if(function_exists('codx')) {
		require_once __DIR__.'/vendor/autoload.php';
		//codx()->init();
	}
});	

register_activation_hook( __FILE__, 'CodX_Library::do_activate' );
register_deactivation_hook( __FILE__, 'CodX_Library::do_deactivate' );
register_uninstall_hook( __FILE__, 'CodX_Library::do_uninstall' );
