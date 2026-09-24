# AJAX: Multi-Step Form Saved to a Custom Post Type

A multi-step form where every step saves itself to WordPress through `admin-ajax.php`. The first step creates a post in a private "Assessment" post type, and each later step updates that same post's ACF fields, so an entry is recorded as the visitor moves through the form, not only at the end. Progress is kept in `localStorage`, so a visitor who reloads or comes back later picks up where they left off.

## What it does

- A **shortcode** (`[custom_assessment_form]`) drops the form onto any page.
- **Step 1** collects a name and email. On "Get Started" it creates an `assessment` post titled with the visitor's name and stores the new post ID in the browser.
- **Steps 2 and 3** each send their data to their own AJAX action, which updates the same post (`last_step`, then `property_type`).
- **Back** returns to the previous step, and a **restart** link opens a confirm popup that clears the saved progress.
- A **progress bar** fills in as steps are completed.
- **Validation** runs before any request: a missing required field shows an inline error under it. The same function also range-checks years and dates for the later steps.
- **No duplicate saves:** on steps 1 and 3, when a visitor goes back, edits nothing and continues, the form moves forward without another request.
- **Resume:** on page load the saved step is shown, the progress bar is filled to it, and earlier answers are filled back into the fields.
- In the dashboard, the post type's list gets a sortable **Last Step** column and a **filter by last step** dropdown, to see where visitors drop off.

## Where to look

| If you want to see... | Open |
|---|---|
| The form markup (progress bar, restart popup, steps 1 to 3) | [`html/assessment-form.php`](html/assessment-form.php) |
| The AJAX handlers that create and update the post | [`html/functions-ajax-post.php`](html/functions-ajax-post.php) |
| Passing the AJAX URL to the script (`wp_localize_script`) | [`html/functions.php`](html/functions.php) |
| The shortcode | [`html/functions-custom.php`](html/functions-custom.php) |
| The post type, plus the admin column, sorting and filter | [`html/functions-cpt.php`](html/functions-cpt.php) |
| Step navigation, validation, `localStorage` and the `fetch` requests | [`js/main.js`](js/main.js) |
| The post type's ACF fields | [`acf-json/group_6476015dd3b90.json`](acf-json/group_6476015dd3b90.json) |
| Form, button, popup and page-transition styles | [`scss/_general-form.scss`](scss/_general-form.scss) |
| The progress bar | [`scss/_progress-bar.scss`](scss/_progress-bar.scss) |
| Per-step layout | [`scss/_step-1.scss`](scss/_step-1.scss), [`scss/_step-2.scss`](scss/_step-2.scss), [`scss/_step-3.scss`](scss/_step-3.scss) |
| Variables, breakpoints and mixins | [`scss/_variables.scss`](scss/_variables.scss), [`scss/_mixins.scss`](scss/_mixins.scss) |

## Stack

WordPress (Astra child theme) · PHP (`admin-ajax.php`, `wp_insert_post`) · Advanced Custom Fields Pro · SCSS · vanilla JavaScript (`fetch`, `FormData`, `localStorage`) · Swiper · Fancybox

## Highlights

- **Create once, then update.** The step 1 handler calls `wp_insert_post()` when no post ID is sent and returns the new ID with a `200` status. The script saves it, and every later request sends it back, so the same post is updated with `update_field()` and the handler answers `201`.
- **One request helper.** `sendAjaxRequestPost( action, data )` builds a `FormData` object from the step's data plus the saved post ID, posts it to the AJAX URL, and handles the create, update and error responses in one place.
- **Standard WordPress AJAX wiring.** Each step has its own action, registered with both `wp_ajax_` and `wp_ajax_nopriv_` so it works for logged-out visitors. Inputs go through `sanitize_text_field()`, and responses use `wp_send_json_success()` and `wp_send_json_error()`.
- **Browser state kept separate from the server.** `localStorage` holds the current step, substep, post ID and a copy of the answers. `checkFieldChanges()` compares new input against that copy to skip requests when nothing changed.
- **Private post type with admin tools.** The `assessment` post type is shown in the dashboard but isn't public. `manage_{post_type}_posts_columns`, `pre_get_posts`, `restrict_manage_posts` and `parse_query` add a sortable, filterable Last Step column.
- **Pages without page loads.** Every step is in the markup from the start, and switching the `active` class crossfades between them.

## Notes

This is an excerpt from a larger theme, trimmed to the first three steps of the form. It won't run standalone. It depends on things not included here:

- The Astra parent theme, ACF Pro, and Swiper and Fancybox (loaded from a CDN at the bottom of the template)
- The images referenced in the template and SCSS (logo, report samples, icons)
- The later steps (`<!-- ... -->` and `// ...` markers): residential and commercial property details with address autocomplete and property data lookups, neighborhood sales, results, payment, and re-sending a report by email. The step 3 "Continue" button leads into those substeps, and restarting also clears a server-side session in the full version.
- `html/functions.php` is trimmed to the enqueue and includes, `functions-ajax-post.php` to the step 1 to 3 handlers, `functions-custom.php` to the form shortcode, and the ACF group to the fields those steps save.
- `_variables.scss` keeps the full color list, plus the one breakpoint these styles use.

Names have been neutralized ("Acme" image alt, `acme_` prefix, `component-` classes).
