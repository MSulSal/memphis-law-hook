# Wasmer and Migration Discipline

## Why this matters

The demo is intended for Wasmer hosting with a hard size ceiling for All-in-One WP Migration imports. That means every plugin, image, and theme asset needs a reason to exist.

## Rules for this project

- Prefer custom code over heavyweight plugins when the feature is small and stable.
- Store design assets inside the theme only when they are actually needed.
- Avoid bundling videos, giant images, or unused theme libraries.
- Do not commit WordPress core or Local runtime files to the repo.
- Keep uploads pruned before exports.

## Current lean choices

- No page builder.
- No generic contact form plugin.
- No design framework dependency.
- No extra starter themes in version control.

## Export checklist

1. Remove unused media.
2. Remove any inactive nonessential plugins before export.
3. Check `wp-content/uploads` size.
4. Check total migration export size.
5. Do one import rehearsal before sending the demo.
