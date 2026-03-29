# ACF Field Types Reference

## Field type decision table

| Content type | ACF field type | JSON `"type"` | PHP return value | Use when |
|---|---|---|---|---|
| Any text (heading, label, name, description, body copy) | Textarea | `textarea` | `string` (plain, newlines preserved) | **All text fields without exception** — render with `nl2br(esc_html($val))` |
| Rich text (formatted body copy) | WYSIWYG | `wysiwyg` | `string` (HTML) | Only when editor needs bold/links/lists — avoid by default |
| Single image | Image | `image` | `int` (attachment ID) — always use `return_format: "id"` | Any image |
| Icon in a repeater card | Image | `image` | `int` (attachment ID) — always use `return_format: "id"`, `preview_size: "thumbnail"` | SVG icons in cards — always name `icon` |
| URL + label + target | Link | `link` | `array`: `['url']`, `['title']`, `['target']` | CTA buttons, nav links |
| Phone number | Link | `link` | `array`: `['url']` (tel: URL), `['title']` (display text) | Phone — see php-patterns.md |
| Email address | Link | `link` | `array`: `['url']` (mailto: URL), `['title']` (display text) | Email — see php-patterns.md |
| True/False toggle | True / False | `true_false` | `bool` | Show/hide sections, feature flags |
| Select from options | Select | `select` | `string` (selected key) | Layout variants, colour themes |
| Repeating rows | Repeater | `repeater` | `array` of rows (loop with `have_rows` / `the_row` / `get_sub_field`) | Cards, lists, team members, FAQs |
| Background image (section bg) | Image | `image` | `int` (attachment ID) — pass directly to `Utils::get_bg()` | Hero, CTA sections with bg image |
| Number | Number | `number` | `int` or `float` | Counts, years, prices |
| URL only | URL | `url` | `string` | External links without label |

---

## Textarea field — used for ALL text fields

```json
{
  "type": "textarea",
  "rows": 2,
  "new_lines": ""
}
```

- `"rows"` — set based on expected content length:

  | Content type | `rows` |
  |---|---|
  | Heading, label, short phrase | `2` |
  | Subheading, short description (1–2 sentences) | `3` |
  | Body copy, extended description (3+ sentences) | `5` |
- **`"new_lines": ""` — ALWAYS. Every textarea field without exception.** ACF stores raw text with no auto-formatting; newlines are handled exclusively via `nl2br()` in PHP
- In PHP always output via `nl2br(esc_html($value))`

---

## Icon field in repeater cards

Icons in repeater cards (services, features, trust strips, etc.) are **always an Image field** — never hardcoded SVG.

```json
{
  "key": "field_[section]_items_icon",
  "label": "Icon",
  "name": "icon",
  "type": "image",
  "return_format": "id",
  "preview_size": "thumbnail"
}
```

In PHP — use `wp_get_attachment_image()` with a small fixed size:
```php
$icon = get_sub_field('icon');
?>
<?php if (!empty($icon)): ?>
  <?= wp_get_attachment_image($icon, 'thumbnail', false, [
    'class'       => 'size-10',
    'aria-hidden' => 'true',
  ]) ?>
<?php endif; ?>
```

- Always name the field `icon`
- Always `return_format: "id"`
- Always `preview_size: "thumbnail"` for compact display in admin

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
      <h3><?= nl2br(esc_html($title)) ?></h3>
      <p><?= nl2br(esc_html($desc)) ?></p>
    </div>
  <?php endwhile; ?>
<?php endif; ?>
```

---

## Repeater sub-fields — `parent_repeater` is required

Every sub-field inside a repeater **must** include `"parent_repeater"` set to the `key` of the parent repeater field:

```json
{
  "key": "field_services_items",
  "name": "items",
  "type": "repeater",
  "sub_fields": [
    {
      "key": "field_services_items_title",
      "name": "title",
      "type": "textarea",
      "rows": 2,
      "new_lines": "",
      "parent_repeater": "field_services_items"
    }
  ]
}
```

- `"parent_repeater"` value = the `"key"` of the repeater field (e.g., `"field_services_items"`)
- Apply to every sub-field in the repeater without exception

---

## Field naming conventions
- Always `snake_case`
- Be descriptive but short: `heading` not `main_section_heading_text`
- Sub-fields in repeaters: name relative to the row (e.g., repeater = `services`, sub-field = `title`, not `service_title`)
- Background image field: always name `background_image`
- CTA button: always name `cta_link` (Link type)
- Section visibility toggle: always name `enabled` (True/False type, default: `1`)
