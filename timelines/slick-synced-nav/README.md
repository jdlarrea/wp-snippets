# Timeline: Slick Synced Nav

A click-through timeline. A row of angled tabs across the top (one per period) controls a carousel of content below. Each period has a text panel and its own set of image slides with a caption bar and arrows. Built with Slick.

## What it does

- Editors add **items** (each with a tab title, a rich-text panel, and any number of **image slides** with a title and description) under one section heading.
- The **tabs** run across the top as angled shapes. The current tab is highlighted, and the row scrolls with its own arrows when there are more tabs than fit.
- Clicking a tab jumps the content carousel to that period, and moving the carousel updates the current tab. The two stay in sync.
- Each period shows a text panel beside an **image slider**. The slider has its own prev and next arrows, built into the caption bar over the image.
- The number of visible tabs steps down with screen width (9 down to 1).
- On tablets and below, the panel and images stack. On small phones the caption drops below the image.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (tabs, content items and nested image slides) | [`html/timeline.php`](html/timeline.php) |
| The Slick setup (two synced sliders plus nested sliders) | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_6622bcf6d029e.json`](acf-json/group_6622bcf6d029e.json) |
| Angled tabs, caption bar and responsive rules | [`scss/_timeline.scss`](scss/_timeline.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Slick

## Highlights

- **Synced sliders with `asNavFor`.** The tab row and the content carousel are two Slick instances pointing at each other, so either one drives the other.
- **Angled tabs in CSS.** Each tab is a parallelogram made with `clip-path: polygon()`, with different shapes for the first and last tabs so the row has clean ends.
- **Nested carousels.** Every period has its own image slider inside the outer content carousel, with arrows placed by passing the arrow elements straight to Slick.
- **Per-instance setup.** Each `.timeline` looks up its own tab row and carousel with `find()`.
- **Content-managed.** A two-level ACF repeater (items, then slides) is all an editor needs.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Slick (loaded by the theme), and an icon font for the arrows
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Slick setup

Slick is an older slider library. For a scroll-driven version built with GSAP, see [`gsap-pinned-scrub`](../gsap-pinned-scrub).

Names have been neutralized ("Acme" theme header).
