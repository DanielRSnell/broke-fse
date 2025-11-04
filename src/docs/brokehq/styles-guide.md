# BrokeHQ Style Guide

**Version:** 1.0.0
**Last Updated:** 2025-11-04
**Purpose:** Design system specification for BrokeHQ project management interface

This document extracts all design tokens from the Linear-inspired design concept and provides implementation guidelines for translating them into the theme's architecture (theme.json → colors.css → Tailwind CSS).

---

## Table of Contents

1. [Design Philosophy](#design-philosophy)
2. [Color Palette](#color-palette)
3. [Typography](#typography)
4. [Spacing & Layout](#spacing--layout)
5. [Components](#components)
6. [Animations](#animations)
7. [Icons & Imagery](#icons--imagery)
8. [BrokeHQ Feature Mapping](#brokehq-feature-mapping)
9. [Implementation Guidelines](#implementation-guidelines)

---

## Design Philosophy

### Design Principles

**Clean & Minimal**
- Light background (#fafafa neutral-50)
- Subtle borders and dividers (#e5e5e5 neutral-200)
- Plenty of whitespace
- Soft shadows for depth

**Performance First**
- 60fps animations
- Optimized for large datasets (hundreds of tasks/projects)
- Efficient rendering with backdrop-blur

**Accessibility**
- WCAG AA contrast ratios
- Keyboard navigation support
- Clear visual hierarchy
- Readable font sizes (minimum 11px/0.6875rem)

### Visual Identity

**Brand Name:** Brind PM (for BrokeHQ)
**Aesthetic:** Linear-inspired, professional, refined
**Personality:** Efficient, organized, trustworthy

---

## Color Palette

### Primary Accent: Emerald Green

The signature color for BrokeHQ, used for CTAs, focus states, and brand identity.

```css
/* Emerald Scale (from design.html) */
emerald-50:   #ecfdf5  /* Light tints for backgrounds */
emerald-100:  #d1fae5  /* Ring colors, subtle highlights */
emerald-400:  #34d399  /* Not used in design */
emerald-500:  #10b981  /* Primary brand color, gradients start */
emerald-600:  #059669  /* Gradient end, hover states */
emerald-700:  #047857  /* Not used in design */
```

**Usage:**
- Primary buttons: `linear-gradient(135deg, #10b981, #059669)`
- Brand logo background: `from-emerald-500 to-emerald-600`
- Checkmarks for completed items: `text-emerald-600`
- Button shadows: `rgba(16, 185, 129, 0.25)` to `rgba(16, 185, 129, 0.28)`
- Animated lines: `rgba(16, 185, 129, 0)` gradient

### Neutrals

A comprehensive gray scale for UI elements, text, and surfaces.

```css
/* Neutral Scale (from Tailwind default in design) */
neutral-50:   #fafafa  /* Main background (body bg) */
neutral-100:  #f5f5f5  /* Input backgrounds, badges, hover states */
neutral-200:  #e5e5e5  /* Borders, dividers, animated lines */
neutral-400:  #a3a3a3  /* Status dots (scope), secondary icons */
neutral-500:  #737373  /* Placeholders, secondary text */
neutral-600:  #525252  /* Body text, labels */
neutral-700:  #404040  /* Navigation links, primary text */
neutral-900:  #171717  /* Headings, high-emphasis text, dark buttons */
```

**Usage:**
- Background: `bg-neutral-50` (body)
- Cards/panels: `bg-white` or `bg-white/80` with `backdrop-blur`
- Borders: `border-neutral-200`
- Text hierarchy:
  - Primary: `text-neutral-900`
  - Secondary: `text-neutral-700`
  - Tertiary: `text-neutral-600`
  - Placeholder: `text-neutral-500`

### Status Colors

For task/issue status indicators and priority badges.

```css
/* Status Indicators (from design.html issue rows) */
amber-50:   #fffbeb  /* High priority badge background */
amber-100:  #fef3c7  /* High priority badge border */
amber-400:  #fbbf24  /* In progress dot */
amber-500:  #f59e0b  /* Started chart line */
amber-700:  #b45309  /* High priority text */

yellow-100: #fef9c3  /* In progress dot ring */
yellow-400: #facc15  /* In progress dot alternate */

indigo-100: #e0e7ff  /* Completed dot ring */
indigo-500: #6366f1  /* Completed dot */
indigo-600: #4f46e5  /* Completed chart line */
```

**Usage:**
- Status dots (left of issue row):
  - In progress: `bg-amber-400 ring-amber-100` or `bg-yellow-400 ring-yellow-100`
  - Completed: `bg-indigo-500 ring-indigo-100`
  - Scope (neutral): `bg-neutral-400` (chart legend)
- Priority badges:
  - High: `bg-amber-50 text-amber-700 border-amber-100`
  - Normal: `bg-neutral-100 text-neutral-700 border-neutral-200`

### Semantic Colors

```css
/* Additional semantic usage */
white:        #ffffff  /* Cards, elevated surfaces */
transparent:  rgba(0,0,0,0)  /* Chart backgrounds */

/* Opacity variations */
white/80:     rgba(255,255,255,0.8)   /* Sidebar/topbar with backdrop-blur */
white/70:     rgba(255,255,255,0.7)   /* Right panel backdrop */
neutral-200/60: rgba(229,229,229,0.6) /* Background animated lines */
neutral-200/70: rgba(229,229,229,0.7) /* Issue row borders (subtle) */
```

### theme.json Implementation

**IMPORTANT:** All colors in theme.json should use OKLCH format for future-proof color management.

**Emerald palette to add:**

```json
{
  "slug": "emerald-50",
  "color": "oklch(0.985 0.03 166)",
  "name": "Emerald 50"
},
{
  "slug": "emerald-100",
  "color": "oklch(0.96 0.06 166)",
  "name": "Emerald 100"
},
{
  "slug": "emerald-500",
  "color": "oklch(0.71 0.15 166)",
  "name": "Emerald 500"
},
{
  "slug": "emerald-600",
  "color": "oklch(0.61 0.15 166)",
  "name": "Emerald 600"
}
```

**Neutral palette to add:**

```json
{
  "slug": "neutral-50",
  "color": "oklch(0.99 0 0)",
  "name": "Neutral 50"
},
{
  "slug": "neutral-100",
  "color": "oklch(0.97 0 0)",
  "name": "Neutral 100"
},
{
  "slug": "neutral-200",
  "color": "oklch(0.91 0 0)",
  "name": "Neutral 200"
},
{
  "slug": "neutral-400",
  "color": "oklch(0.69 0 0)",
  "name": "Neutral 400"
},
{
  "slug": "neutral-500",
  "color": "oklch(0.53 0 0)",
  "name": "Neutral 500"
},
{
  "slug": "neutral-600",
  "color": "oklch(0.42 0 0)",
  "name": "Neutral 600"
},
{
  "slug": "neutral-700",
  "color": "oklch(0.33 0 0)",
  "name": "Neutral 700"
},
{
  "slug": "neutral-900",
  "color": "oklch(0.19 0 0)",
  "name": "Neutral 900"
}
```

**Status colors to add:**

```json
{
  "slug": "amber-50",
  "color": "oklch(0.985 0.03 85)",
  "name": "Amber 50"
},
{
  "slug": "amber-100",
  "color": "oklch(0.96 0.06 85)",
  "name": "Amber 100"
},
{
  "slug": "amber-400",
  "color": "oklch(0.80 0.13 85)",
  "name": "Amber 400"
},
{
  "slug": "amber-500",
  "color": "oklch(0.75 0.15 70)",
  "name": "Amber 500"
},
{
  "slug": "amber-700",
  "color": "oklch(0.55 0.12 70)",
  "name": "Amber 700"
},
{
  "slug": "yellow-100",
  "color": "oklch(0.97 0.06 95)",
  "name": "Yellow 100"
},
{
  "slug": "yellow-400",
  "color": "oklch(0.85 0.14 95)",
  "name": "Yellow 400"
},
{
  "slug": "indigo-100",
  "color": "oklch(0.93 0.04 272)",
  "name": "Indigo 100"
},
{
  "slug": "indigo-500",
  "color": "oklch(0.57 0.18 272)",
  "name": "Indigo 500"
},
{
  "slug": "indigo-600",
  "color": "oklch(0.51 0.20 272)",
  "name": "Indigo 600"
}
```

### colors.css Implementation

**CRITICAL:** colors.css MUST wrap theme.json values, NOT hardcode colors.

```css
@theme {
  /* Emerald palette - Wrap theme.json */
  --color-emerald-50: var(--wp--preset--color--emerald-50);
  --color-emerald-100: var(--wp--preset--color--emerald-100);
  --color-emerald-500: var(--wp--preset--color--emerald-500);
  --color-emerald-600: var(--wp--preset--color--emerald-600);

  /* Neutral palette - Wrap theme.json */
  --color-neutral-50: var(--wp--preset--color--neutral-50);
  --color-neutral-100: var(--wp--preset--color--neutral-100);
  --color-neutral-200: var(--wp--preset--color--neutral-200);
  --color-neutral-400: var(--wp--preset--color--neutral-400);
  --color-neutral-500: var(--wp--preset--color--neutral-500);
  --color-neutral-600: var(--wp--preset--color--neutral-600);
  --color-neutral-700: var(--wp--preset--color--neutral-700);
  --color-neutral-900: var(--wp--preset--color--neutral-900);

  /* Status colors - Wrap theme.json */
  --color-amber-50: var(--wp--preset--color--amber-50);
  --color-amber-100: var(--wp--preset--color--amber-100);
  --color-amber-400: var(--wp--preset--color--amber-400);
  --color-amber-500: var(--wp--preset--color--amber-500);
  --color-amber-700: var(--wp--preset--color--amber-700);

  --color-yellow-100: var(--wp--preset--color--yellow-100);
  --color-yellow-400: var(--wp--preset--color--yellow-400);

  --color-indigo-100: var(--wp--preset--color--indigo-100);
  --color-indigo-500: var(--wp--preset--color--indigo-500);
  --color-indigo-600: var(--wp--preset--color--indigo-600);

  /* Semantic aliases for BrokeHQ */
  --color-brand-primary: var(--color-emerald-500);
  --color-brand-gradient-start: var(--color-emerald-500);
  --color-brand-gradient-end: var(--color-emerald-600);

  --color-bg-body: var(--color-neutral-50);
  --color-bg-card: var(--wp--preset--color--white);
  --color-border-default: var(--color-neutral-200);

  --color-text-primary: var(--color-neutral-900);
  --color-text-secondary: var(--color-neutral-700);
  --color-text-tertiary: var(--color-neutral-600);
  --color-text-placeholder: var(--color-neutral-500);
}
```

**Why this approach?**
- Gutenberg stays in sync with colors.css
- Single source of truth = theme.json
- Easy to update colors globally
- WordPress color picker shows correct values

---

## Typography

### Font Families

**Primary (Body Text):** Inter
**Secondary (Headings):** Geist
**Fallback Stack:** `system-ui, -apple-system, Segoe UI, Inter, sans-serif`

**Loading from Google Fonts:**

```html
<!-- Inter: Weights 300, 400, 500, 600 -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Geist: Weights 300, 400, 500, 600, 700 -->
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

**CSS Class for Geist:**

```css
.font-geist {
  font-family: 'Geist', system-ui, -apple-system, Segoe UI, Inter, sans-serif !important;
}
```

### Font Sizes

From design.html, extracted font sizes:

| Size | Pixels | Rem | Usage |
|------|--------|-----|-------|
| `10px` | 10px | 0.625rem | Badge counts, labels (uppercase), chart ticks |
| `11px` | 11px | 0.6875rem | Badge text, section headers (uppercase), small metadata |
| `12px` | 12px | 0.75rem | Issue IDs (PRO-38), dates, project tags, secondary info |
| `13px` | 13px | 0.8125rem | Not used in design |
| `14px` | 14px | 0.875rem | Body text, navigation links, issue titles, buttons, inputs |
| `16px` | 16px | 1rem | Not explicitly used (standard body) |
| `18px` | 18px | 1.125rem | Brand name (sidebar header) - actually shows `text-lg` |
| `24px` | 24px | 1.5rem | Right panel heading "Cycle 12" (`text-2xl`) |

**Implementation in theme.json:**

```json
"fontFamilies": [
  {
    "slug": "inter",
    "fontFamily": "'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif",
    "name": "Inter"
  },
  {
    "slug": "geist",
    "fontFamily": "'Geist', system-ui, -apple-system, 'Segoe UI', 'Inter', sans-serif",
    "name": "Geist"
  }
]
```

```json
"fontSizes": [
  {
    "slug": "xxs",
    "size": "0.625rem",
    "name": "Extra Extra Small"
  },
  {
    "slug": "xs",
    "size": "0.6875rem",
    "name": "Extra Small"
  },
  {
    "slug": "sm",
    "size": "0.75rem",
    "name": "Small"
  },
  {
    "slug": "base",
    "size": "0.875rem",
    "name": "Base"
  },
  {
    "slug": "lg",
    "size": "1.125rem",
    "name": "Large"
  },
  {
    "slug": "2xl",
    "size": "1.5rem",
    "name": "2X Large"
  }
]
```

### Font Weights

| Weight | Name | Usage |
|--------|------|-------|
| 300 | Light | Headings (`font-light` on "Cycle 12") |
| 400 | Regular | Body text (default) |
| 500 | Medium | Navigation items, issue titles (`font-medium`), section headers |
| 600 | Semibold | Brand name, emphasized text |
| 700 | Bold | Not used in design |

### Letter Spacing

**Tracking Tight (`tracking-tight`):**
Used for headings and titles to create a refined, professional look.

```css
.tracking-tight {
  letter-spacing: -0.025em;
}
```

**Tracking Wide (`tracking-wide`):**
Used for uppercase labels (11px section headers).

```css
.tracking-wide {
  letter-spacing: 0.025em;
}
```

### Text Rendering

```css
body {
  font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
  -webkit-font-smoothing: antialiased; /* Applied via .antialiased class */
  -moz-osx-font-smoothing: grayscale;
}
```

**Antialiased class:**
Applied to `<body>` for smooth font rendering on macOS/iOS.

---

## Spacing & Layout

### Container & Max Widths

**Sidebar:**
- Default: `280px` (mobile hidden)
- Large screens: `300px` (lg:)
- Shrink behavior: `shrink-0` (fixed width, doesn't shrink)

**Right Panel:**
- Width: `420px` (fixed, only on xl: breakpoint)
- Hidden below `xl:` breakpoint

**Main Content:**
- Flexible: `flex-1 min-w-0` (takes remaining space, allows text truncation)

### Padding & Spacing

**Padding Scale (from design.html classes):**

| Class | Pixels | Rem | Usage |
|-------|--------|-----|-------|
| `p-1` | 4px | 0.25rem | Icon button padding (small) |
| `p-1.5` | 6px | 0.375rem | Icon button padding (default) |
| `p-2` | 8px | 0.5rem | Button padding, icon containers |
| `p-3` | 12px | 0.75rem | Input padding, card padding |
| `p-4` | 16px | 1rem | Section padding, sidebar sections |
| `px-3` | 12px H | - | Issue row horizontal padding (mobile) |
| `px-4` | 16px H | - | Sidebar padding |
| `px-6` | 24px H | - | Issue row horizontal padding (desktop) |
| `py-2` | 8px V | - | Navigation link vertical padding |
| `py-3` | 12px V | - | Issue row vertical padding, nav padding |
| `py-4` | 16px V | - | Section header padding |

**Gap/Space Between:**

| Class | Pixels | Usage |
|-------|--------|-------|
| `gap-1` | 4px | Tight spacing (badge icons, small groups) |
| `gap-2` | 8px | Default spacing (icons + text, metadata items) |
| `gap-3` | 12px | Section spacing, card groups |

**Margin/Space-y:**

```css
/* Vertical spacing between list items */
.space-y-1 > * + * { margin-top: 0.25rem; } /* 4px */
.space-y-2 > * + * { margin-top: 0.5rem; }  /* 8px */
```

### Border Radius

| Class | Pixels | Usage |
|-------|--------|-------|
| `rounded-md` | 6px | Buttons, inputs, navigation items |
| `rounded-lg` | 8px | Cards, brand logo, sidebar sections |
| `rounded-2xl` | 16px | Chart container (large cards) |
| `rounded-full` | 9999px | Avatars, badges, status dots, pills |

### Borders

**Default Border:**

```css
.border {
  border-width: 1px;
}

.border-neutral-200 {
  border-color: #e5e5e5;
}
```

**Border Sides:**

```css
.border-b  /* Bottom border (dividers) */
.border-t  /* Top border (footer) */
.border-l  /* Left border (right panel) */
.border-r  /* Right border (sidebar) */
.border-y  /* Top and bottom (section containers) */
```

**Border Opacity:**

```css
.border-neutral-200/70 {
  border-color: rgba(229, 229, 229, 0.7);
}
```

### Shadows

**Default Shadow (Cards):**

```css
/* Not explicitly in design, but implied soft shadow */
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
```

**Button Shadow (Emerald):**

```css
.shadow-emerald {
  box-shadow: 0 10px 20px rgba(16, 185, 129, 0.25);
}

.shadow-emerald-hover {
  box-shadow: 0 12px 24px rgba(16, 185, 129, 0.28);
}
```

**Hover Lift Shadow:**

```css
.hover-lift:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
}
```

### Layout Grid

**Main App Layout:**

```css
/* Two-column grid: sidebar + main */
.app-container {
  display: flex;
  min-height: 100vh;
}

/* Three-column grid: sidebar + content + right panel */
.content-grid {
  display: grid;
  grid-template-columns: 1fr;
}

@media (min-width: 1280px) { /* xl: */
  .content-grid {
    grid-template-columns: 1fr 420px;
  }
}
```

**Responsive Breakpoints:**

| Breakpoint | Min Width | Usage |
|------------|-----------|-------|
| `md:` | 768px | Show sidebar, change padding |
| `lg:` | 1024px | Increase sidebar width to 300px |
| `xl:` | 1280px | Show right panel |

---

## Components

### Navigation

#### Sidebar Navigation

**Structure:**

```html
<aside class="w-[280px] lg:w-[300px] shrink-0 border-r border-neutral-200 bg-white/80 backdrop-blur">
  <!-- Brand / Search -->
  <!-- Primary nav -->
  <!-- Your teams (collapsible sections) -->
  <!-- Footer (user profile) -->
</aside>
```

**Navigation Links:**

```css
.nav-link {
  display: flex;
  align-items: center;
  gap: 0.5rem; /* 8px between icon and text */
  padding: 0.5rem 0.75rem; /* py-2 px-3 */
  border-radius: 0.375rem; /* rounded-md */
  color: #404040; /* text-neutral-700 */
  font-size: 0.875rem; /* text-sm */
}

.nav-link:hover {
  background-color: #f5f5f5; /* hover:bg-neutral-100 */
}
```

**Badge Counts:**

```css
.badge-count {
  margin-left: auto;
  font-size: 0.6875rem; /* 11px */
  border-radius: 9999px;
  background-color: #f5f5f5; /* bg-neutral-100 */
  border: 1px solid #e5e5e5; /* border-neutral-200 */
  color: #404040; /* text-neutral-700 */
  padding: 0.125rem 0.5rem; /* py-0.5 px-2 */
}
```

**Collapsible Sections (details/summary):**

```css
details {
  /* No default styling */
}

details summary {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 0.75rem;
  border-radius: 0.375rem;
  cursor: pointer;
  list-style: none; /* Remove default arrow */
}

details summary:hover {
  background-color: #f5f5f5;
}

/* Chevron rotation */
details summary .chevron {
  margin-left: auto;
  transition: transform 0.2s ease;
}

details[open] summary .chevron {
  transform: rotate(180deg);
}

/* Nested items */
details ul {
  margin-top: 0.25rem;
  padding-left: 2.25rem; /* pl-9 (36px) */
  padding-right: 0.75rem;
}
```

#### Topbar

**Structure:**

```html
<header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-neutral-200">
  <div class="px-6 h-14 flex items-center gap-3">
    <!-- Mobile menu button (md:hidden) -->
    <!-- Breadcrumbs -->
    <!-- Actions (Filter, Display, Notifications, Focus) -->
  </div>
</header>
```

**Breadcrumbs:**

```css
.breadcrumb {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem; /* text-sm */
}

.breadcrumb-link {
  color: #404040; /* text-neutral-700 */
}

.breadcrumb-link:hover {
  color: #171717; /* hover:text-neutral-900 */
}

.breadcrumb-separator {
  width: 1rem;
  height: 1rem;
  color: #a3a3a3; /* text-neutral-400 */
}

.breadcrumb-current {
  color: #171717; /* text-neutral-900 */
}
```

### Buttons

#### Primary Button (Emerald Gradient)

```css
.btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem; /* gap-2 */
  height: 2.5rem; /* h-10 */
  padding: 0 1rem; /* px-4 (implied) */
  border-radius: 0.5rem; /* rounded-lg */
  font-size: 0.875rem; /* text-sm */
  color: white;
  background-image: linear-gradient(135deg, #10b981, #059669);
  box-shadow: 0 10px 20px rgba(16, 185, 129, 0.25);
  transition: box-shadow 0.25s ease;
}

.btn-primary:hover {
  box-shadow: 0 12px 24px rgba(16, 185, 129, 0.28);
}
```

#### Secondary Button

```css
.btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  height: 2.25rem; /* h-9 */
  padding: 0 0.75rem; /* px-3 */
  border-radius: 0.375rem; /* rounded-md */
  font-size: 0.875rem;
  background-color: white;
  border: 1px solid #e5e5e5;
  color: #171717;
}

.btn-secondary:hover {
  background-color: #fafafa; /* hover:bg-neutral-50 */
}
```

#### Dark Button (Focus Mode)

```css
.btn-dark {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  height: 2.25rem;
  padding: 0 0.75rem;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  background-color: #171717; /* bg-neutral-900 */
  color: white;
}

.btn-dark:hover {
  background-color: #262626; /* hover:bg-neutral-800 */
}
```

#### Icon Button

```css
.btn-icon {
  padding: 0.375rem; /* p-1.5 (6px) */
  border-radius: 0.375rem;
  background-color: transparent;
  color: #171717;
  transition: background-color 0.15s ease;
}

.btn-icon:hover {
  background-color: #f5f5f5; /* hover:bg-neutral-100 */
}

/* Revealed on group hover */
.group:hover .btn-icon-reveal {
  opacity: 1;
}

.btn-icon-reveal {
  opacity: 0;
  transition: opacity 0.2s ease;
}
```

### Cards & Containers

#### Card (Standard)

```css
.card {
  border-radius: 0.5rem; /* rounded-lg */
  border: 1px solid #e5e5e5;
  background-color: white;
  padding: 0.75rem; /* p-3 */
}
```

#### Chart Container

```css
.chart-container {
  border-radius: 1rem; /* rounded-2xl */
  border: 1px solid #e5e5e5;
  background-color: white;
  padding: 0.75rem;
}

.chart-container canvas {
  position: relative;
  height: 220px; /* Fixed height to prevent canvas growth bug */
}
```

### Forms

#### Search Input

```css
.search-input-container {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  height: 2.5rem; /* h-10 */
  padding: 0 0.75rem; /* px-3 */
  border-radius: 0.5rem; /* rounded-lg */
  background-color: #f5f5f5; /* bg-neutral-100 */
  border: 1px solid #e5e5e5;
}

.search-input {
  flex: 1;
  background-color: transparent;
  font-size: 0.875rem;
  outline: none;
  border: none;
}

.search-input::placeholder {
  color: #737373; /* text-neutral-500 */
}

.search-kbd {
  font-size: 0.625rem; /* 10px */
  color: #737373;
}
```

### Lists

#### Issue/Task Row

**Structure:**

```html
<article class="group px-6">
  <div class="flex items-center gap-3 py-3 border-b border-neutral-200/70 last:border-0">
    <!-- Status dot -->
    <!-- Content (ID, title, badges) -->
    <!-- Metadata (project, date, assignee) -->
    <!-- Actions (hover reveal) -->
  </div>
</article>
```

**Status Dot:**

```css
.status-dot {
  height: 0.625rem; /* h-2.5 (10px) */
  width: 0.625rem; /* w-2.5 */
  border-radius: 9999px;
  /* Ring: ring-4 ring-{color}-100 */
  box-shadow: 0 0 0 4px var(--ring-color);
}

/* In Progress */
.status-dot-amber {
  background-color: #fbbf24; /* bg-amber-400 */
  --ring-color: #fef3c7; /* ring-amber-100 */
}

/* Completed */
.status-dot-indigo {
  background-color: #6366f1; /* bg-indigo-500 */
  --ring-color: #e0e7ff; /* ring-indigo-100 */
}
```

**Priority Badge:**

```css
.badge-priority {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem; /* gap-1 */
  font-size: 0.625rem; /* 10px */
  padding: 0.125rem 0.375rem; /* py-0.5 px-1.5 */
  border-radius: 9999px;
}

.badge-priority-high {
  background-color: #fffbeb; /* bg-amber-50 */
  color: #b45309; /* text-amber-700 */
  border: 1px solid #fef3c7; /* border-amber-100 */
}

.badge-priority-normal {
  background-color: #f5f5f5; /* bg-neutral-100 */
  color: #404040; /* text-neutral-700 */
  border: 1px solid #e5e5e5;
}
```

**Project Tag:**

```css
.project-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  font-size: 0.75rem; /* text-xs (12px) */
  padding: 0.25rem 0.5rem; /* py-1 px-2 */
  border-radius: 9999px;
  background-color: white;
  border: 1px solid #e5e5e5;
  color: #525252; /* text-neutral-600 */
}
```

**Issue Title:**

```css
.issue-title {
  font-size: 0.875rem; /* text-sm */
  font-weight: 500; /* font-medium */
  letter-spacing: -0.025em; /* tracking-tight */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap; /* truncate */
}
```

#### Section Header

```html
<div class="px-6 py-4">
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
      <span class="text-sm font-medium tracking-tight">In Progress</span>
      <span class="text-[11px] px-2 py-0.5 rounded-full bg-neutral-100 border border-neutral-200 text-neutral-700">1</span>
    </div>
    <button class="p-1.5 rounded-md hover:bg-neutral-100">
      <i data-lucide="plus" class="w-4 h-4"></i>
    </button>
  </div>
</div>
```

### Right Panel

**Progress Legend:**

```css
.legend-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.75rem; /* text-xs */
}

.legend-dot {
  height: 0.5rem; /* h-2 */
  width: 0.5rem; /* w-2 */
  border-radius: 9999px;
}
```

**Segmented Control:**

```html
<div class="grid grid-cols-3 gap-2">
  <button class="text-sm h-9 rounded-md border border-neutral-200 bg-neutral-900 text-white">Active</button>
  <button class="text-sm h-9 rounded-md border border-neutral-200 bg-white hover:bg-neutral-50">Inactive</button>
</div>
```

---

## Animations

### Keyframe Animations

**Fade In Up:**

```css
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeInUp {
  animation: fadeInUp 0.5s ease-out forwards;
}

/* Staggered delays */
.animation-delay-100 {
  animation-delay: 0.1s;
  opacity: 0;
}

.animation-delay-200 {
  animation-delay: 0.2s;
  opacity: 0;
}

.animation-delay-300 {
  animation-delay: 0.3s;
  opacity: 0;
}
```

**Fade In:**

```css
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.animate-fadeIn {
  animation: fadeIn 0.6s ease-out forwards;
}
```

**Drop (Background Lines):**

```css
@keyframes drop {
  0% {
    top: -40%;
  }
  100% {
    top: 110%;
  }
}

.line-anim::after {
  content: '';
  position: absolute;
  left: 0;
  top: -40%;
  width: 100%;
  height: 12vh;
  background: linear-gradient(to bottom, rgba(16, 185, 129, 0) 0%, rgba(2, 6, 23, 0.06) 100%);
  animation: drop 9s cubic-bezier(0.4, 0.26, 0, 0.97) infinite;
}

.line-1::after {
  animation-delay: 2s;
}

.line-3::after {
  animation-delay: 3s;
}
```

### Transitions

**Hover Lift:**

```css
.hover-lift {
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.hover-lift:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
}
```

**Button/Link Hover:**

```css
.transition-colors {
  transition-property: background-color, color, border-color;
  transition-duration: 0.15s;
  transition-timing-function: ease-in-out;
}
```

**Chevron Rotation:**

```css
.chevron {
  transition: transform 0.2s ease;
}

details[open] .chevron {
  transform: rotate(180deg);
}
```

### Backdrop Blur

```css
.backdrop-blur {
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Applied to sidebar/topbar with semi-transparent backgrounds */
.sidebar {
  background-color: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(8px);
}
```

---

## Icons & Imagery

### Icon Library: Lucide

**CDN:**

```html
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
```

**NPM Installation (recommended for production):**

```bash
pnpm add lucide
```

**Usage:**

```html
<i data-lucide="inbox" class="w-4 h-4"></i>
<i data-lucide="plus" class="w-4 h-4"></i>
<i data-lucide="search" class="w-5 h-5"></i>
```

**Icon Sizes (from design):**

| Class | Pixels | Usage |
|-------|--------|-------|
| `w-3 h-3` | 12px | Tiny icons (inside tiny badges) |
| `w-3.5 h-3.5` | 14px | Small icons (chart legend, project tags) |
| `w-4 h-4` | 16px | Default icons (navigation, buttons, issue rows) |
| `w-5 h-5` | 20px | Larger icons (topbar, sidebar header) |

**Icon Colors:**

Most icons inherit text color. Exceptions:
- Emerald brand icon: `text-emerald-600`
- Placeholder/secondary: `text-neutral-400` or `text-neutral-500`
- Completed checkmark: `text-emerald-600`

**Icon Set Used in Design:**

| Icon | Name | Usage |
|------|------|-------|
| `inbox` | Inbox | Navigation |
| `user` | User | My issues |
| `layout-list` | Layout List | Views |
| `map` | Map | Roadmaps |
| `users` | Users | Teams |
| `box` | Box | Team icon (Product Studio) |
| `shield` | Shield | Admin team icon |
| `folder` | Folder | Generic team icon |
| `stethoscope` | Stethoscope | Triage view |
| `list-todo` | List Todo | Issues view |
| `activity` | Activity | Active view |
| `archive` | Archive | Backlog view |
| `repeat` | Repeat | Cycles |
| `folder-kanban` | Folder Kanban | Projects view |
| `grid` | Grid | Views |
| `settings` | Settings | Settings button |
| `panel-left` | Panel Left | Mobile sidebar toggle |
| `chevron-right` | Chevron Right | Breadcrumbs, navigation |
| `chevron-down` | Chevron Down | Dropdowns, collapsible sections |
| `list-filter` | List Filter | Filter button |
| `layout-grid` | Layout Grid | Display button |
| `bell` | Bell | Notifications |
| `circle` | Circle | Focus mode, legend, status |
| `plus` | Plus | New issue, add buttons |
| `search` | Search | Search input |
| `alert-triangle` | Alert Triangle | High priority badge |
| `git-branch` | Git Branch | Tag type (Design) |
| `app-window` | App Window | Project tag icon |
| `smartphone` | Smartphone | Mobile tag |
| `tag` | Tag | Label type (Style) |
| `loader` | Loader | Loading spinner (animate-spin) |
| `external-link` | External Link | Open issue (hover reveal) |
| `check` | Check | Completed status |
| `more-horizontal` | More Horizontal | Options menu |
| `gauge` | Gauge | Progress indicator |
| `x` | X | Close button |

### Avatars

**Sizing:**

```css
.avatar {
  width: 2rem; /* w-8 (32px) - sidebar footer */
  height: 2rem;
  border-radius: 9999px;
  object-fit: cover;
}

.avatar-sm {
  width: 1.5rem; /* w-6 (24px) - issue rows */
  height: 1.5rem;
  border-radius: 9999px;
  object-fit: cover;
}
```

**Placeholder Images:**

Using Unsplash for demo avatars:
```
https://images.unsplash.com/photo-{id}?auto=format&fit=crop&w={size}&q=60
```

### Brand Logo

**Gradient Square:**

```html
<div class="h-8 w-8 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600"></div>
```

**Usage:** Sidebar header, favicon

---

## BrokeHQ Feature Mapping

### Design → BrokeHQ Translation

This section maps the Linear design concept to BrokeHQ's data model and features.

#### 1. Sidebar Navigation

**Design Concept → BrokeHQ:**

| Design Element | BrokeHQ Equivalent | Implementation |
|----------------|-------------------|----------------|
| **Brand: "Brind PM"** | **BrokeHQ** | Update brand name and logo |
| **New issue button** | **New task button** | Modal/page for creating tasks |
| **Search** | **Search tasks/projects** | Query `post_title` in tasks/projects |
| **Inbox (29)** | **Inbox (comment count)** | All comments for admin; new comments for users |
| **My issues** | **My tasks** | Tasks where `assigned_to = current_user` |
| **Views** | **Views (optional)** | Custom saved filters (future phase) |
| **Roadmaps** | **Roadmaps (optional)** | Timeline view of projects (future phase) |
| **Teams** | **Companies** | Navigate to company detail pages |
| **Your teams** section | **Your Companies** | List companies current user belongs to |
| **Product Studio** | **Company name** | Collapsible section per company |
| **Triage** | **Triage** | High-priority tasks needing attention |
| **Issues** | **All Tasks** | Archive of company's tasks |
| **Active** | **Active Projects** | Projects with status = "In Progress" |
| **Backlog** | **Backlog** | Tasks with status = "Backlog" |
| **Cycles** | **Cycles (optional)** | Sprint-like groupings (future phase) |
| **Projects** | **Projects** | Company's projects archive |
| **Views** | **Views** | Saved filters per company |
| **User profile footer** | **User profile + company** | Show user name, job title, company logo |

#### 2. Topbar

**Design Concept → BrokeHQ:**

| Design Element | BrokeHQ Equivalent |
|----------------|-------------------|
| **Breadcrumbs: Product Studio → Cycle 12** | **Company Name → Project/Task Name** |
| **Filter button** | **Filter by status, priority, assignee** |
| **Display button** | **Toggle views (list/kanban - future)** |
| **Notifications** | **Comment notifications** |
| **Focus button** | **Focus mode (optional)** |

#### 3. Issue List (Main Content)

**Design Concept → BrokeHQ:**

| Design Element | BrokeHQ Equivalent | Data Model |
|----------------|-------------------|------------|
| **Section: "In Progress"** | **Status: "In Progress"** | `taxonomy: status`, term: "In Progress" |
| **Section: "Todo"** | **Status: "To Do"** | Term: "To Do" |
| **Section: "Done"** | **Status: "Completed"** | Term: "Completed" |
| **Issue row** | **Task card** | Custom post type: `task` |
| **Issue ID: PRO-38** | **Task ID: format** | `{Company Prefix}-{ID}` (e.g., "ABC-123") |
| **Priority badge: High** | **Priority: High/Medium/Low** | ACF field: `priority` (Select) |
| **Status dot colors** | **Status colors** | Map status terms to colors (amber, indigo, yellow) |
| **Project tag: SteelSync** | **Project name** | ACF field: `parent_project` (Post Object) |
| **Date: 29 Nov** | **Due date** | ACF field: `due_date` (Date Picker) |
| **Assignee avatar** | **Assigned user** | ACF field: `assigned_to` (User) |
| **Completed checkmark** | **Completed status** | Status = "Completed" |
| **Hover reveal: external link** | **Link to task detail** | Single task permalink |
| **Badge tags** | **Custom taxonomies** | Tags like "Design", "Mobile", "Style" |

#### 4. Right Panel (Project Progress)

**Design Concept → BrokeHQ:**

| Design Element | BrokeHQ Equivalent | Implementation |
|----------------|-------------------|----------------|
| **"Cycle 12"** | **Project name** | Current project being viewed |
| **"Current · 30 Nov → 7 Dec"** | **Project dates** | `start_date` to `deadline` |
| **Progress chart** | **Task completion chart** | Chart.js line chart |
| **Legend: Scope/Started/Completed** | **Planned/In Progress/Completed** | Count tasks by status over time |
| **Assignees tab** | **Team members** | Show `assigned_users` for project |
| **Labels tab** | **Tags** | Show task tags (taxonomies) |
| **Projects tab** | **N/A** | Not nested in BrokeHQ (flat structure) |
| **"No assignee" metric** | **Unassigned tasks** | Tasks where `assigned_to` is empty |
| **"90% of Δ 8"** | **Progress metric** | Percentage complete, delta from previous |

### Access Control Logic

**Inbox Feature:**

```php
// Admin: ALL comments from ALL tasks/projects
if (current_user_can('edit_others_posts')) {
    $comments = get_comments([
        'post_type' => ['task', 'project'],
        'status' => 'approve',
        'order' => 'DESC'
    ]);
}

// Regular user: NEW comments on THEIR tasks NOT made by them
else {
    $user_id = get_current_user_id();

    // Get user's assigned tasks
    $user_tasks = get_posts([
        'post_type' => 'task',
        'meta_key' => 'assigned_to',
        'meta_value' => $user_id,
        'fields' => 'ids',
        'posts_per_page' => -1
    ]);

    if ($user_tasks) {
        $comments = get_comments([
            'post__in' => $user_tasks,
            'status' => 'approve',
            'user_id__not_in' => [$user_id], // Exclude their own comments
            'date_query' => [
                [
                    'after' => get_user_meta($user_id, 'last_inbox_check', true) ?: '1 week ago',
                    'inclusive' => false
                ]
            ],
            'order' => 'DESC'
        ]);
    }
}
```

**Visibility Filtering:**

Already implemented in `src/context/brokehq-access.php`:
- `public`: Everyone can see
- `company`: Only company members can see
- `assigned`: Only assigned users + project manager + admins

### Data Queries for Context Filters

**My Tasks (Sidebar):**

```php
$my_tasks = Timber::get_posts([
    'post_type' => 'task',
    'meta_key' => 'assigned_to',
    'meta_value' => get_current_user_id(),
    'posts_per_page' => -1
]);
```

**Company Projects:**

```php
$user_company_id = get_field('company', 'user_' . get_current_user_id());

$company_projects = Timber::get_posts([
    'post_type' => 'project',
    'meta_key' => 'company',
    'meta_value' => $user_company_id,
    'posts_per_page' => -1
]);
```

**Tasks by Status:**

```php
$in_progress_tasks = Timber::get_posts([
    'post_type' => 'task',
    'tax_query' => [
        [
            'taxonomy' => 'status',
            'field' => 'slug',
            'terms' => 'in-progress'
        ]
    ]
]);
```

**High Priority Tasks:**

```php
$high_priority = Timber::get_posts([
    'post_type' => 'task',
    'meta_key' => 'priority',
    'meta_value' => 'high',
    'orderby' => 'meta_value_date',
    'meta_key' => 'due_date',
    'order' => 'ASC'
]);
```

---

## Implementation Guidelines

### Phase 1: Design System Foundation

**Step 1: Update theme.json**

Add all new color palettes and font families to `theme.json`:
- Emerald colors (50, 100, 500, 600)
- Neutral colors (50, 100, 200, 400, 500, 600, 700, 900)
- Status colors (amber, yellow, indigo scales)
- Inter and Geist font families
- Updated font sizes (add xxs: 0.625rem, xs: 0.6875rem)

**Step 2: Update colors.css**

Wrap ALL new theme.json colors in `@theme` layer:
```css
@theme {
  --color-emerald-500: var(--wp--preset--color--emerald-500);
  /* ... etc */
}
```

**Step 3: Update tailwind.css**

Add animations and utilities:
```css
@layer utilities {
  /* Animations */
  @keyframes fadeInUp { /* ... */ }
  @keyframes fadeIn { /* ... */ }
  @keyframes drop { /* ... */ }

  .animate-fadeInUp { animation: fadeInUp 0.5s ease-out forwards; }
  .animate-fadeIn { animation: fadeIn 0.6s ease-out forwards; }
  .animation-delay-100 { animation-delay: 0.1s; opacity: 0; }
  .animation-delay-200 { animation-delay: 0.2s; opacity: 0; }
  .animation-delay-300 { animation-delay: 0.3s; opacity: 0; }

  /* Hover lift */
  .hover-lift {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
  }

  /* Scrollbar hide (plugin already installed) */
}
```

**Step 4: Add dependencies**

Update `package.json`:
```bash
pnpm add lucide chart.js
```

**Step 5: Enqueue Google Fonts**

Update `includes/enqueue.php`:
```php
wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Geist:wght@300;400;500;600;700&display=swap',
    [],
    null
);
```

### Phase 2: Component Patterns

**Step 1: Create reusable component patterns**

Create files in `src/patterns/`:
- `brokehq-sidebar.html` - Sidebar navigation
- `brokehq-topbar.html` - Topbar with breadcrumbs
- `brokehq-task-row.html` - Single task row component
- `brokehq-project-card.html` - Project card
- `brokehq-chart-panel.html` - Right panel with Chart.js

**Step 2: Use Universal Block syntax**

Example task row pattern:
```html
<article class="group px-3 md:px-6" loopsource="tasks" loopvariable="task">
  <div class="flex items-center gap-3 py-3 border-b border-neutral-200/70 last:border-0">
    <!-- Status dot -->
    <div class="h-2.5 w-2.5 rounded-full bg-amber-400 ring-4 ring-amber-100"></div>

    <!-- Content -->
    <div class="min-w-0 flex-1">
      <div class="flex items-center gap-2">
        <span class="text-xs text-neutral-500">{{ task.meta('project_prefix') }}-{{ task.ID }}</span>
        <span class="text-[10px] inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-100">
          <i data-lucide="alert-triangle" class="w-3 h-3"></i>{{ task.meta('priority') }}
        </span>
      </div>
      <h3 class="text-sm font-medium tracking-tight truncate">{{ task.title }}</h3>
    </div>

    <!-- Metadata -->
    <div class="hidden md:flex items-center gap-2 text-xs text-neutral-600">
      <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-white border border-neutral-200">
        <i data-lucide="app-window" class="w-3.5 h-3.5"></i>{{ task.meta('parent_project').post_title }}
      </span>
      <span>{{ task.meta('due_date') }}</span>
      <img class="h-6 w-6 rounded-full object-cover" src="{{ task.meta('assigned_to').avatar }}" alt="assignee">
    </div>

    <!-- Actions -->
    <button class="opacity-0 group-hover:opacity-100 p-1.5 rounded-md hover:bg-neutral-100 transition">
      <i data-lucide="external-link" class="w-4 h-4"></i>
    </button>
  </div>
</article>
```

**Step 3: Convert patterns**

```bash
npm run parse:patterns
```

### Phase 3: Template Pages

**Step 1: Create page templates**

Create files in `src/pages/`:
- `dashboard.html` - Main dashboard view
- `project-single.html` - Single project view
- `task-single.html` - Single task view
- `company-archive.html` - Company list
- `company-single.html` - Company detail with projects

**Step 2: Add context filters**

Already created in `src/context/`:
- `brokehq-user.php`
- `brokehq-projects.php`
- `brokehq-tasks.php`
- `brokehq-access.php`

**Step 3: Implement inbox logic**

Create `src/context/brokehq-inbox.php`:
```php
add_filter('timber/context', function($context) {
    $user_id = get_current_user_id();

    // Admin: All comments
    if (current_user_can('edit_others_posts')) {
        $context['inbox_comments'] = Timber::get_comments([
            'post_type' => ['task', 'project'],
            'status' => 'approve',
            'number' => 50,
            'order' => 'DESC'
        ]);
        $context['inbox_count'] = wp_count_comments()->total_comments;
    }
    // Regular user: New comments on their tasks
    else {
        $user_tasks = get_posts([
            'post_type' => 'task',
            'meta_key' => 'assigned_to',
            'meta_value' => $user_id,
            'fields' => 'ids',
            'posts_per_page' => -1
        ]);

        if ($user_tasks) {
            $last_check = get_user_meta($user_id, 'last_inbox_check', true) ?: '1 week ago';

            $context['inbox_comments'] = Timber::get_comments([
                'post__in' => $user_tasks,
                'status' => 'approve',
                'user_id__not_in' => [$user_id],
                'date_query' => [['after' => $last_check, 'inclusive' => false]],
                'number' => 50,
                'order' => 'DESC'
            ]);

            $context['inbox_count'] = count($context['inbox_comments']);
        }
    }

    return $context;
});
```

### Phase 4: JavaScript Integration

**Step 1: Enqueue Lucide icons**

Create `src/scripts/lucide-init.js`:
```javascript
// Initialize Lucide icons
import { createIcons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
  createIcons();
});
```

**Step 2: Enqueue Chart.js**

Create `src/scripts/project-chart.js`:
```javascript
import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
  const ctx = document.getElementById('projectChart');
  if (!ctx) return;

  // Get data from data attributes or API
  const chartData = JSON.parse(ctx.dataset.chartData || '{}');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartData.labels,
      datasets: [
        {
          label: 'Planned',
          data: chartData.planned,
          borderColor: '#9CA3AF',
          backgroundColor: 'transparent',
          pointRadius: 0,
          tension: 0.35
        },
        {
          label: 'In Progress',
          data: chartData.inProgress,
          borderColor: '#F59E0B',
          backgroundColor: 'transparent',
          pointRadius: 3,
          pointBackgroundColor: '#F59E0B',
          tension: 0.35
        },
        {
          label: 'Completed',
          data: chartData.completed,
          borderColor: '#4F46E5',
          backgroundColor: 'transparent',
          pointRadius: 3,
          pointBackgroundColor: '#4F46E5',
          borderDash: [4, 3],
          tension: 0.35
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: { mode: 'index', intersect: false }
      },
      scales: {
        x: {
          grid: { color: 'rgba(0,0,0,0.06)' },
          ticks: { color: '#6B7280', font: { size: 11 } }
        },
        y: {
          grid: { color: 'rgba(0,0,0,0.06)' },
          ticks: { color: '#6B7280', font: { size: 11 } },
          beginAtZero: true
        }
      }
    }
  });
});
```

**Step 3: Update esbuild config**

Ensure `src/scripts/` files are bundled:
```javascript
// In build script
import * as esbuild from 'esbuild'

await esbuild.build({
  entryPoints: [
    'src/scripts/main.js',
    'src/scripts/lucide-init.js',
    'src/scripts/project-chart.js'
  ],
  bundle: true,
  outdir: 'assets/_production',
  format: 'esm',
  splitting: true
})
```

### Phase 5: Testing Checklist

**Design System:**
- [ ] All colors from design.html mapped to theme.json (OKLCH format)
- [ ] colors.css wraps theme.json (no hardcoded values)
- [ ] Inter and Geist fonts load correctly
- [ ] Font sizes match design (10px, 11px, 12px, 14px, 18px, 24px)
- [ ] Animations work (fadeInUp, fadeIn, drop, hover-lift)
- [ ] Lucide icons render correctly
- [ ] Chart.js renders project progress

**Components:**
- [ ] Sidebar navigation renders with collapsible sections
- [ ] Topbar breadcrumbs show correct path
- [ ] Task rows display status dot, badges, metadata
- [ ] Right panel chart displays with correct data
- [ ] Buttons have correct hover states and shadows
- [ ] Search input styled correctly
- [ ] Avatars render and size correctly

**Functionality:**
- [ ] Inbox shows ALL comments for admins
- [ ] Inbox shows only NEW comments for regular users
- [ ] My Tasks filters correctly by assigned user
- [ ] Company navigation lists user's companies
- [ ] Task status filtering works (In Progress, To Do, Done)
- [ ] Priority badges show correct colors
- [ ] Project tags link to parent project
- [ ] Access control: visibility filtering works
- [ ] Comment count badge updates

**Responsive:**
- [ ] Sidebar hidden on mobile (md:hidden)
- [ ] Topbar mobile menu button works
- [ ] Task row metadata hidden on mobile (hidden md:flex)
- [ ] Right panel hidden below xl: breakpoint
- [ ] Padding adjusts on mobile (px-3 md:px-6)

**Performance:**
- [ ] Animations run at 60fps
- [ ] Large task lists render efficiently
- [ ] Chart.js doesn't cause canvas growth bug
- [ ] Backdrop blur performs well
- [ ] Icons load without flicker

---

## Summary

This style guide provides a comprehensive blueprint for implementing BrokeHQ's design system based on the Linear-inspired design concept. Key principles:

1. **Single Source of Truth:** theme.json → colors.css → Tailwind CSS
2. **OKLCH Color Format:** Future-proof color management
3. **Wrapping Approach:** colors.css wraps theme.json (Gutenberg sync)
4. **Component-First:** Reusable patterns in `src/patterns/`
5. **MVC Pattern:** Context filters for data, templates for presentation
6. **Progressive Enhancement:** Mobile-first responsive design
7. **Performance:** Optimized animations, efficient rendering
8. **Accessibility:** WCAG AA compliance, keyboard navigation

**Next Steps:**
1. Update theme.json with new color palette and fonts
2. Update colors.css to wrap theme.json values
3. Update tailwind.css with animations and utilities
4. Install dependencies (Lucide, Chart.js)
5. Create component patterns
6. Create template pages
7. Implement inbox logic
8. Test thoroughly

**Reference Design:**
- Source: `src/_raw_example/design.html`
- Live Preview: Open design.html in browser to see all components in action

---

**Version History:**
- v1.0.0 (2025-11-04): Initial comprehensive style guide
