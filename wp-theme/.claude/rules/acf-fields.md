# ACF Field Types Reference

## Field type decision table

| Content type | ACF field type | JSON `"type"` | PHP return value | Use when |
|---|---|---|---|---|
| Short text (heading, label, name) | Text | `text` | `string` | Single line, no HTML |
| Descriptive text (paragraph, description, body copy) | Textarea | `textarea` | `string` (plain, newlines preserved) | **Default for all multi-line text** — render with `nl2br(esc_html($val))` |
| Rich text (formatted body copy) | WYSIWYG | `wysiwyg` | `string` (HTML) | Only when editor needs bold/links/lists — avoid by default |
| Single image | Image | `image` | `int` (attachment ID) — always use `return_format: "id"` | Any image |
| URL + label + target | Link | `link` | `array`: `['url']`, `['title']`, `['target']` | CTA buttons, nav links |
| Phone number | Group | `group` | `array`: `['link']` (tel: URL), `['label']` (display text) | Phone — see php-patterns.md |
| Email address | Group | `group` | `array`: `['link']` (mailto: URL), `['label']` (display text) | Email — see php-patterns.md |
| True/False toggle | True / False | `true_false` | `bool` | Show/hide sections, feature flags |
| Select from options | Select | `select` | `string` (selected key) | Layout variants, colour themes |
| Repeating rows | Repeater | `repeater` | `array` of rows (loop with `have_rows` / `the_row` / `get_sub_field`) | Cards, lists, team members, FAQs |
| Background image (section bg) | Image | `image` | `int` (attachment ID) — pass directly to `Utils::get_bg()` | Hero, CTA sections with bg image |
| Number | Number | `number` | `int` or `float` | Counts, years, prices |
| URL only | URL | `url` | `string` | External links without label |

---

## Textarea field — default for all descriptive text

```json
{
  "type": "textarea",
  "rows": 2,
  "new_lines": ""
}
```

- `"rows": 2` — compact in the admin UI
- `"new_lines": ""` — ACF stores raw text, no auto-formatting
- In PHP always output via `nl2br(esc_html($value))`

---

## Image field — always use `return_format: "id"`

```json
{
  "type": "image",
  "return_format": "id",
  "preview_size": "medium",
  "library": "all"
}
```

In PHP always use `wp_get_attachment_image()` — never write `<img>` manually:
```php
$image = get_sub_field('image'); // returns int (attachment ID)
// Pass directly to wp_get_attachment_image()
// WP reads alt, width, height, srcset automatically from the attachment
```

---

## Link field — structure

```json
{
  "type": "link",
  "return_format": "array"
}
```

In PHP:
```php
$link = get_sub_field('cta_link');
// $link['url']    → href
// $link['title']  → link label
// $link['target'] → '_blank' or ''
```

---

## Repeater field — loop pattern

```php
<?php if (have_rows('items')): ?>
  <?php while (have_rows('items')): the_row(); ?>
    <?php $title = get_sub_field('title'); ?>
    <?php $desc  = get_sub_field('description'); ?>
    <div>
      <h3><?= esc_html($title) ?></h3>
      <p><?= esc_html($desc) ?></p>
    </div>
  <?php endwhile; ?>
<?php endif; ?>
```

---

## Field naming conventions
- Always `snake_case`
- Be descriptive but short: `heading` not `main_section_heading_text`
- Sub-fields in repeaters: name relative to the row (e.g., repeater = `services`, sub-field = `title`, not `service_title`)
- Background image field: always name `background_image`
- CTA button: always name `cta_link` (Link type)
- Section visibility toggle: always name `enabled` (True/False type, default: `1`)
