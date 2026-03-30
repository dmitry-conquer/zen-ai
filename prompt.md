# Prompts

---

## 1. Static layout
> Use at the beginning of every new session before writing any HTML.
> **Run `/frontend-design` first, then paste this prompt.**

```
Your task is to build a complete, production-ready static website layout based on the provided content, images, and design references.

Ignore the `wp-theme/` directory entirely — it is not relevant at this stage.

Before writing any code, read the following in order:
1. CLAUDE.md — stack, fonts, colors overview
2. .claude/rules/ — all rules files (workflow, layout, scripts, accessibility, seo, sources)
3. content/homepage.md — read ## Project first (client, business, tone), then ## Brief, then all sections
4. Determine scope: collect all ## [section-id] headings from content files, exclude (Project, Brief, meta, header, footer), then list files in components/ — what exists is already built, the rest is pending. Also check components/header.html and components/footer.html — if either is an empty stub, add it to the pending list explicitly.
5. public/images/ — list available image files
6. design-examples/ — visually analyze all images to derive color palette, layout patterns, and visual style
7. src/styles/main.css — check if Google Fonts @import is already on line 1

Then confirm back before touching any file:
- Client and site goal (from content/homepage.md → ## Project)
- Scope: built sections vs pending sections
- Section order: id, background, what it contains
- Images available in public/images/ vs missing (will use placeholder)
- Tailwind color shades chosen for primary, accent, surface
- Font(s) to use and whether the @import is already in main.css

Do not write any code until I explicitly confirm your summary.
```

---

## 2. ACF / WordPress integration
> Use at the beginning of every new session before writing any PHP or ACF JSON.

```
Your task is to convert the approved static layout into an ACF Flexible Content WordPress theme.

Then read the following in order:
1. wp-theme/CLAUDE.md — theme config, helpers, nav menus, static rules reference
2. wp-theme/.claude/rules/ — all rules files (wp-workflow, acf-fields, acf-json, php-patterns)
3. content/homepage.md — read ## Project first (client, business, tone), then all sections
4. Determine scope:
   - Flexible sections: collect all ## [section-id] headings from content files, exclude (Project, Brief, meta, header, footer), compare with wp-theme/template-parts/flexible/ — what exists is implemented, the rest is pending
   - Header/footer: check if components/header.html and components/footer.html are non-empty — if empty stubs, mark as **pending (blocker)** and do not proceed with WP migration until they are built in the static project
5. components/ — for each pending section, confirm the static component file exists and is non-empty

Then confirm back before touching any file:
- Client and site goal (from content/homepage.md → ## Project)
- Flexible sections: implemented vs pending
- Header/footer status: ready to convert or pending (static not built yet)
- For each pending section: fields to create and their ACF types

Do not write any code until I explicitly confirm your summary.
```

---

## 3. Content import
> Use at the beginning of every new session before importing content into WordPress.

```
Read `content/`, `public/images/` and `wp-theme/acf-json/group_flexible_content.json`.
Upload images to WP Media Library, create pages with template `templates/flexible.php` and fill
ACF Flexible Content fields from content files.

**WP site:** [URL]
**WP user:** [username]
**App Password:** [password]
**Theme active:** yes

Use WP-CLI via Local WP PHP + MySQL socket. Figure out everything needed on your own.
```