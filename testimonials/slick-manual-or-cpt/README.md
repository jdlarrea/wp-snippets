# Testimonials: Manual or Post Type (Slick)

A testimonial carousel that can be filled two ways: by typing each testimonial into the section, or by picking entries from a dedicated Testimonial post type. One template handles both. Each slide shows a company logo, the quote, and the author with a photo. Built with Slick.

## What it does

- A **Type** switch chooses between **Manual Entry** and **selecting posts** from a `testimonial` custom post type.
- Each testimonial has a **logo**, a **quote**, an **author photo**, a **name** and a **company**.
- The logo sits in a circle above the quote. If the logo is an SVG it's inlined, so CSS can recolor it. Otherwise it's a normal image.
- Slick shows one slide at a time, autoplays every 5 seconds, matches its height to the current slide, and shows dots.
- Author photos are lazy-loaded, and the lazy loader re-checks after each slide change.
- The section fades up when it scrolls into view.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (one path for manual and post-type data) | [`html/testimonial_carousel.php`](html/testimonial_carousel.php) |
| The Slick setup | [`js/main.js`](js/main.js) |
| The section's ACF fields | [`acf-json/group_64d3e5f0e2aff.json`](acf-json/group_64d3e5f0e2aff.json) |
| The Testimonial post type's ACF fields | [`acf-json/group_64f0a526a0f84.json`](acf-json/group_64f0a526a0f84.json) |
| Registering the `testimonial` post type | [`html/functions-cpt-testimonial.php`](html/functions-cpt-testimonial.php) |
| The SVG helper | [`html/functions-render-svg.php`](html/functions-render-svg.php) |
| Layout, logo circle, quote mark and dots | [`scss/_testimonial_carousel.scss`](scss/_testimonial_carousel.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Slick · Blazy

## Highlights

- **One template, two data sources.** The template picks the item list based on the type, then reads each field from either the row or the post. The markup below that is written once.
- **Reusable testimonials.** Testimonials created once as posts can be shown on any page, while one-off quotes can be typed straight into the section.
- **Recolorable logos.** The helper returns the SVG's markup, so CSS `fill` can turn any logo white, with a fallback to a regular image.
- **Custom post type with ACF.** The post type is registered in code, and its fields (logo, photos, quote, name, company) come from an ACF group.
- **Lazy loading that survives sliding.** The `afterChange` hook re-checks the page so author images that slid into view get loaded.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery, Slick and Blazy (loaded by the theme, with a global `blazy` instance), and animate.css-style classes for the fade-up
- The rest of the SCSS partials (`// ... other imports`), and the background image referenced in the SCSS
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `html/functions-cpt-testimonial.php` is the `testimonial` post type from the theme's larger post-type file

Slick is an older slider library. For Swiper versions, see [`swiper-quote-with-photo`](../swiper-quote-with-photo) and [`swiper-synced-avatars`](../swiper-synced-avatars).

Names have been neutralized (`acme_` prefix, "Acme" theme header).
