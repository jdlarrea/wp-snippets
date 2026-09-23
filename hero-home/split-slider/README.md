# Hero Home: Split Slider

A split-layout homepage hero. Copy and a button sit on the left, an image or video sits on the right, and the two sides slide together. Editors build each slide in ACF and pick image or video for the right side. Built with Slick.

## What it does

- Each slide has a **left side** (background design image, eyebrow, header, button) and a **right side** (an image or a video).
- Two Slick sliders run in sync: one for the copy, one for the media. They fade together on a 5-second autoplay loop.
- A single prev/next arrow bar controls both sliders.
- On each new slide the eyebrow, header and button animate in from different directions.
- Both sliders stay hidden until Slick has initialized, so visitors never see unstyled slides stacked on top of each other.
- Below 992px the layout stacks: media on top, then copy, then the arrows.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (builds both slide sets in one loop) | [`html/hero_home.php`](html/hero_home.php) |
| The ACF fields that power it | [`acf-json/group_634edfa4d8c9a.json`](acf-json/group_634edfa4d8c9a.json) |
| Slick setup (two synced sliders) | [`js/main.js`](js/main.js) |
| Layout, entrance animations and responsive rules | [`scss/_hero_home.scss`](scss/_hero_home.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Slick

## Highlights

- **Synced sliders with `asNavFor`.** The copy slider drives autoplay and the arrows, and the media slider follows it, so one loop and one set of controls run both.
- **One loop, two outputs.** The template walks the slides once and builds the left and right markup in parallel, so the two sides can never get out of order.
- **No flash of unstyled content.** Slides are hidden until Slick adds `.slick-initialized`, and only the first slide is shown before that.
- **CSS-driven entrance animation.** The `.slick-active` class triggers the staggered slide-in, so no extra JS is needed for it.
- **Content-managed.** Image vs. video is a conditional ACF field, and the actual rendering is handled by shared template parts.
- **Stacks cleanly on mobile.** Flexbox `order` reflows the three parts without changing the markup.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Slick (loaded by the theme)
- The theme's `Helpers\Templates` class and the `framework_bg_image`, `framework_bg_video` and `framework_button` template parts, plus the ACF groups they clone
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's two Slick calls

Slick is an older slider library. The [`slider-image-or-video`](../slider-image-or-video) version of this hero uses Swiper instead, and [`off-screen-slider`](../off-screen-slider) is another Slick variant where the next slide peeks in from off-screen.

Names have been neutralized ("Acme" theme header).
