# Hero Home: Side Slider

A homepage hero with the copy on the left and a row of rounded image cards on the right. The image slider runs off the edge of the page, so the next slide peeks in from off-screen. Editors build each slide in ACF (header, text, button, image). Built with Slick.

## What it does

- Each slide has a **header**, **content**, a **button** and a **background image**.
- Two Slick sliders run in sync: the copy fades between slides while the image cards slide along beside it.
- The image slider is wider than its container and its list is padded on the right, so the next card is partly visible and hints that there's more.
- Navigation is a custom dot indicator that's built from your own markup and placed with `appendDots`.
- With a single slide, no sliders or dots are created and the image just sits there.
- Below 1080px the layout stacks with the image on top. At tablet width and below, the dots also move under the copy.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (builds copy and image markup in one loop) | [`html/homepage_hero.php`](html/homepage_hero.php) |
| The ACF fields that power it | [`acf-json/group_5e25d40b53db3.json`](acf-json/group_5e25d40b53db3.json) |
| Slick setup (two synced sliders, custom dots) | [`js/main.js`](js/main.js) |
| Layout, the peek effect, dots and responsive rules | [`scss/_homepage_hero.scss`](scss/_homepage_hero.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Slick

## Highlights

- **Synced sliders with `asNavFor`.** The copy slider handles autoplay and dots, and the image slider follows it, so one loop drives both.
- **The off-screen peek.** A wide image wrapper plus right padding on `.slick-list` lets the next slide show without extra markup or JS.
- **Custom dot markup.** `customPaging` and `appendDots` render the dots as buttons and place them in their own container, so they can be styled and positioned freely.
- **Safe with one slide.** The JS only initializes Slick when there are multiple slides, and the template only outputs the dot container when it's needed.
- **Scoped per instance.** Each `.homepage-hero` looks up its own sliders with `find()`, so more than one can live on a page.
- **Content-managed.** Slides are an ACF repeater, and images and buttons go through shared template parts.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Slick (loaded by the theme)
- The theme's `Helpers\Templates` class and the `button` and `background_image` template parts, plus the ACF groups they clone
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Slick calls

Slick is an older slider library. The [`slider-image-or-video`](../slider-image-or-video) version of this hero uses Swiper instead, and [`split-slider`](../split-slider) is another Slick variant with a full-bleed split layout.

Names have been neutralized ("Acme" theme header).
