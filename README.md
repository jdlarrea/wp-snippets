# WordPress Snippets

I'm Jonathan Larrea, a WordPress developer. This repo collects sections and components from custom WordPress themes I've built, organized so they're quick to read. Each snippet groups the PHP template, the SCSS, the JavaScript and the ACF field definitions that make it work, with a short README on what it does and where to look.

Most of these come from custom themes built on the [Underscores](https://underscores.me/) starter, with content managed through ACF Pro and front-end behavior written in SCSS, jQuery, GSAP, Swiper and Slick.

## Snippets

### Mega menus

| Snippet | What it shows | Built with |
|---|---|---|
| [`with-icons-and-posts`](mega-menus/with-icons-and-posts) | Hover mega menu with icon children and a panel of latest or hand-picked posts, sticky header, mobile drill-down | Custom `Walker_Nav_Menu`, ACF, GSAP ScrollTrigger |
| [`rows-columns-and-cta`](mega-menus/rows-columns-and-cta) | Click-to-open mega menu with three layouts (rows, columns, CTA card), three levels deep, mobile drill-down | Custom `Walker_Nav_Menu`, ACF, GSAP |

### Hero home

| Snippet | What it shows | Built with |
|---|---|---|
| [`slider-image-or-video`](hero-home/slider-image-or-video) | Full-height fade slider, each slide an image or video | Swiper, ACF |
| [`off-screen-slider`](hero-home/off-screen-slider) | Copy beside image cards, with the next slide peeking in from off-screen | Slick, ACF |
| [`split-slider`](hero-home/split-slider) | Split layout with two synced sliders and staggered entrance animation | Slick, ACF |
| [`pop-up-circles`](hero-home/pop-up-circles) | Video in an animated circle with CSS-only motion and image position controls | CSS keyframes, ACF |
| [`gsap-scrubbing-pinning`](hero-home/gsap-scrubbing-pinning) | Hero that pins and scrubs through slides, with stats that count up | GSAP ScrollTrigger, CounterUp |

### Logo sliders

| Snippet | What it shows | Built with |
|---|---|---|
| [`opposite-scrolling-rows`](logo-sliders/opposite-scrolling-rows) | Continuous logo marquee that splits into two rows scrolling in opposite directions | Swiper |
| [`optional-links-slider`](logo-sliders/optional-links-slider) | Logo slider where each logo can link out, or not, with custom dots | Slick, Blazy |

### Latest posts

| Snippet | What it shows | Built with |
|---|---|---|
| [`swiper-cards`](latest-posts/swiper-cards) | Post-card slider with editor-chosen query modes (latest, by category or tag, hand-picked) | `WP_Query`, ACF, Swiper |
| [`featured-plus-list`](latest-posts/featured-plus-list) | One large featured post beside a list of the next few, with the same query modes | `WP_Query`, ACF, CSS only |

### Testimonials

| Snippet | What it shows | Built with |
|---|---|---|
| [`swiper-quote-with-photo`](testimonials/swiper-quote-with-photo) | Full-width slider with a quote panel and a photo that breaks out to the page edge | Swiper, ACF |
| [`swiper-synced-avatars`](testimonials/swiper-synced-avatars) | Photo strip synced to a crossfading quote slider, with global or per-page content | Swiper `thumbs`, ACF options |
| [`slick-manual-or-cpt`](testimonials/slick-manual-or-cpt) | Carousel filled by hand or from a Testimonial post type, with recolorable SVG logos | Slick, custom post type, ACF |

### Footers

| Snippet | What it shows | Built with |
|---|---|---|
| [`multi-column`](footers/multi-column) | Branding column plus link columns from separate menus, landing-page mode | `wp_nav_menu()`, ACF |
| [`single-row`](footers/single-row) | Compact one-row footer with menu, social icons and legal links | `wp_nav_menu()`, ACF |

## How each snippet is organized

```
snippet-name/
  README.md     what it does, where to look, highlights, what it depends on
  html/         PHP templates (and helper code where relevant)
  scss/         the styles for the component, plus trimmed variables and mixins
  js/           the JavaScript, if the component needs any
  acf-json/     the ACF field definitions that drive it
```

## About these excerpts

- **They're excerpts, not runnable themes.** I trimmed each one to the pieces that make up the component, so they depend on the rest of the theme (helper classes, template parts, other SCSS partials, plugins). Each README lists what's missing.
- **Trimmed on purpose.** `// ... other imports`, `// ... other components` and `// ... other colors` mark where I left unrelated code out. I kept the reusable `$color-*` variables to show how I assign colors.
- **Names are neutralized.** I replaced client and employer names with a generic "Acme" (function prefixes, class names, font and asset names, theme headers).
- **Otherwise left as I wrote it.** Beyond the trims and renames above, the comments and structure are unchanged, apart from a handful of small fixes such as removing unused variables.
