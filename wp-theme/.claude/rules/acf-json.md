# ACF JSON Format

## How ACF JSON sync works
- ACF reads `.json` files from `acf-json/` on theme activation / field group save
- File name = field group `key` value (e.g., `group_flexible_content.json`)
- After importing, ACF writes its own `modified` timestamp — do not edit manually after first sync

---

## Master Flexible Content field group structure

File: `acf-json/group_flexible_content.json`

```json
{
  "key": "group_flexible_content",
  "title": "Page Sections",
  "fields": [
    {
      "key": "field_content",
      "label": "Content",
      "name": "content",
      "type": "flexible_content",
      "button_label": "Add section",
      "layouts": {
        "layout_hero": {
          "key": "layout_hero",
          "name": "hero",
          "label": "Hero",
          "display": "block",
          "sub_fields": [
            {
              "key": "field_hero_heading",
              "label": "Heading",
              "name": "heading",
              "type": "text",
              "required": 1
            },
            {
              "key": "field_hero_subheading",
              "label": "Subheading",
              "name": "subheading",
              "type": "textarea",
              "rows": 3,
              "required": 0
            },
            {
              "key": "field_hero_cta_link",
              "label": "CTA Button",
              "name": "cta_link",
              "type": "link",
              "return_format": "array",
              "required": 0
            },
            {
              "key": "field_hero_background_image",
              "label": "Background Image",
              "name": "background_image",
              "type": "image",
              "return_format": "id",
              "preview_size": "medium",
              "required": 0
            }
          ]
        }
      }
    }
  ],
  "location": [
    [
      {
        "param": "page_template",
        "operator": "==",
        "value": "templates/flexible.php"
      }
    ]
  ],
  "menu_order": 0,
  "position": "normal",
  "style": "default",
  "label_placement": "top",
  "instruction_placement": "label",
  "active": true,
  "description": ""
}
```

---

## Key naming rules — CRITICAL
ACF keys must be **globally unique**. Follow this pattern without exception:

| What | Pattern | Example |
|---|---|---|
| Field group | `group_[slug]` | `group_flexible_content` |
| Flexible content field | `field_content` | `field_content` |
| Layout | `layout_[section]` | `layout_hero` |
| Sub-field | `field_[section]_[name]` | `field_hero_heading` |
| Repeater field | `field_[section]_[name]` | `field_services_items` |
| Repeater sub-field | `field_[section]_[repeater]_[name]` | `field_services_items_title` |

**Never reuse the same key across different layouts.**

---

## Repeater layout example

```json
{
  "key": "layout_services",
  "name": "services",
  "label": "Services",
  "display": "block",
  "sub_fields": [
    {
      "key": "field_services_heading",
      "label": "Heading",
      "name": "heading",
      "type": "text",
      "required": 1
    },
    {
      "key": "field_services_items",
      "label": "Service Items",
      "name": "items",
      "type": "repeater",
      "layout": "block",
      "button_label": "Add item",
      "sub_fields": [
        {
          "key": "field_services_items_title",
          "label": "Title",
          "name": "title",
          "type": "text",
          "required": 1,
          "parent_repeater": "field_services_items"
        },
        {
          "key": "field_services_items_description",
          "label": "Description",
          "name": "description",
          "type": "textarea",
          "rows": 3,
          "required": 0,
          "parent_repeater": "field_services_items"
        },
        {
          "key": "field_services_items_icon",
          "label": "Icon",
          "name": "icon",
          "type": "image",
          "return_format": "id",
          "preview_size": "thumbnail",
          "required": 0,
          "parent_repeater": "field_services_items"
        }
      ]
    }
  ]
}
```

---

## Required fields on every sub_field object
```json
{
  "key": "field_[layout]_[name]",
  "label": "Human Label",
  "name": "snake_case_name",
  "type": "text"
}
```
Minimum required: `key`, `label`, `name`, `type`. All other properties are optional unless the type requires them (e.g., `return_format` on `image` — always `"id"`; and on `link` — always `"array"`).

---

## Adding a new layout
1. Add the layout object to `"layouts": {...}` object in `group_flexible_content.json` — key = layout key (e.g., `"layout_hero": { ... }`)
2. Create the matching PHP file: `template-parts/flexible/[layout-name].php`
3. Layout `"name"` must exactly match the PHP filename (without `.php`)
