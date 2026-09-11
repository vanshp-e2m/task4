# Task 4 — ACF Flexible Content in Code

**Student:** Vansh Patel  
**Date:** September 11, 2026  
**GitHub Repo:** [task4](https://github.com/yourusername/task4)

---

## Task Completion Checklist

- ✅ **Step 1:** Generated theme at underscores.me with Sass, installed and activated
- ✅ **Step 2:** Registered CPT `project` with taxonomy `project_type` in `inc/cpt-project.php`, show_in_rest enabled
- ✅ **Step 3:** Built Flexible Content field `page_sections` with 6 layouts (hero, text_block, gallery, cta, stats, two_column), includes image subfield and repeater in stats
- ✅ **Step 4:** Set up Local JSON in `acf-json/`, field group committed to version control
- ✅ **Step 5:** Inspected postmeta storage and analyzed the structure
- ✅ **Step 6:** Wrote WP_Query with meta_query filtering projects by layout type
- ✅ **Step 7:** Built programmatic-population function that creates projects and fills Flexible Content via code
- ✅ **Step 8:** Template renders with `have_rows()` loop and template parts per layout

---

## Postmeta Analysis — How ACF Stores Flexible Content

### The Data

A project titled "Programmatically Created Project" with 3 layouts (hero, text_block, stats).

### The Storage Structure

ACF stores Flexible Content as a flat key-value system in `wp_postmeta`. Here's what lives in the database:

```
Parent Row (the layout order):
  meta_key:   page_sections
  meta_value: a:3:{i:0;s:4:"hero";i:1;s:10:"text_block";i:2;s:5:"stats";}
  Purpose:    Lists layouts in order. This one row tells ACF what to loop over.

Field Key Reference (hidden from admin):
  meta_key:   _page_sections
  meta_value: field_page_sections
  Purpose:    Points to the field definition so ACF knows the field is Flexible Content.

Layout 0 — Hero (first layout):
  meta_key:   page_sections_0_hero_title
  meta_value: Built Entirely From Code
  
  meta_key:   _page_sections_0_hero_title
  meta_value: field_hero_title

  meta_key:   page_sections_0_hero_subtitle
  meta_value: This project post and every section below were created...
  
  meta_key:   _page_sections_0_hero_subtitle
  meta_value: field_hero_subtitle

  meta_key:   page_sections_0_hero_background
  meta_value: 0

Layout 1 — Text Block (second layout):
  meta_key:   page_sections_1_text_heading
  meta_value: Why This Matters
  
  meta_key:   page_sections_1_text_content
  meta_value: <p>Anything an editor can assemble in the admin...</p>

Layout 2 — Stats (third layout, contains a repeater):
  meta_key:   page_sections_2_stats_items
  meta_value: 3  ← This is the ROW COUNT for the repeater
  
  meta_key:   page_sections_2_stats_items_0_stat_name
  meta_value: Layouts available
  
  meta_key:   page_sections_2_stats_items_0_stat_value
  meta_value: 6
  
  meta_key:   page_sections_2_stats_items_1_stat_name
  meta_value: Sections created here
  
  meta_key:   page_sections_2_stats_items_1_stat_value
  meta_value: 3
  
  meta_key:   page_sections_2_stats_items_2_stat_name
  meta_value: Clicks required
  
  meta_key:   page_sections_2_stats_items_2_stat_value
  meta_value: 0
```

### How It Works (In Your Own Words)

ACF doesn't use a separate table for Flexible Content. Instead, it flattens everything into `wp_postmeta` using a naming convention. Each layout gets an index (0, 1, 2...), and each subfield gets a suffixed key like `page_sections_0_hero_title`. The parent row `page_sections` is a serialized array that lists the layouts in order, so when you load the post, ACF reads that one row and knows exactly what to loop over. Repeaters inside layouts work the same way: the parent repeater has a count row (e.g., `page_sections_2_stats_items = 3`), and then ACF looks for `_0_`, `_1_`, `_2_` subrows. It's a flat, queryable structure that lets you filter on meta keys without touching complex nested tables.

---

## Programmatic Population Function

### Purpose

This function demonstrates the exact technique you'll reuse in Module 9 for AI-driven content generation. If you can build a post and fill its Flexible Content fields from code, you can automate it at scale.

### The Function

Located in `inc/programmatic-population.php`:

```php
function vansh_projects_create_project( $overrides = array() ) {

    $args = wp_parse_args(
        $overrides,
        array(
            'title'        => 'Programmatically Created Project',
            'project_type' => 'web-design',
            'image_id'     => 0,
        )
    );

    // STEP 1: Create the post
    $post_id = wp_insert_post(
        array(
            'post_title'   => $args['title'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'project',
        ),
        true
    );

    if ( is_wp_error( $post_id ) ) {
        return $post_id;
    }

    // STEP 2: Assign taxonomy
    if ( ! empty( $args['project_type'] ) ) {
        wp_set_object_terms( $post_id, $args['project_type'], 'project_type', false );
    }

    // STEP 3: Build Flexible Content array
    $sections = array(
        array(
            'acf_fc_layout'   => 'hero',
            'hero_title'      => 'Built Entirely From Code',
            'hero_subtitle'   => 'This project was created by a PHP function...',
            'hero_background' => $args['image_id'],
        ),
        array(
            'acf_fc_layout' => 'text_block',
            'text_heading'  => 'Why This Matters',
            'text_content'  => '<p>Anything an editor can assemble...</p>',
        ),
        array(
            'acf_fc_layout' => 'stats',
            'stats_items'   => array(
                array( 'stat_name' => 'Layouts available', 'stat_value' => '6' ),
                array( 'stat_name' => 'Sections created', 'stat_value' => '3' ),
                array( 'stat_name' => 'Clicks required', 'stat_value' => '0' ),
            ),
        ),
    );

    // STEP 4: Write to database using ACF
    // KEY DETAIL: Use field KEY, not name. Ensures proper _fieldkey rows.
    update_field( 'field_page_sections', $sections, $post_id );

    return $post_id;
}
```

### How to Use It

```php
// Create a project with defaults
$project_id = vansh_projects_create_project();

// Create a project with custom values
$project_id = vansh_projects_create_project( array(
    'title'        => 'My AI-Generated Project',
    'project_type' => 'mobile-app',
    'image_id'     => 123,
) );
```

### Key Details

1. **Use field KEY, not name:** `update_field( 'field_page_sections', ... )` not `update_field( 'page_sections', ... )`. On a fresh post, ACF can't resolve the name reliably.

2. **Flexible Content is an array of rows:** Each row is an array with `'acf_fc_layout'` key naming the layout, then the subfield keys.

3. **Repeaters nest naturally:** Inside a layout, a repeater is just an array of arrays.

4. **Everything goes to postmeta:** No separate table. Same rows an editor creates in wp-admin.

---

## How to Trigger (Admin Only)

A button appears on the Projects list table. Click "Create a project programmatically" and a new project is created with 3 sample layouts. The function is guarded by:
- Capability check (`manage_options`)
- Nonce validation
- Admin-only trigger URL

---

## REST API Verification

Test that the CPT and ACF fields are accessible via REST:

```bash
# Get all projects
curl http://wordpress-learning.local/wp-json/wp/v2/project

# Get one project with its ACF fields
curl http://wordpress-learning.local/wp-json/wp/v2/project/139
```

Response includes `acf` object with `page_sections` array containing all layouts and subfields.

---

## Files Submitted

```
vansh-projects/              (theme root)
├── acf-json/
│   └── group_page_sections.json    ← Field group config (version controlled)
├── inc/
│   ├── cpt-project.php             ← CPT + taxonomy registration
│   ├── programmatic-population.php ← Creates projects from code
│   ├── query-examples.php          ← WP_Query examples
│   └── template-functions.php
├── template-parts/
│   └── sections/                   ← One template part per layout
│       ├── hero.php
│       ├── text-block.php
│       ├── gallery.php
│       ├── cta.php
│       ├── stats.php
│       └── two-column.php
├── page-templates/
│   └── page-sections.php           ← Assigns page template
└── functions.php                   ← Loads all the above
```

---

## Video Demonstration

**Video 1:** [Loom Link 1](https://www.loom.com/share/3f858c4bb45243678ca76b4858e59e3d)
- Shows the Flexible Content editor in wp-admin
- Demonstrates all 6 layouts and their fields
- Shows the repeater inside stats layout

**Video 2:** [Loom Link 2](https://www.loom.com/share/fa29d16c3a014a9f92a0c09b5bc641bc)
- Shows the front end rendering sections correctly
- Demonstrates the programmatic-population function creating a project
- Shows the project rendering on the front end

---

## Done When

✅ An editor can build a page using Flexible Content layouts in wp-admin  
✅ Field configuration survives version control (acf-json/)  
✅ Field config survives deployment to a fresh environment (no database exports needed)  
✅ Programmatic function can create posts with Flexible Content via code  
✅ Same data structure whether created by editor or by code  
✅ REST API exposes the CPT and ACF fields  

---

## How to Deploy This

1. **Clone the theme** from your repo
2. **ACF auto-syncs from JSON:** Place `acf-json/group_page_sections.json` in the theme
3. **CPT and taxonomy register on init:** No manual setup needed
4. **Edit a page, assign "Page with Sections" template, add sections** — everything works

No database exports. No field-by-field recreation. Version control handles it all.
