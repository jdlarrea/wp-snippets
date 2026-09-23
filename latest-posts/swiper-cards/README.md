# Latest Posts: Swiper Cards

A "latest posts" section with a header, optional description, a "view all" style button and a Swiper slider of post cards. Editors choose where the posts come from: the latest of a content type, the latest by category or tag, or a hand-picked list. Built with Swiper.

## What it does

- A section header with an optional **description** and an optional **button** (for example "View all posts").
- A **Select Mode** in ACF decides the posts shown (up to 12):
  - Latest from Insights, News or Case Studies
  - Latest by category, tag or content type
  - Latest by category or tag for Case Studies
  - **Individual:** hand-picked posts, in the order the editor chose
- The slider shows **1 card** on mobile, **2** from 575px and **3** from 1080px, and slides move by a full set at a time.
- It loops and autoplays, with dot pagination on desktop and prev/next arrows on tablet and mobile.
- Each card is a single link with a thumbnail, a small label pill (content type, tag or news type) and the post title. The image scales down slightly on hover.
- Nothing renders when the query returns no posts.

## Where to look

| If you want to see... | Open |
|---|---|
| The section template (query modes, header, Swiper markup) | [`html/featured_post_cards.php`](html/featured_post_cards.php) |
| The card template (thumbnail, label, title) | [`html/content-post.php`](html/content-post.php) |
| The ACF fields that power it | [`acf-json/group_6695e872eddd4.json`](acf-json/group_6695e872eddd4.json) |
| The Swiper setup and breakpoints | [`js/main.js`](js/main.js) |
| Section layout, arrows vs. dots, spacing | [`scss/_featured-post-cards.scss`](scss/_featured-post-cards.scss) |
| Card styles (label pill, hover) | [`scss/_archive-grid.scss`](scss/_archive-grid.scss) |
| The image wrapper styles used by the card | [`scss/_figure.scss`](scss/_figure.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Underscores-based custom theme) · PHP (`WP_Query`) · Advanced Custom Fields Pro · SCSS · jQuery · Swiper

## Highlights

- **Content-managed queries.** One ACF select field switches the whole `WP_Query` between latest, taxonomy-filtered and manual modes, with the matching category, tag or post picker shown only when it applies.
- **Manual order respected.** Individual mode uses `post__in` with `orderby => post__in`, so posts appear in the editor's order.
- **Reusable card.** The slider loops over posts and calls `get_template_part()` for each card, so the card markup lives in one place.
- **Responsive slider, not just responsive CSS.** Slides per view and slides per group change together at each breakpoint, so each page advances a full set.
- **Different controls per screen size.** Dots on desktop and arrows below 1080px, switched with CSS only.

## Notes

This is an excerpt from a larger custom theme, trimmed to the pieces that make up this component. It won't run standalone. It depends on things not included here:

- ACF Pro, jQuery and Swiper (loaded by the theme), plus the Swiper plugin styles (`@import 'plugins/swiper'`)
- The theme's `Helpers\Templates` class, the `button` template part, and the `acme_post_thumbnail()` helper that outputs the card image
- The custom post types and taxonomies the queries refer to (`news`, `case-study`, `content-type`, `news-type`)
- The rest of the SCSS partials (`// ... other imports`)
- `_variables.scss` is trimmed to the colors this snippet uses, plus the full set of `$color-*` assignments to show how reusable colors are mapped (`// ... other colors`)
- `js/main.js` is trimmed to this component's Swiper setup, and the SCSS in `_archive-grid.scss` and `_figure.scss` is pulled from the theme's shared styles

Names have been neutralized (`acme_` prefix, `acme-figure` class, "Acme" theme header).
