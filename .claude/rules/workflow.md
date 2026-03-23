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

Each file has two parts:
1. **`## Brief`** at the top — free-text notes from the client: layout wishes, style preferences, sections to skip, special requirements
2. **Content sections** below — one `## [section-id]` heading per section, followed by copy fields

Section IDs are derived from the heading name (e.g. `## hero` → `id="hero"`).
Always read the Brief first — it may override default layout or skip sections entirely.

### Slider sections
If a section contains `**slider:** swiper`, build it with Swiper.js.
See `.claude/rules/scripts.md → Swiper` for implementation.

### Header & Footer
Every page file includes `## header` and `## footer` blocks describing what they must contain.
Build them from scratch using those blocks + rules in `layout.md`, `scripts.md`, `accessibility.md`.

## Workflow (always follow this order)
1. Identify which page you are building → read `content/[page].md` → understand structure + copy
2. Check `public/images/` → list available image files
3. Analyze images in `design-examples/` → internalize visual direction and color palette
4. Read `CLAUDE.md → ## Project` → confirm font(s) and color shades for this project
5. Add Google Fonts `@import` to top of `src/styles/main.css` if not already present
6. Check `components/` → reuse before creating new
7. Build semantic HTML → apply Tailwind → add Alpine → verify a11y
