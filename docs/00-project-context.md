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

## First commit architecture

- Custom theme handles the full presentation layer.
- Companion plugin handles structured content and contact intake.
- Content-heavy areas use sensible fallback data so the front-end can be built before the database is active.

## Current blocker noted during build

The Local WordPress database was not reachable during this session, so the site could not yet be activated or seeded through WP-CLI. Code was still written safely around that constraint.

## Next commits to preserve momentum

1. Bring Local online and activate the custom theme and plugin.
2. Seed demo content into WordPress and verify the home page visually in-browser.
3. Create dedicated practice area pages for Bankruptcy, Personal Injury, and Workers' Compensation.
4. Add final client polish: legal disclaimer review, favicon, OG image, and migration export validation.
