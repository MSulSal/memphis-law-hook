<?php
/**
 * Plugin Name: Memphis Law Google Maps
 * Plugin URI: https://github.com/MSulSal/memphis-law-hook
 * Description: Lightweight Google Maps embed plugin for the Memphis Law WordPress build.
 * Version: 0.1.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 * Author: Sul + Codex
 * Text Domain: memphislaw-google-maps
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function memphislaw_google_maps_get_defaults(): array
{
    return [
        'map_title' => __('Arthur Ray Law Offices location map', 'memphislaw-google-maps'),
        'place_query' => '6244 Poplar Ave Suite 150, Memphis, TN 38119',
        'custom_embed_url' => '',
        'api_key' => '',
        'zoom' => 15,
        'height' => 136,
    ];
}

function memphislaw_google_maps_get_options(): array
{
    $stored_options = get_option('memphislaw_google_maps_options', []);

    if (!is_array($stored_options)) {
        $stored_options = [];
    }

    return wp_parse_args($stored_options, memphislaw_google_maps_get_defaults());
}

function memphislaw_google_maps_sanitize_options($input): array
{
    $defaults = memphislaw_google_maps_get_defaults();

    if (!is_array($input)) {
        return $defaults;
    }

    return [
        'map_title' => sanitize_text_field((string) ($input['map_title'] ?? $defaults['map_title'])),
        'place_query' => sanitize_text_field((string) ($input['place_query'] ?? $defaults['place_query'])),
        'custom_embed_url' => esc_url_raw((string) ($input['custom_embed_url'] ?? '')),
        'api_key' => sanitize_text_field((string) ($input['api_key'] ?? '')),
        'zoom' => max(5, min(21, (int) ($input['zoom'] ?? $defaults['zoom']))),
        'height' => max(120, min(480, (int) ($input['height'] ?? $defaults['height']))),
    ];
}

function memphislaw_google_maps_register_settings(): void
{
    register_setting(
        'memphislaw_google_maps',
        'memphislaw_google_maps_options',
        [
            'sanitize_callback' => 'memphislaw_google_maps_sanitize_options',
            'default' => memphislaw_google_maps_get_defaults(),
        ]
    );
}
add_action('admin_init', 'memphislaw_google_maps_register_settings');

function memphislaw_google_maps_add_settings_page(): void
{
    add_options_page(
        __('Memphis Law Map', 'memphislaw-google-maps'),
        __('Memphis Law Map', 'memphislaw-google-maps'),
        'manage_options',
        'memphislaw-google-maps',
        'memphislaw_google_maps_render_settings_page'
    );
}
add_action('admin_menu', 'memphislaw_google_maps_add_settings_page');

function memphislaw_google_maps_render_settings_page(): void
{
    $options = memphislaw_google_maps_get_options();
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Memphis Law Google Map', 'memphislaw-google-maps'); ?></h1>
        <p><?php esc_html_e('Use the query fields below for a lean setup, or paste a full Google Maps embed URL if the client supplies one.', 'memphislaw-google-maps'); ?></p>

        <form action="options.php" method="post">
            <?php settings_fields('memphislaw_google_maps'); ?>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-map-title"><?php esc_html_e('Map title', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-map-title"
                                class="regular-text"
                                name="memphislaw_google_maps_options[map_title]"
                                type="text"
                                value="<?php echo esc_attr((string) $options['map_title']); ?>"
                            >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-place-query"><?php esc_html_e('Place query', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-place-query"
                                class="regular-text"
                                name="memphislaw_google_maps_options[place_query]"
                                type="text"
                                value="<?php echo esc_attr((string) $options['place_query']); ?>"
                            >
                            <p class="description"><?php esc_html_e('This address is used for the built-in embed fallback and for the default Google Maps place search.', 'memphislaw-google-maps'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-custom-embed-url"><?php esc_html_e('Custom embed URL', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-custom-embed-url"
                                class="large-text"
                                name="memphislaw_google_maps_options[custom_embed_url]"
                                type="url"
                                value="<?php echo esc_attr((string) $options['custom_embed_url']); ?>"
                            >
                            <p class="description"><?php esc_html_e('Optional. Paste the src value from a Google Maps embed if you want a client-supplied embed to override the query-based map.', 'memphislaw-google-maps'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-api-key"><?php esc_html_e('Google Maps Embed API key', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-api-key"
                                class="regular-text"
                                name="memphislaw_google_maps_options[api_key]"
                                type="text"
                                value="<?php echo esc_attr((string) $options['api_key']); ?>"
                                autocomplete="off"
                            >
                            <p class="description"><?php esc_html_e('Optional. If supplied, the plugin will use the official Google Maps Embed API place endpoint.', 'memphislaw-google-maps'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-zoom"><?php esc_html_e('Zoom', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-zoom"
                                class="small-text"
                                name="memphislaw_google_maps_options[zoom]"
                                type="number"
                                min="5"
                                max="21"
                                value="<?php echo esc_attr((string) $options['zoom']); ?>"
                            >
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="memphislaw-google-maps-height"><?php esc_html_e('Map height', 'memphislaw-google-maps'); ?></label></th>
                        <td>
                            <input
                                id="memphislaw-google-maps-height"
                                class="small-text"
                                name="memphislaw_google_maps_options[height]"
                                type="number"
                                min="120"
                                max="480"
                                value="<?php echo esc_attr((string) $options['height']); ?>"
                            >
                            <span><?php esc_html_e('px', 'memphislaw-google-maps'); ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(__('Save Map Settings', 'memphislaw-google-maps')); ?>
        </form>
    </div>
    <?php
}

function memphislaw_google_maps_build_class_string(string $class_name = ''): string
{
    $classes = ['memphislaw-google-map'];

    foreach (preg_split('/\s+/', trim($class_name)) ?: [] as $class) {
        if ($class === '') {
            continue;
        }

        $classes[] = sanitize_html_class($class);
    }

    return implode(' ', array_unique($classes));
}

function memphislaw_google_maps_get_embed_url(array $options): string
{
    $custom_embed_url = esc_url_raw((string) ($options['custom_embed_url'] ?? ''));
    if ($custom_embed_url !== '') {
        return $custom_embed_url;
    }

    $place_query = trim((string) ($options['place_query'] ?? ''));
    if ($place_query === '') {
        return '';
    }

    $zoom = max(5, min(21, (int) ($options['zoom'] ?? 15)));
    $api_key = trim((string) ($options['api_key'] ?? ''));

    if ($api_key !== '') {
        return add_query_arg(
            [
                'key' => $api_key,
                'q' => $place_query,
                'zoom' => $zoom,
            ],
            'https://www.google.com/maps/embed/v1/place'
        );
    }

    return add_query_arg(
        [
            'q' => $place_query,
            't' => 'm',
            'z' => $zoom,
            'output' => 'embed',
        ],
        'https://www.google.com/maps'
    );
}

function memphislaw_google_maps_render_map(array $args = []): string
{
    $options = wp_parse_args($args, memphislaw_google_maps_get_options());
    $embed_url = memphislaw_google_maps_get_embed_url($options);

    if ($embed_url === '') {
        return '';
    }

    $height = max(120, min(480, (int) ($options['height'] ?? 136)));
    $title = sanitize_text_field((string) ($options['title'] ?? $options['map_title'] ?? 'Google Map'));
    $class_name = memphislaw_google_maps_build_class_string((string) ($args['class_name'] ?? ''));

    return sprintf(
        '<div class="%1$s"><div class="memphislaw-google-map__frame"><iframe src="%2$s" title="%3$s" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen style="height:%4$dpx;"></iframe></div></div>',
        esc_attr($class_name),
        esc_url($embed_url),
        esc_attr($title),
        $height
    );
}

function memphislaw_google_maps_shortcode($atts): string
{
    $shortcode_atts = shortcode_atts(
        [
            'class_name' => '',
            'height' => '',
            'title' => '',
        ],
        $atts,
        'memphislaw_google_map'
    );

    if ($shortcode_atts['height'] !== '') {
        $shortcode_atts['height'] = (int) $shortcode_atts['height'];
    }

    return memphislaw_google_maps_render_map($shortcode_atts);
}
add_shortcode('memphislaw_google_map', 'memphislaw_google_maps_shortcode');

function memphislaw_google_maps_add_action_links(array $links): array
{
    array_unshift(
        $links,
        sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url(admin_url('options-general.php?page=memphislaw-google-maps')),
            esc_html__('Settings', 'memphislaw-google-maps')
        )
    );

    return $links;
}
add_filter(
    'plugin_action_links_' . plugin_basename(__FILE__),
    'memphislaw_google_maps_add_action_links'
);

function memphislaw_google_maps_activate(): void
{
    if (!get_option('memphislaw_google_maps_options')) {
        add_option('memphislaw_google_maps_options', memphislaw_google_maps_get_defaults());
    }
}
register_activation_hook(__FILE__, 'memphislaw_google_maps_activate');
