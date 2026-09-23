# Testimonials: Swiper with Synced Photos

A testimonial section with a row of photo cards on top and the matching quote below. The two are separate Swiper sliders linked together: the active photo gets a highlighted border and a pointer, and the quote crossfades to match. Editors can pull the content from a global options page or enter it on the page itself.

## What it does

- A row of **photo cards** (each with an optional logo overlay) shows 1 card on mobile, 2 from 576px and 3 from 768px.
- The **quote** below crossfades between testimonials, autoplays every 5 seconds, and adjusts its height to the current quote.
- The active photo card has a highlighted border and a pointer icon, and clicking a card jumps to its quote.
- An optional intro text and a button sit above, in a header row.
- **Global or manual:** a **Pull Data From** switch chooses between testimonials edited once on the theme options page and testimonials entered on the page itself.
- Nothing renders when there are no testimonials.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (global-or-manual data, two sliders) | [`html/testimonials.php`](html/testimonials.php) |
| The synced Swiper setup | [`js/main.js`](js/main.js) |
| The page-level ACF fields | [`acf-json/group_6695e5344e47d.json`](acf-json/group_6695e5344e47d.json) |
| The global options field | [`acf-json/group_5e3442d949c6b.json`](acf-json/group_5e3442d949c6b.json) |
| Card states, pointer icon and responsive rules | [`scss/_testimonials.scss`](scss/_testimonials.scss) |
| The image wrapper styles used by the cards | [`scss/_figure.scss`](scss/_figure.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Swiper

## Highlights

- **Two synced sliders.** The photo slider is passed to the quote slider through Swiper's `thumbs` option, and its `slideChange` event moves the quote slider, so clicking or autoplay keeps both in step.
- **Active state from Swiper.** The highlighted card uses the `swiper-slide-thumb-active` class Swiper adds, so the styling needs no extra JS.
- **Global or local content.** One template reads its data from either the options page or the section's own fields, and the rest of the markup doesn't care where it came from.
- **Crossfade with auto height.** The quotes fade over each other while the container resizes to the current one.
- **Native lazy loading.** Images come from `wp_get_attachment_image()` through a small helper, so WordPress's built-in `loading="lazy"` handles them.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Swiper (loaded by the theme), plus the Swiper plugin styles (`@import 'plugins/swiper'`)
- The `Helpers\Templates` class, the `framework_button` template part, and the `acme_post_thumbnail_manual()` helper that outputs the images
- The `acme-icons` icon font used for the pointer under the active card
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `acf-json/` contains only the global-testimonials part of the theme's site-settings group

For a simpler single slider, see [`swiper-quote-with-photo`](../swiper-quote-with-photo).

Names have been neutralized (`acme_` prefix, `acme-figure` class, `acme-icons` font name, `acme-site-settings` options page, "Acme" theme header).
