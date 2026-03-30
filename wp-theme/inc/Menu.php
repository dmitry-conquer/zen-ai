<?php
namespace WP_Starter_Theme;
if (!defined('ABSPATH')) {
  exit;
}

final class Menu
{
  public static function register()
  {
    add_filter('nav_menu_link_attributes', [self::class, 'add_link_classes'], 10, 4);
    add_filter('nav_menu_css_class', [self::class, 'add_li_classes'], 10, 4);
  }

  /**
   * Add Tailwind classes to <a> elements.
   * Derive actual classes from components/header.html and components/footer.html
   * after the static layout is built.
   */
  public static function add_link_classes($atts, $item, $args, $depth)
  {
    if (!isset($args->theme_location)) {
      return $atts;
    }

    // Example Tailwind classes — replace with classes from the built static layout
    $map = [
      'header_menu'        => 'text-sm font-semibold text-white hover:text-amber-400 transition-colors duration-200',
      'header_mobile_menu' => 'block py-3 text-base font-semibold text-white hover:text-amber-400 transition-colors duration-200',
      'footer_menu'        => 'text-sm text-slate-400 hover:text-white transition-colors duration-200',
    ];

    if (isset($map[$args->theme_location])) {
      $existing = $atts['class'] ?? '';
      $atts['class'] = trim($existing . ' ' . $map[$args->theme_location]);
    }

    return $atts;
  }

  /**
   * Add Tailwind classes to <li> elements.
   * Derive actual classes from components/header.html and components/footer.html
   * after the static layout is built.
   */
  public static function add_li_classes($classes, $item, $args, $depth)
  {
    if (!isset($args->theme_location)) {
      return $classes;
    }

    // Example Tailwind classes — replace with classes from the built static layout
    $map = [
      'header_menu'        => 'relative',
      'header_mobile_menu' => 'border-b border-white/10 last:border-0',
      'footer_menu'        => '',
    ];

    if (isset($map[$args->theme_location]) && $map[$args->theme_location] !== '') {
      $classes[] = $map[$args->theme_location];
    }

    return array_filter($classes);
  }
}
