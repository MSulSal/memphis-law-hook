<?php
declare(strict_types=1);

function memphislaw_get_consultation_url(): string
{
    return home_url('/#consultation');
}

function memphislaw_get_page_url_by_path(string $slug, string $fallback): string
{
    $page = get_page_by_path($slug, OBJECT, 'page');

    if ($page instanceof WP_Post) {
        $permalink = get_permalink($page);

        if (is_string($permalink) && $permalink !== '') {
            return $permalink;
        }
    }

    return $fallback;
}

function memphislaw_get_primary_navigation_items(): array
{
    return [
        ['label' => __('Practice Areas', 'memphislaw'), 'url' => home_url('/#practice-areas')],
        ['label' => __("Workers' Comp", 'memphislaw'), 'url' => memphislaw_get_page_url_by_path('workers-compensation', home_url('/#workers-comp'))],
        ['label' => __('Our Team', 'memphislaw'), 'url' => home_url('/#team')],
        ['label' => __('Testimonials', 'memphislaw'), 'url' => home_url('/#testimonials')],
        ['label' => __('Contact', 'memphislaw'), 'url' => memphislaw_get_consultation_url()],
    ];
}

function memphislaw_get_practice_area_pages(): array
{
    return [
        'bankruptcy' => [
            'slug' => 'bankruptcy',
            'icon' => 'B',
            'title' => __('Bankruptcy', 'memphislaw'),
            'summary' => __('Over 50 years of experience filing bankruptcies in the Western District of Tennessee, guiding clients through Chapter 7 and Chapter 13 with clarity and care.', 'memphislaw'),
            'bullets' => [
                __('Chapter 7 liquidation filings', 'memphislaw'),
                __('Chapter 13 repayment plans', 'memphislaw'),
                __('Automatic stay protection', 'memphislaw'),
                __('Trustee filing and creditor negotiation', 'memphislaw'),
            ],
            'fallback_link' => memphislaw_get_consultation_url(),
            'eyebrow' => __('Memphis Debt Relief Counsel', 'memphislaw'),
            'hero_title' => __('A clear bankruptcy plan can stop the spiral and help you reset.', 'memphislaw'),
            'hero_summary' => __('If collection pressure, wage garnishment, or the threat of foreclosure is closing in, Arthur Ray Law Offices helps you understand what bankruptcy can protect and which filing path actually fits your situation.', 'memphislaw'),
            'overview_heading' => __('Debt relief strategy built around real life, not paperwork alone.', 'memphislaw'),
            'overview_copy' => __('We explain your options in plain language, prepare the filing carefully, and stay involved through trustee questions and creditor pressure so you can move forward with more certainty.', 'memphislaw'),
            'case_cards' => [
                [
                    'title' => __('Chapter 7 relief', 'memphislaw'),
                    'summary' => __('When unsecured debt has outpaced income and a faster fresh start may be the most practical path forward.', 'memphislaw'),
                ],
                [
                    'title' => __('Chapter 13 repayment plans', 'memphislaw'),
                    'summary' => __('When you need court protection while catching up on mortgage arrears, tax debt, or other structured obligations.', 'memphislaw'),
                ],
                [
                    'title' => __('Foreclosure and garnishment pressure', 'memphislaw'),
                    'summary' => __('We help clients evaluate timing issues when wages, bank accounts, or homes are already under immediate pressure.', 'memphislaw'),
                ],
                [
                    'title' => __('Creditor and trustee communication', 'memphislaw'),
                    'summary' => __('Your filing needs to be accurate, documented, and supported so you are not left alone answering legal and procedural questions.', 'memphislaw'),
                ],
            ],
            'process_heading' => __('What working with our office looks like', 'memphislaw'),
            'process_steps' => [
                [
                    'title' => __('Review the full financial picture', 'memphislaw'),
                    'summary' => __('We look at debt, income, assets, pending lawsuits, and timing concerns before recommending any filing path.', 'memphislaw'),
                ],
                [
                    'title' => __('Choose the filing strategy that fits', 'memphislaw'),
                    'summary' => __('We walk through the tradeoffs between Chapter 7, Chapter 13, and non-filing alternatives so the decision is informed.', 'memphislaw'),
                ],
                [
                    'title' => __('Prepare and file with care', 'memphislaw'),
                    'summary' => __('Accurate schedules, supporting documents, and steady communication reduce avoidable problems after filing.', 'memphislaw'),
                ],
                [
                    'title' => __('Guide you through the next stage', 'memphislaw'),
                    'summary' => __('We stay involved through trustee questions, creditor issues, and the practical steps that follow your case.', 'memphislaw'),
                ],
            ],
            'support_points' => [
                __('Collection calls and lawsuits', 'memphislaw'),
                __('Mortgage arrears and foreclosure pressure', 'memphislaw'),
                __('Wage garnishments and frozen breathing room', 'memphislaw'),
                __('Choosing between Chapter 7 and Chapter 13', 'memphislaw'),
            ],
            'cta_title' => __('Talk with an attorney before making a rushed financial decision.', 'memphislaw'),
            'cta_copy' => __('A short consultation can clarify whether bankruptcy is the right step or whether another path makes more sense for your household.', 'memphislaw'),
        ],
        'personal-injury' => [
            'slug' => 'personal-injury',
            'icon' => 'P',
            'title' => __('Personal Injury', 'memphislaw'),
            'summary' => __('Injury representation built around medical recovery, lost wages, and long-term accountability. No fees unless you win.', 'memphislaw'),
            'bullets' => [
                __('Auto and truck accidents', 'memphislaw'),
                __('Slip and fall injuries', 'memphislaw'),
                __('Medical malpractice', 'memphislaw'),
                __('Wrongful death claims', 'memphislaw'),
            ],
            'fallback_link' => memphislaw_get_consultation_url(),
            'eyebrow' => __('Memphis Injury Representation', 'memphislaw'),
            'hero_title' => __('When someone else causes the harm, we push for the recovery you actually need.', 'memphislaw'),
            'hero_summary' => __('Serious injuries can disrupt medical treatment, work, transportation, and family stability all at once. We help clients move quickly on the evidence while standing up to insurers that want the claim resolved cheaply.', 'memphislaw'),
            'overview_heading' => __('Your case is about more than a settlement number.', 'memphislaw'),
            'overview_copy' => __('Strong injury representation means understanding the full effect of the accident on your health, your wages, and your daily life. We build the claim around those realities from the beginning.', 'memphislaw'),
            'case_cards' => [
                [
                    'title' => __('Vehicle collisions', 'memphislaw'),
                    'summary' => __('Car, truck, and commercial vehicle claims often require fast evidence preservation and careful communication with adjusters.', 'memphislaw'),
                ],
                [
                    'title' => __('Premises liability injuries', 'memphislaw'),
                    'summary' => __('Falls and unsafe-property claims often turn on documentation, notice issues, and credible proof of damages.', 'memphislaw'),
                ],
                [
                    'title' => __('Wrongful death matters', 'memphislaw'),
                    'summary' => __('When a family is grieving, the legal process still moves quickly. We help protect the claim while treating the situation with care.', 'memphislaw'),
                ],
                [
                    'title' => __('Medical and wage loss claims', 'memphislaw'),
                    'summary' => __('We organize treatment records, missed work, and long-term consequences so the case reflects the real cost of the injury.', 'memphislaw'),
                ],
            ],
            'process_heading' => __('How we move an injury case forward', 'memphislaw'),
            'process_steps' => [
                [
                    'title' => __('Get the facts and records in quickly', 'memphislaw'),
                    'summary' => __('Crash reports, scene details, treatment records, and witness information are strongest when gathered early.', 'memphislaw'),
                ],
                [
                    'title' => __('Document the full scope of harm', 'memphislaw'),
                    'summary' => __('A case should account for treatment, lost income, pain, future care, and the day-to-day disruption the injury caused.', 'memphislaw'),
                ],
                [
                    'title' => __('Negotiate from a prepared position', 'memphislaw'),
                    'summary' => __('Insurers take claims more seriously when they see the evidence is organized and trial preparation is real.', 'memphislaw'),
                ],
                [
                    'title' => __('Litigate when the offer is not fair', 'memphislaw'),
                    'summary' => __('When necessary, we keep pressing the case instead of encouraging a quick resolution that leaves value behind.', 'memphislaw'),
                ],
            ],
            'support_points' => [
                __('Insurance companies delaying or minimizing the claim', 'memphislaw'),
                __('Medical bills and treatment coordination', 'memphislaw'),
                __('Lost wages and return-to-work pressure', 'memphislaw'),
                __('Understanding the value of a serious injury case', 'memphislaw'),
            ],
            'cta_title' => __('The first conversation should help you see the road ahead more clearly.', 'memphislaw'),
            'cta_copy' => __('We review what happened, what evidence matters next, and what mistakes to avoid while the injury claim is still taking shape.', 'memphislaw'),
        ],
        'workers-compensation' => [
            'slug' => 'workers-compensation',
            'icon' => 'W',
            'title' => __("Workers' Compensation", 'memphislaw'),
            'summary' => __('Representation for injured employees dealing with denied claims, wage replacement disputes, disability benefits, and return-to-work issues.', 'memphislaw'),
            'bullets' => [
                __('Work injury claims', 'memphislaw'),
                __('Denied claim appeals', 'memphislaw'),
                __('Permanent disability questions', 'memphislaw'),
                __('Third-party liability claims', 'memphislaw'),
            ],
            'fallback_link' => home_url('/#workers-comp'),
            'eyebrow' => __('Tennessee Work Injury Claims', 'memphislaw'),
            'hero_title' => __('Injured at work? We help protect the claim before the system starts pushing back.', 'memphislaw'),
            'hero_summary' => __("Workers' compensation cases can become difficult quickly when treatment is delayed, wages are interrupted, or a valid claim is denied. We help injured workers understand the process and respond early.", 'memphislaw'),
            'overview_heading' => __('A work injury claim can affect treatment, income, and job security at the same time.', 'memphislaw'),
            'overview_copy' => __("We help clients make sense of Tennessee's workers' compensation rules, preserve key deadlines, and challenge decisions that leave injured employees without the care or benefits they need.", 'memphislaw'),
            'case_cards' => [
                [
                    'title' => __('Denied or disputed claims', 'memphislaw'),
                    'summary' => __('When the insurer questions whether the injury happened at work or whether the treatment is really necessary.', 'memphislaw'),
                ],
                [
                    'title' => __('Medical treatment problems', 'memphislaw'),
                    'summary' => __('We help address panel physician issues, delayed care, and disputes over whether treatment should continue.', 'memphislaw'),
                ],
                [
                    'title' => __('Wage replacement disputes', 'memphislaw'),
                    'summary' => __('Temporary disability benefits and return-to-work issues often create immediate household pressure.', 'memphislaw'),
                ],
                [
                    'title' => __('Permanent impairment and appeals', 'memphislaw'),
                    'summary' => __('When a long-term injury affects future work capacity, the claim needs careful documentation and strong follow-through.', 'memphislaw'),
                ],
            ],
            'process_heading' => __('Key steps after a Tennessee work injury', 'memphislaw'),
            'process_steps' => memphislaw_get_workers_comp_steps(),
            'support_points' => [
                __('Report deadlines and documentation problems', 'memphislaw'),
                __('Denied claim appeals and benefit disputes', 'memphislaw'),
                __('Medical care delays or treatment denials', 'memphislaw'),
                __('Questions about permanent disability exposure', 'memphislaw'),
            ],
            'cta_title' => __('Getting help early can protect both the medical side and the legal side of the claim.', 'memphislaw'),
            'cta_copy' => __("We can review what has happened so far, identify pressure points in the claim, and help you decide what to do next before the file gets more complicated.", 'memphislaw'),
        ],
    ];
}

function memphislaw_get_practice_area_page(string $slug): ?array
{
    $pages = memphislaw_get_practice_area_pages();

    return $pages[$slug] ?? null;
}

function memphislaw_get_related_practice_areas(string $current_slug): array
{
    return array_values(
        array_filter(
            memphislaw_get_practice_areas(),
            static fn(array $area): bool => $area['id'] !== $current_slug
        )
    );
}

function memphislaw_get_practice_areas(): array
{
    $areas = [];

    foreach (memphislaw_get_practice_area_pages() as $slug => $page) {
        $areas[] = [
            'id' => $slug,
            'icon' => $page['icon'],
            'title' => $page['title'],
            'summary' => $page['summary'],
            'bullets' => $page['bullets'],
            'link' => memphislaw_get_page_url_by_path($slug, $page['fallback_link']),
        ];
    }

    return $areas;
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
            'summary' => __("Arthur Ray has practiced bankruptcy law in Memphis for decades while also building a trusted personal injury and workers' compensation practice for Mid-South families.", 'memphislaw'),
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
            'role' => __("Personal Injury and Workers' Compensation", 'memphislaw'),
            'badge' => '',
            'summary' => __("The associate attorney team supports focused personal injury and workers' compensation litigation with attentive case management and courtroom preparation.", 'memphislaw'),
            'credentials' => [
                __('Licensed in Tennessee', 'memphislaw'),
                __('Personal injury litigation', 'memphislaw'),
                __("Workers' compensation claims and appeals", 'memphislaw'),
            ],
            'initials' => 'AA',
        ],
    ];

    if (!post_type_exists('ml_attorney')) {
        return $defaults;
    }

    $query = new WP_Query(
        [
            'post_type' => 'ml_attorney',
            'posts_per_page' => 4,
            'post_status' => 'publish',
            'orderby' => 'menu_order title',
            'order' => 'ASC',
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

        $title_words = preg_split('/\s+/', trim((string) get_the_title())) ?: [];
        $initials = '';

        foreach (array_slice($title_words, 0, 2) as $word) {
            if ($word !== '') {
                $initials .= strtoupper(substr($word, 0, 1));
            }
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
            'initials' => $initials !== '' ? $initials : 'ML',
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
            'quote' => __("My workers' compensation claim was denied after a serious back injury on the job. Mr. Ray appealed the decision and we won.", 'memphislaw'),
            'client' => __('R. Thomas, Bartlett, TN', 'memphislaw'),
            'matter' => __("Workers' Compensation Client", 'memphislaw'),
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
            'post_type' => 'ml_testimonial',
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
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

        $client_name = (string) get_post_meta(get_the_ID(), 'memphislaw_testimonial_client', true);
        $client_location = (string) get_post_meta(get_the_ID(), 'memphislaw_testimonial_location', true);
        $client_line = trim($client_name . ', ' . $client_location, ', ');

        $items[] = [
            'quote' => $quote,
            'client' => $client_line !== '' ? $client_line : get_the_title(),
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
