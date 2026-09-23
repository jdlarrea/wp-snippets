# Footer: Single Row

A compact site footer. The logo sits on the left, and on the right are a horizontal menu, social icons, a copyright line and a small legal-links menu. It's pure PHP and CSS, with no JavaScript.

## What it does

- **Logo** on the left, linked to the home page, using a separate footer logo from the theme options.
- **Main menu** across the top right, styled as small uppercase links, with social icons beside it.
- **Copyright line** below, supporting a `%year%` token that's replaced with the current year.
- **Legal menu** at the bottom right, with the links separated by pipes that are drawn in CSS (the last one has none).
- If ACF isn't active, the footer still renders. Every `get_field()` call is behind a `function_exists( 'get_field' )` check, and the copyright falls back to a plain "(c) year site name" line.
- Footer scripts (like an analytics snippet) come from a theme option and are output after `wp_footer()`.
- On small screens everything stacks and centers.

## Where to look

| If you want to see... | Open |
|---|---|
| The footer template | [`html/footer.php`](html/footer.php) |
| The ACF options fields that power it | [`acf-json/group_5e3442d949c6b.json`](acf-json/group_5e3442d949c6b.json) |
| Layout, menu styling and responsive rules | [`scss/_footer.scss`](scss/_footer.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS

## Highlights

- **Plain `wp_nav_menu()`.** Two calls with their own `theme_location` and `menu_class`, styled directly with CSS, so there's no custom walker or helper.
- **CSS-drawn separators.** The pipes between legal links come from `:after`, and `:last-child` removes the extra one, so editors can add or remove links without touching markup.
- **Graceful without ACF.** Each ACF read is guarded, and the logo and social-links markup already handles empty values, so a missing plugin or unset option doesn't cause an error.
- **Options-page driven.** Logo, social links, copyright and scripts are all edited in the admin.
- **Simple responsive behavior.** One flex row that becomes a centered column below the small breakpoint.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up the footer. It won't run standalone. It depends on things not included here:

- ACF Pro and an icon font for the social icons
- Two registered menu locations (`footer-main` and `footer-copyright`)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `acf-json/` contains only the footer-related fields of the theme's site-settings group

For a footer with several link columns, see [`multi-column`](../multi-column).

Names have been neutralized ("Acme" theme header, `@package acme`).
