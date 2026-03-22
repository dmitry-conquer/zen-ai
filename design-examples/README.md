# Design References

Claude reads this file to understand visual direction before building any section.

## Reference images
All reference images are in the `design-examples/` folder.
Before building any section, visually analyze the images in this folder to extract color palette, layout patterns, and UI conventions.

---

## Patterns to apply (priority order)

1. **Hero:** Strong high-contrast background (dark overlay on photo OR solid dark teal/navy)
2. **Trust strip:** Immediately below hero, accent color bg (orange/red-orange), 4 items with icons
3. **Service cards:** image-top → title → description → CTA button
4. **CTAs:** Two styles — primary (solid brand color) + secondary (outlined or contrasting fill)
5. **Nav:** Prominent phone number CTA button on right (desktop)
6. **Color:** Dark navy/teal primary + red-orange/amber accent + white text on dark
7. **Headings:** Bold, `tracking-wide` or uppercase for trustworthy feel

---

## Color palette (derive from reference images, map to closest Tailwind shades)
| Role           | Approximate value              | Tailwind equivalent       |
|----------------|--------------------------------|---------------------------|
| Primary dark   | `#0a2540` / `#0f4c6e`         | `slate-900` / `sky-950`   |
| Accent         | `#e84c1e` / `#f59e0b`         | `orange-600` / `amber-500`|
| Surface light  | `#f8fafc`                      | `slate-50`                |
| Text on dark   | `#ffffff`                      | `white`                   |
| Text on light  | `#1e293b`                      | `slate-800`               |

If the project specifies different colors in `layout.md`, those take priority over these defaults.
