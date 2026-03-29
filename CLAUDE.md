# Claude Config

## Project
- **Stack:** Vite + Tailwind CSS v4 + Alpine.js + TypeScript + Handlebars
- **Body font:** Open Sans
- **Heading font:** _(none — use body font for all headings)_
- **Colors:** _(not specified — derive from `design-examples/`)_

## About this project
_See `content/homepage.md → ## Project` for client name, business description, site goal, and tone._

## File structure
| What                  | Where                        |
|-----------------------|------------------------------|
| Pages (HTML entry)    | `pages/[page].html`          |
| Handlebars components | `components/[name].html`     |
| Scripts entry         | `src/scripts/main.ts`        |
| Styles entry          | `src/styles/main.css`        |
| Public assets         | `public/`                    |
| Build output          | `dist/`                      |


## Quick Reference
| What              | Where                                            |
|-------------------|--------------------------------------------------|
| Workflow & rules  | `.claude/rules/workflow.md`                      |
| Layout rules      | `.claude/rules/layout.md`                        |
| Scripts & UI      | `.claude/rules/scripts.md`                       |
| Accessibility     | `.claude/rules/accessibility.md`                 |
| SEO rules         | `.claude/rules/seo.md`                           |
| Content & images  | `.claude/rules/sources.md`                       |
| Content copy      | `content/[page].md` (e.g. `content/homepage.md`) |
| Images            | `public/images/`                                 |
| Design references | `design-examples/`                               |
| Components        | `components/`                                    |
| Main CSS          | `src/styles/main.css`                            |
