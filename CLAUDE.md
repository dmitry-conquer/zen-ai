# Rick's AC Maintenance & Service LLC — Claude Config

## Project
- **Type:** HVAC service landing page
- **Stack:** Vite + Tailwind CSS v4 + Alpine.js + TypeScript + Handlebars

## Quick Reference
| What              | Where                              |
|-------------------|------------------------------------|
| Layout rules      | `.claude/rules/layout.md`          |
| Alpine.js rules   | `.claude/rules/alpine.md`          |
| Accessibility     | `.claude/rules/accessibility.md`   |
| SEO rules         | `.claude/rules/seo.md`             |
| Content copy      | `content/content-homepage.md`      |
| Page structure    | `content/structure.md`             |
| Images            | `public/images/images.md`          |
| Design references | `design-examples/`                 |
| Components        | `components/`                      |
| Main CSS          | `src/styles/main.css`              |

## Non-negotiables
- NEVER invent content — always use `content/content-homepage.md`
- NEVER use external image URLs — only `public/images/`
- NEVER create custom CSS classes or use `@apply`
- NEVER use `document.querySelector` for UI — Alpine.js only
- ONE `<h1>` per page

## Workflow (always follow this order)
1. Read `content/content-homepage.md` → understand all copy
2. Check `public/images/images.md` → know which images are ready (`[x]`)
3. Analyze images in `design-examples/` → internalize visual direction and color palette
4. Read `.claude/rules/layout.md` → confirm font(s) and color shades for this project
5. Add Google Fonts `@import` to top of `src/styles/main.css` if not already present
6. Check `components/` → reuse before creating new
7. Build semantic HTML → apply Tailwind → add Alpine → verify a11y

## Prompt templates

**Session start** → see `prompt.md`

**Build full page:**
Build the complete homepage section by section following `content/structure.md`. One section at a time — pause after each for confirmation.

**Build one section:**
Build the [NAME] section. Before writing HTML, quote the copy from `content-homepage.md` and confirm image availability in `images.md`.

**Build service cards:**
Build all 6 service cards from `content-homepage.md → ## services`. Grid: `grid-cols-1 md:grid-cols-2 lg:grid-cols-3`. Use placeholder div for images marked `[ ]`.

**Review / fix a section:**
Review [NAME] section against `layout.md`, `accessibility.md`, and `content-homepage.md`. List every issue, then fix all.

**New component partial:**
Create `components/[name].html`. Follow `layout.md` + `alpine.md` + `accessibility.md`. Show where to add `{{> name}}` in `pages/index.html`.

**Fill placeholders:**
Scan `pages/index.html` and `components/` for `[PLACEHOLDER]` and `<!-- TODO: -->`. Replace all where `content-homepage.md` has the value. Leave TODO only where content is missing.
