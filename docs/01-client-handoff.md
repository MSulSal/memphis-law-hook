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

Items still best handled by a developer or power user:

- Major homepage layout changes
- CSS or spacing refinements
- Deployment and migration packaging

## Styling controls already exposed

The current Customizer controls cover:

- Hero image
- Hero heading, supporting copy, CTA labels, and stat row
- Accent gold, action blue, page background, and panel surface colors

## Recommended client-facing plugin policy

Keep the production plugin footprint minimal. The current custom plugin is intentionally small to protect import size and reduce future plugin breakage risk.

## Before handoff

1. Confirm admin email is set correctly in WordPress.
2. Confirm consultation requests are saving and emailing correctly.
3. Replace any fallback copy with approved final client copy.
4. Run a final mobile pass.
5. Export a fresh migration package and confirm the file size is still safe.
