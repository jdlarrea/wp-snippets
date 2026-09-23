# Hero Home: Swiper Slider

A full-height homepage hero built as a flexible-content component. Editors add any number of slides in the admin, and each slide can use an image or video background. Slides crossfade with Swiper.

## What it does

- Each slide has a **type** (image or video), an **eyebrow**, a **header**, a **button**, and an **overlay** (all editable in ACF).
- Slides crossfade on a 5-second autoplay loop, with clickable pagination.
- Only the first slide's header is an `<h1>`, and later slides use a styled `<div>`, so the page keeps a single `h1` for SEO and accessibility.
- The component renders nothing if there are no slides.
- Pagination sits vertically on the right on desktop, then moves to a horizontal row at the bottom left on small screens.
- The hero content sits on a translucent panel, and the panel sizes and offsets adjust at each breakpoint.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (slide loop, background layers, content) | [`html/hero_home.php`](html/hero_home.php) |
| The ACF fields that power it | [`acf-json/group_5e25d40b53db3.json`](acf-json/group_5e25d40b53db3.json) |
| Swiper setup (fade, autoplay, loop, pagination) | [`js/main.js`](js/main.js) |
| Hero layout and responsive rules | [`scss/_hero-home.scss`](scss/_hero-home.scss) |
| Shared Swiper pagination styles | [`scss/_swiper.scss`](scss/_swiper.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Swiper 11

## Highlights

- **Repeater-driven and content-managed.** ACF repeater with conditional fields (image group vs. video group depending on the slide type).
- **Semantic heading handling.** The first slide gets the `h1` and the rest don't.
- **Component reuse.** Backgrounds, overlays and buttons are rendered through shared template parts, so each one is handled in a single place.
- **Multiple instances are safe.** The JS initializes each `.component.hero-home` separately and scopes its pagination element to its own container.
- **Modern CSS where it helps.** A `:has(.hero-home)` rule removes the page's top padding only when a hero is present.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Swiper (loaded by the theme)
- The theme's `Helpers\Templates` class and the `framework_bg_image`, `framework_bg_video`, `overlay` and `framework_button` template parts, plus the ACF groups they clone
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Swiper block, and `scss/_swiper.scss` is pulled from the theme's `_default.scss`

Names have been neutralized (`acme-` prefix, "Acme" theme header).
