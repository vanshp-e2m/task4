# 5-Minute Video Guide — Project Content Model

Read this while recording. Legend:

- **[GO]** — where to navigate
- **[SHOW]** — what must be visible on screen
- **[SAY]** — narration, roughly word for word
- **[DO]** — the only things you actually click live

Approach: everything is already built. You are giving a tour, not a tutorial.
There is exactly **one** live action, in Segment 3, and it exists because the
brief's acceptance criterion is about the editor experience — a reviewer cannot
verify that from a finished page alone.

---

## Before you hit record

**Tabs, left to right:**

| # | URL |
|---|---|
| 1 | `http://wordpress-learning.local/wp-admin/` |
| 2 | VS Code, theme folder open |
| 3 | `http://wordpress-learning.local/wp-json/wp/v2/project` |
| 4 | `http://wordpress-learning.local/accusamus-nobis-dignissimos-eum-reiciendis/` |
| 5 | `http://wordpress-learning.local/project/programmatically-created-project/` |
| 6 | `http://wordpress-learning.local/query-test/` |

y Okay, now let's see the query monitor Part here, here we can go to the database queries and we can actually see, the database queries and we can Actually see, the project and the pages which, we had, inserted into the project. Here Project and the pages which, We had, inserted into the project. Here we can see that the project type and It's a web design, and, this slug is the web design, like, like, what we have inserted, so it's working properly, and here The web design, like, like, what We have inserted, so it's working properly, and here it's published, like, and then, now it's, page And there are now it's a page sections, which we have also inserted into the, so in the database query, it's showing like, so it means the projects works So in the database query, it's showing like, so it means the projects works completely fine. And, last thing I want to show is the...

- [ ] Day 2 plugins deactivated (`vansh-day2`, `vansh-day2-addon`) — they inject
      a yellow box into every post and text into the footer
- [ ] Query Monitor active
- [ ] VS Code font size up two steps; sidebar showing the theme tree
- [ ] Close unrelated tabs and notifications
- [ ] Optional: rename page #30 from the FakerPress lorem title to something
      readable like "Services" — it appears on screen twice

**Content you will point at (already exists, do not rebuild):**

| What | Where | Layouts |
|---|---|---|
| Editor-built page #30 | tab 4 | hero, text_block, gallery, cta |
| Code-built project #139 | tab 5 | hero, text_block, stats |
| Query test page #140 | tab 6 | two shortcodes |

---

## Segment 1 — 0:00–0:30 — Framing

**[GO]** Tab 2, VS Code, theme root visible.

**[SHOW]** The folder tree: `inc/`, `acf-json/`, `template-parts/sections/`,
`page-templates/`, `sass/`.

**[SAY]**
> "This is a custom underscores theme with Sass, called Vansh Projects.
> The whole content model lives in this folder and is committed to git — the
> post type, the taxonomy, the field configuration, and the templates.
> Nothing here was clicked into existence in the admin, and no content is
> hardcoded in a template. That's the point of the exercise, so that's what
> I'll walk through."

---

## Segment 2 — 0:30–1:10 — Post type and taxonomy in code

**[GO]** Tab 2, open `inc/cpt-project.php`.

**[SHOW]** Scroll slowly. Pause on the `$args` array.

**[SAY]**
> "The project post type and the project_type taxonomy are registered here,
> both on the init hook, because that's the point where WordPress is fully
> loaded but hasn't handled the request yet. Full labels, supports title,
> editor, thumbnail and excerpt — and show_in_rest is true, which does two
> things: it gives me the block editor, and it exposes the post type over the
> REST API."

**[GO]** Tab 3, the REST endpoint.

**[SHOW]** The JSON. Search the page for `acf`.

**[SAY]**
> "And there it is as a live REST resource. Notice this acf key — that's the
> field group's own Show in REST setting, so the flexible content comes through
> as structured data: hero, text_block, stats, in order. That matters for
> anything headless or AI-driven later."

---

## Segment 3 — 1:10–2:10 — The editor experience (THE LIVE BIT)

> This is the segment the brief is actually graded on:
> *"an editor can build a page out of your layouts in wp-admin with nothing
> hardcoded."* Do it live. It takes 40 seconds.

**[GO]** Tab 1, then **Pages**, open page **#30**.

**[SHOW]** Scroll to the **Page Sections** metabox. Four collapsed sections:
Hero, Text Block, Gallery, CTA.

**[SAY]**
> "Here's a page an editor built. Four sections, stacked in order."

**[DO]** Click one section header to expand it.

**[SAY]**
> "Each one is just fields. The Gallery layout has a repeater inside it, so an
> editor can add as many images as they want without anyone touching code."

**[DO]** — the live proof, in this order:

1. Click **+ Add Section**, choose **Stats**
2. Click **Add Row**, type `Projects delivered` / `42`
3. Click **Add Row** again, type `Happy clients` / `12`
4. **Drag the Stats section above the CTA** using the handle
5. Click **Update**

**[SAY]** while doing it:
> "Six layouts to choose from — hero, text block, gallery, CTA, stats, two
> column. I add a stats section, add two repeater rows, and drag it into
> position. No developer involved, and I'm not touching a template."

**[GO]** Tab 4, then **reload**.

**[SHOW]** The new stats section rendering in its new position.

**[SAY]**
> "And the front end follows."

---

## Segment 4 — 2:10–2:50 — How rendering works

**[GO]** Tab 2, open `page-templates/page-sections.php`.

**[SAY]**
> "The page template is almost empty — it checks have_rows and hands off."

**[GO]** Open `template-parts/sections/loop.php`.

**[SHOW]** The `str_replace` line and `get_template_part`.

**[SAY]**
> "This is the whole rendering engine. One have_rows loop, get_row_layout to
> find out which layout this row is, convert the underscore to a hyphen — so
> two_column becomes two-column dot php — and load that template part. Adding
> a seventh layout means adding one file. The loop never changes."

**[GO]** Open `template-parts/sections/stats.php`.

**[SAY]**
> "And each part is small. get_sub_field inside a have_rows loop for the
> repeater. Six of these, one per layout."

**[SAY]** (worth adding, shows judgement)
> "The loop lives in its own file because single-project.php uses it too —
> a page template can never apply to a custom post type, so projects needed
> their own template, but they share this one loop."

---

## Segment 5 — 2:50–3:35 — Building a page from code

**[GO]** Tab 2, open `inc/programmatic-population.php`.

**[SHOW]** The `$sections` array, then the `update_field` line.

**[SAY]**
> "Same content model, driven by code instead of a person. wp_insert_post to
> create the project, then update_field with an array of layouts. Each row's
> acf_fc_layout key names the layout, the rest are the sub-field names. The
> stats layout has a nested repeater — that's just an array of arrays."

**[SHOW]** Highlight `update_field( 'field_page_sections', ... )`.

**[SAY]** — say this bit, it's the strongest thing in the video:
> "One detail worth calling out: I pass the field key here, not the field name.
> If you pass a name, ACF has to work out which field you mean from the field
> groups that apply to that post, and on a post created a moment ago that
> lookup can fail. When it fails it still writes the values, but without their
> reference rows — so the data is in the database, the admin shows an empty
> field, and nothing errors anywhere. Using the key skips the lookup."

**[GO]** Tab 1, then **Projects**, then **All Projects**.

**[SHOW]** The "Create a project programmatically" button.

**[SAY]**
> "This button calls that function. It's nonce-guarded, since it changes state."

**[GO]** Tab 5, the already-created project.

**[SAY]**
> "And here's one it made earlier — hero, text block, and a stats section with
> three repeater rows. Rendered through single-project.php, using the same loop
> as the page."

---

## Segment 6 — 3:35–4:15 — How it's stored

**[GO]** Tab 2, open `docs/postmeta-analysis.md`.

**[SAY]**
> "I mapped what this actually writes to the database. Those three layouts
> produced twenty-eight rows. ACF doesn't store flexible content as one blob —
> it flattens everything into individual postmeta rows and encodes the position
> in the meta key itself."

**[SHOW]** The three-row section. Read them out:

> "The parent row, page_sections, is a serialised array of the layout names
> in order — that's the only thing recording how many sections exist and in
> what order.
>
> Then each value: page_sections_0_hero_title. Read it backwards — the
> hero_title subfield, in row zero, of page_sections.
>
> And every value row is paired with an underscore-prefixed row holding the
> field key. That pairing is how ACF maps a raw database value back to its
> definition, so it knows the type and the return format. It's why my image
> fields store an attachment ID but hand me back a URL."

**[SAY]** to close the segment:
> "One nice detail: a repeater's parent row stores an integer count, where a
> flexible content parent row stores the ordered layout names. That's the only
> structural difference between the two field types at the database level."

---

## Segment 7 — 4:15–4:45 — Querying it

**[GO]** Tab 6, the query test page.

**[SHOW]** The two result blocks.

**[SAY]**
> "Two WP_Query examples, exposed as shortcodes so they run on a real request.
> One filters projects by taxonomy term, the other finds projects that contain
> a hero section."

**[DO]** Admin toolbar, then **Query Monitor**, then **Queries**, filter `wp_posts`.

**[SHOW]** The two SELECT statements.

**[SAY]**
> "And here's the SQL. The tax query joins term_relationships — and notice the
> slug is gone: WordPress resolved web-design to term_taxonomy_id 4 before
> the query even ran, so it's filtering on an integer.
>
> The meta query is an inner join on postmeta with a LIKE against that parent
> row I just described — looking for the serialised fragment for hero. That's
> a deliberate choice: you can't query a subfield by name, because there is no
> hero_title key, only page_sections_0_hero_title with the index baked in.
> So I query the parent row instead."

---

## Segment 8 — 4:45–5:00 — Local JSON, and the close

**[GO]** Tab 2, open `acf-json/group_page_sections.json`.

**[SAY]**
> "Last thing. The entire field configuration is this file, in the repo — not a
> row in my local database. Deploy this theme to a fresh environment and ACF
> offers to sync the field group straight in. No export step, no clicking.
>
> I learned that the hard way: deleting a field group in wp-admin also deletes
> its JSON file, because ACF hooks the delete action to remove it. Both copies
> gone in one click. It was committed, so one git checkout brought it back —
> which is exactly the argument for Local JSON in the first place."

**[SAY]** to finish:
> "So: post type and taxonomy in code, six flexible layouts an editor can
> assemble freely, the same model buildable from code, field config that
> deploys, and nothing hardcoded in a template. That's the lot."

---

## Do NOT do on camera

- **Do not delete a field group to demo the sync.** It deletes the JSON file
  too. If you want to show sync, delete the database row directly instead.
- Do not reactivate the Day 2 plugins.
- Do not open the trashed post 109 — orphaned rows from an earlier structure.

## If you overrun

Cut in this order: Segment 4 down to 20 seconds, then Segment 7's SQL detail.
**Never cut Segment 3.** It is the acceptance criterion.

## If a reviewer asks

**"Why is the loop in a separate file?"**
Page templates can't apply to a custom post type, so projects need their own
template. Both call the same loop rather than duplicating it.

**"Why LIKE on a serialised value? Isn't that fragile?"**
It is, and it's the tradeoff of flexible content. There's no indexed way to ask
"does this post contain a hero section" because the layout list only exists as
a serialised array. For anything performance-critical I'd write a flat helper
meta field on save_post and query that instead.

**"What happens if you reorder sections?"**
The parent row's array order changes and the row indexes in every meta key are
rewritten, since the index is part of the key.
