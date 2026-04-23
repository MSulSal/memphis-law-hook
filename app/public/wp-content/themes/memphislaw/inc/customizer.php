<?php
declare(strict_types=1);

function memphislaw_get_customizer_defaults(): array
{
    return [
        'accent_color' => '#efb725',
        'action_color' => '#5e88e6',
        'background_color' => '#0a1020',
        'panel_color' => '#111a2d',
        'hero_image' => get_theme_file_uri('/assets/images/courthouse.png'),
        'hero_pill_location' => __('Memphis, Tennessee', 'memphislaw'),
        'hero_pill_since' => __('Since 1974', 'memphislaw'),
        'hero_title_line_1' => __('Trusted Legal', 'memphislaw'),
        'hero_title_line_2' => __('Counsel', 'memphislaw'),
        'hero_title_line_3' => __('When It Matters', 'memphislaw'),
        'hero_title_line_4' => __('Most', 'memphislaw'),
        'hero_practice_one' => __('Bankruptcy', 'memphislaw'),
        'hero_practice_two' => __('Personal Injury', 'memphislaw'),
        'hero_practice_three' => __("Workers' Compensation", 'memphislaw'),
        'hero_support_line_1' => __('Over 30 years fighting for the people of', 'memphislaw'),
        'hero_support_line_2' => __('Memphis and the Mid-South.', 'memphislaw'),
        'hero_primary_button_label' => __('Get a Free Consultation', 'memphislaw'),
        'hero_primary_button_url' => memphislaw_get_consultation_url(),
        'hero_secondary_button_label' => __('Call 901-475-8200', 'memphislaw'),
        'hero_secondary_button_url' => memphislaw_get_phone_href(),
        'hero_metric_1_value' => '30+',
        'hero_metric_1_label' => __('Years Experience', 'memphislaw'),
        'hero_metric_2_value' => '5,000+',
        'hero_metric_2_label' => __('Cases Handled', 'memphislaw'),
        'hero_metric_3_value' => __('Free', 'memphislaw'),
        'hero_metric_3_label' => __('Consultation', 'memphislaw'),
    ];
}

function memphislaw_customize_register(WP_Customize_Manager $wp_customize): void
{
    $defaults = memphislaw_get_customizer_defaults();

    $wp_customize->add_panel(
        'memphislaw_theme_options',
        [
            'title' => __('Memphis Law Theme Options', 'memphislaw'),
            'priority' => 160,
        ]
    );

    $wp_customize->add_section(
        'memphislaw_brand_styles',
        [
            'title' => __('Brand Styles', 'memphislaw'),
            'description' => __('Adjust the site palette without editing theme files.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    $color_controls = [
        [
            'setting' => 'memphislaw_accent_color',
            'label' => __('Accent Gold', 'memphislaw'),
            'default' => $defaults['accent_color'],
        ],
        [
            'setting' => 'memphislaw_action_color',
            'label' => __('Action Blue', 'memphislaw'),
            'default' => $defaults['action_color'],
        ],
        [
            'setting' => 'memphislaw_background_color',
            'label' => __('Background', 'memphislaw'),
            'default' => $defaults['background_color'],
        ],
        [
            'setting' => 'memphislaw_panel_color',
            'label' => __('Panel Surface', 'memphislaw'),
            'default' => $defaults['panel_color'],
        ],
    ];

    foreach ($color_controls as $index => $control) {
        $wp_customize->add_setting(
            $control['setting'],
            [
                'default' => $control['default'],
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $control['setting'],
                [
                    'label' => $control['label'],
                    'section' => 'memphislaw_brand_styles',
                    'priority' => 10 + $index,
                ]
            )
        );
    }

    $wp_customize->add_section(
        'memphislaw_homepage_hero',
        [
            'title' => __('Homepage Hero', 'memphislaw'),
            'description' => __('Manage the hero image, copy, CTA buttons, and stat row from WordPress.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    $text_controls = [
        [
            'setting' => 'memphislaw_hero_pill_location',
            'label' => __('Pill: City', 'memphislaw'),
            'default' => $defaults['hero_pill_location'],
        ],
        [
            'setting' => 'memphislaw_hero_pill_since',
            'label' => __('Pill: Since', 'memphislaw'),
            'default' => $defaults['hero_pill_since'],
        ],
        [
            'setting' => 'memphislaw_hero_title_line_1',
            'label' => __('Title Line 1', 'memphislaw'),
            'default' => $defaults['hero_title_line_1'],
        ],
        [
            'setting' => 'memphislaw_hero_title_line_2',
            'label' => __('Title Line 2', 'memphislaw'),
            'default' => $defaults['hero_title_line_2'],
        ],
        [
            'setting' => 'memphislaw_hero_title_line_3',
            'label' => __('Accent Title Line 1', 'memphislaw'),
            'default' => $defaults['hero_title_line_3'],
        ],
        [
            'setting' => 'memphislaw_hero_title_line_4',
            'label' => __('Accent Title Line 2', 'memphislaw'),
            'default' => $defaults['hero_title_line_4'],
        ],
        [
            'setting' => 'memphislaw_hero_practice_one',
            'label' => __('Practice Area 1', 'memphislaw'),
            'default' => $defaults['hero_practice_one'],
        ],
        [
            'setting' => 'memphislaw_hero_practice_two',
            'label' => __('Practice Area 2', 'memphislaw'),
            'default' => $defaults['hero_practice_two'],
        ],
        [
            'setting' => 'memphislaw_hero_practice_three',
            'label' => __('Practice Area 3', 'memphislaw'),
            'default' => $defaults['hero_practice_three'],
        ],
        [
            'setting' => 'memphislaw_hero_support_line_1',
            'label' => __('Support Line 1', 'memphislaw'),
            'default' => $defaults['hero_support_line_1'],
        ],
        [
            'setting' => 'memphislaw_hero_support_line_2',
            'label' => __('Support Line 2', 'memphislaw'),
            'default' => $defaults['hero_support_line_2'],
        ],
        [
            'setting' => 'memphislaw_hero_primary_button_label',
            'label' => __('Primary Button Label', 'memphislaw'),
            'default' => $defaults['hero_primary_button_label'],
        ],
        [
            'setting' => 'memphislaw_hero_secondary_button_label',
            'label' => __('Secondary Button Label', 'memphislaw'),
            'default' => $defaults['hero_secondary_button_label'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_1_value',
            'label' => __('Metric 1 Value', 'memphislaw'),
            'default' => $defaults['hero_metric_1_value'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_1_label',
            'label' => __('Metric 1 Label', 'memphislaw'),
            'default' => $defaults['hero_metric_1_label'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_2_value',
            'label' => __('Metric 2 Value', 'memphislaw'),
            'default' => $defaults['hero_metric_2_value'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_2_label',
            'label' => __('Metric 2 Label', 'memphislaw'),
            'default' => $defaults['hero_metric_2_label'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_3_value',
            'label' => __('Metric 3 Value', 'memphislaw'),
            'default' => $defaults['hero_metric_3_value'],
        ],
        [
            'setting' => 'memphislaw_hero_metric_3_label',
            'label' => __('Metric 3 Label', 'memphislaw'),
            'default' => $defaults['hero_metric_3_label'],
        ],
    ];

    foreach ($text_controls as $index => $control) {
        $wp_customize->add_setting(
            $control['setting'],
            [
                'default' => $control['default'],
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_control(
            $control['setting'],
            [
                'label' => $control['label'],
                'section' => 'memphislaw_homepage_hero',
                'type' => 'text',
                'priority' => 10 + $index,
            ]
        );
    }

    $wp_customize->add_setting(
        'memphislaw_hero_primary_button_url',
        [
            'default' => $defaults['hero_primary_button_url'],
            'sanitize_callback' => 'esc_url_raw',
        ]
    );

    $wp_customize->add_control(
        'memphislaw_hero_primary_button_url',
        [
            'label' => __('Primary Button URL', 'memphislaw'),
            'section' => 'memphislaw_homepage_hero',
            'type' => 'url',
            'priority' => 40,
        ]
    );

    $wp_customize->add_setting(
        'memphislaw_hero_secondary_button_url',
        [
            'default' => $defaults['hero_secondary_button_url'],
            'sanitize_callback' => 'esc_url_raw',
        ]
    );

    $wp_customize->add_control(
        'memphislaw_hero_secondary_button_url',
        [
            'label' => __('Secondary Button URL', 'memphislaw'),
            'section' => 'memphislaw_homepage_hero',
            'type' => 'url',
            'priority' => 41,
        ]
    );

    $wp_customize->add_setting(
        'memphislaw_hero_image',
        [
            'default' => $defaults['hero_image'],
            'sanitize_callback' => 'esc_url_raw',
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'memphislaw_hero_image',
            [
                'label' => __('Hero Background Image', 'memphislaw'),
                'section' => 'memphislaw_homepage_hero',
                'priority' => 42,
            ]
        )
    );
}
add_action('customize_register', 'memphislaw_customize_register');

function memphislaw_get_theme_palette(): array
{
    $defaults = memphislaw_get_customizer_defaults();

    return [
        'background' => sanitize_hex_color((string) get_theme_mod('memphislaw_background_color', $defaults['background_color'])) ?: $defaults['background_color'],
        'panel' => sanitize_hex_color((string) get_theme_mod('memphislaw_panel_color', $defaults['panel_color'])) ?: $defaults['panel_color'],
        'action' => sanitize_hex_color((string) get_theme_mod('memphislaw_action_color', $defaults['action_color'])) ?: $defaults['action_color'],
        'accent' => sanitize_hex_color((string) get_theme_mod('memphislaw_accent_color', $defaults['accent_color'])) ?: $defaults['accent_color'],
    ];
}

function memphislaw_get_dynamic_styles(): string
{
    $palette = memphislaw_get_theme_palette();

    return sprintf(
        ':root { --ml-bg: %1$s; --ml-panel: %2$s; --ml-panel-soft: %2$s; --ml-surface: %2$s; --ml-blue: %3$s; --ml-blue-deep: %3$s; --ml-gold: %4$s; }',
        $palette['background'],
        $palette['panel'],
        $palette['action'],
        $palette['accent']
    );
}

function memphislaw_get_homepage_hero_content(): array
{
    $defaults = memphislaw_get_customizer_defaults();

    return [
        'pill_location' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_pill_location', $defaults['hero_pill_location'])),
        'pill_since' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_pill_since', $defaults['hero_pill_since'])),
        'title_lines' => [
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_title_line_1', $defaults['hero_title_line_1'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_title_line_2', $defaults['hero_title_line_2'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_title_line_3', $defaults['hero_title_line_3'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_title_line_4', $defaults['hero_title_line_4'])),
        ],
        'practice_areas' => [
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_practice_one', $defaults['hero_practice_one'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_practice_two', $defaults['hero_practice_two'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_practice_three', $defaults['hero_practice_three'])),
        ],
        'support_lines' => [
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_support_line_1', $defaults['hero_support_line_1'])),
            sanitize_text_field((string) get_theme_mod('memphislaw_hero_support_line_2', $defaults['hero_support_line_2'])),
        ],
        'primary_button_label' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_primary_button_label', $defaults['hero_primary_button_label'])),
        'primary_button_url' => esc_url((string) get_theme_mod('memphislaw_hero_primary_button_url', $defaults['hero_primary_button_url'])) ?: $defaults['hero_primary_button_url'],
        'secondary_button_label' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_secondary_button_label', $defaults['hero_secondary_button_label'])),
        'secondary_button_url' => esc_url((string) get_theme_mod('memphislaw_hero_secondary_button_url', $defaults['hero_secondary_button_url'])) ?: $defaults['hero_secondary_button_url'],
        'metrics' => [
            [
                'value' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_1_value', $defaults['hero_metric_1_value'])),
                'label' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_1_label', $defaults['hero_metric_1_label'])),
            ],
            [
                'value' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_2_value', $defaults['hero_metric_2_value'])),
                'label' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_2_label', $defaults['hero_metric_2_label'])),
            ],
            [
                'value' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_3_value', $defaults['hero_metric_3_value'])),
                'label' => sanitize_text_field((string) get_theme_mod('memphislaw_hero_metric_3_label', $defaults['hero_metric_3_label'])),
            ],
        ],
    ];
}

function memphislaw_get_homepage_hero_image_url(): string
{
    $defaults = memphislaw_get_customizer_defaults();
    $image_url = esc_url_raw((string) get_theme_mod('memphislaw_hero_image', $defaults['hero_image']));

    return $image_url !== '' ? $image_url : $defaults['hero_image'];
}
