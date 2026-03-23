# Accessibility Rules (WCAG 2.1 AA)

## Must-haves on every page
- [ ] `<html lang="en">` (or correct language code)
- [ ] `<title>` present and descriptive — screen readers announce it first
- [ ] Skip-to-main link as **first focusable element** in `<body>`
  ```html
  <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded focus:px-4 focus:py-2 focus:text-sm focus:font-semibold">
    Skip to main content
  </a>
  ```
- [ ] `<main id="main-content">` wraps page content
- [ ] One `<h1>` per page
- [ ] All `<img>` have descriptive `alt` (empty `alt=""` for decorative images)
- [ ] All form inputs have associated `<label>`
- [ ] `<address>` tag wraps contact/location info
- [ ] Landmark regions have `aria-label` or `aria-labelledby`

## Focus styles
- NEVER `outline-none` without a `focus-visible:` replacement
- Standard focus: `focus-visible:outline-2 focus-visible:outline-offset-2` + project's accent color class (e.g., `focus-visible:outline-amber-500`)

## Color contrast
- Normal text: 4.5:1 minimum
- Large text (18px+ bold or 24px+): 3:1 minimum
- Always verify: dark background + white text, and accent color + white text

## Navigation
```html
<button
  @click="open = !open"
  :aria-expanded="open"
  aria-controls="mobile-menu"
  aria-label="Toggle navigation menu"
>
```

## Interactive non-button elements
If a `<div>` or `<span>` is clickable:
```html
<div role="button" tabindex="0" @click="..." @keydown.enter="..." @keydown.space.prevent="...">
```
Prefer real `<button>` elements wherever possible.

## Modals / Drawers
- `role="dialog"` + `aria-modal="true"` + `aria-labelledby="modal-title"`
- Focus must be trapped inside while open
- Close on `Escape` key (`@keydown.escape.window="open = false"`)
- Return focus to trigger element on close

## Images
- Hero/above-fold: `loading="eager"` + `fetchpriority="high"`
- Below-fold: `loading="lazy"`
- Always include `width` and `height` attributes to prevent CLS
- Decorative images: `alt=""` + `aria-hidden="true"`
