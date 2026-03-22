---
globs: ["**/*.html", "**/*.hbs"]
---

# Content & Assets Rules

## Forms
- NEVER build HTML forms — skip them entirely
- Where a form should appear, insert this placeholder:
  ```html
  <!-- [FORM HERE] -->
  ```
- Leave surrounding section structure (heading, description, layout) intact — only the form itself is skipped

---

## Copy source
- ALL text comes from `content/content-homepage.md`
- NEVER invent, paraphrase, or improvise content
- If a specific label is missing (e.g., a button label) → use short, professional English consistent with the existing tone
- Missing sections → leave `<!-- TODO: copy for [section] needed in content-homepage.md -->`

## Images source
- ALL images come from `public/images/`
- NEVER use external URLs, Lorem Picsum, or placeholder services
- Before using an image, check `public/images/images.md` — only use files marked `[x]`
- Missing image (`[ ]`) → use placeholder div pattern from `images.md`

## Image map
Full manifest with ready status: `public/images/images.md`. Naming convention:
| Pattern             | Usage                         |
|---------------------|-------------------------------|
| `hero.*`            | Hero section background       |
| `service-[name].*`  | Service card image            |
| `brand-[name].*`    | Brand logo                    |
| `team-[name].*`     | Team member photo             |
| `about.*`           | About section image           |

## Image attributes
See `public/images/images.md` for required attributes, loading rules, and placeholder pattern.

## Design references
- Visual direction + color palette: `design-examples/README.md` and images in `design-examples/`
