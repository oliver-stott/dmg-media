<?php

/**
 * Plugin Name:       Dmg Media
 * Description:       A posts search block that hooks into the wordpress Rest API
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dmg-media
 *
 * @package Dmgmedia
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
// Registers the block
function dmgmedia_dmg_media_block_init()
{
    register_block_type(__DIR__ . '/build/read-more');
}
add_action('init', 'dmgmedia_dmg_media_block_init');

// Register WP CLI commands (only if WP-CLI is available)
if (defined('WP_CLI') && WP_CLI) {
    // Make sure the file with WP-CLI commands is loaded
    require_once plugin_dir_path(__FILE__) . 'cli-commands/dmg-wpcli-commands.php';
}
