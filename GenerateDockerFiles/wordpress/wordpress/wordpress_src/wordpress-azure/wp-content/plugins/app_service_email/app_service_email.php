<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.microsoft.com
 * @since             1.0.0
 * @package           App_service_email
 *
 * @wordpress-plugin
 * Plugin Name:       App Service Email
 * Plugin URI:        https://github.com/Azure/Wordpress-on-Linux-App-Service-plugins/tree/main/app_service_email
 * Description:       App Service Email Plugin enables seamless integration with the Azure Email Communication Service, empowering your WordPress website with the ability to leverage Microsoft Azure's robust infrastructure for email delivery.
 * Version:           1.0.0
 * Author:            Microsoft
 * Author URI:        https://www.microsoft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       app_service_email
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('APP_SERVICE_EMAIL_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-app_service_email-activator.php
 */
function activate_app_service_email()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-app_service_email-activator.php';
	App_service_email_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-app_service_email-deactivator.php
 */
function deactivate_app_service_email()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-app_service_email-deactivator.php';
	App_service_email_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_app_service_email');
register_deactivation_hook(__FILE__, 'deactivate_app_service_email');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-app_service_email.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
add_action('admin_notices', 'your_custom_plugin_admin_notice');

function your_custom_plugin_admin_notice()
{
	if (function_exists('wp_mail')) {
?>
		<div class="notice notice-warning is-dismissible">
			<p><?php esc_html_e('Attention: App Service Email has detected conflict with wp_mail function.Please deactivate other process or plugin to prevent conflicts.', 'app_service_email'); ?></p>
		</div>
<?php
	}
	return;
}

function run_app_service_email()
{

	$plugin = new App_service_email();
	$plugin->run();
}
run_app_service_email();
