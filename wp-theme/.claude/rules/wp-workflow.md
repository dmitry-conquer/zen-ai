# Integration Workflow

## Overview
Convert the approved static layout (Vite + Tailwind + Alpine.js) into ACF Flexible Content WordPress theme.

**Golden rule:** every static `components/[name].html` → one ACF Flexible Content layout + one PHP template part.

---

## Step-by-step order (always follow)

### 1. Read the static source
- Read `../components/[name].html` — understand the HTML structure
- Read `../content/[page].md` — understand all copy fields and section IDs
- List all **hardcoded values** that must become ACF fields (text, images, links, lists)

### 2. Define fields for this section
- For each hardcoded value → choose the correct ACF type (see `acf-fields.md`)
- Name fields in `snake_case`, short and descriptive (e.g., `heading`, `body_text`, `cta_link`, `background_image`)
- Group repeating items into a **Repeater** field

### 3. Create the PHP template part
- File: `template-parts/flexible/[layout-name].php`
- Layout name = section ID from `content/[page].md` (e.g., `hero`, `services`, `about`)
- Replace every hardcoded value with `get_sub_field()` call
- Follow patterns in `php-patterns.md` — no exceptions

### 4. Generate ACF JSON for this layout
- Each section = one `acf-json/layout_[name].json` file during development
- Follow the format in `acf-json.md` exactly
- Key format: `field_[layout]_[fieldname]` (e.g., `field_hero_heading`)

### 5. After ALL sections are done — build the master field group
- Create `acf-json/group_flexible_content.json`
- This is the **single Flexible Content field group** that combines all layouts
- Location rule: `page_template == templates/flexible.php`
- All individual `layout_*.json` files can be deleted after merging

### 6. Convert header and footer
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
