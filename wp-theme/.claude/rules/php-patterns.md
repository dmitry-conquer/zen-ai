# PHP Patterns

## Template part structure
Every `template-parts/flexible/[name].php` follows this skeleton:

```php
<?php
/**
 * Flexible layout: [Layout Label]
 *
 * Fields:
 *  - heading (textarea)
 *  - body_text (textarea)
 *  - cta_link (link)
 *
 * @package WP_Starter_Theme
 */

$heading   = get_sub_field('heading');
$body_text = get_sub_field('body_text');
$cta_link  = get_sub_field('cta_link');
?>

<section id="[section-id]" aria-label="[Section Name]" class="...tailwind...">
  <!-- SECTION: SectionName -->
  <!-- HTML from static layout with hardcoded values replaced -->
</section>
```

**Always fetch all fields at the top** before the HTML block. Never call `get_sub_field()` inline inside attributes.

---

## Escaping — mandatory rules

| Output context | Function |
|---|---|
| Inside tag content (visible text) | `esc_html($value)` |
| Inside HTML attribute | `esc_attr($value)` |
| As a URL (`href`, `src`, `action`) | `esc_url($value)` |
| HTML from WYSIWYG field | `wp_kses_post($value)` |
| Inline style attribute value | `esc_attr($value)` |

Never output raw `$value` directly — always escape.

---

## Emptiness checks
Always use `!empty()` — never bare `if ($var)`:
```php
if (!empty($heading)) { ... }
if (!empty($image)) { ... }
if (!empty($cta_link)) { ... }
```

---

## Textarea field — used for ALL text fields
All text fields (headings, labels, descriptions, body copy) use Textarea — **not** Text or WYSIWYG.
ACF stores raw text; newlines are converted to `<br>` via `nl2br()` in PHP.

```php
$heading = get_sub_field('heading');
$text    = get_sub_field('body_text');
?>
<?php if (!empty($heading)): ?>
  <h2 class="..."><?= nl2br(esc_html($heading)) ?></h2>
<?php endif; ?>
<?php if (!empty($text)): ?>
  <p class="..."><?= nl2br(esc_html($text)) ?></p>
<?php endif; ?>
```

---

## WYSIWYG field
Use **only** when the editor explicitly needs bold, lists, or inline links. Default to Textarea.

```php
$content = get_sub_field('content');
?>
<?php if (!empty($content)): ?>
  <div class="prose"><?= wp_kses_post($content) ?></div>
<?php endif; ?>
```

---

## Image field (`return_format: "id"`)
ACF returns an `int` (attachment ID). Use `wp_get_attachment_image()` — never write `<img>` manually.

```php
$image = get_sub_field('image'); // int
?>
<?php if (!empty($image)): ?>
  <?= wp_get_attachment_image($image, 'large', false, [
    'class'   => 'w-full object-cover',
    'loading' => 'lazy',
  ]) ?>
<?php endif; ?>
```

Hero / above-fold image — override loading attributes:
```php
<?php if (!empty($image)): ?>
  <?= wp_get_attachment_image($image, 'full', false, [
    'class'         => 'w-full h-full object-cover',
    'loading'       => 'eager',
    'fetchpriority' => 'high',
  ]) ?>
<?php endif; ?>
```

`wp_get_attachment_image()` automatically outputs correct `alt`, `width`, `height`, `srcset`, and `sizes` — do not add these manually.

---

## Background image (via Utils::get_bg)
```php
$bg       = get_sub_field('background_image'); // int
$bg_style = !empty($bg) ? \WP_Starter_Theme\Utils::get_bg($bg) : '';
?>
<section
  <?= $bg_style ?>
  class="bg-cover bg-center bg-no-repeat relative ..."
>
  <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>
  <div class="relative ...">
    <!-- content -->
  </div>
</section>
```

---

## Link field (`return_format: "array"`)
```php
$link = get_sub_field('cta_link');
?>
<?php if (!empty($link)): ?>
  <a
    href="<?= esc_url($link['url']) ?>"
    <?= !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : '' ?>
    class="..."
  >
    <?= esc_html($link['title']) ?>
  </a>
<?php endif; ?>
```

---

## Phone and email links
Phone and email are **Link fields** — the editor sets the URL (`tel:` / `mailto:`) and the display label in one field.

```php
$phone = get_sub_field('phone');
$email = get_sub_field('email');
?>
<?php if (!empty($phone)): ?>
  <a href="<?= esc_url($phone['url']) ?>" class="...">
    <?= esc_html($phone['title']) ?>
  </a>
<?php endif; ?>

<?php if (!empty($email)): ?>
  <a href="<?= esc_url($email['url']) ?>" class="...">
    <?= esc_html($email['title']) ?>
  </a>
<?php endif; ?>
```

ACF JSON:
```json
{
  "key": "field_[section]_phone",
  "label": "Phone",
  "name": "phone",
  "type": "link",
  "return_format": "array"
}
```
Use the same structure for `email`.

---

## Repeater field
```php
<?php if (have_rows('items')): ?>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php while (have_rows('items')): the_row(); ?>
      <?php
        $title       = get_sub_field('title');
        $description = get_sub_field('description');
        $image       = get_sub_field('image'); // int
      ?>
      <div class="...">
        <?php if (!empty($image)): ?>
          <?= wp_get_attachment_image($image, 'medium', false, [
            'class'   => 'w-full object-cover',
            'loading' => 'lazy',
          ]) ?>
        <?php endif; ?>
        <?php if (!empty($title)): ?>
          <h3 class="..."><?= nl2br(esc_html($title)) ?></h3>
        <?php endif; ?>
        <?php if (!empty($description)): ?>
          <p class="..."><?= nl2br(esc_html($description)) ?></p>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
```

## Repeater with step numbers
When cards need an order number (steps, process, how-it-works), fetch all rows as array and use `foreach` with index:

```php
<?php $items = get_sub_field('items'); ?>
<?php if (!empty($items)): ?>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php foreach ($items as $index => $item): ?>
      <?php
        $number      = $index + 1;
        $title       = $item['title'];
        $description = $item['description'];
      ?>
      <div class="...">
        <span class="..."><?= esc_html($number) ?></span>
        <?php if (!empty($title)): ?>
          <h3 class="..."><?= nl2br(esc_html($title)) ?></h3>
        <?php endif; ?>
        <?php if (!empty($description)): ?>
          <p class="..."><?= nl2br(esc_html($description)) ?></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
```

- `$index` is 0-based — always add `+ 1` for display
- Sub-fields are accessed as array keys: `$item['field_name']`
- Use this pattern only when the number is visually rendered; for regular repeaters use `have_rows` / `the_row`

---

## Navigation (header / footer)
```php
wp_nav_menu([
  'theme_location' => 'header_menu',
  'container'      => false,
  'menu_class'     => '',
  'fallback_cb'    => false,
  'items_wrap'     => '<ul class="flex items-center gap-6">%3$s</ul>',
]);
```

For mobile nav use `header_mobile_menu`. For footer use `footer_menu`.

---

## AOS attributes
Always preserve `data-aos` and `data-aos-delay` attributes from the static HTML — copy them as-is into PHP templates. AOS is initialized globally and works without any changes in PHP.

```php
<h2 data-aos="fade-up" class="..."><?= nl2br(esc_html($heading)) ?></h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <?php foreach ($items as $index => $item): ?>
    <div data-aos="fade-up" data-aos-delay="<?= esc_attr($index * 100) ?>" class="...">
      ...
    </div>
  <?php endforeach; ?>
</div>
```

---

## Alpine.js in PHP templates
Alpine directives work as-is in PHP — no changes needed:
```php
<nav x-data="{ open: false }" @keydown.escape.window="open = false">
  <button @click="open = !open" :aria-expanded="open">...</button>
  <div x-show="open" x-transition ...>...</div>
</nav>
```

---

## Conditional section visibility
If a section has an `enabled` True/False field:
```php
$enabled = get_sub_field('enabled');
if (!$enabled) return;
```
Place this at the very top of the template part, before any output.

---

## Forms
NEVER build HTML forms. Where a form exists in the static layout, insert:
```php
<!-- [FORM HERE] -->
```
Leave surrounding section structure intact.
