# CTA Banner: Linked Offer Sliders

A content-plus-image banner where two Swipers move together: a full-bleed image slider behind, and a card of copy in front. Both are fed from a custom "Offer" post type, so an editor picks and orders offers and the banner builds itself. Each offer can also carry a video that opens in a popup.

## What it does

- A page section picks **Offers** (a custom post type) in the order they should appear.
- The **image slider** fills half the section and crossfades between each offer's featured image. An offer with a video gets a round play button over its image that opens the video in a popup.
- The **content card** overlaps the image and shows the matching offer's eyebrow, headline, description and button. Its dots at the top right switch offers.
- The two sliders are **linked**, so changing the offer in one changes it in the other.
- **Content left or right:** an alignment setting puts the card on one side and the image on the other.
- **Light or dark:** a setting switches the section's colors.
- On phones the image goes full-width on top and the card slides up over its bottom edge.
- Nothing renders when no offers are selected.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (one query, two sliders' worth of markup) | [`html/offer_slider.php`](html/offer_slider.php) |
| The linked Swiper setup | [`js/main.js`](js/main.js) |
| The section's ACF fields (offers, side, theme) | [`acf-json/group_68cc5b6da76a6.json`](acf-json/group_68cc5b6da76a6.json) |
| The Offer post type's ACF fields | [`acf-json/group_68d01e72b2e96.json`](acf-json/group_68d01e72b2e96.json) |
| The Offer post type itself | [`acf-json/post_type_68c030a933557.json`](acf-json/post_type_68c030a933557.json) |
| Layout, side and theme variants, and responsive rules | [`scss/_offer_slider.scss`](scss/_offer_slider.scss) |
| The shared pagination dots | [`scss/_swiper.scss`](scss/_swiper.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP (`WP_Query`) · Advanced Custom Fields Pro · SCSS · jQuery · Swiper · Fancybox

## Highlights

- **One query, two sliders.** A single `WP_Query` on the `offer` post type keeps the editor's order (`post__in` with `orderby => post__in`). The loop prints the image slides directly and builds the content slides into a string, which is printed afterward inside the second slider, so both sliders always have the same slides in the same order.
- **Two-way controller link.** `offerContents.controller.control = offerImages` and the reverse connect the Swipers, so the pagination on the card drives the images and the other way around.
- **Per-post fields inside the loop.** With `the_post()` active, `get_field( 'header' )` and friends read the current offer without needing an ID.
- **Variants from classes.** The ACF settings become `align-left` / `align-right` and `theme-light` / `theme-dark` classes on the section, and the SCSS handles the rest.
- **Post type registered through ACF.** The `offer` post type comes from ACF's post-type export, and its fields (eyebrow, headline, description, button, video URL) are a separate field group.
- **Popup video without extra markup.** The play link is a plain `<a data-fancybox>` and works with a file, Vimeo or YouTube URL.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro (the post type file is in ACF's post-type export format), jQuery, Swiper and Fancybox (loaded by the theme), plus the Swiper plugin styles (`@import 'plugins/swiper'`)
- The `Helpers\Templates` class, the `framework_button` template part, the `acme_post_thumbnail()` helper that outputs the image, and an icon font for the play button
- The theme's eyebrow accent style (`hdr-accent`) and the small chevron image referenced in the dark-theme button styles
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Swiper setup, and `_swiper.scss` is pulled from the theme's shared styles

For other ways of pulling custom post types, see the `WP_Query` versions in [`latest-posts`](../../latest-posts/swiper-cards) and the post-type-driven [`gsap-pinned-scrub`](../../timelines/gsap-pinned-scrub) timeline and [`slick-manual-or-cpt`](../../testimonials/slick-manual-or-cpt) carousel.

Names have been neutralized ("Acme" theme header, `acme_` prefix, `acme-swiper-pagination` class).
