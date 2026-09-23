# Testimonials: Swiper Quote with Photo

A full-width testimonial slider. Each slide is a dark panel with a section header, a quote, the person's name and title, and a photo that breaks out to the edge of the page. A looping Swiper moves through the testimonials, with dot pagination at the left of the panel. Editors add testimonials in ACF.

## What it does

- A section **header** and a repeater of **testimonials** (photo, quote, name, title).
- Slides loop and autoplay every 10 seconds, with clickable dots.
- On desktop, the panel is inset from the left, with a rounded corner, and the photo runs out to the right edge of the page. A decorative gradient shape sits behind the photo.
- On smaller screens the dots go back into the normal page flow and the photo drops under the quote at full width.
- Nothing renders when there are no testimonials.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (header, quote, author, photo per slide) | [`html/featured_testimonials.php`](html/featured_testimonials.php) |
| The Swiper setup | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_66c4cf11c54ea.json`](acf-json/group_66c4cf11c54ea.json) |
| Panel layout, photo breakout and responsive rules | [`scss/_featured-testimonials.scss`](scss/_featured-testimonials.scss) |
| The image wrapper styles used by the photo | [`scss/_figure.scss`](scss/_figure.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Swiper

## Highlights

- **Photo breakout in pure CSS.** The image column has a fixed width and the image inside is sized with `calc()` from the viewport width, so it extends to the page edge without a wider wrapper.
- **Inline decorative SVG.** The gradient shape is inline in the template, positioned behind the photo, so it needs no extra request.
- **Header repeated per slide.** The section header sits inside each slide, so it stays in view and slides in with its testimonial.
- **Native lazy loading.** The photo comes from `wp_get_attachment_image()` through a small helper, so WordPress's built-in `loading="lazy"` handles it.
- **Content-managed.** Everything comes from a small ACF group.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Swiper (loaded by the theme), plus the Swiper plugin styles (`@import 'plugins/swiper'`)
- The `acme_post_thumbnail_manual()` helper that outputs the photo
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Swiper setup, and `_figure.scss` is pulled from the theme's shared styles

For a slider with a synced photo strip, see [`swiper-synced-avatars`](../swiper-synced-avatars). For one that mixes manual and post-type entries, see [`slick-manual-or-cpt`](../slick-manual-or-cpt).

Names have been neutralized (`acme_` prefix, `acme-figure` class, "Acme" theme header).
