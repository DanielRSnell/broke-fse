# Templates Directory

## Overview

This directory contains **WordPress Full Site Editing (FSE) templates**—complete page layouts that define how different types of content are displayed (homepage, single posts, archives, etc.).

Think of this as **your theme's template hierarchy**—defining the structure for every type of page WordPress serves.

---

## Philosophy

### The Problem This Solves

Traditional WordPress themes use PHP template files (`single.php`, `page.php`, `archive.php`) which:

- **Require PHP knowledge** - Can't be edited without coding
- **No visual editing** - Must edit code to change layouts
- **Hard to version control** - Templates often edited in WordPress only
- **Limited flexibility** - Difficult to create template variations

FSE templates solve this by making page layouts:
- Editable in block editor
- Syncable as HTML files
- Version controllable
- Composable from template parts and patterns

### The Solution

This directory enables **bidirectional sync** between HTML template files and WordPress FSE templates:

1. **Edit in WordPress** - Use block editor to design layouts
2. **Pull to files** - Run `npm run template:pull` to save to HTML
3. **Edit in IDE** - Edit HTML directly when needed
4. **Push to WordPress** - Run `npm run template:push` to update

**Benefits:**
- Version control for page layouts
- Edit visually (WordPress) or in code (HTML)
- Reusable template parts
- WordPress template hierarchy support

### Core Principle

**"Page layouts should be FSE templates—editable in WordPress or as HTML files, following WordPress's template hierarchy."**

---

## What Are FSE Templates?

### WordPress Template Hierarchy

WordPress uses a **template hierarchy** to determine which template displays content:

| **Template** | **Used For** | **Example URL** |
|--------------|--------------|-----------------|
| `index.html` | Fallback for all pages | Any page |
| `home.html` | Blog homepage | `/blog` |
| `front-page.html` | Static homepage | `/` |
| `single.html` | Single blog posts | `/blog/post-title` |
| `page.html` | Static pages | `/about` |
| `archive.html` | Post archives | `/category/news` |
| `404.html` | Not found errors | `/missing-page` |
| `search.html` | Search results | `/?s=query` |

**Learn more:** [WordPress Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

### Templates vs. Template Parts

| **Templates** | **Template Parts** |
|---------------|-------------------|
| Full page layouts | Global components |
| `single.html`, `page.html` | `header.html`, `footer.html` |
| One per page type | Reused across templates |
| Lives in `templates/` | Lives in `parts/` |
| Composed of template parts | Standalone components |

**Example:** `single.html` template includes `header` part, content area, `footer` part.

---

## How It Works

### Bidirectional Sync

**Pull (WordPress → HTML):**
```bash
npm run template:pull
```

What happens:
1. Fetches FSE templates from WordPress
2. Converts blocks to clean HTML
3. Saves to `src/templates/*.html`

**Push (HTML → WordPress):**
```bash
npm run template:push
```

What happens:
1. Reads HTML files from `src/templates/`
2. Converts HTML to Universal Blocks
3. Updates FSE templates in WordPress

### File Flow

```
WordPress Template Editor
    ↓ (npm run template:pull)
src/templates/single.html
    ↓ (Edit in IDE)
src/templates/single.html
    ↓ (npm run template:push)
WordPress Template Editor
```

---

## Directory Structure

### Typical Organization

```
src/templates/
├── README.md           # This file
├── index.html          # Fallback template
├── front-page.html     # Static homepage
├── home.html           # Blog homepage
├── single.html         # Single blog post
├── page.html           # Static pages
├── archive.html        # Category/tag archives
├── search.html         # Search results
└── 404.html            # Not found page
```

**Naming convention:** Must match WordPress template names exactly.

### Common Templates

**Essential (most sites):**
- `index.html` - Fallback for all pages
- `single.html` - Single blog posts
- `page.html` - Static pages

**Homepage:**
- `front-page.html` - Static homepage (if set in Settings → Reading)
- `home.html` - Blog posts page

**Archives:**
- `archive.html` - Category, tag, date archives
- `category.html` - Category archives (optional, more specific)
- `tag.html` - Tag archives (optional, more specific)
- `author.html` - Author archives (optional)

**Special:**
- `search.html` - Search results
- `404.html` - Not found errors

**Custom post types:**
- `single-project.html` - Single project
- `archive-project.html` - Projects archive

---

## Template Examples

### Single Post Template

```html
<!-- src/templates/single.html -->
<!DOCTYPE html>
<html>
<body>
    <!-- Header template part -->
    <template-part slug="header"></template-part>

    <!-- Main content -->
    <main class="section-first">
        <div class="content max-w-3xl mx-auto">
            <!-- Post title -->
            <h1 class="h1">{{ post.title }}</h1>

            <!-- Post meta template part -->
            <template-part slug="post-meta"></template-part>

            <!-- Post content -->
            <article class="prose mt-12">
                {{ post.content }}
            </article>

            <!-- Related posts (pattern or template part) -->
            <template-part slug="related-posts"></template-part>
        </div>
    </main>

    <!-- Footer template part -->
    <template-part slug="footer"></template-part>
</body>
</html>
```

### Page Template

```html
<!-- src/templates/page.html -->
<!DOCTYPE html>
<html>
<body>
    <template-part slug="header"></template-part>

    <main class="section-first">
        <div class="content">
            <!-- Page title -->
            <h1 class="h1 text-center">{{ post.title }}</h1>

            <!-- Page content (built with blocks in editor) -->
            <div class="mt-12">
                {{ post.content }}
            </div>
        </div>
    </main>

    <template-part slug="footer"></template-part>
</body>
</html>
```

### Archive Template

```html
<!-- src/templates/archive.html -->
<!DOCTYPE html>
<html>
<body>
    <template-part slug="header"></template-part>

    <main class="section-first">
        <div class="content">
            <!-- Archive title (category name, etc.) -->
            <div class="text-center mb-12">
                <h1 class="h1">{{ term.name|default('Blog Archive') }}</h1>
                {% if term.description %}
                    <p class="lead mt-4">{{ term.description }}</p>
                {% endif %}
            </div>

            <!-- Posts loop -->
            <div class="card-grid-3">
                <div loopsource="posts" loopvariable="post">
                    <article class="v-card">
                        <h2 class="h3">{{ post.title }}</h2>
                        <time class="meta">{{ post.date|date("M j, Y") }}</time>
                        <p class="body-sm mt-4">{{ post.excerpt }}</p>
                        <a href="{{ post.link }}" class="btn mt-4">Read More</a>
                    </article>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination mt-12">
                {{ pagination }}
            </div>
        </div>
    </main>

    <template-part slug="footer"></template-part>
</body>
</html>
```

### Homepage (Front Page)

```html
<!-- src/templates/front-page.html -->
<!DOCTYPE html>
<html>
<body>
    <template-part slug="header"></template-part>

    <!-- Homepage content is typically custom blocks/patterns -->
    <!-- This template just provides the structure -->
    <main>
        <!-- Content added via WordPress editor -->
        {{ post.content }}
    </main>

    <template-part slug="footer"></template-part>
</body>
</html>
```

### 404 Page

```html
<!-- src/templates/404.html -->
<!DOCTYPE html>
<html>
<body>
    <template-part slug="header"></template-part>

    <main class="section-first section-hero text-center">
        <div class="content">
            <h1 class="h1">404 - Page Not Found</h1>
            <p class="lead mt-4">Sorry, the page you're looking for doesn't exist.</p>

            <!-- Search form -->
            <form role="search" method="get" action="/" class="max-w-md mx-auto mt-8">
                <div class="flex gap-2">
                    <input type="search" name="s" placeholder="Search..." class="flex-1">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <!-- Helpful links -->
            <div class="mt-12">
                <a href="/" class="btn">Go Home</a>
                <a href="/contact" class="btn">Contact Us</a>
            </div>
        </div>
    </main>

    <template-part slug="footer"></template-part>
</body>
</html>
```

---

## Workflow

### Starting Fresh (WordPress First)

```bash
# 1. Create templates in WordPress
#    - Appearance → Editor → Templates
#    - Customize templates using block editor

# 2. Pull to HTML files
npm run template:pull

# 3. Now you have version-controlled templates
git add src/templates/
git commit -m "Add FSE templates"
```

### Starting from HTML

```bash
# 1. Create HTML files
touch src/templates/single.html
touch src/templates/page.html

# 2. Add HTML content
# (Edit files)

# 3. Push to WordPress
npm run template:push

# 4. Templates now available in WordPress
#    - Appearance → Editor → Templates
```

### Iterative Development

```bash
# Edit in WordPress
npm run template:pull
git diff src/templates/
git commit -m "Update single post layout"

# OR

# Edit HTML files
npm run template:push
# Verify in WordPress
```

---

## Structure by Project Type

### Blog / Publication Site

```
src/templates/
├── index.html          # Fallback
├── front-page.html     # Custom homepage
├── home.html           # Blog posts page
├── single.html         # Blog post
├── page.html           # Static pages
├── archive.html        # Category/tag archives
├── author.html         # Author archives
├── search.html         # Search results
└── 404.html            # Not found
```

### Business / Corporate Site

```
src/templates/
├── index.html          # Fallback
├── front-page.html     # Homepage
├── page.html           # Default page
├── page-services.html  # Custom services page template
├── page-team.html      # Custom team page template
└── 404.html            # Not found
```

### Portfolio / Agency Site

```
src/templates/
├── index.html
├── front-page.html
├── single-project.html     # Single project
├── archive-project.html    # Projects archive
├── page.html
└── 404.html
```

### E-commerce Site (WordPress + WooCommerce)

```
src/templates/
├── index.html
├── front-page.html
├── page.html
├── single-product.html     # WooCommerce product
├── archive-product.html    # Shop page
└── 404.html
```

---

## Best Practices

### 1. Use Template Parts for Reusable Components

**Good:**
```html
<!-- src/templates/single.html -->
<template-part slug="header"></template-part>
<main>...</main>
<template-part slug="footer"></template-part>
```

**Bad:**
```html
<!-- Duplicating header/footer in every template -->
<header>...long header code...</header>
<main>...</main>
<footer>...long footer code...</footer>
```

### 2. Follow WordPress Template Hierarchy

```
index.html              # Always have this fallback
single.html             # More specific for posts
page.html               # More specific for pages
single-project.html     # Most specific for project CPT
```

WordPress uses the **most specific** template available.

### 3. Keep Templates Simple

Templates should be **composition layers**—assembling template parts and defining structure.

**Good:**
```html
<template-part slug="header"></template-part>
<main class="section-first">
    <div class="content">
        {{ post.content }}
    </div>
</main>
<template-part slug="footer"></template-part>
```

**Bad:**
```html
<!-- Complex logic and styling in template -->
<header class="...">
    ...50 lines of header code...
</header>
<main class="...">
    ...100 lines of complex loops and conditions...
</main>
```

### 4. Sync Regularly

```bash
# After WordPress edits
npm run template:pull
git diff src/templates/
git commit -m "Update archive layout"

# Before HTML edits
npm run template:pull  # Get latest
# Edit files
npm run template:push  # Push back
```

### 5. Test Template Hierarchy

Verify templates load correctly:
- Homepage: Check `front-page.html` loads
- Blog page: Check `home.html` loads
- Single post: Check `single.html` loads
- Category archive: Check `archive.html` (or `category.html`) loads

---

## Advanced Patterns

### Custom Page Templates

Create page-specific templates:

```
src/templates/
├── page.html               # Default
├── page-full-width.html    # Full width (no sidebar)
├── page-landing.html       # Landing page (minimal header/footer)
└── page-contact.html       # Contact form page
```

**Assign in WordPress:**
1. Edit page
2. Sidebar → Template → Select custom template

### Conditional Content

```html
<!-- src/templates/single.html -->
<main>
    <!-- Show sidebar only on blog posts, not projects -->
    <div conditionalvisibility="true" conditionalexpression="post.post_type == 'post'" class="sidebar">
        <template-part slug="sidebar"></template-part>
    </div>

    <article class="prose">
        {{ post.content }}
    </article>
</main>
```

### Custom Post Type Templates

```html
<!-- src/templates/single-project.html -->
<main class="section-first">
    <div class="content">
        <h1 class="h1">{{ post.title }}</h1>

        <!-- Custom fields specific to projects -->
        <div class="project-meta">
            <p><strong>Client:</strong> {{ post.meta('client_name') }}</p>
            <p><strong>Year:</strong> {{ post.meta('project_year') }}</p>
            <p><strong>Services:</strong> {{ post.meta('services') }}</p>
        </div>

        <!-- Project content -->
        <div class="prose mt-12">
            {{ post.content }}
        </div>
    </div>
</main>
```

---

## Integration with Theme Workflow

### With Template Parts

```html
<!-- Templates compose parts -->
<template-part slug="header"></template-part>
<main>...</main>
<template-part slug="footer"></template-part>
```

### With Context Filters

```html
<!-- Template uses data from context -->
<div loopsource="recent_posts" loopvariable="post">
    <h3>{{ post.title }}</h3>
</div>
```

### With Patterns

```html
<!-- Insert patterns in page content -->
<main>
    {{ post.content }}  <!-- Can include patterns inserted in editor -->
</main>
```

---

## Troubleshooting

### Template Not Loading

1. Check filename matches WordPress template name
2. Verify template hierarchy (more specific templates override)
3. Clear WordPress cache
4. Check for PHP errors in template

### Changes Not Syncing

**After WordPress edits:**
```bash
npm run template:pull
git status  # See if files changed
```

**After HTML edits:**
```bash
npm run template:push
# Check WordPress editor to verify
```

### Template Parts Not Appearing

Verify template part slug matches:
```html
<!-- Must match exactly -->
<template-part slug="header"></template-part>
<!-- Not "Header" or "header.html" -->
```

---

## Commands Reference

```bash
# Pull all templates from WordPress
npm run template:pull

# Push all templates to WordPress
npm run template:push

# WP-CLI commands (manual)
cd ../../..  # Navigate to WordPress root
wp template pull <template-slug>   # Pull specific template
wp template push <template-slug>   # Push specific template
```

---

## Related Documentation

- **[src/parts/README.md](../parts/README.md)** - Template parts (header, footer)
- **[src/patterns/README.md](../patterns/README.md)** - Reusable patterns
- **[src/pages/README.md](../pages/README.md)** - Page layout patterns
- **[src/context/README.md](../context/README.md)** - Data layer
- **[CLAUDE.md](../../CLAUDE.md)** - Theme architecture
- **[WordPress Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)** - Official docs

---

**Summary:**

This directory contains **WordPress FSE templates**—full page layouts defining how different content types display. Bidirectionally synced between WordPress block editor and HTML files for version control. Follow WordPress template hierarchy for proper template selection.

The structure you choose depends on your content types and pages, but the principle remains the same: **templates define page structure, composed of template parts and patterns.**

---

**Version:** 1.0.0
**Last Updated:** 2025-01-21
