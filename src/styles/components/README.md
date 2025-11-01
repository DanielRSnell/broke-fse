# Components Layer Directory

## Overview

This directory contains **component layer CSS**—reusable component classes that form your design system's building blocks.

Think of this as **your component library**—buttons, cards, typography, layouts extracted from repeated patterns.

---

## Philosophy

Components are extracted when:

1. **Pattern repeats 3+ times** - Same HTML structure used multiple times
2. **Semantic meaning** - `.btn` is clearer than `.px-4 py-2 rounded-lg bg-primary`
3. **Team velocity** - Faster to use `.card` than rebuild utilities each time

### Core Principle

**"Extract components from utilities when patterns repeat, not before."**

---

## Core Framework Files

These files are part of the framework and should remain:

### `typography.css` - Text Component Classes

Semantic text classes for headings, paragraphs, labels:

```css
.h1 { font-size: var(--text-5xl); font-weight: 900; }
.h2 { font-size: var(--text-3xl); font-weight: 700; }
.lead { font-size: var(--text-lg); line-height: 1.6; }
.body { font-size: var(--text-base); }
```

**Why keep:** Every project needs typography components.

### `buttons.css` - Button Component Classes

Button variants with states:

```css
.btn {
  display: inline-flex;
  padding: 0.75rem 1.5rem;
  border-radius: 9999px;
  transition: all 200ms;
}

.btn-primary {
  background: var(--color-primary);
  color: white;
}
```

**Why keep:** Buttons are universal across projects.

### `cards.css` - Card Layout Components

Vertical and horizontal card layouts:

```css
.v-card {
  display: flex;
  flex-direction: column;
  padding: 1.5rem;
  background: var(--color-card);
  border-radius: 1rem;
}
```

**Why keep:** Cards are common UI patterns.

### `layout.css` - Layout Utilities

Content containers and section spacing:

```css
.content {
  max-width: var(--container-3xl);
  margin: 0 auto;
  padding: 0 2rem;
}

.section {
  padding: 3rem 0;
}
```

**Why keep:** Every site needs layout utilities.

---

## Project-Specific Files

These can be removed or customized per project:

- `badges.css` - Badge components (`.badge`)
- `carousel.css` - Legacy carousel styles
- `css-carousel.css` - Pure CSS carousel
- `forms.css` - Form components
- `gradients.css` - Gradient utilities
- `navigation.css` - Header/footer navigation
- `patterns.css` - Background patterns
- `syntax-highlighting.css` - Code syntax highlighting
- `utilities.css` - Custom utility classes

**Why remove:** These are specific to certain project types.

---

## Creating New Components

### Step 1: Identify the Pattern

If you're using this HTML 3+ times:

```html
<div class="flex items-center gap-4 p-6 bg-white rounded-lg shadow">
  <img src="..." class="w-16 h-16 rounded-full">
  <div>
    <h3 class="text-lg font-bold">Title</h3>
  </div>
</div>
```

### Step 2: Extract to Component

Create `components/profile-card.css`:

```css
@layer components {
  .profile-card {
    @apply flex items-center gap-4 p-6 bg-white rounded-lg shadow;
  }

  .profile-card__avatar {
    @apply w-16 h-16 rounded-full;
  }

  .profile-card__title {
    @apply text-lg font-bold;
  }
}
```

### Step 3: Import in `tailwind.css`

```css
@import './components/profile-card.css' layer(components);
```

### Step 4: Use the Component

```html
<div class="profile-card">
  <img src="..." class="profile-card__avatar">
  <div>
    <h3 class="profile-card__title">Title</h3>
  </div>
</div>
```

---

## Component Naming

### BEM-Style Naming

```css
.component { }              /* Block */
.component__element { }     /* Element */
.component--modifier { }    /* Modifier */
```

**Example:**

```css
.card { }                   /* Base component */
.card__header { }           /* Child element */
.card__body { }             /* Child element */
.card--featured { }         /* Variant */
```

### Utility-Based Naming

```css
.btn { }
.btn-primary { }
.btn-lg { }
.btn-sm { }
```

**Choose the style that fits your team.**

---

## Best Practices

### 1. Use @apply for Utilities

**Good:**
```css
.btn {
  @apply px-4 py-2 rounded-lg bg-primary text-white;
}
```

**Also good:**
```css
.btn {
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  background: var(--color-primary);
  color: white;
}
```

### 2. Reference Theme Variables

**Good:**
```css
.card {
  background: var(--color-card);
  border: 1px solid var(--color-border);
}
```

**Bad:**
```css
.card {
  background: #ffffff;  /* Hard-coded */
  border: 1px solid #e5e7eb;
}
```

### 3. Mobile-First Responsive

```css
.grid {
  grid-template-columns: 1fr;  /* Mobile */
}

@media (min-width: 768px) {
  .grid {
    grid-template-columns: repeat(2, 1fr);  /* Tablet */
  }
}
```

### 4. Keep Components Focused

One component per file:
```
components/
├── buttons.css        # Just buttons
├── cards.css          # Just cards
├── forms.css          # Just forms
```

### 5. Document Complex Components

```css
/**
 * Dropdown Component
 *
 * Requires Alpine.js for interactivity.
 *
 * Usage:
 * <div x-data="{ open: false }" class="dropdown">
 *   <button @click="open = !open" class="dropdown__trigger">Toggle</button>
 *   <div x-show="open" class="dropdown__menu">...</div>
 * </div>
 */
.dropdown {
  position: relative;
}
```

---

## Component Examples

### Minimal Button

```css
@layer components {
  .btn {
    @apply inline-flex items-center gap-2;
    @apply px-4 py-2 rounded-full;
    @apply font-medium text-sm;
    @apply transition-all duration-200;
  }

  .btn-primary {
    @apply bg-primary text-white;
  }

  .btn-primary:hover {
    @apply bg-primary-600;
  }
}
```

### Minimal Card

```css
@layer components {
  .card {
    @apply p-6 rounded-lg;
    @apply bg-white shadow;
  }

  .card-hover {
    @apply transition-shadow duration-200;
  }

  .card-hover:hover {
    @apply shadow-lg;
  }
}
```

---

## When to Extract Components

### Extract:
- Used 3+ times across the site
- Has semantic meaning (`.btn`, `.card`, `.nav`)
- Team velocity benefit

### Don't Extract:
- Used once or twice (keep as utilities)
- No clear semantic meaning
- Utilities are already clear enough

---

## Integration with Utilities

Components and utilities work together:

```html
<!-- Component provides base, utilities override -->
<button class="btn btn-primary px-8 py-4">
  Custom Size
</button>

<!-- Utility classes (higher layer) override component padding -->
```

---

**Summary:**

This directory contains **component layer CSS**—reusable classes extracted from repeated patterns. Core framework files (typography, buttons, cards, layout) should remain. Project-specific files can be customized or removed. Extract components when patterns repeat 3+ times.

**Core files to keep:**
- `typography.css`
- `buttons.css`
- `cards.css`
- `layout.css`

**Files to customize per project:**
- Everything else

---

**Version:** 1.0.0
**Last Updated:** 2025-01-21
