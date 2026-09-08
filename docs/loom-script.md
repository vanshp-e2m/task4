# 5-minute Loom script

Tabs to open before recording (in this order, left to right):

1. `http://wordpress-learning.local/wp-admin/`
2. VS Code on the theme folder
3. `http://wordpress-learning.local/wp-json/wp/v2/project`
4. `http://wordpress-learning.local/query-test/`

---

## 0:00 - 0:30 — What this is

**Show:** VS Code, theme root.

> "This is a custom `_s` theme called Vansh Projects, with Sass. Everything —
> the post type, the taxonomy, the ACF field config, the templates — lives in
> this theme folder and is in git. Nothing was clicked into existence in the
> admin, and nothing is hardcoded in a template."

Point at `inc/`, `acf-json/`, `template-parts/sections/`.

---

## 0:30 - 1:15 — CPT and taxonomy in code

**Show:** `inc/cpt-project.php`.

> "The `project` post type and the `project_type` taxonomy are registered here,
> on `init`, with full labels and `show_in_rest` true."

Scroll to `supports` and `show_in_rest`.

**Switch to tab 3** — the REST endpoint.

> "And because `show_in_rest` is on, the post type is a real REST resource."

Point out that `acf.page_sections` is in the payload, listing `hero`,
`text_block`, `stats` — that is the field group's own `show_in_rest`.

---

## 1:15 - 2:15 — An editor builds a page. This is the important bit.

**Show:** wp-admin → **Pages → Add New**.

- Add Section → **Hero** → type a title and subtitle
- Add Section → **Stats** → click **Add Row** twice, fill in two stats
- Drag the Stats section **above** the Hero to show reordering
- **Publish**, then **View Page**

> "Six layouts, no code. The editor picks sections, reorders them, and the
> front end follows. Adding a section never involves a developer."

---

## 2:15 - 3:00 — How it renders

**Show:** `page-templates/page-sections.php`, then
`template-parts/sections/loop.php`.

> "One `have_rows()` loop. It reads the layout name and converts it to a
> filename — `two_column` becomes `two-column.php` — so one template part per
> layout in `template-parts/sections/`. Adding a seventh layout means adding
> one file; the loop never changes."

Open `template-parts/sections/stats.php` to show `get_sub_field()` inside a
repeater.

---

## 3:00 - 3:45 — Building a page from code

**Show:** `inc/programmatic-population.php`.

> "Same content model, driven by code instead of a human. `wp_insert_post`,
> then `update_field()` with an array of layouts. Note I pass the field KEY,
> not the name — with a name, ACF can fail to resolve the field on a brand new
> post and write the values without their reference rows, which looks like an
> empty field in the admin with no error anywhere."

Point at the `stats_items` nesting — a repeater is just an array of arrays.

**Switch to wp-admin → Projects**, click **Create a project programmatically**.

> "Three sections, populated, in one request."

Then **View** it on the front end.

---

## 3:45 - 4:20 — How it is stored

**Show:** `docs/postmeta-analysis.md`.

> "Three layouts became 28 rows. ACF flattens everything and puts the position
> in the meta_key itself."

Read out the three rows:

- `page_sections` → serialised array of layout names, in order
- `page_sections_0_hero_title` → one value, index encoded in the key
- `_page_sections_0_hero_title` → the field key, which is how ACF knows the
  field's type and return format

> "A repeater's parent row stores a count; a flexible content parent row stores
> the ordered layout names. That is the only structural difference between them."

---

## 4:20 - 4:50 — Querying it

**Switch to tab 4** — the query test page. Then Query Monitor → Queries.

> "A `tax_query` and a `meta_query`, both hitting real SQL."

Point at the two SELECTs:

- tax_query → `LEFT JOIN wp_term_relationships`, and the slug already resolved
  to `term_taxonomy_id IN (4)`
- meta_query → `INNER JOIN wp_postmeta` with
  `meta_value LIKE '%s:4:"hero"%'` against the parent row

---

## 4:50 - 5:00 — Local JSON, and why it matters

**Show:** `acf-json/group_page_sections.json` in VS Code.

> "The field config is a file in the repo, not a database row. Deploy this
> theme to a fresh environment and ACF offers to sync the field group in — no
> export step, no clicking. I proved that the hard way: deleting a field group
> in wp-admin also deletes its JSON file, because ACF hooks
> `acf/delete_field_group` to remove it. Because the file was committed, one
> `git checkout` brought it back."

---

## Do NOT do on camera

- Do not delete a field group to demo sync — it deletes the JSON file too.
  If you want to show sync, delete the DB row directly instead.
- Day 2 plugins should stay deactivated (they inject a yellow box into every
  post and text into the footer).
