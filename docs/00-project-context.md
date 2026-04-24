# Project Context

## Client and build intent

This site is being rebuilt in WordPress for Arthur Ray Law Offices. The approved visual direction lives in `C:\Users\Sul\Desktop\memphislaw redesign.pdf`.

The immediate business goal is simple: get a client-ready demo close enough to the approved design that the client feels the project is already meaningfully complete.

## Constraints

- Must remain WordPress-native.
- Must be clean enough for client handoff.
- Must stay lean for Wasmer demo hosting and All-in-One WP Migration imports.
- Must avoid plugin bloat and page-builder lock-in.

## Approved homepage structure from the PDF

1. Hero with trust-first messaging and strong consultation CTA.
2. Three practice area cards.
3. Workers' compensation explainer section with benefits and next steps.
4. Team section.
5. Testimonials grid.
6. Contact section with consultation form and office details.
7. Legal footer.

## WordPress-native editing direction

The site must not depend on a page builder or non-WordPress handoff workflow. Homepage content and appearance controls should move into native WordPress editing surfaces wherever practical so the client can update copy, images, and brand styling without code changes.

The current theme now uses the Customizer for hero content, homepage section copy, contact details, workers' compensation benefit cards and step list copy, shared firm stats, logo replacement, and the core dark/light palette colors. The live office map is now handled by a dedicated lightweight WordPress plugin instead of a static image. The practice-area landing pages use structured WordPress editing surfaces instead of relying on PHP fallback copy.

The homepage editing model is now split in a client-friendly way:

- `Appearance > Customize` handles hero content, section headings, workers' compensation section copy, benefit cards, next-step items, contact details, shared stats, logo replacement, and key brand styling.
- `Settings > Memphis Law Map` handles the Google Maps query or client-supplied embed URL for the live office map.
- `Pages > Bankruptcy`, `Pages > Personal Injury`, and `Pages > Workers' Compensation` handle both the homepage cards and the deeper landing-page copy through the page title, excerpt, body content, and a structured "Practice Area Page Details" meta box.
- `Attorneys` and `Testimonials` remain managed through the companion plugin post types.
- The front-end header toggle switches between the dark and light visual treatments without requiring a separate theme.

## First commit architecture

- Custom theme handles the full presentation layer.
- Companion plugin handles structured content and contact intake.
- Content-heavy areas use sensible fallback data so the front-end can be built before the database is active.

## Current build status

The Local site is running, the custom theme and plugins activate cleanly, starter content is seeded through the setup script, and the homepage has been visually checked against the redesign PDF in both desktop and mobile layouts.

## Next commits to preserve momentum

1. Add favicon and OG/share image assets if they are needed for the client presentation.
2. Run a final migration export rehearsal and confirm the All-in-One WP Migration package stays within the Wasmer-friendly size target.
3. Replace any remaining demo-only content after client copy approval.
4. Package proposal screenshots and handoff notes from the current live demo state.
