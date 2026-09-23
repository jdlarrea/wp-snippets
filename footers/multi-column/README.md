# Footer: Multi-Column

A site footer with a branding column (logo, blurb, social icons) and two link columns, each one a separate WordPress menu output with plain `wp_nav_menu()`. A slim bottom bar holds the copyright and a small legal-links menu. It's pure PHP and CSS, with no JavaScript.

## What it does

- **Top band:** three columns. The first has the logo, an intro blurb and social icons. The next two are link columns, each managed as its own menu in Appearance > Menus.
- **Column headings from the menu.** The first item in each link menu is styled as the column heading, so editors set a heading just by ordering the menu.
- **Bottom bar:** a copyright line and a small menu for links like privacy and terms.
- The copyright field supports a `%year%` token that's replaced with the current year.
- **Landing-page mode:** a per-page ACF switch hides the whole top band, leaving just the bottom bar, for pages that shouldn't have a full footer.
- Footer scripts (like an analytics snippet) come from a theme option and are output just before `</body>`.
- The layout steps down as the screen narrows: the branding column goes full width first, then the link columns pair up, then everything stacks into one column.

## Where to look

| If you want to see... | Open |
|---|---|
| The footer template | [`html/footer.php`](html/footer.php) |
| The ACF options fields that power it | [`acf-json/group_5e3442d949c6b.json`](acf-json/group_5e3442d949c6b.json) |
| Columns, heading style and responsive rules | [`scss/_footer.scss`](scss/_footer.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP · Advanced Custom Fields Pro · SCSS

## Highlights

- **Plain `wp_nav_menu()`.** Each column is one call with its own `theme_location` and `menu_class`. There's no custom walker or helper code, so it stays easy to read and to change.
- **Column classes in the menu class.** The `menu_class` sets both the column position (`footer-col-2`) and the menu name (`footer-menu-1`), so the layout CSS targets the `<ul>` directly.
- **Editor-friendly.** Logo, blurb, social links, copyright, analytics and the landing-page switch are all editable in the admin.
- **Accessible logo link.** The logo link has an `aria-label`, and the footer uses the semantic `<footer>` element.
- **Responsive without JS.** Flexbox with width steps at each breakpoint.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up the footer. It won't run standalone. It depends on things not included here:

- ACF Pro, plus the per-page `page_options` group with its `is_landing_page` field
- Three registered menu locations (`footer-col-1`, `footer-col-2`, `footer-copyright`) and an icon font for the social icons
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `acf-json/` contains only the footer-related fields of the theme's site-settings group

For a simpler one-row footer, see [`single-row`](../single-row).

Names have been neutralized (`acme_` prefix, `acme-site-settings` options page, "Acme" theme header).
