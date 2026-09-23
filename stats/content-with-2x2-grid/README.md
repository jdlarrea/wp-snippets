# Stats: Content with 2x2 Grid

A stats section with a block of content on the left (heading, description, button) and a two-column grid of big numbers on the right. Each number counts up from zero as it scrolls into view. It's a light, mostly CSS component with a small jQuery counter.

## What it does

- **Left side:** a heading with a rule under it, a rich-text description, and a call-to-action button, all optional and all editable in ACF.
- **Right side:** the stats, each with a large number and a short description, laid out in a two-column grid (2x2 for four stats).
- Each number **counts up** when it reaches the bottom of the viewport, and only once.
- Dark background with light text and a tinted number color.
- Below tablet width the layout stacks (content first, stats below), and on small phones the stats grid becomes a single column.
- Nothing renders when there are no stats.

## Where to look

| If you want to see... | Open |
|---|---|
| The template | [`html/stats.php`](html/stats.php) |
| The counter-up JS | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_6695c7fa58280.json`](acf-json/group_6695c7fa58280.json) |
| Layout, grid and responsive rules | [`scss/_stats.scss`](scss/_stats.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery · CounterUp + Waypoints

## Highlights

- **Flex outside, grid inside.** The section is a flex row with two 50% columns, and the stats column is its own CSS grid, so the two halves can be sized and reflowed independently.
- **Counts up once, on scroll.** A Waypoint fires the counter when each number enters the viewport, then destroys itself.
- **Layout-stable numbers.** Each number's width is set to its final rendered width before it counts, so the layout doesn't shift while the digits change.
- **Optional pieces.** The stat rule, the description and the button only render when they have content.
- **Content-managed.** A small ACF group with a repeater for the stats.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery, and the CounterUp and Waypoints libraries (loaded by the theme)
- The `Helpers\Templates` class and the `button` template part
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's counter code

For a version where the stats run in a single row, see [`row-with-dividers`](../row-with-dividers).

Names have been neutralized ("Acme" theme header).
