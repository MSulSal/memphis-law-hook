# Memphis Law WordPress Build

Lightweight WordPress build for Arthur Ray Law Offices, aligned to the approved redesign PDF and prepared for clean client handoff.

## Project goals

- Keep the deliverable WordPress-native.
- Stay friendly to a `60 MB` All-in-One WP Migration import budget for Wasmer demos.
- Avoid heavy page builders and dependency sprawl.
- Preserve continuity with docs so future sessions can pick up without guesswork.

## Current custom stack

- Theme: `app/public/wp-content/themes/memphislaw`
- Plugin: `app/public/wp-content/plugins/memphislaw-core`
- Plugin: `app/public/wp-content/plugins/memphislaw-google-maps`
- WP-CLI helper: `scripts/wp-local.ps1`

## What this build includes

- A lightweight custom theme implementing the approved one-page homepage direction.
- A companion plugin for attorneys, testimonials, and consultation request handling.
- A lightweight Google Maps plugin for the live office map without adding third-party plugin bloat.
- Starter docs for handoff, deployment discipline, and next commits.
- Git hygiene that tracks only the custom WordPress surface, not core or Local runtime files.

## Local workflow

1. Start the site in Local so MySQL is available.
2. Run `.\scripts\setup-demo-site.ps1` for the first-time site bootstrap.
3. Use `.\scripts\wp-local.ps1 <wp-cli args>` for ongoing local WordPress operations.

If the Local site is down, WP-CLI will fail with a database connection error until Local is started.

## Bootstrap command

The setup script is idempotent and handles the initial site state:

- activates the `Memphis Law Core` plugin
- activates the `Memphis Law Google Maps` plugin
- activates the `Memphis Law` theme
- creates or reuses the `Home` page
- creates or reuses the three core practice area pages
- sets WordPress to show a static front page
- creates and assigns the primary navigation menu
- removes default starter content
- seeds starter attorneys and testimonials
- seeds structured practice-area page fields for the three core landing pages

## Git remote

Planned GitHub remote:

`https://github.com/MSulSal/memphis-law-hook.git`

## Repo structure

- `app/public/wp-content/themes/memphislaw`: presentation layer and homepage layout.
- `app/public/wp-content/plugins/memphislaw-core`: structured content and form handling.
- `app/public/wp-content/plugins/memphislaw-google-maps`: live Google Maps embed settings and shortcode rendering.
- `docs`: continuity, handoff, and deployment notes.
- `scripts`: local helper scripts for WordPress operations.

## Proposal-ready checks

- Confirm the final office map settings in `Settings > Memphis Law Map`.
- Rehearse the All-in-One WP Migration export and verify the archive size stays safe for Wasmer hosting.
- Replace any remaining placeholder content only after client feedback requires it.
