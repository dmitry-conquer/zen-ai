# Page Structure — Rick's AC Maintenance & Service LLC

> Claude reads this before building any section.
> Section `id` values must match `id="..."` attributes in HTML exactly.

## Slider notation
To mark any section as a slider, add this line to its definition:
```
- **slider:** swiper
```
When this line is present, Claude must build that section using Swiper.js.
See `.claude/rules/alpine.md → Swiper` for implementation rules.

## Layout

| Element  | Sticky | Contains                                                    |
|----------|--------|-------------------------------------------------------------|
| `header` | yes    | logo, desktop nav, phone CTA (desktop), hamburger (mobile) |
| `footer` | no     | company name, quick links, contact info, license, copyright |

---

## Sections (top → bottom)

### 1. `hero`
- **Tag:** `<section id="hero" aria-label="Hero">`
- **Background:** full-width image with dark overlay
- **Contains:** H1 headline, subheadline, 2 CTA buttons (primary + secondary)
- **Content source:** `content-homepage.md → ## hero`

### 2. `trust-strip`
- **Tag:** `<section id="trust-strip" aria-label="Trust Highlights">`
- **Background:** accent color (e.g., `bg-amber-500`)
- **Contains:** 4 items — icon + short label each, flex row
- **Note:** immediately below hero, full-width — this is the first thing seen after hero
- **Content source:** `content-homepage.md → ## trust-badges`

### 3. `about`
- **Tag:** `<section id="about" aria-label="About">`
- **Background:** white
- **Contains:** heading + body paragraph, optional supporting image
- **Content source:** `content-homepage.md → ## about`

### 4. `why-choose-us`
- **Tag:** `<section id="why-choose-us" aria-label="Why Choose Us">`
- **Background:** `bg-slate-50`
- **Contains:** 4 pillars — icon + title + body each, `grid-cols-1 md:grid-cols-2 lg:grid-cols-4`
- **Content source:** `content-homepage.md → ## why-choose-us`

### 5. `services`
- **Tag:** `<section id="services" aria-label="Our Services">`
- **Background:** white
- **Contains:** 6 service cards — image top + title + description + CTA button
- **Card layout:** `grid-cols-1 md:grid-cols-2 lg:grid-cols-3`
- **Content source:** `content-homepage.md → ## services`
- **Images:** `public/images/service-[slug].jpg`

### 6. `brands`
- **Tag:** `<section id="brands" aria-label="Brands We Service">`
- **Background:** `bg-slate-50`
- **Contains:** heading + brand logos or text list
- **slider:** swiper
- **Content source:** `content-homepage.md → ## brands`
- **Images:** `public/images/brand-[name].svg` (or `.png`)

### 7. `cta`
- **Tag:** `<section id="cta" aria-label="Call to Action">`
- **Background:** primary dark (e.g., `bg-slate-900`) — use the project's chosen dark shade
- **Contains:** heading + subheading + CTA button + phone number
- **Content source:** `content-homepage.md → ## cta`

### 8. `contact`
- **Tag:** `<section id="contact" aria-label="Contact Information">`
- **Background:** white
- **Contains:** address, phones, email, hours — wrap in `<address>`
- **Content source:** `content-homepage.md → ## contact`

### 9. `credentials`
- **Tag:** `<section id="credentials" aria-label="Licenses and Payment">`
- **Background:** `bg-slate-50 border-t border-slate-200`
- **Contains:** license numbers + accepted payment methods
- **Content source:** `content-homepage.md → ## credentials`
