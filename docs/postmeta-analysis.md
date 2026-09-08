# Task 5 — How ACF Flexible Content is stored in `wp_postmeta`

Source: post **139**, "Programmatically Created Project", created by
`vansh_projects_create_project()` in `inc/programmatic-population.php`.
Three layouts (`hero`, `text_block`, `stats`) produced **28 rows**.

## In my own words

ACF does not store the Flexible Content field as one blob. It flattens the whole
structure into individual `wp_postmeta` rows and encodes the position of each value
*in the meta_key itself*, using the pattern `{field}_{rowIndex}_{subfield}`. One
parent row holds an ordered array of layout names, which is the only thing that
records how many sections exist and in what order. Every value row is then paired
with a second row of the same name prefixed with an underscore, whose value is the
ACF **field key** — that pairing is what lets ACF map a raw database value back to
its field definition so it knows the field's type and return format.

## The three rows the brief asks for

### 1. The parent layout-order row

```
meta_id 492 | page_sections  | a:3:{i:0;s:4:"hero";i:1;s:10:"text_block";i:2;s:5:"stats";}
meta_id 493 | _page_sections | field_page_sections
```

A serialised PHP array: index → layout name, in display order. This single row is
the section list. Reorder sections in the admin and only this row's contents change —
the value rows keep their indexes. Delete this row and the post renders nothing,
even though all the content rows still exist, because `have_rows()` has no list to
iterate.

### 2. A subfield value row + its `_fieldkey` pair

```
meta_id 467 | page_sections_0_hero_title  | Built Entirely From Code
meta_id 468 | _page_sections_0_hero_title | field_hero_title
```

Read the key right to left: subfield `hero_title`, in row `0` (the first layout),
of the field `page_sections`. The `0` is why moving a section around rewrites keys.

The underscore row is the important half. `field_hero_title` points at the field
definition in the field group, so ACF knows this is a `text` field. On the image
subfield the same mechanism is what makes `return_format: url` work —
`page_sections_0_hero_background` stores the raw attachment ID (`0` here, no image),
and ACF converts it to a URL on read *because* the paired row told it which field
definition to consult. Delete the `_` rows and `get_field()` degrades to raw values.

### 3. The nested repeater

`stats_items` is a repeater inside the `stats` layout, so the naming just nests again:

```
meta_id 489 | page_sections_2_stats_items                | 3          <- row COUNT
meta_id 490 | _page_sections_2_stats_items               | field_stats_items
meta_id 477 | page_sections_2_stats_items_0_stat_name    | Layouts available
meta_id 478 | _page_sections_2_stats_items_0_stat_name   | field_stat_name
meta_id 479 | page_sections_2_stats_items_0_stat_value   | 6
...
meta_id 487 | page_sections_2_stats_items_2_stat_value   | 0
```

A repeater's parent row stores an **integer count** (`3`), where a Flexible Content
parent row stores a **serialised array of layout names**. That is the one structural
difference between the two field types at the database level.

## Other rows

```
meta_id 491 | _page_sections_layout_meta | a:2:{s:8:"disabled";a:0:{}s:7:"renamed";a:0:{}}
```

ACF 6.x bookkeeping for layouts that have been disabled or renamed. Empty here.

## Consequences worth remembering

- **Every value costs two rows.** 3 layouts → 28 rows. A page with 15 sections is
  several hundred rows, all fetched by one `get_post_meta()` call.
- **You cannot query a subfield by name.** There is no `hero_title` key — only
  `page_sections_0_hero_title`. A `meta_query` has to target an exact index, which
  is why `inc/query-examples.php` instead runs a `LIKE` against the serialised
  parent row to ask "does this post contain a hero section?".
- **Writing with the field name instead of the key is the classic bug.** If ACF
  cannot resolve the name it writes the value rows without the `_` pair rows. The
  data is in the database, the admin shows an empty field, and nothing errors.

## Note on post 109

Post 109 ("AI Generated Project") has keys like `hero_section_hero_title` with a
`hero_section` parent whose value is empty. There is no `page_sections` row at all,
so `have_rows( 'page_sections' )` returns false and the post renders nothing. These
are orphaned rows from an earlier attempt where the sections were separate group
fields rather than Flexible Content layouts. Safe to delete the post.
