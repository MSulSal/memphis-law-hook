<?php
/**
 * Plugin Name: Memphis Law Core
 * Plugin URI: https://github.com/MSulSal/memphis-law-hook
 * Description: Structured content and lightweight consultation handling for the Memphis Law WordPress build.
 * Version: 0.3.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 * Author: Sul + Codex
 * Text Domain: memphislaw-core
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function memphislaw_core_register_post_types(): void
{
    register_post_type(
        'ml_attorney',
        [
            'labels' => [
                'name' => __('Attorneys', 'memphislaw-core'),
                'singular_name' => __('Attorney', 'memphislaw-core'),
            ],
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-businessperson',
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
            'rewrite' => ['slug' => 'attorneys'],
            'has_archive' => false,
        ]
    );

    register_post_type(
        'ml_testimonial',
        [
            'labels' => [
                'name' => __('Testimonials', 'memphislaw-core'),
                'singular_name' => __('Testimonial', 'memphislaw-core'),
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-format-quote',
            'supports' => ['title', 'editor', 'excerpt'],
        ]
    );

    register_post_type(
        'ml_consultation_request',
        [
            'labels' => [
                'name' => __('Consultation Requests', 'memphislaw-core'),
                'singular_name' => __('Consultation Request', 'memphislaw-core'),
            ],
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => false,
            'menu_icon' => 'dashicons-email-alt',
            'supports' => ['title', 'editor', 'custom-fields'],
            'map_meta_cap' => true,
        ]
    );
}
add_action('init', 'memphislaw_core_register_post_types');

function memphislaw_core_register_meta_boxes(): void
{
    add_meta_box(
        'memphislaw_attorney_details',
        __('Attorney Details', 'memphislaw-core'),
        'memphislaw_core_render_attorney_meta_box',
        'ml_attorney',
        'normal',
        'high'
    );

    add_meta_box(
        'memphislaw_testimonial_details',
        __('Testimonial Details', 'memphislaw-core'),
        'memphislaw_core_render_testimonial_meta_box',
        'ml_testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'memphislaw_core_register_meta_boxes');

function memphislaw_core_render_attorney_meta_box(WP_Post $post): void
{
    wp_nonce_field('memphislaw_save_attorney_meta', 'memphislaw_attorney_meta_nonce');
    ?>
    <p>
        <label for="memphislaw_role"><strong><?php esc_html_e('Role', 'memphislaw-core'); ?></strong></label><br>
        <input type="text" class="widefat" id="memphislaw_role" name="memphislaw_role" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_role', true)); ?>">
    </p>
    <p>
        <label for="memphislaw_badge"><strong><?php esc_html_e('Badge', 'memphislaw-core'); ?></strong></label><br>
        <input type="text" class="widefat" id="memphislaw_badge" name="memphislaw_badge" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_badge', true)); ?>">
    </p>
    <p>
        <label for="memphislaw_credentials"><strong><?php esc_html_e('Credentials', 'memphislaw-core'); ?></strong></label><br>
        <textarea class="widefat" rows="6" id="memphislaw_credentials" name="memphislaw_credentials"><?php echo esc_textarea((string) get_post_meta($post->ID, 'memphislaw_credentials', true)); ?></textarea>
        <small><?php esc_html_e('Enter one credential per line.', 'memphislaw-core'); ?></small>
    </p>
    <?php
}

function memphislaw_core_render_testimonial_meta_box(WP_Post $post): void
{
    wp_nonce_field('memphislaw_save_testimonial_meta', 'memphislaw_testimonial_meta_nonce');
    ?>
    <p>
        <label for="memphislaw_testimonial_client"><strong><?php esc_html_e('Client Name', 'memphislaw-core'); ?></strong></label><br>
        <input type="text" class="widefat" id="memphislaw_testimonial_client" name="memphislaw_testimonial_client" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_testimonial_client', true)); ?>">
    </p>
    <p>
        <label for="memphislaw_testimonial_location"><strong><?php esc_html_e('Client Location', 'memphislaw-core'); ?></strong></label><br>
        <input type="text" class="widefat" id="memphislaw_testimonial_location" name="memphislaw_testimonial_location" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_testimonial_location', true)); ?>">
    </p>
    <p>
        <label for="memphislaw_testimonial_matter"><strong><?php esc_html_e('Matter Type', 'memphislaw-core'); ?></strong></label><br>
        <input type="text" class="widefat" id="memphislaw_testimonial_matter" name="memphislaw_testimonial_matter" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_testimonial_matter', true)); ?>">
    </p>
    <p>
        <label for="memphislaw_testimonial_rating"><strong><?php esc_html_e('Star Rating', 'memphislaw-core'); ?></strong></label><br>
        <input type="number" min="1" max="5" class="small-text" id="memphislaw_testimonial_rating" name="memphislaw_testimonial_rating" value="<?php echo esc_attr((string) get_post_meta($post->ID, 'memphislaw_testimonial_rating', true)); ?>">
    </p>
    <?php
}

function memphislaw_core_save_post_meta(int $post_id): void
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $post_type = get_post_type($post_id);

    if ($post_type === 'ml_attorney') {
        if (
            !isset($_POST['memphislaw_attorney_meta_nonce']) ||
            !wp_verify_nonce(
                sanitize_text_field(wp_unslash($_POST['memphislaw_attorney_meta_nonce'])),
                'memphislaw_save_attorney_meta'
            )
        ) {
            return;
        }

        update_post_meta($post_id, 'memphislaw_role', sanitize_text_field(wp_unslash($_POST['memphislaw_role'] ?? '')));
        update_post_meta($post_id, 'memphislaw_badge', sanitize_text_field(wp_unslash($_POST['memphislaw_badge'] ?? '')));
        update_post_meta($post_id, 'memphislaw_credentials', sanitize_textarea_field(wp_unslash($_POST['memphislaw_credentials'] ?? '')));
    }

    if ($post_type === 'ml_testimonial') {
        if (
            !isset($_POST['memphislaw_testimonial_meta_nonce']) ||
            !wp_verify_nonce(
                sanitize_text_field(wp_unslash($_POST['memphislaw_testimonial_meta_nonce'])),
                'memphislaw_save_testimonial_meta'
            )
        ) {
            return;
        }

        update_post_meta($post_id, 'memphislaw_testimonial_client', sanitize_text_field(wp_unslash($_POST['memphislaw_testimonial_client'] ?? '')));
        update_post_meta($post_id, 'memphislaw_testimonial_location', sanitize_text_field(wp_unslash($_POST['memphislaw_testimonial_location'] ?? '')));
        update_post_meta($post_id, 'memphislaw_testimonial_matter', sanitize_text_field(wp_unslash($_POST['memphislaw_testimonial_matter'] ?? '')));
        update_post_meta($post_id, 'memphislaw_testimonial_rating', max(1, min(5, (int) ($_POST['memphislaw_testimonial_rating'] ?? 5))));
    }
}
add_action('save_post', 'memphislaw_core_save_post_meta');

function memphislaw_core_get_legal_need_options(): array
{
    return [
        'Bankruptcy',
        'Personal Injury',
        "Workers' Compensation",
        'Wrongful Death',
        'General Consultation',
    ];
}

function memphislaw_core_render_consultation_form(): string
{
    $status = sanitize_key((string) ($_GET['consultation'] ?? ''));

    ob_start();
    ?>
    <div class="consultation-form">
        <h3><?php esc_html_e('Request Your Free Consultation', 'memphislaw-core'); ?></h3>

        <?php if ($status === 'success') : ?>
            <p class="consultation-form__status consultation-form__status--success"><?php esc_html_e("Message received. We'll be in touch within one business day.", 'memphislaw-core'); ?></p>
        <?php elseif ($status === 'error') : ?>
            <p class="consultation-form__status consultation-form__status--error"><?php esc_html_e('Please complete the required fields and try again.', 'memphislaw-core'); ?></p>
        <?php endif; ?>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <?php wp_nonce_field('memphislaw_submit_consultation', 'memphislaw_consultation_nonce'); ?>
            <input type="hidden" name="action" value="memphislaw_submit_consultation">

            <div class="consultation-form__grid">
                <div class="consultation-form__field">
                    <label for="ml-first-name"><?php esc_html_e('First Name', 'memphislaw-core'); ?> *</label>
                    <input id="ml-first-name" name="first_name" type="text" required>
                </div>
                <div class="consultation-form__field">
                    <label for="ml-last-name"><?php esc_html_e('Last Name', 'memphislaw-core'); ?> *</label>
                    <input id="ml-last-name" name="last_name" type="text" required>
                </div>
                <div class="consultation-form__field consultation-form__field--full">
                    <label for="ml-email"><?php esc_html_e('Email Address', 'memphislaw-core'); ?> *</label>
                    <input id="ml-email" name="email" type="email" required>
                </div>
                <div class="consultation-form__field consultation-form__field--full">
                    <label for="ml-phone"><?php esc_html_e('Phone Number', 'memphislaw-core'); ?> *</label>
                    <input id="ml-phone" name="phone" type="tel" required>
                </div>
                <div class="consultation-form__field consultation-form__field--full">
                    <label for="ml-legal-need"><?php esc_html_e('Area of Legal Need', 'memphislaw-core'); ?></label>
                    <select id="ml-legal-need" name="legal_need">
                        <?php foreach (memphislaw_core_get_legal_need_options() as $option) : ?>
                            <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="consultation-form__field consultation-form__field--full">
                    <label for="ml-description"><?php esc_html_e('Brief Description of Your Situation', 'memphislaw-core'); ?></label>
                    <textarea id="ml-description" name="description" placeholder="<?php esc_attr_e('Tell us what happened, when it happened, and any immediate concerns.', 'memphislaw-core'); ?>"></textarea>
                </div>
            </div>

            <label class="consultation-form__consent" for="ml-consent">
                <input id="ml-consent" name="consent" type="checkbox" value="1" required>
                <span><?php esc_html_e('I understand that submitting this form does not create an attorney-client relationship and that my information will be kept confidential.', 'memphislaw-core'); ?></span>
            </label>

            <button class="button" type="submit"><?php esc_html_e('Send My Request', 'memphislaw-core'); ?></button>

            <p class="consultation-form__footnote"><?php esc_html_e('Attorney advertising. Results vary by case. No attorney-client relationship is formed by submitting this form.', 'memphislaw-core'); ?></p>
        </form>
    </div>
    <?php

    return (string) ob_get_clean();
}
add_shortcode('memphislaw_consultation_form', 'memphislaw_core_render_consultation_form');

function memphislaw_core_handle_consultation_submission(): void
{
    if (
        !isset($_POST['memphislaw_consultation_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['memphislaw_consultation_nonce'])),
            'memphislaw_submit_consultation'
        )
    ) {
        wp_die(esc_html__('Invalid submission.', 'memphislaw-core'));
    }

    $first_name = sanitize_text_field(wp_unslash($_POST['first_name'] ?? ''));
    $last_name = sanitize_text_field(wp_unslash($_POST['last_name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
    $legal_need = sanitize_text_field(wp_unslash($_POST['legal_need'] ?? ''));
    $description = sanitize_textarea_field(wp_unslash($_POST['description'] ?? ''));
    $consent = !empty($_POST['consent']);

    $redirect = wp_get_referer() ?: home_url('/#consultation');

    if ($first_name === '' || $last_name === '' || $email === '' || $phone === '' || !$consent) {
        wp_safe_redirect(add_query_arg('consultation', 'error', $redirect));
        exit;
    }

    $title = trim($first_name . ' ' . $last_name);
    $body = "Name: {$title}\nEmail: {$email}\nPhone: {$phone}\nArea: {$legal_need}\n\n{$description}";

    $request_id = wp_insert_post(
        [
            'post_type' => 'ml_consultation_request',
            'post_status' => 'private',
            'post_title' => $title !== '' ? $title : __('Consultation Request', 'memphislaw-core'),
            'post_content' => $body,
        ]
    );

    if (!is_wp_error($request_id) && $request_id > 0) {
        update_post_meta($request_id, 'memphislaw_email', $email);
        update_post_meta($request_id, 'memphislaw_phone', $phone);
        update_post_meta($request_id, 'memphislaw_legal_need', $legal_need);
        update_post_meta($request_id, 'memphislaw_consent', $consent ? 'yes' : 'no');
    }

    $admin_email = get_option('admin_email');
    if ($admin_email) {
        wp_mail(
            $admin_email,
            sprintf(__('New consultation request from %s', 'memphislaw-core'), $title),
            $body
        );
    }

    wp_safe_redirect(add_query_arg('consultation', 'success', $redirect));
    exit;
}
add_action('admin_post_nopriv_memphislaw_submit_consultation', 'memphislaw_core_handle_consultation_submission');
add_action('admin_post_memphislaw_submit_consultation', 'memphislaw_core_handle_consultation_submission');

function memphislaw_core_seed_starter_content(): void
{
    if ((int) wp_count_posts('ml_attorney')->publish === 0) {
        $attorney_id = wp_insert_post(
            [
                'post_type' => 'ml_attorney',
                'post_status' => 'publish',
                'post_title' => 'Arthur Ray, Esq.',
                'post_excerpt' => "Arthur Ray has practiced bankruptcy law in Memphis for decades and built a respected personal injury and workers' compensation practice serving the Mid-South.",
                'menu_order' => 0,
            ]
        );

        if (!is_wp_error($attorney_id) && $attorney_id > 0) {
            update_post_meta($attorney_id, 'memphislaw_role', 'Founding Attorney');
            update_post_meta($attorney_id, 'memphislaw_badge', 'Lead Attorney');
            update_post_meta($attorney_id, 'memphislaw_credentials', "University of Memphis Cecil C. Humphreys School of Law\nTennessee Bar Association member\nWestern District of Tennessee bankruptcy practice\nMemphis Bar Association member");
        }

        $associate_id = wp_insert_post(
            [
                'post_type' => 'ml_attorney',
                'post_status' => 'publish',
                'post_title' => 'Associate Attorney',
                'post_excerpt' => "Focused personal injury and workers' compensation advocacy backed by attentive case preparation and responsive client care.",
                'menu_order' => 1,
            ]
        );

        if (!is_wp_error($associate_id) && $associate_id > 0) {
            update_post_meta($associate_id, 'memphislaw_role', "Personal Injury and Workers' Compensation");
            update_post_meta($associate_id, 'memphislaw_badge', '');
            update_post_meta($associate_id, 'memphislaw_credentials', "Licensed in Tennessee\nPersonal injury litigation\nWorkers' compensation claims and appeals");
        }
    }

    if ((int) wp_count_posts('ml_testimonial')->publish === 0) {
        $items = [
            [
                'title' => 'Bankruptcy Testimonial One',
                'excerpt' => 'Mr. Ray helped me through Chapter 7 bankruptcy when I felt like I had nowhere to turn. He explained everything clearly and handled the paperwork from start to finish.',
                'client' => 'D. Johnson',
                'location' => 'Memphis, TN',
                'matter' => 'Bankruptcy Client',
            ],
            [
                'title' => 'Personal Injury Testimonial One',
                'excerpt' => 'Arthur Ray Law Offices took my car accident case, handled the insurance company, and recovered far more than I expected.',
                'client' => 'M. Williams',
                'location' => 'Germantown, TN',
                'matter' => 'Personal Injury Client',
            ],
            [
                'title' => 'Workers Compensation Testimonial One',
                'excerpt' => "My workers' compensation claim was denied after a serious back injury on the job. Mr. Ray appealed the decision and we won.",
                'client' => 'R. Thomas',
                'location' => 'Bartlett, TN',
                'matter' => "Workers' Compensation Client",
            ],
        ];

        foreach ($items as $item) {
            $testimonial_id = wp_insert_post(
                [
                    'post_type' => 'ml_testimonial',
                    'post_status' => 'publish',
                    'post_title' => $item['title'],
                    'post_excerpt' => $item['excerpt'],
                ]
            );

            if (!is_wp_error($testimonial_id) && $testimonial_id > 0) {
                update_post_meta($testimonial_id, 'memphislaw_testimonial_client', $item['client']);
                update_post_meta($testimonial_id, 'memphislaw_testimonial_location', $item['location']);
                update_post_meta($testimonial_id, 'memphislaw_testimonial_matter', $item['matter']);
                update_post_meta($testimonial_id, 'memphislaw_testimonial_rating', 5);
            }
        }
    }
}

function memphislaw_core_get_or_create_page(string $title, string $slug): int
{
    $existing = get_page_by_path($slug, OBJECT, 'page');

    if ($existing instanceof WP_Post) {
        $needs_update = $existing->post_title !== $title || $existing->post_status !== 'publish';

        if ($needs_update) {
            wp_update_post(
                [
                    'ID' => (int) $existing->ID,
                    'post_title' => $title,
                    'post_status' => 'publish',
                ]
            );
        }

        return (int) $existing->ID;
    }

    $page_id = wp_insert_post(
        [
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => $title,
            'post_name' => $slug,
        ]
    );

    return is_wp_error($page_id) ? 0 : (int) $page_id;
}

function memphislaw_core_ensure_practice_area_pages(): array
{
    $pages = [
        'bankruptcy' => 'Bankruptcy',
        'personal-injury' => 'Personal Injury',
        'workers-compensation' => "Workers' Compensation",
    ];

    $page_ids = [];

    foreach ($pages as $slug => $title) {
        $page_ids[$slug] = memphislaw_core_get_or_create_page($title, $slug);
    }

    return $page_ids;
}

function memphislaw_core_remove_default_content(): void
{
    $default_post = get_page_by_path('hello-world', OBJECT, 'post');
    if ($default_post instanceof WP_Post && $default_post->post_title === 'Hello world!') {
        wp_delete_post($default_post->ID, true);
    }

    $default_page = get_page_by_path('sample-page', OBJECT, 'page');
    if ($default_page instanceof WP_Post && $default_page->post_title === 'Sample Page') {
        wp_delete_post($default_page->ID, true);
    }

    foreach (get_comments(['status' => 'all', 'number' => 20]) as $comment) {
        if (
            $comment instanceof WP_Comment &&
            $comment->comment_author === 'A WordPress Commenter' &&
            strpos($comment->comment_content, 'Hi, this is a comment.') !== false
        ) {
            wp_delete_comment((int) $comment->comment_ID, true);
        }
    }
}

function memphislaw_core_ensure_primary_menu(): int
{
    $menu_name = 'Primary Navigation';
    $menu = wp_get_nav_menu_object($menu_name);

    if (!$menu) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = (int) $menu->term_id;
    }

    if (is_wp_error($menu_id) || $menu_id <= 0) {
        return 0;
    }

    $locations = get_theme_mod('nav_menu_locations');
    if (!is_array($locations)) {
        $locations = [];
    }

    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    $existing_items = wp_get_nav_menu_items($menu_id);
    if (!empty($existing_items)) {
        return $menu_id;
    }

    $menu_items = [
        ['title' => 'Practice Areas', 'url' => home_url('/#practice-areas')],
        ['title' => "Workers' Comp", 'url' => home_url('/#workers-comp')],
        ['title' => 'Our Team', 'url' => home_url('/#team')],
        ['title' => 'Testimonials', 'url' => home_url('/#testimonials')],
        ['title' => 'Contact', 'url' => home_url('/#consultation')],
    ];

    foreach ($menu_items as $item) {
        wp_update_nav_menu_item(
            $menu_id,
            0,
            [
                'menu-item-title' => $item['title'],
                'menu-item-url' => $item['url'],
                'menu-item-status' => 'publish',
            ]
        );
    }

    return $menu_id;
}

function memphislaw_core_apply_site_setup(): array
{
    memphislaw_core_register_post_types();
    memphislaw_core_seed_starter_content();
    memphislaw_core_remove_default_content();

    update_option('blogname', 'Arthur Ray Law Offices');
    update_option('blogdescription', 'Trusted legal counsel for Memphis families since 1974.');
    update_option('timezone_string', 'America/Chicago');
    update_option('date_format', 'F j, Y');
    update_option('time_format', 'g:i A');

    $home_page_id = memphislaw_core_get_or_create_page('Home', 'home');
    $practice_page_ids = memphislaw_core_ensure_practice_area_pages();

    if ($home_page_id > 0) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page_id);
        update_option('page_for_posts', 0);
    }

    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();

    $menu_id = memphislaw_core_ensure_primary_menu();

    return [
        'home_page_id' => $home_page_id,
        'menu_id' => $menu_id,
        'practice_page_count' => count(array_filter($practice_page_ids)),
    ];
}

function memphislaw_core_register_wp_cli_commands(): void
{
    WP_CLI::add_command(
        'memphislaw setup-site',
        function (): void {
            $result = memphislaw_core_apply_site_setup();

            WP_CLI::success(
                sprintf(
                    'Memphis Law site configured. Home page ID: %1$d. Menu ID: %2$d. Practice pages: %3$d.',
                    (int) $result['home_page_id'],
                    (int) $result['menu_id'],
                    (int) $result['practice_page_count']
                )
            );
        }
    );
}

function memphislaw_core_activate(): void
{
    memphislaw_core_register_post_types();
    memphislaw_core_seed_starter_content();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'memphislaw_core_activate');

if (defined('WP_CLI') && WP_CLI) {
    memphislaw_core_register_wp_cli_commands();
}
