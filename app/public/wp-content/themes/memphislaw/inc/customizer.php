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
        'hero_secondary_button_url' => 'tel:9014758200',
        'hero_metric_1_value' => '30+',
        'hero_metric_1_label' => __('Years Experience', 'memphislaw'),
        'hero_metric_2_value' => '5,000+',
        'hero_metric_2_label' => __('Cases Handled', 'memphislaw'),
        'hero_metric_3_value' => __('Free', 'memphislaw'),
        'hero_metric_3_label' => __('Consultation', 'memphislaw'),
        'header_consultation_label' => __('Free Consultation', 'memphislaw'),
        'contact_address_line_1' => __('6244 Poplar Ave, Suite 150', 'memphislaw'),
        'contact_address_line_2' => __('Memphis, TN 38119', 'memphislaw'),
        'contact_phone' => '901-475-8200',
        'contact_email' => 'info@memphislaw.com',
        'contact_hours' => __('Mon-Fri: 8:30 AM - 5:30 PM | Sat: By appointment', 'memphislaw'),
        'contact_map_image' => get_theme_file_uri('/assets/images/office-map.jpg'),
        'footer_legal_disclaimer' => __('Attorney advertising. This website is for general information only and does not create an attorney-client relationship.', 'memphislaw'),
        'practice_section_eyebrow' => __('Practice Areas', 'memphislaw'),
        'practice_section_title' => __('Comprehensive Legal Services for Memphis Families', 'memphislaw'),
        'practice_section_intro' => __("Whether you're facing financial hardship, recovering from an injury, or navigating a workplace accident, Arthur Ray Law Offices provides experienced, compassionate representation.", 'memphislaw'),
        'workers_section_eyebrow' => __('Tennessee Law', 'memphislaw'),
        'workers_section_title' => __("Workers' Compensation in Tennessee: Know Your Rights", 'memphislaw'),
        'workers_section_intro' => __("Tennessee's workers' compensation system provides important protections for employees injured on the job. Understanding your eligibility and benefits is the first step toward recovery.", 'memphislaw'),
        'workers_section_covered_heading' => __('Who Is Covered?', 'memphislaw'),
        'workers_section_covered_copy' => __("Under Tennessee Code Annotated Section 50-6-102, employers with five or more employees are required to carry workers' compensation insurance. This coverage protects employees in virtually all industries.", 'memphislaw'),
        'workers_section_denied_title' => __('Was Your Claim Denied?', 'memphislaw'),
        'workers_section_denied_copy' => __('Insurance companies often deny valid claims. We fight back at no cost unless you win.', 'memphislaw'),
        'workers_section_denied_button_label' => __('Get Help Now', 'memphislaw'),
        'workers_section_benefits_heading' => __('What Benefits Are Available?', 'memphislaw'),
        'workers_section_deadline_label' => __('Important deadline:', 'memphislaw'),
        'workers_section_deadline_copy' => __("You must report your injury quickly and file your claim within the required time. Don't wait to ask for guidance.", 'memphislaw'),
        'workers_section_steps_eyebrow' => __('Steps After a Work Injury', 'memphislaw'),
        'team_section_eyebrow' => __('Our Team', 'memphislaw'),
        'team_section_title' => __('Experience You Can Trust', 'memphislaw'),
        'team_section_intro' => __('The attorneys at Arthur Ray Law Offices bring decades of combined experience and a genuine commitment to the people of Memphis and surrounding communities.', 'memphislaw'),
        'testimonials_section_eyebrow' => __('Client Stories', 'memphislaw'),
        'testimonials_section_title' => __('What Our Clients Say', 'memphislaw'),
        'consultation_section_eyebrow' => __('Get in Touch', 'memphislaw'),
        'consultation_section_title' => __('Free Consultation. No Fees Unless You Win.', 'memphislaw'),
        'consultation_section_intro' => __("Tell us about your situation. We'll review your case at no charge and advise you on the strongest next step.", 'memphislaw'),
        'site_stat_1_value' => '50+',
        'site_stat_1_label' => __('Years of Bankruptcy Practice', 'memphislaw'),
        'site_stat_2_value' => '5,000+',
        'site_stat_2_label' => __('Bankruptcy Cases Filed', 'memphislaw'),
        'site_stat_3_value' => '$Millions',
        'site_stat_3_label' => __('Recovered for Injured Clients', 'memphislaw'),
        'site_stat_4_value' => '3',
        'site_stat_4_label' => __('Core Practice Areas', 'memphislaw'),
    ];
}

function memphislaw_customize_add_fields(WP_Customize_Manager $wp_customize, string $section, array $fields): void
{
    foreach ($fields as $index => $field) {
        $type = $field['type'] ?? 'text';
        $priority = $field['priority'] ?? (10 + $index);

        $sanitize_callback = match ($type) {
            'color' => 'sanitize_hex_color',
            'textarea' => 'sanitize_textarea_field',
            'url', 'image' => 'esc_url_raw',
            'email' => 'sanitize_email',
            default => 'sanitize_text_field',
        };

        $wp_customize->add_setting(
            $field['setting'],
            [
                'default' => $field['default'],
                'sanitize_callback' => $sanitize_callback,
            ]
        );

        if ($type === 'color') {
            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    $field['setting'],
                    [
                        'label' => $field['label'],
                        'section' => $section,
                        'priority' => $priority,
                    ]
                )
            );

            continue;
        }

        if ($type === 'image') {
            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    $field['setting'],
                    [
                        'label' => $field['label'],
                        'section' => $section,
                        'priority' => $priority,
                    ]
                )
            );

            continue;
        }

        $wp_customize->add_control(
            $field['setting'],
            [
                'label' => $field['label'],
                'section' => $section,
                'type' => $type,
                'priority' => $priority,
            ]
        );
    }
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

    memphislaw_customize_add_fields(
        $wp_customize,
        'memphislaw_brand_styles',
        [
            [
                'setting' => 'memphislaw_accent_color',
                'label' => __('Accent Gold', 'memphislaw'),
                'default' => $defaults['accent_color'],
                'type' => 'color',
            ],
            [
                'setting' => 'memphislaw_action_color',
                'label' => __('Action Blue', 'memphislaw'),
                'default' => $defaults['action_color'],
                'type' => 'color',
            ],
            [
                'setting' => 'memphislaw_background_color',
                'label' => __('Background', 'memphislaw'),
                'default' => $defaults['background_color'],
                'type' => 'color',
            ],
            [
                'setting' => 'memphislaw_panel_color',
                'label' => __('Panel Surface', 'memphislaw'),
                'default' => $defaults['panel_color'],
                'type' => 'color',
            ],
        ]
    );

    $wp_customize->add_section(
        'memphislaw_homepage_hero',
        [
            'title' => __('Homepage Hero', 'memphislaw'),
            'description' => __('Manage the hero image, copy, CTA buttons, and stat row from WordPress.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    memphislaw_customize_add_fields(
        $wp_customize,
        'memphislaw_homepage_hero',
        [
            ['setting' => 'memphislaw_hero_pill_location', 'label' => __('Pill: City', 'memphislaw'), 'default' => $defaults['hero_pill_location']],
            ['setting' => 'memphislaw_hero_pill_since', 'label' => __('Pill: Since', 'memphislaw'), 'default' => $defaults['hero_pill_since']],
            ['setting' => 'memphislaw_hero_title_line_1', 'label' => __('Title Line 1', 'memphislaw'), 'default' => $defaults['hero_title_line_1']],
            ['setting' => 'memphislaw_hero_title_line_2', 'label' => __('Title Line 2', 'memphislaw'), 'default' => $defaults['hero_title_line_2']],
            ['setting' => 'memphislaw_hero_title_line_3', 'label' => __('Accent Title Line 1', 'memphislaw'), 'default' => $defaults['hero_title_line_3']],
            ['setting' => 'memphislaw_hero_title_line_4', 'label' => __('Accent Title Line 2', 'memphislaw'), 'default' => $defaults['hero_title_line_4']],
            ['setting' => 'memphislaw_hero_practice_one', 'label' => __('Practice Area 1', 'memphislaw'), 'default' => $defaults['hero_practice_one']],
            ['setting' => 'memphislaw_hero_practice_two', 'label' => __('Practice Area 2', 'memphislaw'), 'default' => $defaults['hero_practice_two']],
            ['setting' => 'memphislaw_hero_practice_three', 'label' => __('Practice Area 3', 'memphislaw'), 'default' => $defaults['hero_practice_three']],
            ['setting' => 'memphislaw_hero_support_line_1', 'label' => __('Support Line 1', 'memphislaw'), 'default' => $defaults['hero_support_line_1']],
            ['setting' => 'memphislaw_hero_support_line_2', 'label' => __('Support Line 2', 'memphislaw'), 'default' => $defaults['hero_support_line_2']],
            ['setting' => 'memphislaw_hero_primary_button_label', 'label' => __('Primary Button Label', 'memphislaw'), 'default' => $defaults['hero_primary_button_label']],
            ['setting' => 'memphislaw_hero_primary_button_url', 'label' => __('Primary Button URL', 'memphislaw'), 'default' => $defaults['hero_primary_button_url'], 'type' => 'url'],
            ['setting' => 'memphislaw_hero_secondary_button_label', 'label' => __('Secondary Button Label', 'memphislaw'), 'default' => $defaults['hero_secondary_button_label']],
            ['setting' => 'memphislaw_hero_secondary_button_url', 'label' => __('Secondary Button URL', 'memphislaw'), 'default' => $defaults['hero_secondary_button_url'], 'type' => 'url'],
            ['setting' => 'memphislaw_hero_metric_1_value', 'label' => __('Metric 1 Value', 'memphislaw'), 'default' => $defaults['hero_metric_1_value']],
            ['setting' => 'memphislaw_hero_metric_1_label', 'label' => __('Metric 1 Label', 'memphislaw'), 'default' => $defaults['hero_metric_1_label']],
            ['setting' => 'memphislaw_hero_metric_2_value', 'label' => __('Metric 2 Value', 'memphislaw'), 'default' => $defaults['hero_metric_2_value']],
            ['setting' => 'memphislaw_hero_metric_2_label', 'label' => __('Metric 2 Label', 'memphislaw'), 'default' => $defaults['hero_metric_2_label']],
            ['setting' => 'memphislaw_hero_metric_3_value', 'label' => __('Metric 3 Value', 'memphislaw'), 'default' => $defaults['hero_metric_3_value']],
            ['setting' => 'memphislaw_hero_metric_3_label', 'label' => __('Metric 3 Label', 'memphislaw'), 'default' => $defaults['hero_metric_3_label']],
            ['setting' => 'memphislaw_hero_image', 'label' => __('Hero Background Image', 'memphislaw'), 'default' => $defaults['hero_image'], 'type' => 'image'],
        ]
    );

    $wp_customize->add_section(
        'memphislaw_homepage_sections',
        [
            'title' => __('Homepage Sections', 'memphislaw'),
            'description' => __('Update the homepage section headings and supporting copy.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    memphislaw_customize_add_fields(
        $wp_customize,
        'memphislaw_homepage_sections',
        [
            ['setting' => 'memphislaw_practice_section_eyebrow', 'label' => __('Practice: Eyebrow', 'memphislaw'), 'default' => $defaults['practice_section_eyebrow']],
            ['setting' => 'memphislaw_practice_section_title', 'label' => __('Practice: Title', 'memphislaw'), 'default' => $defaults['practice_section_title']],
            ['setting' => 'memphislaw_practice_section_intro', 'label' => __('Practice: Intro', 'memphislaw'), 'default' => $defaults['practice_section_intro'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_workers_section_eyebrow', 'label' => __("Workers' Comp: Eyebrow", 'memphislaw'), 'default' => $defaults['workers_section_eyebrow']],
            ['setting' => 'memphislaw_workers_section_title', 'label' => __("Workers' Comp: Title", 'memphislaw'), 'default' => $defaults['workers_section_title']],
            ['setting' => 'memphislaw_workers_section_intro', 'label' => __("Workers' Comp: Intro", 'memphislaw'), 'default' => $defaults['workers_section_intro'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_workers_section_covered_heading', 'label' => __("Workers' Comp: Coverage Heading", 'memphislaw'), 'default' => $defaults['workers_section_covered_heading']],
            ['setting' => 'memphislaw_workers_section_covered_copy', 'label' => __("Workers' Comp: Coverage Copy", 'memphislaw'), 'default' => $defaults['workers_section_covered_copy'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_workers_section_denied_title', 'label' => __("Workers' Comp: Denied Card Title", 'memphislaw'), 'default' => $defaults['workers_section_denied_title']],
            ['setting' => 'memphislaw_workers_section_denied_copy', 'label' => __("Workers' Comp: Denied Card Copy", 'memphislaw'), 'default' => $defaults['workers_section_denied_copy'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_workers_section_denied_button_label', 'label' => __("Workers' Comp: Denied Card Button", 'memphislaw'), 'default' => $defaults['workers_section_denied_button_label']],
            ['setting' => 'memphislaw_workers_section_benefits_heading', 'label' => __("Workers' Comp: Benefits Heading", 'memphislaw'), 'default' => $defaults['workers_section_benefits_heading']],
            ['setting' => 'memphislaw_workers_section_deadline_label', 'label' => __("Workers' Comp: Deadline Label", 'memphislaw'), 'default' => $defaults['workers_section_deadline_label']],
            ['setting' => 'memphislaw_workers_section_deadline_copy', 'label' => __("Workers' Comp: Deadline Copy", 'memphislaw'), 'default' => $defaults['workers_section_deadline_copy'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_workers_section_steps_eyebrow', 'label' => __("Workers' Comp: Steps Eyebrow", 'memphislaw'), 'default' => $defaults['workers_section_steps_eyebrow']],
            ['setting' => 'memphislaw_team_section_eyebrow', 'label' => __('Team: Eyebrow', 'memphislaw'), 'default' => $defaults['team_section_eyebrow']],
            ['setting' => 'memphislaw_team_section_title', 'label' => __('Team: Title', 'memphislaw'), 'default' => $defaults['team_section_title']],
            ['setting' => 'memphislaw_team_section_intro', 'label' => __('Team: Intro', 'memphislaw'), 'default' => $defaults['team_section_intro'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_testimonials_section_eyebrow', 'label' => __('Testimonials: Eyebrow', 'memphislaw'), 'default' => $defaults['testimonials_section_eyebrow']],
            ['setting' => 'memphislaw_testimonials_section_title', 'label' => __('Testimonials: Title', 'memphislaw'), 'default' => $defaults['testimonials_section_title']],
            ['setting' => 'memphislaw_consultation_section_eyebrow', 'label' => __('Consultation: Eyebrow', 'memphislaw'), 'default' => $defaults['consultation_section_eyebrow']],
            ['setting' => 'memphislaw_consultation_section_title', 'label' => __('Consultation: Title', 'memphislaw'), 'default' => $defaults['consultation_section_title']],
            ['setting' => 'memphislaw_consultation_section_intro', 'label' => __('Consultation: Intro', 'memphislaw'), 'default' => $defaults['consultation_section_intro'], 'type' => 'textarea'],
        ]
    );

    $wp_customize->add_section(
        'memphislaw_firm_details',
        [
            'title' => __('Firm Details', 'memphislaw'),
            'description' => __('Manage shared contact information and legal text used across the site.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    memphislaw_customize_add_fields(
        $wp_customize,
        'memphislaw_firm_details',
        [
            ['setting' => 'memphislaw_header_consultation_label', 'label' => __('Header Consultation Button Label', 'memphislaw'), 'default' => $defaults['header_consultation_label']],
            ['setting' => 'memphislaw_contact_address_line_1', 'label' => __('Address Line 1', 'memphislaw'), 'default' => $defaults['contact_address_line_1']],
            ['setting' => 'memphislaw_contact_address_line_2', 'label' => __('Address Line 2', 'memphislaw'), 'default' => $defaults['contact_address_line_2']],
            ['setting' => 'memphislaw_contact_phone', 'label' => __('Phone Number', 'memphislaw'), 'default' => $defaults['contact_phone']],
            ['setting' => 'memphislaw_contact_email', 'label' => __('Contact Email', 'memphislaw'), 'default' => $defaults['contact_email'], 'type' => 'email'],
            ['setting' => 'memphislaw_contact_hours', 'label' => __('Office Hours', 'memphislaw'), 'default' => $defaults['contact_hours'], 'type' => 'textarea'],
            ['setting' => 'memphislaw_contact_map_image', 'label' => __('Consultation Map Image', 'memphislaw'), 'default' => $defaults['contact_map_image'], 'type' => 'image'],
            ['setting' => 'memphislaw_footer_legal_disclaimer', 'label' => __('Footer Legal Disclaimer', 'memphislaw'), 'default' => $defaults['footer_legal_disclaimer'], 'type' => 'textarea'],
        ]
    );

    $wp_customize->add_section(
        'memphislaw_homepage_stats',
        [
            'title' => __('Homepage Stats', 'memphislaw'),
            'description' => __('Edit the four firm stats shown in the team section.', 'memphislaw'),
            'panel' => 'memphislaw_theme_options',
        ]
    );

    memphislaw_customize_add_fields(
        $wp_customize,
        'memphislaw_homepage_stats',
        [
            ['setting' => 'memphislaw_site_stat_1_value', 'label' => __('Stat 1 Value', 'memphislaw'), 'default' => $defaults['site_stat_1_value']],
            ['setting' => 'memphislaw_site_stat_1_label', 'label' => __('Stat 1 Label', 'memphislaw'), 'default' => $defaults['site_stat_1_label']],
            ['setting' => 'memphislaw_site_stat_2_value', 'label' => __('Stat 2 Value', 'memphislaw'), 'default' => $defaults['site_stat_2_value']],
            ['setting' => 'memphislaw_site_stat_2_label', 'label' => __('Stat 2 Label', 'memphislaw'), 'default' => $defaults['site_stat_2_label']],
            ['setting' => 'memphislaw_site_stat_3_value', 'label' => __('Stat 3 Value', 'memphislaw'), 'default' => $defaults['site_stat_3_value']],
            ['setting' => 'memphislaw_site_stat_3_label', 'label' => __('Stat 3 Label', 'memphislaw'), 'default' => $defaults['site_stat_3_label']],
            ['setting' => 'memphislaw_site_stat_4_value', 'label' => __('Stat 4 Value', 'memphislaw'), 'default' => $defaults['site_stat_4_value']],
            ['setting' => 'memphislaw_site_stat_4_label', 'label' => __('Stat 4 Label', 'memphislaw'), 'default' => $defaults['site_stat_4_label']],
        ]
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

function memphislaw_get_string_theme_mod(string $setting, string $default_key, string $sanitize = 'text'): string
{
    $defaults = memphislaw_get_customizer_defaults();
    $default = (string) ($defaults[$default_key] ?? '');
    $value = (string) get_theme_mod($setting, $default);

    return match ($sanitize) {
        'textarea' => sanitize_textarea_field($value),
        'email' => sanitize_email($value),
        'url' => esc_url_raw($value),
        default => sanitize_text_field($value),
    };
}

function memphislaw_get_homepage_hero_content(): array
{
    return [
        'pill_location' => memphislaw_get_string_theme_mod('memphislaw_hero_pill_location', 'hero_pill_location'),
        'pill_since' => memphislaw_get_string_theme_mod('memphislaw_hero_pill_since', 'hero_pill_since'),
        'title_lines' => [
            memphislaw_get_string_theme_mod('memphislaw_hero_title_line_1', 'hero_title_line_1'),
            memphislaw_get_string_theme_mod('memphislaw_hero_title_line_2', 'hero_title_line_2'),
            memphislaw_get_string_theme_mod('memphislaw_hero_title_line_3', 'hero_title_line_3'),
            memphislaw_get_string_theme_mod('memphislaw_hero_title_line_4', 'hero_title_line_4'),
        ],
        'practice_areas' => [
            memphislaw_get_string_theme_mod('memphislaw_hero_practice_one', 'hero_practice_one'),
            memphislaw_get_string_theme_mod('memphislaw_hero_practice_two', 'hero_practice_two'),
            memphislaw_get_string_theme_mod('memphislaw_hero_practice_three', 'hero_practice_three'),
        ],
        'support_lines' => [
            memphislaw_get_string_theme_mod('memphislaw_hero_support_line_1', 'hero_support_line_1'),
            memphislaw_get_string_theme_mod('memphislaw_hero_support_line_2', 'hero_support_line_2'),
        ],
        'primary_button_label' => memphislaw_get_string_theme_mod('memphislaw_hero_primary_button_label', 'hero_primary_button_label'),
        'primary_button_url' => memphislaw_get_string_theme_mod('memphislaw_hero_primary_button_url', 'hero_primary_button_url', 'url'),
        'secondary_button_label' => memphislaw_get_string_theme_mod('memphislaw_hero_secondary_button_label', 'hero_secondary_button_label'),
        'secondary_button_url' => memphislaw_get_string_theme_mod('memphislaw_hero_secondary_button_url', 'hero_secondary_button_url', 'url'),
        'metrics' => [
            [
                'value' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_1_value', 'hero_metric_1_value'),
                'label' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_1_label', 'hero_metric_1_label'),
            ],
            [
                'value' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_2_value', 'hero_metric_2_value'),
                'label' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_2_label', 'hero_metric_2_label'),
            ],
            [
                'value' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_3_value', 'hero_metric_3_value'),
                'label' => memphislaw_get_string_theme_mod('memphislaw_hero_metric_3_label', 'hero_metric_3_label'),
            ],
        ],
    ];
}

function memphislaw_get_homepage_hero_image_url(): string
{
    return memphislaw_get_string_theme_mod('memphislaw_hero_image', 'hero_image', 'url');
}

function memphislaw_get_homepage_sections(): array
{
    return [
        'practice' => [
            'eyebrow' => memphislaw_get_string_theme_mod('memphislaw_practice_section_eyebrow', 'practice_section_eyebrow'),
            'title' => memphislaw_get_string_theme_mod('memphislaw_practice_section_title', 'practice_section_title'),
            'intro' => memphislaw_get_string_theme_mod('memphislaw_practice_section_intro', 'practice_section_intro', 'textarea'),
        ],
        'workers_comp' => [
            'eyebrow' => memphislaw_get_string_theme_mod('memphislaw_workers_section_eyebrow', 'workers_section_eyebrow'),
            'title' => memphislaw_get_string_theme_mod('memphislaw_workers_section_title', 'workers_section_title'),
            'intro' => memphislaw_get_string_theme_mod('memphislaw_workers_section_intro', 'workers_section_intro', 'textarea'),
            'covered_heading' => memphislaw_get_string_theme_mod('memphislaw_workers_section_covered_heading', 'workers_section_covered_heading'),
            'covered_copy' => memphislaw_get_string_theme_mod('memphislaw_workers_section_covered_copy', 'workers_section_covered_copy', 'textarea'),
            'denied_title' => memphislaw_get_string_theme_mod('memphislaw_workers_section_denied_title', 'workers_section_denied_title'),
            'denied_copy' => memphislaw_get_string_theme_mod('memphislaw_workers_section_denied_copy', 'workers_section_denied_copy', 'textarea'),
            'denied_button_label' => memphislaw_get_string_theme_mod('memphislaw_workers_section_denied_button_label', 'workers_section_denied_button_label'),
            'benefits_heading' => memphislaw_get_string_theme_mod('memphislaw_workers_section_benefits_heading', 'workers_section_benefits_heading'),
            'deadline_label' => memphislaw_get_string_theme_mod('memphislaw_workers_section_deadline_label', 'workers_section_deadline_label'),
            'deadline_copy' => memphislaw_get_string_theme_mod('memphislaw_workers_section_deadline_copy', 'workers_section_deadline_copy', 'textarea'),
            'steps_eyebrow' => memphislaw_get_string_theme_mod('memphislaw_workers_section_steps_eyebrow', 'workers_section_steps_eyebrow'),
        ],
        'team' => [
            'eyebrow' => memphislaw_get_string_theme_mod('memphislaw_team_section_eyebrow', 'team_section_eyebrow'),
            'title' => memphislaw_get_string_theme_mod('memphislaw_team_section_title', 'team_section_title'),
            'intro' => memphislaw_get_string_theme_mod('memphislaw_team_section_intro', 'team_section_intro', 'textarea'),
        ],
        'testimonials' => [
            'eyebrow' => memphislaw_get_string_theme_mod('memphislaw_testimonials_section_eyebrow', 'testimonials_section_eyebrow'),
            'title' => memphislaw_get_string_theme_mod('memphislaw_testimonials_section_title', 'testimonials_section_title'),
        ],
        'consultation' => [
            'eyebrow' => memphislaw_get_string_theme_mod('memphislaw_consultation_section_eyebrow', 'consultation_section_eyebrow'),
            'title' => memphislaw_get_string_theme_mod('memphislaw_consultation_section_title', 'consultation_section_title'),
            'intro' => memphislaw_get_string_theme_mod('memphislaw_consultation_section_intro', 'consultation_section_intro', 'textarea'),
        ],
    ];
}

function memphislaw_get_brand_settings(): array
{
    $defaults = memphislaw_get_customizer_defaults();
    $tagline = get_bloginfo('description');

    return [
        'tagline' => is_string($tagline) && $tagline !== '' ? $tagline : __('Trusted legal counsel for Memphis families since 1974.', 'memphislaw'),
        'header_consultation_label' => memphislaw_get_string_theme_mod('memphislaw_header_consultation_label', 'header_consultation_label'),
        'footer_disclaimer' => memphislaw_get_string_theme_mod('memphislaw_footer_legal_disclaimer', 'footer_legal_disclaimer', 'textarea'),
        'contact_map_image' => memphislaw_get_string_theme_mod('memphislaw_contact_map_image', 'contact_map_image', 'url') ?: $defaults['contact_map_image'],
    ];
}
