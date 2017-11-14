<?php
/**
 * @package SMF Sisyphus Mod
 * @author digger
 * @copyright 2011-2017
 * @license MIT
 * @version 2.0
 */

if (!defined('SMF')) {
    die('Hacking attempt...');
}

/**
 * Load all needed hooks
 */
function loadSisyphusHooks()
{
    add_integration_function('integrate_load_theme', 'loadSisyphusJS', false);
    add_integration_function('integrate_menu_buttons', 'addSisyphusCopyright', false);
}

/**
 * Add mod copyright to the forum credit's page
 */
function addSisyphusCopyright()
{
    global $context;

    if ($context['current_action'] == 'credits') {
        $context['copyrights']['mods'][] = '<a href="http://mysmf.net/mods/sisyphus" title="Sisyphus" target="_blank">Sisyphus</a> &copy; 2011-2017, digger</a>';
    }
}

/**
 * Load mod JS
 */
function loadSisyphusJS()
{
    global $context, $settings;

    if (empty($context['current_topic'])) {
        return false;
    }

    // Skip Sisyphus for message edit
    if (!empty($_GET['action']) && ($_GET['action'] == 'post' || $_GET['action'] == 'post2') && !empty($_GET['msg'])) {
        return false;
    }

    $context['insert_after_template'] .= '
        <script type="text/javascript"><!-- // --><![CDATA[
        var sisyphusKey = "topic-' . $context['current_topic'] . '-reply";        
        // ]]></script>
        <script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/sisyphus.js"></script>';
}
