# Task 4 — ACF Flexible Content in Code

Build a WordPress theme with Advanced Custom Fields Flexible Content, Custom Post Types, taxonomies, and programmatic population.

## What's Here

- **vansh-projects/** — Full _s (Underscores) theme with Flexible Content setup
- **acf-json/** — Field group configuration (version controlled, survives deployment)
- **TASK_4_SUBMISSION.md** — Complete analysis and programmatic function documentation
- **inc/cpt-project.php** — CPT and taxonomy registration
- **inc/programmatic-population.php** — Create posts with Flexible Content from code
- **template-parts/sections/** — One template part per layout

## Quick Start

1. Clone this repo into `wp-content/themes/`
2. Activate the theme
3. ACF auto-syncs field config from `acf-json/`
4. Go to Projects → "Create a project programmatically"
5. Edit a Page, assign "Page with Sections" template

## Videos

**Video 1** (2.5 min): https://www.loom.com/share/3f858c4bb45243678ca76b4858e59e3d
- ACF editor, all 6 layouts, repeater, Local JSON

**Video 2** (2.5 min): https://www.loom.com/share/fa29d16c3a014a9f92a0c09b5bc641bc
- Front end rendering, programmatic creation, Query Monitor

## Key Files

- `inc/cpt-project.php` — CPT + taxonomy registration
- `inc/programmatic-population.php` — Create posts from code (reusable for Module 9 AI flows)
- `acf-json/group_page_sections.json` — Field definitions (version controlled)
- `template-parts/sections/` — Layout renderers (hero, text-block, gallery, cta, stats, two-column)

## Storage: ACF Uses Flat Postmeta

Every layout and subfield is a row in `wp_postmeta`. Parent row lists layout order. Subfields get suffixed keys like `page_sections_0_hero_title`. See `TASK_4_SUBMISSION.md` for complete analysis.

## Programmatic Population

```php
$project_id = vansh_projects_create_project( array(
    'title'        => 'My Project',
    'project_type' => 'web-design',
    'image_id'     => 123,
) );
```

This is the exact technique for AI-driven content in Module 9.

## Done When

✅ Editor builds pages with Flexible Content in wp-admin
✅ Field config survives deployment (no database exports)
✅ Programmatic function creates posts from code
✅ Front end renders sections correctly
✅ REST API exposes CPT and ACF fields

See `TASK_4_SUBMISSION.md` for full analysis and documentation.

Author: Vansh Patel | Date: September 11, 2026
