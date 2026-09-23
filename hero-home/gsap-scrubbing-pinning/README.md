# Hero Home: GSAP Scrubbing & Pinning

A full-screen homepage hero that pins in place while the visitor scrolls, then steps through its slides as the scroll position "scrubs" the animation. Each slide has a headline, an optional logo and button, and optional stats that count up as they come into view. Built with GSAP ScrollTrigger.

## What it does

- The hero **pins to the top of the page** and the slides scroll up through it, one after another. The scrollbar drives the motion, so scrolling back up plays it in reverse.
- The first slide is visible right away. Later slides fade in as the scroll position reaches them.
- Slides can hold **stats** (a number, a unit and a description). When a slide with stats scrolls into view, the numbers count up from zero.
- Headlines can wrap words in a `<span>` for an outlined-text effect.
- Editors choose a background **image or video**, with an optional overlay. On desktop the video loads and plays after the page has loaded. On small screens the video is hidden and the image shows instead.
- A rotated "Scroll Down" arrow and a colored bar along the bottom finish the design.
- With a single slide, no pinning or scroll animation is set up at all.

## Where to look

| If you want to see... | Open |
|---|---|
| The pinning, scrubbing and count-up logic | [`js/main.js`](js/main.js) |
| The template (slides, stats, background layers) | [`html/hero_full.php`](html/hero_full.php) |
| The ACF fields that power it | [`acf-json/group_6669901648915.json`](acf-json/group_6669901648915.json) |
| Layout, outlined text, stats grid and responsive rules | [`scss/_hero_full.scss`](scss/_hero_full.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · GSAP + ScrollTrigger · CounterUp

## Highlights

- **Pin and scrub.** A single ScrollTrigger pins the hero and scrubs a `top` tween across the slide stack. The pin lasts for as many screen heights as there are slides.
- **Several triggers, one scroll.** Separate scrubbed fade-ins for each later slide, plus a per-slide trigger that fires the count-up, all run from the same scroll position.
- **Per-slide entry logic.** The count-up starts on `onEnter` for each multi-stat slide, so each set of numbers animates when its own slide arrives.
- **Semantic headings.** The first slide's headline is an `<h1>` and later ones are `<h2>`.
- **CSS text outline with a fallback.** The outlined `<span>` text is behind an `@supports` check, so browsers without `text-stroke` show normal text.
- **Deferred video.** The video's real source is kept in `data-src` and only swapped in and played on window load, and only on wide screens.
- **Content-managed.** Background type, overlay, slides, logos and stats are ACF fields, with images, videos and buttons rendered through shared template parts.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery, GSAP with ScrollTrigger, and the CounterUp library (loaded by the theme)
- The theme's `Helpers\Templates` class, the `framework_bg_video`, `overlay` and `framework_button` template parts, and the `acme_post_thumbnail_manual()` helper
- The color bar image referenced in the SCSS (`acme_colorbar.svg`)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's animation and video code

The other hero variants are [`slider-image-or-video`](../slider-image-or-video), [`off-screen-slider`](../off-screen-slider), [`split-slider`](../split-slider) and [`pop-up-circles`](../pop-up-circles).

Names have been neutralized (`acme_` prefix, "Acme" theme header).
