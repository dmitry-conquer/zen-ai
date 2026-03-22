---
globs: ["**/*.html", "**/*.hbs"]
---

# SEO Rules

## `<head>` checklist (every page)
- [ ] `<title>` → `[Page Topic] | [Company Name from content-homepage.md]`
- [ ] `<meta name="description">` → 150–160 chars, includes primary keyword + location
- [ ] `<meta name="robots" content="index, follow">`
- [ ] Canonical: `<link rel="canonical" href="[site url]">`
- [ ] Open Graph: `og:title`, `og:description`, `og:image`, `og:url`, `og:type`
- [ ] Twitter card: `twitter:card`, `twitter:title`, `twitter:description`
- [ ] JSON-LD LocalBusiness schema (see template below)

## LocalBusiness JSON-LD template
All values must come from `content/content-homepage.md`. Never hardcode.

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "[business type, e.g. HVACBusiness, LocalBusiness]",
  "name": "[company name from content-homepage.md]",
  "url": "[site url from content-homepage.md]",
  "telephone": "[from content-homepage.md → ## contact]",
  "email": "[from content-homepage.md → ## contact]",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "[from content-homepage.md → ## contact]",
    "addressLocality": "[city]",
    "addressRegion": "[state]",
    "postalCode": "[zip]",
    "addressCountry": "US"
  },
  "openingHours": "[from content-homepage.md → ## contact]",
  "priceRange": "$$",
  "areaServed": "[from content-homepage.md → ## contact]"
}
</script>
```

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
- Internal links: use anchor IDs matching section ids in `content/structure.md`
- Phone links: `<a href="tel:+1XXXXXXXXXX">`
- Email links: `<a href="mailto:...">`
