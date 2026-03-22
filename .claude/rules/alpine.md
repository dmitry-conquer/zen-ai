---
globs: ["**/*.html", "**/*.hbs"]
---

# Alpine.js Rules

## Core principle
All UI interactivity lives in HTML via Alpine directives.
No separate JS files for UI behavior unless initializing a third-party library.

## Directive usage
| Need                  | Directive                          |
|-----------------------|------------------------------------|
| Local state           | `x-data="{ open: false }"`        |
| Dynamic attribute     | `:class`, `:href`, `:disabled`     |
| Events                | `@click`, `@keydown.escape`       |
| Toggle visibility     | `x-show` (preferred over `x-if`) |
| True conditional      | `x-if` (removes from DOM)         |
| List rendering        | `x-for` with `:key`              |
| Dynamic text          | `x-text`                          |
| Enter/leave animation | `x-transition`                    |
| DOM reference         | `$refs.myElement`                  |

## Plugins (registered in `src/scripts/main.ts`)

### `@alpinejs/focus` — use when focus management is needed
- Traps keyboard focus inside a visible element (modals, drawers, dropdowns)
- Directive: `x-trap="isOpen"` on the container
- Options: `x-trap.inert="isOpen"` (disables background), `x-trap.noscroll="isOpen"` (locks scroll)
- Use whenever a UI pattern opens over the page and must prevent background interaction

```html
<div x-show="open" x-trap.inert.noscroll="open" role="dialog" aria-modal="true">
  <!-- content -->
</div>
```

### `@alpinejs/collapse` — use for animated height transitions
- Smoothly animates `height` from 0 to auto and back (accordions, FAQs, expandable sections)
- Directive: `x-collapse` on the element being shown/hidden
- Always pair with `x-show`

```html
<div x-show="open" x-collapse>
  <!-- expandable content -->
</div>
```

## x-data placement
- Attach to the **smallest logical parent** that needs the state
- Do not attach to `<body>` or `<main>` for component-level state

## Forbidden patterns
- `document.querySelector` / `getElementById` for UI
- `onclick=`, `onchange=` inline legacy handlers
- jQuery or any DOM-manipulation library
- Complex business logic inside `x-data` — extract to a TS module if needed

## Standard components

### Mobile nav toggle
```html
<nav x-data="{ open: false }">
  <button
    @click="open = !open"
    :aria-expanded="open"
    aria-controls="mobile-menu"
    aria-label="Toggle navigation menu"
    class="..."
  >
    <!-- hamburger icon (inline SVG, aria-hidden="true") -->
  </button>
  <div
    id="mobile-menu"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
  >
    <!-- nav links -->
  </div>
</nav>
```

### Accordion / FAQ (uses x-collapse)
```html
<div x-data="{ open: false }">
  <button @click="open = !open" :aria-expanded="open" class="...">
    Question text
  </button>
  <div x-show="open" x-collapse>
    <p class="...">Answer text</p>
  </div>
</div>
```

### x-transition defaults
Always use explicit transition classes for consistency:
```html
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 -translate-y-2"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-150"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 -translate-y-2"
```

---

## Third-party libraries (initialized in `src/scripts/main.ts`)

### Lenis — smooth scroll
Already initialized globally. No extra setup needed in HTML.
- All anchor links (`href="#section-id"`) work automatically with smooth scrolling
- Do NOT use `scroll-behavior: smooth` in CSS — Lenis handles this

### AOS — animate on scroll
Initialized with `once: true` and `duration: 700`. Add `data-aos` attributes directly in HTML.

**Use `data-aos="fade-up"` as the default animation.** Add it to:
- Section headings (`<h2>`)
- Cards and grid items
- Feature/pillar blocks
- Images and media blocks
- CTA blocks

**Do NOT add AOS to:**
- The hero section (above the fold — already visible on load)
- Navigation / header
- Elements that are always visible without scrolling

```html
<!-- Section heading -->
<h2 data-aos="fade-up" class="...">Our Services</h2>

<!-- Grid of cards — stagger with data-aos-delay -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <div data-aos="fade-up" data-aos-delay="0" class="...">...</div>
  <div data-aos="fade-up" data-aos-delay="100" class="...">...</div>
  <div data-aos="fade-up" data-aos-delay="200" class="...">...</div>
</div>
```

**Stagger delay rule:** For grids with 2–4 items use `delay="0/100/200/300"`. For larger grids (6+ items) skip delay — applying it to all items looks cluttered.

### Swiper — slider / carousel
Use when a section in `content/structure.md` is marked with `**slider:** swiper`.

**Rules:**
- Install via npm — already in `package.json`. Never use a CDN.
- Always import the `A11y` module — no exceptions.
- Always check that the DOM element exists before initializing — Swiper will throw if the element is missing.
- Import only the modules actually used (tree-shaking).
- Add CSS import to `src/scripts/main.ts` alongside the JS import.

**Implementation — add to `src/scripts/main.ts`:**
```ts
import Swiper from "swiper";
import { A11y, Navigation, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

const swiperEl = document.querySelector<HTMLElement>(".swiper");
if (swiperEl) {
  new Swiper(swiperEl, {
    modules: [A11y, Navigation, Pagination],
    a11y: { enabled: true },
    navigation: true,
    pagination: { clickable: true },
    loop: true,
  });
}
```

**HTML structure:**
```html
<div class="swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><!-- slide content --></div>
    <div class="swiper-slide"><!-- slide content --></div>
  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
```

**If multiple sliders exist on one page** — use unique selectors (e.g., `#brands-slider .swiper`) and check each element separately before initializing.
