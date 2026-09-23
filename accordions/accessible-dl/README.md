# Accordion: Accessible Definition List

A keyboard- and screen-reader-friendly accordion built on a definition list. Editors add any number of question-and-answer panels in ACF. Clicking a heading (or pressing Enter or Space on it) opens its panel and closes the others.

## What it does

- An optional intro block, then any number of **panels**, each with a heading and a rich-text body.
- Clicking a heading opens its panel with a slide animation, and any other open panel in the same accordion closes.
- The headings work from the **keyboard**: they can be tabbed to, and Enter or Space opens and closes them.
- A chevron icon on each heading rotates a quarter turn when its panel is open.
- The panel bodies are run through `do_shortcode()`, so shortcodes work inside them.
- Nothing renders when there are no panels.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (markup and ARIA attributes) | [`html/accordion.php`](html/accordion.php) |
| The open/close behavior | [`js/main.js`](js/main.js) |
| The ACF fields that power it | [`acf-json/group_6695c777266ff.json`](acf-json/group_6695c777266ff.json) |
| Panel styling and the rotating chevron | [`scss/_accordion.scss`](scss/_accordion.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS · jQuery

## Highlights

- **ARIA wiring.** Each heading is a `role="button"` with `tabindex="0"`, `aria-expanded`, and `aria-controls` pointing at its panel, and each panel is a `role="region"` with `aria-hidden`. The JS keeps these in step as panels open and close.
- **Unique IDs per instance.** The template generates a `uniqid()` prefix for each accordion, so several accordions on one page never share IDs.
- **Keyboard support.** The handler listens for both `click` and `keydown`, ignores every key except Enter and Space, and calls `preventDefault()` so Space doesn't scroll the page.
- **One open at a time.** Opening a panel closes any other open one in the same `<dl>`, resetting its `aria-expanded` and `aria-hidden` too.
- **Delegated events.** The handler is bound once on the document, so it also works for accordions added to the page later.
- **Content-managed.** A small ACF group with an intro field and a repeater.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro and jQuery (loaded by the theme), and an icon font for the chevron
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` contains just the accordion handler from the theme's main script

Names have been neutralized ("Acme" theme header).
