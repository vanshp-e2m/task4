ACF does not save Flexible Content as one blob. It saves each value separately in wp_postmeta.

1. Parent row = section order

page_sections → hero, text_block stats

This lets ACF know:

which sections are there

the order they are, in

which layout each row uses

Without this row have_rows('page_sections) will not work.

2. Each value has a matching field-key row

page_sections_0_hero_title  → Built Entirely From Code

_page_sections_0_hero_title → field_hero_title

The first row holds the value.

The _ row tells ACF which field definition the value belongs to so ACF knows how to process the data.

3. Repeaters work in a way

page_sections_2_stats_items → 3
as the one that was the most popular.
The 3 means the repeater has 3 rows.


Then each row is saved separately:

page_sections_2_stats_items_0_stat_name

page_sections_2_stats_items_0_stat_value