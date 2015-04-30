<?php

define('KOPA_DOMAIN', 'divine');
define('KOPA_PREFIX', 'divine_');

#KOPA FRAMEWORK
require_once(get_template_directory() . '/framework/kopa-framework.php');

#ADDON
require_once(get_template_directory() . '/inc/addon/BFIThumb.class.php');

#DIVINE FUNCTION
require_once(get_template_directory() . '/inc/util.php');
require_once(get_template_directory() . '/inc/hook.php');
require_once(get_template_directory() . '/inc/config.php');

#DIVINE FEATURED
require_once(get_template_directory() . '/inc/theme-option.php');
require_once(get_template_directory() . '/inc/layout.php');
require_once(get_template_directory() . '/inc/page-builder.php');
require_once(get_template_directory() . '/inc/sidebar.php');
require_once(get_template_directory() . '/inc/widget.php');

#DIVINE AJAX
require_once(get_template_directory() . '/inc/ajax.php');

#PLUGINS
require_once(get_template_directory() . '/inc/plugin.php');
require_once(get_template_directory() . '/woocommerce/woocommerce.php');

#CUSTOMIZE
require_once(get_template_directory() . '/inc/customize.php');
