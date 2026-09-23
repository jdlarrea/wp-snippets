# Hero Home: Pop-Up Circles

A full-height homepage hero with a headline, sub-header and buttons on the left, and either a background image or a looping video in an animated circle on the right. There's no slider and no JavaScript. The motion is pure CSS.

## What it does

- Editors set a **header**, **sub-header** and any number of **buttons**, each with its own style and an option to open in a new tab.
- **Image:** used as a full-bleed background, with position presets or a custom `background-position` value.
- **Video:** a muted, looping, autoplaying `mp4` (with an optional poster) shown inside a circular frame on the right.
- If there's a video, it plays inside the circle on desktop. If there isn't, the image fills the background instead.
- The circle frame and two outlined circles animate in a slow, repeating loop.
- At 767px and below, the video circle is hidden, the image always shows, and the copy centers.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (image position logic, video markup, buttons) | [`html/hero_home.php`](html/hero_home.php) |
| The ACF fields that power it | [`acf-json/group_62fe6b642a830.json`](acf-json/group_62fe6b642a830.json) |
| Layout, gradient background and responsive rules | [`scss/_hero_home.scss`](scss/_hero_home.scss) |
| The circle animations | [`scss/_animations.scss`](scss/_animations.scss) |
| Variables and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS (CSS keyframe animations)

## Highlights

- **No JS.** The circle "pop" loops are three keyframe animations, so there's nothing to load or run for the motion.
- **Editor-friendly image control.** ACF offers position presets, plus a "Custom" option that reveals a text field for any `background-position` value, and the template builds the inline style for whichever one is picked.
- **Video only when set.** The `<video>` element and its poster attribute are only output when a video file exists, and the background image is shown on desktop otherwise.
- **Self-contained styles.** The component keeps its own breakpoint and gradient variables at the top of its SCSS file, so it can be dropped into another theme and adjusted in one place.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, plus the ACF group that defines the button fields (cloned into "Hero Buttons")
- The theme's global `.button` styles and `.wrapper` layout class
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)

The other hero variants are [`slider-image-or-video`](../slider-image-or-video) (Swiper), [`off-screen-slider`](../off-screen-slider) and [`split-slider`](../split-slider) (both Slick).

Names have been neutralized ("Acme" theme header).
