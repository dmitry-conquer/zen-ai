# Workflow & Non-negotiables

## Build system
- Every `.html` file in `pages/` becomes a separate page
- Components are Handlebars partials — include as `{{> name}}` (filename without extension)
- `src/scripts/main.ts` and `src/styles/main.css` are auto-injected into every page via Vite

## Non-negotiables
- NEVER invent content — always use the matching `content/[page].md` file
- NEVER use external image URLs — only `public/images/`
- NEVER create custom CSS classes or use `@apply`
- NEVER use `document.querySelector` for UI — Alpine.js only
- ONE `<h1>` per page

## Content files
Each page has its own file inside `content/`. No `content-` prefix — the folder already provides context:
- Homepage → `content/homepage.md`
- About page → `content/about.md`
- Other pages → `content/[page-slug].md`

Each file has three parts:
1. **`## Project`** at the top — client name, business description, site goal, tone
2. **`## Brief`** — free-text notes from the client: layout wishes, style preferences, sections to skip, special requirements
3. **Content sections** below — one `## [section-id]` heading per section, followed by copy fields

Section IDs are derived from the heading name (e.g. `## hero` → `id="hero"`).
Always read the Brief first — it may override default layout or skip sections entirely.

### Slider sections
If a section contains `**slider:** swiper`, build it with Swiper.js.
See `.claude/rules/scripts.md → Swiper` for implementation.

### Header & Footer
Every page file includes `## header` and `## footer` blocks describing what they must contain.
Build them from scratch using those blocks + rules in `layout.md`, `scripts.md`, `accessibility.md`.

### Sections as components
Every page section (hero, about, services, etc.) must be a **separate Handlebars partial** in `components/`:
- File: `components/[section-id].html` (e.g., `components/hero.html`, `components/services.html`)
- Include in the page as `{{> section-id}}` — the same way as header and footer
- `pages/[page].html` must contain only the page shell (`<head>`, skip link, `{{> header}}`, `<main>`, section includes, `{{> footer}}`) — no section HTML inline

```html
<!-- pages/index.html — correct structure -->
<main id="main-content">
  {{> hero}}
  {{> trust-strip}}
  {{> about}}
  {{> services}}
  {{> cta}}
</main>
```

This ensures every section has a dedicated file that can be read independently during WordPress integration.

## Workflow (always follow this order)
1. Identify which page you are building → read `content/[page].md` → understand structure + copy
2. **Determine scope automatically:**
   - Collect all `## [section-id]` headings from `content/[page].md` — this is the full section list
   - Exclude non-buildable headings: `Project`, `Brief`, `meta`, `header`, `footer`
   - List files in `components/` — every matching `[section-id].html` is already built
   - Remaining sections = pending work
   - Report the result before proceeding: "Built: X, Y. Pending: A, B, C."
3. Check `public/images/` → list available image files
4. Analyze images in `design-examples/` → internalize visual direction and color palette
5. Read `CLAUDE.md → ## Project` → confirm font(s) and color shades for this project
6. Add Google Fonts `@import` to top of `src/styles/main.css` if not already present
7. Build semantic HTML → apply Tailwind → add Alpine → verify a11y
