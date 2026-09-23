# Timeline: GSAP Pinned Scrub

A full-screen history timeline that pins in place while the visitor scrolls. As the page scrolls, a column of years advances, the background image crossfades, and the matching text slides in. Each entry comes from a "History" post type, so an editor picks and orders the entries in the admin. Built with GSAP ScrollTrigger.

## What it does

- Editors pick **History** entries for the timeline. Each has a **year**, a featured **image** with an optional overlay, **content**, and categories.
- The section **pins** to the top of the viewport, and scrolling steps through the entries, one per "notch". The scrollbar drives the motion, so scrolling back up plays it in reverse.
- The years advance with a **snap** to each entry. The active year grows and its dot changes color.
- The background image **crossfades** and the text **fades and slides in** for the active entry.
- Category tags under the text are colored by category name, with a default color for everything else.
- On desktop (768px and up) the years run down a vertical rail. On mobile they become a horizontal row that scrolls sideways.
- The animation is torn down and rebuilt when the window is resized, so the pin length stays correct.
- With a single entry, no scroll animation is set up.

## Where to look

| If you want to see... | Open |
|---|---|
| The pin, scrub and snap logic (desktop and mobile) | [`js/main.js`](js/main.js) |
| The template (images, years and contents built from the same list) | [`html/timeline.php`](html/timeline.php) |
| The ACF field that selects the entries | [`acf-json/group_666b0b139b36e.json`](acf-json/group_666b0b139b36e.json) |
| The History post type and its fields | [`acf-json/post_type_666f33b63fba8.json`](acf-json/post_type_666f33b63fba8.json), [`acf-json/group_666f63df94a37.json`](acf-json/group_666f63df94a37.json) |
| Layout, active states and the mobile rail | [`scss/_timeline.scss`](scss/_timeline.scss) |
| The image wrapper styles used by the backgrounds | [`scss/_figure.scss`](scss/_figure.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · GSAP + ScrollTrigger

## Highlights

- **Pin and scrub with snapping.** One ScrollTrigger pins the section and scrubs the years rail, and a `snap` setting settles it on each entry.
- **Different behavior per screen size.** `gsap.matchMedia()` runs one setup for desktop and another for mobile, and each moves the years on a different axis.
- **Active state from scroll progress.** The trigger's progress is rounded to an index, and that index sets the `active` class on the matching year, image and content, so the styling and transitions are all CSS.
- **Rebuilt on resize.** A debounced resize handler kills the existing triggers, sets them up again and refreshes ScrollTrigger.
- **Content-managed.** The entries are a custom post type registered through ACF, and the timeline just selects and orders them.
- **Native lazy loading.** The images come from `wp_get_attachment_image()` through a small helper.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro (the post type file is in ACF's post-type export format), jQuery, GSAP and ScrollTrigger (loaded by the theme)
- The `Helpers\Templates` class, the `overlay` template part, and the `acme_post_thumbnail_manual()` helper that outputs the images
- The category names in the template (`Category A` and `Category B`) are placeholders for the two categories that get their own tag colors
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's timeline setup and its resize handling

For a lighter, click-driven timeline, see [`slick-synced-nav`](../slick-synced-nav).

Names have been neutralized (`acme_` prefix, `acme-figure` class, "Acme" theme header).
