<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Wistia Responsive
 *
 * Automatically makes Wistia embeds responsive.
 *
 * @class 		SS_Wistia_Responsive
 * @version		1.1.1
 * @package		Wistia Responsive
 * @author 		Saint Systems
 */
class SS_Wistia_Responsive {

	/**
	 * Plugin instance.
	 *
	 * @see get_instance()
	 * @type object
	 */
	protected static $instance = NULL;
 
	/**
	 * URL to this plugin's directory.
	 *
	 * @type string
	 */
	public $plugin_url = '';
 
	/**
	 * Path to this plugin's directory.
	 *
	 * @type string
	 */
	public $plugin_path = '';
 
	/**
	 * Access this plugin’s working instance
	 *
	 * @wp-hook plugins_loaded
	 * @return  object of this class
	 */
	public static function get_instance()
	{
		NULL === self::$instance and self::$instance = new self;
 
		return self::$instance;
	}
 
	/**
	 * Used for regular plugin work.
	 *
	 * @wp-hook plugins_loaded
	 * @return  void
	 */
	public function plugin_setup()
	{
 
		$this->plugin_url    = plugins_url( '/', __FILE__ );
		$this->plugin_path   = plugin_dir_path( __FILE__ );
		//$this->load_language( 'wistia_responsive' );
 
		// Hooks
		add_action( 'wp_enqueue_scripts', array( self::$instance, 'register_wistia_iframe_api' ) );
		add_filter( 'the_excerpt', array( self::$instance, 'make_responsive' ), 10, 1 );
		add_filter( 'the_content', array( self::$instance, 'make_responsive' ), 10, 1 );
	}
 
	/**
	 * Constructor. Intentionally left empty and public.
	 *
	 * @see plugin_setup()
	 */
	public function __construct() {}
 
	/**
	 * Loads translation file.
	 *
	 * Accessible to other classes to load different language files (admin and
	 * front-end for example).
	 *
	 * @wp-hook init
	 * @param   string $domain
	 * @return  void
	 */
	public function load_language( $domain )
	{
		load_plugin_textdomain(
			$domain,
			FALSE,
			$this->plugin_path . '/languages'
		);
	}

	/**
	 * Register and enqueue the wistia iframe api script
	 */
	function register_wistia_iframe_api() {
	    wp_register_script(
	        'wistia-iframe-api',
	        '//fast.wistia.com/static/iframe-api-v1.js',
	        false,
	        '1.0',
	        true
	    );

	    wp_enqueue_script( 'wistia-iframe-api' );

	} //end function register_wistia_iframe_api()

	/**
	 * Add the "videoFoam" parameter to enable the Wistia player to become responsive
	 */
	function make_responsive( $content ) {
		return preg_replace( '/src="(.*)\/\/fast.wistia.net\/embed\/iframe\/(.*)"/isU', 'src="${1}//fast.wistia.net/embed/iframe/${2}?videoFoam=true"', $content );

	} //end function make_responsive( $content )

} //end class SS_Wistia_Responsive
?>