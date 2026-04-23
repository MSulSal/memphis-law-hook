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
- Update homepage section headings, contact details, footer legal text, and shared firm stats in `Appearance > Customize`
- Update the practice area cards by editing the corresponding WordPress pages and their excerpts
- Replace the logo through WordPress custom logo support when needed

Items still best handled by a developer or power user:

- Major homepage layout changes
- CSS or spacing refinements
- Deployment and migration packaging

## Styling controls already exposed

The current Customizer controls cover:

- Hero image
- Hero heading, supporting copy, CTA labels, and stat row
- Accent gold, action blue, page background, and panel surface colors
- Homepage section headings and supporting copy
- Shared contact details, footer legal disclaimer, and consultation map image
- Header consultation button label and the four firm stats below the team section

## Content editing workflow

Use these paths during handoff:

- `Settings > General`: site title and tagline
- `Appearance > Customize > Site Identity`: upload a replacement logo
- `Appearance > Customize > Homepage Hero`: hero copy, buttons, and hero stats
- `Appearance > Customize > Homepage Sections`: section headings and supporting copy
- `Appearance > Customize > Firm Details`: address, phone, email, office hours, footer disclaimer, and map image
- `Appearance > Customize > Homepage Stats`: the four firm credibility stats
- `Pages > Bankruptcy`, `Pages > Personal Injury`, `Pages > Workers' Compensation`: practice page title, excerpt, and homepage card icon/bullets

## Recommended client-facing plugin policy

Keep the production plugin footprint minimal. The current custom plugin is intentionally small to protect import size and reduce future plugin breakage risk.

## Before handoff

1. Confirm admin email is set correctly in WordPress.
2. Confirm consultation requests are saving and emailing correctly.
3. Replace any fallback copy with approved final client copy.
4. Run a final mobile pass.
5. Export a fresh migration package and confirm the file size is still safe.
