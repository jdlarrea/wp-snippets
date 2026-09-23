# Mega Menu: Rows, Columns & CTA

A multi-level WordPress mega menu, built entirely from the admin. Editors pick a layout for each top-level item (rows, columns or a CTA card), then fill in headers, buttons, images and child links. Panels open on click on desktop and drill down on mobile.

## What it does

- Every menu item has a **type**: default, **mega parent** or **mega child**.
- A mega parent picks one of three layouts:
  - **Mega Rows:** child links grouped into rows, each with its own header, text and button.
  - **Mega Columns:** child groups laid out as columns (each a quarter of the panel width) that rise in with a staggered animation.
  - **Mega CTA:** a promo card with an image, title, description and link beside the links.
- Parents also get an optional header and up to two buttons (a link and a second link).
- Children go up to three levels deep, and can carry an icon.
- **Desktop (1280px and up):** clicking a parent slides its panel open, only one panel is open at a time, and clicking outside closes it.
- **Below 1280px:** the menu becomes a slide-in panel that drills down level by level, with a back button. On mobile, Mega Rows can collapse behind a "See More" toggle.
- The header gets a `sticky` class after 50px of scrolling, and a `solid-header` class on pages that open with a light sub-hero or breadcrumbs.
- An optional alert bar sits above the header and pushes it down.

## Where to look

| If you want to see... | Open |
|---|---|
| How the menu markup is generated (custom walker, 3 levels) | [`html/functions-megamenu.php`](html/functions-megamenu.php) |
| How the walker is used in the header template | [`html/header.php`](html/header.php) |
| The ACF fields that power each menu item | [`acf-json/group_64cd0c9b13a64.json`](acf-json/group_64cd0c9b13a64.json) |
| Click-to-open panels, mobile drill-down, sticky header, alert bar | [`js/main.js`](js/main.js) |
| Desktop panels, mobile slide-outs, layouts and animations | [`scss/_header.scss`](scss/_header.scss) |
| Hamburger toggle | [`scss/_hamburger.scss`](scss/_hamburger.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · GSAP

## Highlights

- **Custom `Walker_Nav_Menu` with state.** Extends `start_el`, `end_el`, `start_lvl` and `end_lvl`. Content that belongs in one place (a parent's header, buttons and CTA card, a child's row header) is gathered while the item renders, then output in the right spot around the sub-menu, and the stored values are reset afterward.
- **Three layouts, one walker.** Rows, columns and the CTA card all come from the same class. The ACF type field decides which markup and classes each panel gets.
- **Content-managed.** Layout type, headers, buttons, CTA image and icons are all ACF fields on `nav_menu_item`, so an editor can rebuild the menu without a developer.
- **One markup, two behaviors.** The same HTML runs as click-to-open dropdown panels on desktop and as a GSAP-animated slide-in drill-down on mobile.
- **Click-outside handling.** Desktop and mobile each track their own state class on `<html>`, so one document-level handler can close whichever is open.
- **Header state classes.** `sticky` and `solid-header` let the CSS restyle the header without extra JS.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up the menu. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and GSAP (loaded by the theme)
- The theme's `Helpers\Templates` class, the `framework_button` and `button` template parts, and the `site_logo()` helper
- The rest of the SCSS partials (`// ... other imports`)
- Theme options fields (logo, header button, alert bar)
- The `<head>` in `header.php` is stubbed out (`<!-- ... -->`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` contains only the header and menu handlers from the theme's main script

A simpler, hover-based version of this idea is in [`with-icons-and-posts`](../with-icons-and-posts).

Names have been neutralized (`acme_` prefix, `acme-icons` font name, "Acme" theme header).
