<?php

add_filter('kopa_layout_manager_settings', 'dvt_add_layout_portfolio_archive');
add_filter('kopa_layout_manager_settings', 'dvt_add_layout_portfolio_single');
add_filter('kopa_custom_template_setting_id', 'dvt_portfolio_set_setting_id');
add_filter('kopa_custom_template_setting', 'dvt_portfolio_get_setting', 10, 2);

function dvt_add_layout_portfolio_archive($options) {
    $positions = divine_get_positions();
    $sidebars_default = divine_get_sidebars_default();

    $layout = array(
        'title' => __('Portfolio archive', 'divine-toolkit'),
        'preview' => get_template_directory_uri() . '/images/layouts/portfolio-archive.png',
        'positions' => array(
            'pos_right',
            'pos_footer_1',
            'pos_footer_2',
            'pos_footer_3',
            'pos_footer_4',
            'pos_footer_5',
        )
    );

    $options[] = array(
        'title' => __('Portfolio archive', 'divine-toolkit'),
        'type' => 'title',
        'id' => 'portfolio-archive',
    );

    $options[] = array(
        'title' => __('Portfolio archive', 'divine-toolkit'),
        'type' => 'layout_manager',
        'id' => 'portfolio-archive',
        'positions' => $positions,
        'layouts' => array(
            'portfolio-archive' => $layout
        ),
        'default' => array(
            'layout_id' => 'portfolio-archive',
            'sidebars' => array(
                'portfolio-archive' => $sidebars_default
            ),
        ),
    );

    return $options;
}

function dvt_add_layout_portfolio_single($options) {
    $positions = divine_get_positions();
    $sidebars_default = divine_get_sidebars_default();

    $layout = array(
        'title' => __('Single portfolio', 'divine-toolkit'),
        'preview' => get_template_directory_uri() . '/images/layouts/single-portfolio.png',
        'positions' => array(
            'pos_right',
            'pos_footer_1',
            'pos_footer_2',
            'pos_footer_3',
            'pos_footer_4',
            'pos_footer_5',
        )
    );

    $options[] = array(
        'title' => __('Single portfolio', 'divine-toolkit'),
        'type' => 'title',
        'id' => 'single-portfolio'
    );

    $options[] = array(
        'title' => __('Single portfolio', 'divine-toolkit'),
        'type' => 'layout_manager',
        'id' => 'single-portfolio',
        'positions' => $positions,
        'layouts' => array(
            'single-portfolio' => $layout,
        ),
        'default' => array(
            'layout_id' => 'single-portfolio',
            'sidebars' => array(
                'single-portfolio' => $sidebars_default,
            ),
        ),
    );

    return $options;
}

function dvt_portfolio_set_setting_id($setting_id) {
    if (is_singular('portfolio')) {
        $setting_id = 'single-portfolio';
    } else if (is_post_type_archive('portfolio') || is_tax('portfolio-tag')) {
        $setting_id = 'portfolio-archive';
    }

    return $setting_id;
}

function dvt_portfolio_get_setting($setting, $setting_id) {
    if (empty($setting)) {
        if ('single-portfolio' == $setting_id) {
            $layouts = dvt_add_layout_portfolio_single(array());
            if (isset($layouts[1]['default'])) {
                $setting = $layouts[1]['default'];
            }
        } elseif ('portfolio-archive' == $setting_id) {
            $layouts = dvt_add_layout_portfolio_archive(array());
            if (isset($layouts[1]['default'])) {
                $setting = $layouts[1]['default'];
            }
        }
    }

    return $setting;
}
