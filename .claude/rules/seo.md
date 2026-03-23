# SEO Rules

## `<head>` checklist (every page)
All values come from `content/[page].md → ## meta`.

- [ ] `<title>` → `[Page Topic] | [Company Name]`
- [ ] `<meta name="description">` → 150–160 chars, includes primary keyword + location
- [ ] `<meta name="robots" content="index, follow">`
- [ ] `<link rel="canonical" href="[site url]">`
- [ ] Open Graph: `og:title`, `og:description`, `og:image` (from `## meta → og-image`), `og:url`, `og:type`
- [ ] Twitter card: `twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`

## Semantic HTML
| Element     | Use for                              |
|-------------|--------------------------------------|
| `<header>`  | Site header / nav                    |
| `<nav>`     | Navigation landmark                  |
| `<main>`    | Primary page content                 |
| `<section>` | Thematic content block               |
| `<article>` | Self-contained content               |
| `<aside>`   | Supplementary content                |
| `<footer>`  | Site footer                          |
| `<address>` | Contact / location information       |

## Links
- Anchor text must be descriptive — never "click here" or "read more"
- Internal links: use anchor IDs matching `id="..."` values defined in `## section:` blocks of `content/[page].md`
- Phone links: `<a href="tel:[number-no-spaces]">` — strip spaces and dashes from the number
- Email links: `<a href="mailto:[email]">`
