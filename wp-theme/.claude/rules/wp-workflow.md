# Integration Workflow

## Overview
Convert the approved static layout (Vite + Tailwind + Alpine.js) into ACF Flexible Content WordPress theme.

**Golden rule:** every static `components/[name].html` → one ACF Flexible Content layout + one PHP template part.

---

## Step-by-step order (always follow)

### 1. Determine scope automatically
- Collect all `## [section-id]` headings from `../content/[page].md` — full section list
- Exclude non-buildable headings: `Project`, `Brief`, `meta`, `header`, `footer` (header/footer are handled in Step 6 separately)
- List files in `template-parts/flexible/` — every matching `[section-id].php` is already implemented
- Remaining sections = pending work
- Report before proceeding: "Implemented: X, Y. Pending: A, B, C."

### 2. Read the static source
- Read `../components/[name].html` — understand the HTML structure
- Read `../content/[page].md` — understand all copy fields and section IDs
- List all **hardcoded values** that must become ACF fields (text, images, links, lists)

### 3. Define fields for this section
- For each hardcoded value → choose the correct ACF type (see `acf-fields.md`)
- Name fields in `snake_case`, short and descriptive (e.g., `heading`, `body_text`, `cta_link`, `background_image`)
- Group repeating items into a **Repeater** field

### 4. Create the PHP template part
- File: `template-parts/flexible/[layout-name].php`
- Layout name = section ID from `content/[page].md` (e.g., `hero`, `services`, `about`)
- Replace every hardcoded value with `get_sub_field()` call
- Follow patterns in `php-patterns.md` — no exceptions

### 5. Add layout to the master field group
- Always write directly into `acf-json/group_flexible_content.json` — never create separate `layout_*.json` files
- If `group_flexible_content.json` does not exist yet — create it using the structure from `acf-json.md`
- Add the new layout object into `"layouts": { ... }` alongside any existing ones
- Key format: `field_[layout]_[fieldname]` (e.g., `field_hero_heading`)
- Location rule must be: `page_template == templates/flexible.php`

### 6. Convert header and footer
**Prerequisite:** only proceed if `../components/header.html` and `../components/footer.html` are non-empty (i.e., fully built in the static project). If either file is an empty stub — **stop and report it as a blocker**: "Cannot convert header/footer — static component not built yet. Build it in the static project first, then return to this step." Do not skip silently and do not proceed to assets until both are resolved.

- Read `../components/header.html` → convert to `template-parts/header-default.php`
- Read `../components/footer.html` → convert to `template-parts/footer-default.php`
- Header nav: use `wp_nav_menu()` with `header_menu` and `header_mobile_menu`
- Footer nav: use `wp_nav_menu()` with `footer_menu`
- Alpine.js directives stay as-is — they work in PHP templates
- Replace hardcoded phone/email/address with ACF options fields if available, otherwise keep static

### 7. Assets
- CSS: copy compiled Tailwind from `../dist/assets/main-[hash].css` → paste content into `assets/css/style.css`
- JS: `assets/js/script.js` must import and initialize Alpine.js + Lenis (same as `../src/scripts/main.ts` logic, converted to vanilla JS without TypeScript/module bundler)
- Google Fonts `@import` from the static CSS must be preserved at the top of `assets/css/style.css`

---

## Non-negotiables
- NEVER hardcode copy that was dynamic in the static layout
- NEVER use `the_field()` inside flexible layouts — always `get_sub_field()`
- NEVER create new `inc/` classes unless explicitly asked
- NEVER add `@apply` or custom CSS classes — Tailwind utility classes only
- NEVER use `document.querySelector` for UI — Alpine.js directives only
- All output must be escaped: `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`

---

## Flexible content loop (already in templates/flexible.php)
```php
<?php if (have_rows('content')): ?>
  <?php while (have_rows('content')): the_row(); ?>
    <?php get_template_part('template-parts/flexible/' . get_row_layout()); ?>
  <?php endwhile; ?>
<?php endif; ?>
```
The field group name `content` must match exactly in `acf-json/group_flexible_content.json`.
