<?php
if(!class_exists('PluginY_Settings'))
{
	class PluginY_Settings
	{
		public function __construct()
		{
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		}

        public function admin_init()
        {
        	register_setting('group1', 'setting_a');
        	register_setting('group2', 'setting_b');

        	add_settings_section(
        	    'plugin-y-section',
        	    'Settings',
        	    array(&$this, 'pluginy_template'),
        	    'pluginy_template'
        	);
        	
            add_settings_field(
                'setting_a',
                'Setting A', 
                array(&$this, 'input_text'),
                'pluginy_template',
                'pluginy_template-section',
                array(
                    'field' => 'setting_a'
                )
            );
            add_settings_field(
                'setting_b',
                'Setting B', 
                array(&$this, 'input_text'),
                'pluginy_template',
                'pluginy_template-section',
                array(
                    'field' => 'setting_b'
                )
            );
        }
        
        public function settings_section_wp_plugin_template()
        {
            echo 'These settings do things for the template.';
        }

        public function settings_field_input_text($args)
        {
            $field = $args['field'];
            $value = get_option($field);
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        }

        public function add_menu()
        {
        	add_options_page(
        	    'Setting',
        	    'Template',
        	    'manage_options', 
        	    'pluginy_template',
        	    array(&$this, 'plugin_settings_page')
        	);
        }

        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }
    }
}
