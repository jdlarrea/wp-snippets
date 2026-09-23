# Latest Posts: Featured Post Plus List

A "latest posts" section with a header, one large featured post on the left, and a stacked list of the next few posts on the right. It's pure PHP and CSS, with no JavaScript. Editors choose where the posts come from: the latest posts, a category, a tag, a content type, or a hand-picked list.

## What it does

- A section **header**, then up to four posts (in Individual mode, however many the editor picks). The first is the large post on the left, with an image, a term label, the date and the title. The other three are text rows on the right, each with the same label, date and title.
- A **Select Posts** field in ACF decides the source:
  - Latest posts
  - Latest by category
  - Latest by tag
  - Latest by content type
  - **Individual:** hand-picked posts, in the order the editor chose
- The term label is the post's primary content type. It falls back to the first content type, and then to "General".
- Every post is a single link. On hover, a circular arrow icon fades and slides in.
- On small screens the layout stacks and the large post's image is hidden, so the section reads as a clean list.
- Nothing renders when the query returns no posts.

## Where to look

| If you want to see... | Open |
|---|---|
| The template (query modes, first-vs-rest split, markup) | [`html/featured_post_list.php`](html/featured_post_list.php) |
| The ACF fields that power it | [`acf-json/group_66699b7d65051.json`](acf-json/group_66699b7d65051.json) |
| Layout, hover arrow and responsive rules | [`scss/_featured_post_list.scss`](scss/_featured_post_list.scss) |
| The image wrapper styles used by the large post | [`scss/_figure.scss`](scss/_figure.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP (`WP_Query`) · Advanced Custom Fields Pro · SCSS

## Highlights

- **Content-managed queries.** One ACF select field switches the whole `WP_Query` between latest, taxonomy-filtered and manual modes, with the matching category, tag, type or post picker shown only when it applies.
- **Manual order respected.** Individual mode uses `post__in` with `orderby => post__in`, so posts appear in the editor's order.
- **One loop, two layouts.** The loop collects the first post as the large one and the rest into a list, and then the markup for each side is output separately, so the template has no positional logic inside the HTML.
- **Primary-term logic with fallbacks.** It uses Yoast's primary term when one is set, then the first assigned term, then a default label.
- **No JavaScript.** Layout, the hover arrow and the mobile behavior are all CSS.
- **Native lazy loading.** The large post's image comes from `wp_get_attachment_image()` through a small helper, so WordPress's built-in `loading="lazy"` handles it, with no plugin.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro and the Yoast SEO plugin (for `yoast_get_primary_term_id()`)
- The `acme_post_thumbnail_manual()` helper that outputs the large post's image, and the `acme-icons` icon font used for the hover arrow
- The `content-type` taxonomy the queries refer to
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- The image wrapper styles in `_figure.scss` are pulled from the theme's shared styles

Names have been neutralized (`acme_` prefix, `acme-figure` class, `acme-icons` font name, "Acme" theme header).
