<?php
declare(strict_types=1);

function memphislaw_get_primary_navigation_items(): array
{
    return [
        ['label' => __('Practice Areas', 'memphislaw'), 'url' => home_url('/#practice-areas')],
        ['label' => __("Workers' Comp", 'memphislaw'), 'url' => home_url('/#workers-comp')],
        ['label' => __('Our Team', 'memphislaw'), 'url' => home_url('/#team')],
        ['label' => __('Testimonials', 'memphislaw'), 'url' => home_url('/#testimonials')],
        ['label' => __('Contact', 'memphislaw'), 'url' => home_url('/#consultation')],
    ];
}

function memphislaw_get_practice_areas(): array
{
    return [
        [
            'id' => 'bankruptcy',
            'icon' => 'B',
            'title' => __('Bankruptcy', 'memphislaw'),
            'summary' => __('Over 50 years of experience filing bankruptcies in the Western District of Tennessee, guiding clients through Chapter 7 and Chapter 13 with clarity and care.', 'memphislaw'),
            'bullets' => [
                __('Chapter 7 liquidation filings', 'memphislaw'),
                __('Chapter 13 repayment plans', 'memphislaw'),
                __('Automatic stay protection', 'memphislaw'),
                __('Trustee filing and creditor negotiation', 'memphislaw'),
            ],
            'link' => home_url('/#consultation'),
        ],
        [
            'id' => 'personal-injury',
            'icon' => 'P',
            'title' => __('Personal Injury', 'memphislaw'),
            'summary' => __('Injury representation built around medical recovery, lost wages, and long-term accountability. No fees unless you win.', 'memphislaw'),
            'bullets' => [
                __('Auto and truck accidents', 'memphislaw'),
                __('Slip and fall injuries', 'memphislaw'),
                __('Medical malpractice', 'memphislaw'),
                __('Wrongful death claims', 'memphislaw'),
            ],
            'link' => home_url('/#consultation'),
        ],
        [
            'id' => 'workers-compensation',
            'icon' => 'W',
            'title' => __("Workers' Compensation", 'memphislaw'),
            'summary' => __('Representation for injured employees dealing with denied claims, wage replacement disputes, disability benefits, and return-to-work issues.', 'memphislaw'),
            'bullets' => [
                __('Work injury claims', 'memphislaw'),
                __('Denied claim appeals', 'memphislaw'),
                __('Permanent disability questions', 'memphislaw'),
                __('Third-party liability claims', 'memphislaw'),
            ],
            'link' => home_url('/#workers-comp'),
        ],
    ];
}

function memphislaw_get_workers_comp_benefits(): array
{
    return [
        [
            'icon' => 'M',
            'title' => __('Medical Care', 'memphislaw'),
            'summary' => __('Necessary and reasonable medical treatment paid in full, including visits, surgery, therapy, and prescriptions.', 'memphislaw'),
        ],
        [
            'icon' => 'W',
            'title' => __('Wage Replacement', 'memphislaw'),
            'summary' => __('Temporary Total Disability benefits can replace part of your wages while you are unable to work.', 'memphislaw'),
        ],
        [
            'icon' => 'D',
            'title' => __('Permanent Disability', 'memphislaw'),
            'summary' => __('Lasting impairment may qualify you for permanent partial or total disability benefits.', 'memphislaw'),
        ],
        [
            'icon' => 'V',
            'title' => __('Vocational Rehab', 'memphislaw'),
            'summary' => __('If you cannot return to your prior role, vocational support may help with retraining and reemployment.', 'memphislaw'),
        ],
        [
            'icon' => 'F',
            'title' => __('Death Benefits', 'memphislaw'),
            'summary' => __('Surviving family members may receive funeral expenses and ongoing support after a fatal work injury.', 'memphislaw'),
        ],
        [
            'icon' => 'R',
            'title' => __('Anti-Retaliation', 'memphislaw'),
            'summary' => __('Tennessee law prohibits employers from firing or discriminating against workers for filing legitimate claims.', 'memphislaw'),
        ],
    ];
}

function memphislaw_get_workers_comp_steps(): array
{
    return [
        [
            'title' => __('Report the injury immediately', 'memphislaw'),
            'summary' => __('Notify your supervisor in writing as soon as possible.', 'memphislaw'),
        ],
        [
            'title' => __('Seek approved medical care', 'memphislaw'),
            'summary' => __('Use the employer-approved panel physician when required.', 'memphislaw'),
        ],
        [
            'title' => __('Document everything', 'memphislaw'),
            'summary' => __('Keep records, receipts, correspondence, and work restrictions.', 'memphislaw'),
        ],
        [
            'title' => __('Call us early', 'memphislaw'),
            'summary' => __('We can protect the claim while you focus on healing.', 'memphislaw'),
        ],
    ];
}

function memphislaw_trim_summary(string $text, int $words = 40): string
{
    return wp_trim_words(wp_strip_all_tags($text), $words, '...');
}

function memphislaw_get_attorneys(): array
{
    $defaults = [
        [
            'name' => __('Arthur Ray, Esq.', 'memphislaw'),
            'role' => __('Founding Attorney', 'memphislaw'),
            'badge' => __('Lead Attorney', 'memphislaw'),
            'summary' => __('Arthur Ray has practiced bankruptcy law in Memphis for decades while also building a trusted personal injury and workers’ compensation practice for Mid-South families.', 'memphislaw'),
            'credentials' => [
                __('University of Memphis Cecil C. Humphreys School of Law', 'memphislaw'),
                __('Tennessee Bar Association member', 'memphislaw'),
                __('Western District of Tennessee bankruptcy practice', 'memphislaw'),
                __('Memphis Bar Association member', 'memphislaw'),
            ],
            'initials' => 'AR',
        ],
        [
            'name' => __('Associate Attorney', 'memphislaw'),
            'role' => __('Personal Injury and Workers’ Compensation', 'memphislaw'),
            'badge' => '',
            'summary' => __('The associate attorney team supports focused personal injury and workers’ compensation litigation with attentive case management and courtroom preparation.', 'memphislaw'),
            'credentials' => [
                __('Licensed in Tennessee', 'memphislaw'),
                __('Personal injury litigation', 'memphislaw'),
                __('Workers’ compensation claims and appeals', 'memphislaw'),
            ],
            'initials' => 'AA',
        ],
    ];

    if (!post_type_exists('ml_attorney')) {
        return $defaults;
    }

    $query = new WP_Query(
        [
            'post_type'      => 'ml_attorney',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ]
    );

    if (!$query->have_posts()) {
        return $defaults;
    }

    $items = [];

    while ($query->have_posts()) {
        $query->the_post();
        $credentials = (string) get_post_meta(get_the_ID(), 'memphislaw_credentials', true);
        $summary = get_the_excerpt();

        if ($summary === '') {
            $summary = memphislaw_trim_summary((string) get_the_content(), 48);
        }

        $items[] = [
            'name' => get_the_title(),
            'role' => (string) get_post_meta(get_the_ID(), 'memphislaw_role', true),
            'badge' => (string) get_post_meta(get_the_ID(), 'memphislaw_badge', true),
            'summary' => $summary,
            'credentials' => array_values(
                array_filter(
                    array_map(
                        'trim',
                        preg_split('/\r\n|\r|\n/', $credentials) ?: []
                    )
                )
            ),
            'initials' => strtoupper(substr((string) get_the_title(), 0, 1) . substr((string) get_the_title(), strpos((string) get_the_title(), ' ') + 1, 1)),
        ];
    }

    wp_reset_postdata();

    return $items ?: $defaults;
}

function memphislaw_get_site_stats(): array
{
    return [
        ['value' => '50+', 'label' => __('Years of Bankruptcy Practice', 'memphislaw')],
        ['value' => '5,000+', 'label' => __('Bankruptcy Cases Filed', 'memphislaw')],
        ['value' => '$Millions', 'label' => __('Recovered for Injured Clients', 'memphislaw')],
        ['value' => '3', 'label' => __('Core Practice Areas', 'memphislaw')],
    ];
}

function memphislaw_get_testimonials(): array
{
    $defaults = [
        [
            'quote' => __('Mr. Ray helped me through Chapter 7 bankruptcy when I felt like I had nowhere to turn. He explained everything clearly and handled the paperwork from start to finish.', 'memphislaw'),
            'client' => __('D. Johnson, Memphis, TN', 'memphislaw'),
            'matter' => __('Bankruptcy Client', 'memphislaw'),
            'rating' => 5,
        ],
        [
            'quote' => __('I was injured in a car accident and did not know where to start. Arthur Ray Law Offices took my case, handled the insurance company, and recovered far more than I expected.', 'memphislaw'),
            'client' => __('M. Williams, Germantown, TN', 'memphislaw'),
            'matter' => __('Personal Injury Client', 'memphislaw'),
            'rating' => 5,
        ],
        [
            'quote' => __('My workers’ compensation claim was denied after a serious back injury on the job. Mr. Ray appealed the decision and we won.', 'memphislaw'),
            'client' => __('R. Thomas, Bartlett, TN', 'memphislaw'),
            'matter' => __('Workers’ Compensation Client', 'memphislaw'),
            'rating' => 5,
        ],
        [
            'quote' => __('Filing Chapter 13 bankruptcy saved my home from foreclosure. The team walked me through the repayment plan and kept creditors off my back.', 'memphislaw'),
            'client' => __('L. Brown, Collierville, TN', 'memphislaw'),
            'matter' => __('Bankruptcy Client', 'memphislaw'),
            'rating' => 5,
        ],
        [
            'quote' => __('After my slip-and-fall, the firm helped me recover compensation for medical bills and lost income. Compassionate and highly professional.', 'memphislaw'),
            'client' => __('C. Harris, Memphis, TN', 'memphislaw'),
            'matter' => __('Personal Injury Client', 'memphislaw'),
            'rating' => 5,
        ],
        [
            'quote' => __('I have referred several friends to Arthur Ray over the years. Every one of them came back grateful for the care and professionalism.', 'memphislaw'),
            'client' => __('J. Davis, Memphis, TN', 'memphislaw'),
            'matter' => __('Long-Term Client', 'memphislaw'),
            'rating' => 5,
        ],
    ];

    if (!post_type_exists('ml_testimonial')) {
        return $defaults;
    }

    $query = new WP_Query(
        [
            'post_type'      => 'ml_testimonial',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]
    );

    if (!$query->have_posts()) {
        return $defaults;
    }

    $items = [];

    while ($query->have_posts()) {
        $query->the_post();
        $quote = get_the_excerpt();

        if ($quote === '') {
            $quote = memphislaw_trim_summary((string) get_the_content(), 38);
        }

        $items[] = [
            'quote' => $quote,
            'client' => trim((string) get_post_meta(get_the_ID(), 'memphislaw_testimonial_client', true) . ', ' . (string) get_post_meta(get_the_ID(), 'memphislaw_testimonial_location', true), ', '),
            'matter' => (string) get_post_meta(get_the_ID(), 'memphislaw_testimonial_matter', true),
            'rating' => max(1, min(5, (int) get_post_meta(get_the_ID(), 'memphislaw_testimonial_rating', true))),
        ];
    }

    wp_reset_postdata();

    return $items ?: $defaults;
}

function memphislaw_get_contact_details(): array
{
    return [
        'address_line_1' => __('6244 Poplar Ave, Suite 150', 'memphislaw'),
        'address_line_2' => __('Memphis, TN 38119', 'memphislaw'),
        'phone' => '901-475-8200',
        'email' => 'info@memphislaw.com',
        'hours' => __('Mon-Fri: 8:30 AM - 5:30 PM | Sat: By appointment', 'memphislaw'),
    ];
}
