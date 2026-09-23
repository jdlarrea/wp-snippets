# Mega Menu: Icons & Posts

A custom WordPress mega menu, driven entirely from the admin. Editors build it in **Appearance > Menus** by picking a "Menu Item Type" on each item. No shortcodes, no page builder, no menu plugin.

## What it does

- **Mega Parent** items open a full-width panel with a header, description and CTA, plus either:
  - **Mega Posts**: the two latest posts, or two hand-picked posts (editor's choice), or
  - **Mega Columns**: child links laid out in columns.
- **Mega Child** items can carry an image icon.
- **Default** items behave like normal WordPress menu links.
- The header gains a `scrolled` state once you scroll past its own height.
- An optional alert bar pushes the fixed header down and resizes the mobile menu to match.
- Below 1200px the menu becomes a slide-in panel, with a slide-over drill-down for each mega parent and a back button.

## Where to look

| If you want to see... | Open |
|---|---|
| How the menu markup is generated (custom walker) | [`html/functions-megamenu.php`](html/functions-megamenu.php) |
| How the walker is called in the template | [`html/header.php`](html/header.php) |
| The ACF fields that power the menu options | [`acf-json/group_6679804e517fa.json`](acf-json/group_6679804e517fa.json) |
| Sticky header, mobile drill-down, alert bar offsets | [`js/general.js`](js/general.js) |
| Desktop mega panels, mobile slide-outs, animations | [`scss/_header.scss`](scss/_header.scss) |
| Hamburger toggle | [`scss/_hamburger.scss`](scss/_hamburger.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · GSAP + ScrollTrigger

## Highlights

- **Custom `Walker_Nav_Menu`.** Extends the core walker and overrides `start_el`, `start_lvl` and `end_lvl`. Mega content is collected while a parent item renders, then injected inside its sub-menu wrapper.
- **Content-managed.** Menu item type, mega layout, header/description/CTA, manual vs. latest posts and icons are all ACF fields on `nav_menu_item`, so it works for non-developers.
- **Graceful post fallbacks.** Uses the Yoast primary category if available, then the first category, then a default label, and a placeholder image when a post has no thumbnail.
- **One markup, two behaviors.** The same menu HTML is styled as hover/focus dropdowns on desktop and as a drill-down panel on mobile, with the panel offsets recalculated when the alert bar opens or closes.
- **Resize handling.** Header transitions are frozen during window resize and ScrollTrigger positions are recalculated afterward, with debounced timers.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up the menu. It won't run standalone. It depends on things not included here:

- ACF Pro and the Yoast SEO plugin
- jQuery, GSAP and ScrollTrigger loaded by the theme
- The theme's own `Helpers\Templates` class (used to render the CTA button) and the ACF field group that defines that button
- The rest of the SCSS partials listed in `style.scss` (`// ... other imports`), plus the alert bar styles
- Theme options fields (logo, header CTA, alert bar, placeholder image)

Names have been neutralized (`acme_` prefix, "Acme" theme header).
