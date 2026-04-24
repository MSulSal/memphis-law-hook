# Client Handoff Notes

## Theme responsibility

The custom theme owns:

- Layout and styling
- Homepage section structure
- Navigation, footer, and responsive behavior
- Front-end integration for the consultation form shortcode

## Plugin responsibility

The companion plugin owns:

- Attorney content type
- Testimonial content type
- Consultation request intake
- Admin storage for form submissions

This split keeps presentation concerns out of the plugin and keeps site-specific data behavior out of the theme.

## Client editing expectations

After activation and content entry, the client or operator should be able to:

- Edit attorney bios in WordPress admin
- Edit testimonials in WordPress admin
- Receive consultation requests without a heavy form plugin
- Update the homepage hero copy, hero image, and core brand colors in `Appearance > Customize`
- Update homepage section headings, workers' compensation benefit cards, workers' compensation step copy, contact details, footer legal text, and shared firm stats in `Appearance > Customize`
- Update each practice-area landing page from its own WordPress editor screen, including hero copy, overview copy, detail cards, process steps, and CTA copy
- Replace the logo through WordPress custom logo support when needed
- Preview and toggle the light/dark presentation from the site header without changing themes

Items still best handled by a developer or power user:

- Major homepage layout changes
- CSS or spacing refinements
- Deployment and migration packaging

## Styling controls already exposed

The current Customizer controls cover:

- Hero image
- Hero heading, supporting copy, CTA labels, and stat row
- Accent gold, action blue, dark background and panel colors, plus the light-theme background and panel colors
- Homepage section headings, supporting copy, workers' compensation benefits, and workers' compensation steps
- Shared contact details, footer legal disclaimer, consultation map image, and multi-line office hours
- Header consultation button label and the four firm stats below the team section

## Content editing workflow

Use these paths during handoff:

- `Settings > General`: site title and tagline
- `Appearance > Customize > Site Identity`: upload a replacement logo
- `Appearance > Customize > Homepage Hero`: hero copy, buttons, and hero stats
- `Appearance > Customize > Homepage Sections`: section headings, supporting copy, workers' compensation benefit cards, and the work-injury step list
- `Appearance > Customize > Firm Details`: address, phone, email, office hours, footer disclaimer, and map image
- `Appearance > Customize > Brand Styles`: core dark/light palette colors
- `Appearance > Customize > Homepage Stats`: the four firm credibility stats
- `Pages > Bankruptcy`, `Pages > Personal Injury`, `Pages > Workers' Compensation`: page title, excerpt, body copy, and the structured `Practice Area Page Details` box for card copy, hero copy, overview copy, process steps, and CTA copy

## Theme preview notes

- The crescent toggle in the header swaps between the dark and light visual treatments on the front end.
- For review links or screenshot capture, `?theme=light` and `?theme=dark` can be appended to the home URL as non-destructive preview parameters.
- CSS and JavaScript assets are cache-busted automatically from file timestamps so new visual updates are less likely to get stuck behind stale browser cache.

## Recommended client-facing plugin policy

Keep the production plugin footprint minimal. The current custom plugin is intentionally small to protect import size and reduce future plugin breakage risk.

## Before handoff

1. Confirm admin email is set correctly in WordPress.
2. Confirm consultation requests are saving and emailing correctly.
3. Replace any fallback copy with approved final client copy.
4. Verify both header theme variants, especially on mobile.
5. Export a fresh migration package and confirm the file size is still safe.
