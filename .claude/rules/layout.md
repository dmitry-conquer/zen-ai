# Layout & Styling Rules

## Tailwind v4
- Utility classes inline in HTML only — no `@apply`, no custom class names
- Use Tailwind's **built-in color palette** directly (e.g., `bg-slate-900`, `text-amber-500`)
- Do NOT create custom `--color-*` tokens in `main.css`
- Arbitrary values (e.g., `w-[347px]`) are a **last resort** only
- `style=` attributes only when Alpine.js dynamic binding requires it, or for background images (see ## Background images)

### Forbidden class patterns
- `.card`, `.btn`, `.hero`, `.section-title` — any named abstraction
- External `.css` files beyond `src/styles/main.css`

## Colors

Colors are specified in `CLAUDE.md → ## Project`. Read them from there before building.

### If colors are specified
Use the Tailwind shades from `CLAUDE.md`. Apply them consistently:
| Role            | Usage                                          |
|-----------------|------------------------------------------------|
| Primary (dark)  | Hero, header, dark section backgrounds         |
| Accent          | CTA buttons, trust strip, hover/focus states   |
| Surface (light) | Alternating light section backgrounds          |
| Text on dark    | Headings and body text on dark backgrounds     |
| Text on light   | Body text on light/white backgrounds           |

### If colors are NOT specified
Analyze the images in `design-examples/` — derive the palette directly from what you see there.
Select the closest matching Tailwind shades and apply them consistently throughout.
Typical fallback for a local service business:
- Primary dark → `slate-900` or `sky-950`
- Accent → `amber-500` or `orange-600`
- Surface → `slate-50`
- Text on dark → `white`
- Text on light → `slate-800`

## Typography & Fonts

### Font specification for this project
Fonts are specified in `CLAUDE.md → ## Project`. Read them from there before adding the `@import`.
If no fonts are specified — derive from `design-examples/` or use the system font stack.

### Rules
- AI must add a Google Fonts `@import` to `src/styles/main.css` for every font in use
- **CRITICAL:** `@import url(...)` must be placed on **line 1**, before `@import "tailwindcss"` — CSS requires all `@import` statements before any other rules
- Apply body font globally via `font-[Family_Name]` on `<body>` (use underscores for spaces, e.g. `font-[Open_Sans]`)
- A project may use **one font** (body only) or **two fonts** (body + distinct heading font)
- If two fonts: apply the heading font to `<h1>`–`<h3>` via `font-[family-name]` utility
- Never load fonts that are not actually used in the HTML

### Import format (place at line 1 of main.css, before everything else)
```css
/* Single font */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap");
@import "tailwindcss";

/* Two fonts */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@700;800&display=swap");
@import "tailwindcss";
```

## Typography scale
- Hero H1: `text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight`
- Section H2: `text-3xl md:text-4xl font-bold tracking-tight`
- Subsection H3: `text-xl md:text-2xl font-semibold`
- Body: `text-base leading-relaxed` (min 16px)
- One `<h1>` per page — all others `<h2>` → `<h3>`

## Icons
- Small decorative icons (trust badges, nav, bullet accents, section markers) may be chosen by AI at its discretion
- Prefer **inline SVG** from the [Heroicons](https://heroicons.com) 24px outline set
- Size: `size-5` or `size-6` inline with text; `size-8`–`size-10` for standalone feature icons
- Always add `aria-hidden="true"` to decorative icons
- Significant icons (logos, brand marks) must come from `public/images/` — AI cannot invent these

## Responsive (mobile-first)
- Default styles = mobile (`< 640px`)
- Override at `sm:` / `md:` / `lg:` / `xl:` / `2xl:`
- Grid: always start `grid-cols-1`, expand at `md:grid-cols-2`, `lg:grid-cols-3`
- Touch targets: minimum `min-h-11 min-w-11`
- Images: `w-full` with explicit `aspect-*` or `object-cover`

## Background images
Sections with a background image (e.g. hero) must use inline `style="background-image: url('/images/[filename]')"` — not an `<img>` tag.
This keeps the markup clean for WordPress migration where background images are set via ACF/CSS.

```html
<section
  id="hero"
  style="background-image: url('/images/hero.jpg')"
  class="bg-cover bg-center bg-no-repeat"
>
```

- Always pair with `bg-cover bg-center bg-no-repeat` Tailwind classes
- Add a dark overlay as a child `<div>` with `absolute inset-0 bg-black/50` (adjust opacity as needed)
- Set `class="relative"` on the section so the overlay positions correctly

## Section rhythm
- Section padding: `py-16 md:py-24`
- Max content width: `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- Backgrounds alternate: white → `bg-slate-50` → dark (e.g., `bg-slate-900`) → white
- Use the project's chosen primary dark Tailwind shade for dark sections

## Component patterns

### Cards
- Card styling (rounding, shadow, border) — derive from `design-examples/`
- Card image: always `w-full object-cover` + explicit `aspect-*` based on design

### Buttons
Apply structure classes + color classes together. Color classes depend on the project palette.

**Primary button** (solid, high contrast — use for main CTA):
```html
<a href="..." class="inline-flex items-center gap-2 rounded-{derive from design-examples} px-6 py-3 font-semibold bg-[accent] text-[contrast] transition duration-200 hover:brightness-110 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[accent]">
  Label
</a>
```

**Secondary button** (outlined — use on dark backgrounds):
```html
<a href="..." class="inline-flex items-center gap-2 rounded-{derive from design-examples} px-6 py-3 font-semibold border-2 border-[contrast] text-[contrast] transition duration-200 hover:bg-[contrast] hover:text-[primary]">
  Label
</a>
```

_Use the project's actual Tailwind color shades from `CLAUDE.md` and rounding derived from `design-examples/`._


## Header & Footer
- Header and footer stubs in `components/` are intentionally empty
- AI must build them from scratch using content from `content/[page].md` and rules from `layout.md`, `scripts.md`, and `accessibility.md`
- Header must include: logo, navigation links, phone CTA, mobile hamburger menu
- Footer must include: company name, quick links, contact info, license/copyright

## Section structure
Every `<section>` must have:
- `id="[section-id]"` — matches the id from the `**tag:**` line in the corresponding `## section:` block of `content/[page].md`
- `aria-label="[Section Name]"`
- Comment: `<!-- SECTION: SectionName -->`
