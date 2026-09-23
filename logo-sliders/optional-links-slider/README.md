# Logo Slider: Optional Links

A logo section with a header, an optional intro text, custom dot pagination and a slider of logos. Each logo can link somewhere or not, and a link can open in a new tab. Built with Slick.

## What it does

- Editors add a **header**, optional **text** and a repeater of **logo items**.
- Each logo item has an **image**, an optional **URL** and a **New Tab?** switch.
- Logos with a URL render as links, and logos without one render as plain elements, so the markup never contains an empty `href`.
- Slick shows 5 logos at a time (2 on tablets and phones), advances a full set every 3 seconds, and shows dots for each set.
- The dots are custom-built buttons, placed in the header area instead of below the slider.
- Logo images load lazily.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (link vs. no-link markup, lazy images) | [`html/logo_slider.php`](html/logo_slider.php) |
| The Slick setup | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_62e9c65b748d9.json`](acf-json/group_62e9c65b748d9.json) |
| Layout, dots and responsive rules | [`scss/_logo_slider.scss`](scss/_logo_slider.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Slick · Blazy

## Highlights

- **Optional links done cleanly.** The template checks whether a URL exists and builds either an `<a>` or a `<div>`, and only adds `target="_blank"` when the switch is on.
- **Alt text is always present.** Each logo uses its `alt` from the media library, with a fallback when the image has none.
- **Custom dots.** `customPaging` and `appendDots` render the dots as buttons and move them into the header area, and SCSS styles the active, hover and focus states.
- **Lazy loading that survives sliding.** Logos use `data-src`, and the `afterChange` hook re-checks the page so images that slid into view are loaded.
- **Content-managed.** The whole component is a small ACF group.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery, Slick and Blazy (loaded by the theme, with a global `blazy` instance)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Slick setup

Slick is an older slider library. For a Swiper version with two rows scrolling in opposite directions, see [`opposite-scrolling-rows`](../opposite-scrolling-rows).

Names have been neutralized ("Acme" theme header).
