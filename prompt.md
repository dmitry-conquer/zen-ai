# Prompt Example

## Session start
> Use at the beginning of every new session before writing any code.
```
Your task is to build a complete, production-ready website layout based on the provided content, images, and design references.

Before writing any code, read the following in order:
1. CLAUDE.md — project description, file structure, rules overview
2. .claude/rules/ — all rules files
3. content/ — all page files (e.g. homepage.md, about.md) — section structure and copy for each page
4. public/images/ — list available image files
5. design-examples/ — visually analyze all images to derive color palette, layout patterns and visual style
6. src/styles/main.css — check if Google Fonts import is already present
7. components/ — list existing partials

Then confirm back before touching any file:
- Pages to build and their content files
- Non-negotiables you will follow
- Section order per page: id, background, what it contains
- Images available in `public/images/` vs missing (will use placeholder)
- Tailwind color shades chosen for primary, accent, surface
- Font(s) to use and whether the @import is already in main.css
- Existing component partials found in components/

Do not write any code until I explicitly confirm your summary.
```
