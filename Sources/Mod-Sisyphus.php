<?php
/**
 * @package SMF Sisyphus Mod
 * @author digger
 * @copyright 2011-2016
 * @license GPLv3
 * @version 1.3
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
        $context['copyrights']['mods'][] = '<a href="http://mysmf.ru/mods/sisyphus" title="SMF Sisyphus mod" target="_blank">SMF Sisyphus mod</a> &copy; 2011-2016, digger | <a href="https://github.com/simsalabim/sisyphus" title="Sisyphus.js" target="_blank">Sisyphus.js</a>';
    }

}

/**
 * Load mod JS
 */
function loadSisyphusJS()
{
    global $context, $settings;

    $context['insert_after_template'] .= '
                <script type="text/javascript"><!-- // --><![CDATA[
                        !window.jQuery && document.write(unescape(\'%3Cscript src="//code.jquery.com/jquery.min.js"%3E%3C/script%3E\'));
                // ]]></script>
                <script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/sisyphus/sisyphus.min.js"></script>
                <script type="text/javascript"><!-- // --><![CDATA[        	    
                        jQuery(document).ready(function() {
                                jQuery("#postmodify").sisyphus({
                                locationBased: true,                             
                                });
                        });  
                // ]]></script>';

}