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
- ALL text and section structure comes from `content/[page].md`
- Each file starts with `## Brief` (client notes, layout wishes, sections to skip) — read it first
- Below the brief: content sections in `## [section-id]` format with copy fields
- NEVER invent, paraphrase, or improvise content
- If a specific label is missing (e.g., a button label) → use short, professional English consistent with the existing tone
- Missing copy → leave `<!-- TODO: copy for [section] needed in content/[page].md -->`
- If the content file for the page does not exist yet → leave `<!-- TODO: create content/[page].md -->`

## Images source
- ALL images live in `public/images/` — this is the root for every image reference
- Image names in content files are **filename only** (e.g., `hero.jpg`) — always resolve to `/images/[filename]` in HTML
- NEVER use external URLs, Lorem Picsum, or placeholder services
- Before using an image, check if the file actually exists in `public/images/`
- If the file does not exist → use the placeholder pattern below

## Image placeholder
```html
<div class="w-full aspect-video bg-slate-200 flex items-center justify-center" aria-hidden="true">
  <!-- TODO: add image: [filename] -->
</div>
```

## Image attributes
Always include these attributes on every `<img>`:
- `alt` — descriptive text from `content/[page].md`; empty `alt=""` for decorative images
- `width` and `height` — always set to prevent CLS
- Loading:
  - Hero / above-fold: `loading="eager" fetchpriority="high"`
  - All other images: `loading="lazy"`

```html
<!-- Hero -->
<img src="/images/hero.jpg" alt="..." width="1920" height="1080" loading="eager" fetchpriority="high" class="w-full h-full object-cover">

<!-- Below-fold -->
<img src="/images/[filename]" alt="..." width="800" height="450" loading="lazy" class="w-full object-cover">
```
