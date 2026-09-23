# Stats: Row with Dividers

A stats section with a heading and a single row of big numbers, each with a description and a vertical divider on its left. The numbers count up as they scroll into view. It has a light and a dark theme, chosen in the admin.

## What it does

- A section **heading** and a repeater of **stats** (number and description).
- The stats sit **in a row**, each with a left border as a divider, a large number and a short description under it.
- Each number **counts up** when it reaches the bottom of the viewport, and only once.
- A **Light / Dark** setting switches the section's gradient background and the divider color.
- The number size, spacing and description size step down at each breakpoint.
- On phones the row becomes a centered column, and the dividers turn into horizontal rules between stats (none after the last one).
- Nothing renders when there are no stats.

## Where to look

| If you want to see... | Open |
|---|---|
| The template | [`html/stats.php`](html/stats.php) |
| The counter-up JS | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_6695c7fa58280.json`](acf-json/group_6695c7fa58280.json) |
| Layout, themes and responsive rules | [`scss/_stats.scss`](scss/_stats.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · CounterUp + Waypoints

## Highlights

- **Theme as a class.** The ACF select becomes a `theme-light` or `theme-dark` class on the section, and the CSS restyles the background and dividers from that one class. It defaults to light when the field isn't set.
- **Dividers that change direction.** The left border on desktop becomes a bottom border on mobile, with `:last-child` removing the extra line.
- **Simple flex row.** Each stat is a flex item with a base width of 30% and `flex-grow`, so the row fills the width without a grid definition. It's sized for around three stats.
- **Counts up once, on scroll.** A Waypoint fires the counter when each number enters the viewport, then destroys itself.
- **Content-managed.** A small ACF group with a select and a repeater.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery, and the CounterUp and Waypoints libraries (loaded by the theme)
- The theme's heading accent style (the `hdr-accent` class on the heading, whose decoration the SCSS hides on mobile)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's counter code

For a version with a content block beside a 2x2 grid, see [`content-with-2x2-grid`](../content-with-2x2-grid).

Names have been neutralized ("Acme" theme header).
