<?php
/*
Plugin Name: plugin-y
Version: 1.0
Author: Taha Uygun
*/


if(!class_exists('PluginY'))
{
	class PluginY
	{
		public function __construct()
		{
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WP_Plugin_Template_Settings = new WP_Plugin_Template_Settings();

			require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
			$Post_Type_Template = new Post_Type_Template();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		}

		public static function activate()
		{
			// Do nothing
		}

		public static function deactivate()
		{
			// Do nothing
		}

		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	}
}

if(class_exists('WP_Plugin_Template'))
{
	register_activation_hook(__FILE__, array('WP_Plugin_Template', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Plugin_Template', 'deactivate'));

	$wp_plugin_template = new WP_Plugin_Template();

}
