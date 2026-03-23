# WP Theme — Claude Config

## Project
- **Theme:** Rick's AC Maintenance & Service LLC
- **Base:** WP Starter Theme (namespace `WP_Starter_Theme`)
- **PHP:** 8.2+
- **ACF:** Flexible Content via `acf-json/` sync
- **CSS:** Compiled Tailwind → `assets/css/style.css`
- **JS:** Alpine.js + Lenis → `assets/js/script.js`

## Source of truth
Static layout lives in the **parent directory** (`../`):
| What | Path |
|---|---|
| Static components | `../components/[name].html` |
| Content / copy | `../content/[page].md` |
| Compiled CSS | `../dist/assets/` → copy to `assets/css/style.css` |

**Always read the static component first before writing any PHP.**

## Theme file structure
| What | Where |
|---|---|
| Flexible template | `templates/flexible.php` |
| Flexible section parts | `template-parts/flexible/[layout-name].php` |
| Header partial | `template-parts/header-default.php` |
| Footer partial | `template-parts/footer-default.php` |
| ACF JSON field groups | `acf-json/[group-key].json` |
| Theme classes | `inc/[ClassName].php` |
| Compiled CSS | `assets/css/style.css` |
| JS entry | `assets/js/script.js` |

## Registered nav menus (Setup.php)
| Location slug | Use |
|---|---|
| `header_menu` | Desktop nav |
| `header_mobile_menu` | Mobile nav |
| `footer_menu` | Footer nav |

## Available helpers (Utils.php)
| Helper | Usage |
|---|---|
| `Utils::get_bg($image_id)` | Returns `style="background-image:url('...')"` — use on sections with bg image |
| `Utils::asterisk_to_span($text)` | Converts `*word*` → `<span>word</span>` in text fields |

## Available shortcodes
| Shortcode | Returns |
|---|---|
| `[current_year]` | Current 4-digit year (use in footer copyright) |

## Quick Reference
| What | Where |
|---|---|
| Integration workflow | `.claude/rules/wp-workflow.md` |
| ACF field types | `.claude/rules/acf-fields.md` |
| ACF JSON format | `.claude/rules/acf-json.md` |
| PHP patterns | `.claude/rules/php-patterns.md` |
