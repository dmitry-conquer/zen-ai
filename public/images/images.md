# Image Manifest — public/images/

> Claude reads this before using any image.
> Check the box `[x]` when an image file is added to `public/images/`.
> If an image is not ready, use a placeholder div (see pattern below).

## Placeholder pattern (when image not ready)
```html
<div class="w-full aspect-video bg-slate-200 flex items-center justify-center" aria-hidden="true">
  <!-- TODO: add image: [filename] -->
</div>
```

---

## Loading rules
- **Hero only:** `loading="eager" fetchpriority="high"`
- **All other images:** `loading="lazy"` — no exceptions

---

## Page images

| Ready | File           | Usage                   |
|-------|----------------|-------------------------|
| [ ]   | `hero.jpg`     | Hero background         |
| [ ]   | `about.jpg`    | About section           |
| [ ]   | `og-image.jpg` | Open Graph social share |

## Service cards (all 16:9)

| Ready | File                               | Section card         |
|-------|------------------------------------|----------------------|
| [ ]   | `service-heating-installation.jpg` | Heating Installation |
| [ ]   | `service-ac-installation.jpg`      | AC Installation      |
| [ ]   | `service-heating-repair.jpg`       | Heating Repair       |
| [ ]   | `service-ac-repair.jpg`            | AC Repair            |
| [ ]   | `service-maintenance.jpg`          | Maintenance          |
| [ ]   | `service-indoor-air-quality.jpg`   | Indoor Air Quality   |

## Brand logos

Naming: `brand-[brandname-lowercase].svg` (prefer SVG, fallback PNG)

| Ready | File                |
|-------|---------------------|
| [ ]   | `brand-carrier.svg` |
| [ ]   | `brand-lennox.svg`  |
| [ ]   | `brand-trane.svg`   |
| [ ]   | `brand-york.svg`    |
| [ ]   | `brand-rheem.svg`   |
| [ ]   | `brand-goodman.svg` |

---

## Image attributes (always required)

```html
<!-- Hero / above-fold -->
<img
  src="/images/hero.jpg"
  alt="[descriptive text from content-homepage.md]"
  width="1920"
  height="1080"
  loading="eager"
  fetchpriority="high"
  class="w-full h-full object-cover"
/>

<!-- All other images -->
<img
  src="/images/service-ac-repair.jpg"
  alt="[descriptive text from content-homepage.md]"
  width="800"
  height="450"
  loading="lazy"
  class="w-full aspect-video object-cover"
/>
```
