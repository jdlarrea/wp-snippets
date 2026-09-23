# Logo Slider: Opposite-Scrolling Rows

A logo section with a centered header and one or two rows of client logos that scroll continuously. When there are enough logos, they're split across two rows that scroll in opposite directions. Built with Swiper.

## What it does

- Editors add a **header** and a **gallery** of logos in ACF.
- Logos scroll on a continuous, constant-speed loop that doesn't stop, and touch and drag are turned off.
- With **15 or more logos**, the gallery is split in half into two rows. The second row scrolls the opposite way.
- With **14 or fewer**, everything stays in one row.
- Logos are shown in grayscale at a fixed maximum height, and the number visible at once grows with screen width (3, then 5, then 6).

## Where to look

| If you want to see... | Open |
|---|---|
| The template (row split logic, `dir="rtl"` row) | [`html/logo_slider.php`](html/logo_slider.php) |
| The Swiper setup for both rows | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_67326e2db3af9.json`](acf-json/group_67326e2db3af9.json) |
| Layout, linear easing, grayscale and responsive rules | [`scss/_logo_slider.scss`](scss/_logo_slider.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · Swiper

## Highlights

- **Opposite direction with one HTML attribute.** The second row is marked `dir="rtl"`, and Swiper runs its autoplay the other way, so there's no separate reversed config.
- **Seamless marquee.** `autoplay.delay: 0`, a long `speed` and `loop: true` keep the row moving, and a CSS rule forces `linear` timing on the wrapper so the speed doesn't ease in and out.
- **Sensible splitting.** The template only builds a second row when there are more than 14 logos, using `array_slice` at the halfway point.
- **Multiple instances are safe.** Each `.logo-slider` row is initialized with its own Swiper instance.
- **Content-managed.** A text field and a gallery are all an editor needs.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Swiper (loaded by the theme), plus the Swiper plugin styles (`@import 'plugins/_swiper'`)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Swiper setup

This version has no per-logo link. See [`optional-links-slider`](../optional-links-slider) for one where each logo can link out.

Names have been neutralized ("Acme" theme header).
