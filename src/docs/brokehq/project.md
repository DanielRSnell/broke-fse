# BrokeHQ Project Specification

> A mini Linear-style project management system for WordPress that capitalizes on local development workflow with markdown sync, providing clients with public/private access to projects, tasks, and comments.

**Version:** 1.0.0
**Status:** In Development
**Branch:** `brokehq`
**Created:** 2025-01-26

---

## Table of Contents

1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Data Model](#data-model)
4. [Custom Post Types](#custom-post-types)
5. [Taxonomies](#taxonomies)
6. [ACF Field Groups](#acf-field-groups)
7. [User Relationships](#user-relationships)
8. [Access Control](#access-control)
9. [Content Collections](#content-collections)
10. [Context Filters](#context-filters)
11. [Comments System](#comments-system)
12. [Workflow](#workflow)
13. [Implementation Phases](#implementation-phases)

---

## Overview

### Goals

- **Local-First Development:** Leverage markdown-based content collections for version control
- **Client Access:** Provide public/private project visibility for clients
- **Team Collaboration:** Assign users to projects and tasks
- **Company Management:** Organize projects by company/organization
- **Git-Friendly:** All data syncs bidirectionally with markdown files

### Key Features

- ✅ Projects with status tracking
- ✅ Tasks assigned to users within projects
- ✅ Company/organization management
- ✅ Public/private/company-only visibility controls
- ✅ WordPress native comments + Tiptap frontend editor
- ✅ Markdown sync for all post types
- ✅ Context-based data access (MVC pattern)
- ✅ Standard WordPress user roles

---

## Architecture

### Technology Stack

- **WordPress:** 6.0+ (FSE theme)
- **ACF:** Advanced Custom Fields (for post types, taxonomies, field groups)
- **Timber/Twig:** MVC templating
- **Content Collections:** Markdown sync system (bidirectional)
- **Comments:** WordPress native backend + Tiptap frontend editor
- **User Roles:** Standard WordPress roles

### Design Principles

1. **MVC Pattern:** Context filters for data, Twig templates for presentation
2. **ACF-First:** All custom fields, post types, and taxonomies via ACF UI
3. **Git-Friendly:** ACF JSON + markdown content for version control
4. **Bidirectional Sync:** Edit in WordPress OR markdown files
5. **Access Control:** Visibility filtering via context filters
6. **No Custom Roles:** Use existing WordPress roles (admin, editor, author, etc.)

---

## Data Model

### Entity Relationship Diagram

```
┌─────────────────┐
│     Company     │
│  (Post Type)    │
└────────┬────────┘
         │
         │ has many
         ▼
┌─────────────────┐         ┌─────────────────┐
│    Project      │────────▶│      User       │
│  (Post Type)    │ assigns │  (WordPress)    │
└────────┬────────┘         └─────────────────┘
         │                           │
         │ has many                  │ belongs to
         ▼                           │
┌─────────────────┐                  │
│      Task       │──────────────────┘
│  (Post Type)    │   assigned to
└─────────────────┘

┌─────────────────┐
│     Status      │
│  (Taxonomy)     │
│                 │
│ Applies to:     │
│ - Projects      │
│ - Tasks         │
└─────────────────┘
```

### Relationships

| Entity | Relationship | Entity | Type |
|--------|--------------|--------|------|
| Company | has many | Projects | 1:N |
| Company | has many | Users | 1:N |
| Project | has many | Tasks | 1:N |
| Project | assigned to | Users | N:M |
| Project | belongs to | Company | N:1 |
| Project | has | Status | N:1 |
| Task | belongs to | Project | N:1 |
| Task | assigned to | User | N:1 |
| Task | has | Status | N:1 |
| User | belongs to | Company | N:1 |

---

## Custom Post Types

### 1. Project

**Slug:** `project`
**Labels:** Projects / Project
**Hierarchical:** No
**Supports:** title, editor, comments, thumbnail
**Show in REST:** Yes
**Has Archive:** Yes
**Menu Icon:** dashicons-portfolio

**Description:** Main project container that holds tasks, tracks progress, and manages team assignments.

---

### 2. Task

**Slug:** `task`
**Labels:** Tasks / Task
**Hierarchical:** No
**Supports:** title, editor, comments
**Show in REST:** Yes
**Has Archive:** Yes
**Menu Icon:** dashicons-list-view

**Description:** Individual work items within a project, assigned to specific users with due dates and priorities.

---

### 3. Company

**Slug:** `company`
**Labels:** Companies / Company
**Hierarchical:** No
**Supports:** title, editor, thumbnail
**Show in REST:** Yes
**Has Archive:** Yes
**Menu Icon:** dashicons-building

**Description:** Organization or client that owns projects and has team members.

---

## Taxonomies

### Status

**Slug:** `status`
**Labels:** Statuses / Status
**Hierarchical:** Yes (allows parent/child relationships)
**Show in REST:** Yes
**Applies to:** `project`, `task`

**Default Terms for Projects:**
- Planning
- In Progress
- On Hold
- Completed
- Archived

**Default Terms for Tasks:**
- To Do
- In Progress
- Review
- Done
- Blocked

---

## ACF Field Groups

### Project Details

**Location Rules:** Post Type is equal to `project`

| Field Name | Field Type | Settings | Description |
|------------|------------|----------|-------------|
| `company` | Post Object | Post Type: company, Required: Yes | Company that owns this project |
| `assigned_users` | User | Multiple: Yes, Allow Null: Yes | Team members assigned to project |
| `project_manager` | User | Multiple: No, Required: Yes | Primary project manager |
| `start_date` | Date Picker | Display Format: F j, Y, Return Format: Y-m-d | Project start date |
| `deadline` | Date Picker | Display Format: F j, Y, Return Format: Y-m-d | Project deadline |
| `visibility` | Select | Choices: Public, Company Only, Assigned Users Only | Who can view this project |

---

### Task Details

**Location Rules:** Post Type is equal to `task`

| Field Name | Field Type | Settings | Description |
|------------|------------|----------|-------------|
| `parent_project` | Post Object | Post Type: project, Required: Yes | Project this task belongs to |
| `assigned_to` | User | Multiple: No, Allow Null: Yes | User assigned to this task |
| `priority` | Select | Choices: Low, Medium, High, Urgent, Default: Medium | Task priority level |
| `due_date` | Date Picker | Display Format: F j, Y, Return Format: Y-m-d | Task due date |
| `estimated_hours` | Number | Min: 0, Step: 0.25 | Estimated time to complete |
| `actual_hours` | Number | Min: 0, Step: 0.25 | Actual time spent |

---

### Company Details

**Location Rules:** Post Type is equal to `company`

| Field Name | Field Type | Settings | Description |
|------------|------------|----------|-------------|
| `website` | URL | - | Company website URL |
| `contact_email` | Email | Required: Yes | Primary contact email |
| `team_members` | User | Multiple: Yes, Allow Null: Yes | Users who belong to this company |
| `logo` | Image | Return Format: ID | Company logo |

---

### User Company Assignment

**Location Rules:** User Form is equal to `All`

| Field Name | Field Type | Settings | Description |
|------------|------------|----------|-------------|
| `company` | Post Object | Post Type: company, Allow Null: Yes | Company this user belongs to |
| `job_title` | Text | - | User's job title |

---

## User Relationships

### User → Company

- **Field:** `company` (on user profile)
- **Type:** Post Object (single)
- **Purpose:** Associates user with a company
- **Usage:** Filter projects by user's company

### Project → Users

- **Field:** `assigned_users` (on project)
- **Type:** User (multiple)
- **Purpose:** Team members working on project
- **Usage:** Determine who can access project

### Project → User (Manager)

- **Field:** `project_manager` (on project)
- **Type:** User (single)
- **Purpose:** Primary project owner/manager
- **Usage:** Special permissions for project management

### Task → User

- **Field:** `assigned_to` (on task)
- **Type:** User (single)
- **Purpose:** Person responsible for task
- **Usage:** User's task list, notifications

### Company → Users

- **Field:** `team_members` (on company)
- **Type:** User (multiple)
- **Purpose:** All users in organization
- **Usage:** Company roster, team pages

---

## Access Control

### Visibility Levels

#### Public
- **Who can view:** Everyone (including logged-out users)
- **Use case:** Public projects, marketing sites, open-source projects

#### Company Only
- **Who can view:** Users in the same company
- **Logic:** `user.company == project.company`
- **Use case:** Internal company projects

#### Assigned Users Only
- **Who can view:** Project manager + assigned users
- **Logic:** `user in project.assigned_users OR user == project.project_manager`
- **Use case:** Confidential projects, client work

### Task Visibility Inheritance

Tasks inherit visibility from parent project:
- If user can view parent project → can view task
- **Exception:** Assigned user can always view their task

### Permission Checks

**Can View Project:**
```php
function can_view_project($project, $user) {
    $visibility = $project->meta('visibility');

    if ($visibility === 'public') {
        return true;
    }

    if (!$user->ID) {
        return false; // Not logged in
    }

    if ($visibility === 'company') {
        $user_company = get_field('company', 'user_' . $user->ID);
        $project_company = $project->meta('company');
        return $user_company == $project_company;
    }

    if ($visibility === 'assigned') {
        $assigned = $project->meta('assigned_users');
        $manager = $project->meta('project_manager');
        return in_array($user->ID, $assigned) || $user->ID == $manager;
    }

    return false;
}
```

**Can Edit Project:**
```php
function can_edit_project($project, $user) {
    // WordPress capabilities
    if (current_user_can('edit_others_posts')) {
        return true; // Admin/Editor
    }

    // Project manager
    $manager = $project->meta('project_manager');
    if ($user->ID == $manager) {
        return true;
    }

    return false;
}
```

---

## Content Collections

### Directory Structure

```
src/content/
├── projects/
│   ├── website-redesign.md
│   └── mobile-app.md
├── tasks/
│   ├── design-mockups.md
│   ├── api-integration.md
│   └── user-testing.md
└── companies/
    ├── acme-corp.md
    └── startup-xyz.md
```

### Markdown File Format

#### Project Example

**File:** `src/content/projects/website-redesign.md`

```markdown
---
title: "Website Redesign"
slug: "website-redesign"
status: "publish"
author: 1
date: "2025-01-20 10:00:00"
excerpt: "Complete redesign of company website with new branding"
custom_fields:
  company: 42
  assigned_users: [5, 12, 18]
  project_manager: 5
  start_date: "2025-01-20"
  deadline: "2025-03-15"
  visibility: "company"
---

## Project Overview

Complete overhaul of the existing website with focus on:
- Modern, responsive design
- Improved UX/UI
- Performance optimization
- SEO improvements

## Deliverables

1. Design mockups
2. Frontend implementation
3. CMS integration
4. Testing and launch
```

#### Task Example

**File:** `src/content/tasks/design-mockups.md`

```markdown
---
title: "Create Design Mockups"
slug: "design-mockups"
status: "publish"
author: 1
date: "2025-01-21 09:00:00"
custom_fields:
  parent_project: 85  # Project post ID
  assigned_to: 12
  priority: "High"
  due_date: "2025-02-05"
  estimated_hours: 16
  actual_hours: 0
---

## Task Description

Create high-fidelity mockups for:
- Homepage
- About page
- Services pages
- Contact page

Use Figma for all designs.
```

#### Company Example

**File:** `src/content/companies/acme-corp.md`

```markdown
---
title: "Acme Corporation"
slug: "acme-corp"
status: "publish"
author: 1
date: "2025-01-15 10:00:00"
custom_fields:
  website: "https://acmecorp.com"
  contact_email: "projects@acmecorp.com"
  team_members: [5, 12, 18, 24]
  logo: 156  # Image ID
---

## About

Acme Corporation is a leading provider of innovative solutions.

## Services

- Web development
- Mobile apps
- Consulting
```

### Sync Commands

**Pull from WordPress to Markdown:**
```bash
npm run content:pull

# Or specific post type
wp content pull --post_type=project
wp content pull --post_type=task
wp content pull --post_type=company
```

**Push from Markdown to WordPress:**
```bash
npm run content:push

# Or specific file
wp content push src/content/projects/website-redesign.md
```

### Field Casting

ACF field types are automatically cast during sync:

| ACF Type | Markdown Type | Example |
|----------|---------------|---------|
| Number | Integer/Float | `estimated_hours: 16` |
| True/False | Boolean | `featured: true` |
| Post Object | Post ID | `company: 42` |
| User | User ID | `assigned_to: 5` |
| Repeater | Array | `items: [{...}]` |
| Date Picker | String | `due_date: "2025-02-05"` |

---

## Context Filters

### Overview

Context filters provide data to templates following MVC pattern. All filters are auto-loaded from `src/context/*.php`.

### 1. BrokeHQ User Context

**File:** `src/context/brokehq-user.php`

**Provides:**
- `user_company` - Current user's company (Timber Post object)
- `user_company_id` - Current user's company ID
- `is_company_member` - Boolean if user belongs to a company
- `user_job_title` - User's job title

**Usage in Templates:**
```twig
{% if user_company %}
  <p>Company: {{ user_company.title }}</p>
{% endif %}
```

---

### 2. BrokeHQ Projects Context

**File:** `src/context/brokehq-projects.php`

**Provides:**
- `my_projects` - Projects assigned to current user
- `company_projects` - Projects from user's company
- `accessible_projects` - All projects user can view (filtered by visibility)
- `active_projects` - Projects with "In Progress" status
- `project_statuses` - All status terms for projects

**Usage in Templates:**
```twig
<div loopsource="my_projects" loopvariable="project">
  <h3>{{ project.title }}</h3>
  <p>Status: {{ project.terms('status')[0].name }}</p>
</div>
```

---

### 3. BrokeHQ Tasks Context

**File:** `src/context/brokehq-tasks.php`

**Provides:**
- `my_tasks` - Tasks assigned to current user
- `my_tasks_by_priority` - Tasks grouped by priority
- `overdue_tasks` - Tasks past due date
- `upcoming_tasks` - Tasks due within 7 days
- `task_statuses` - All status terms for tasks

**Usage in Templates:**
```twig
<div loopsource="overdue_tasks" loopvariable="task">
  <h4>{{ task.title }}</h4>
  <p>Due: {{ task.meta('due_date')|date('F j, Y') }}</p>
  <span class="priority-{{ task.meta('priority')|lower }}">
    {{ task.meta('priority') }}
  </span>
</div>
```

---

### 4. BrokeHQ Access Control

**File:** `src/context/brokehq-access.php`

**Provides:**
- `can_view_project($project_id)` - Function to check project access
- `can_edit_project($project_id)` - Function to check edit permissions
- `can_view_task($task_id)` - Function to check task access

**Usage in Templates:**
```twig
<div conditionalvisibility="true" conditionalexpression="can_view_project(project.ID)">
  <!-- Project details -->
</div>
```

---

## Comments System

### Backend: WordPress Native

- Use WordPress core comment system
- Enable for all BrokeHQ post types
- Support threading/nested comments
- Use WordPress comment moderation

### Frontend: Tiptap Editor

**Implementation (Deferred to UI Phase):**
- React/Vue component with Tiptap editor
- Rich text formatting (bold, italic, lists, links)
- Mentions (@user)
- File attachments
- Real-time preview
- Submit via REST API

**REST API Endpoints:**
```
POST /wp-json/wp/v2/comments
GET  /wp-json/wp/v2/comments?post=<id>
PUT  /wp-json/wp/v2/comments/<id>
DELETE /wp-json/wp/v2/comments/<id>
```

---

## Workflow

### Creating a Project (WordPress Admin)

1. Navigate to **Projects → Add New**
2. Enter project title and description
3. Select **Company**
4. Assign **Project Manager**
5. Assign **Team Members** (assigned_users)
6. Set **Start Date** and **Deadline**
7. Choose **Visibility** level
8. Select **Status** (Planning, In Progress, etc.)
9. Publish project

### Creating a Project (Markdown)

1. Create file: `src/content/projects/my-project.md`
2. Add YAML frontmatter with all fields
3. Write content in markdown
4. Run: `npm run content:push`
5. Project appears in WordPress admin

### Assigning a Task

1. Create task in WordPress or markdown
2. Set **Parent Project**
3. Assign **User** (assigned_to)
4. Set **Priority** and **Due Date**
5. Estimate hours
6. Publish task

### User Dashboard View

1. User logs in
2. Context filters load:
   - `my_projects` - Projects user is assigned to
   - `my_tasks` - Tasks assigned to user
   - `user_company` - User's company
3. Dashboard displays filtered data
4. User can only see projects they have access to (visibility rules)

### Syncing Workflow

**WordPress → Markdown:**
```bash
# Make changes in WordPress admin
npm run content:pull
git add src/content/
git commit -m "Update projects from WordPress"
```

**Markdown → WordPress:**
```bash
# Edit markdown files
npm run content:push
# Changes appear in WordPress
```

---

## Implementation Phases

### Phase 1: Foundation ✓

- [x] Create `brokehq` branch
- [x] Create `src/docs/brokehq/project.md`
- [ ] Document full specification (this file)

### Phase 2: ACF Setup

- [ ] Create post types via ACF UI (project, task, company)
- [ ] Create status taxonomy via ACF UI
- [ ] Create default status terms
- [ ] Commit ACF JSON files

### Phase 3: Field Groups

- [ ] Create Project Details field group
- [ ] Create Task Details field group
- [ ] Create Company Details field group
- [ ] Create User Company field group
- [ ] Commit ACF JSON files

### Phase 4: Content Collections

- [ ] Create `src/content/projects/` directory
- [ ] Create `src/content/tasks/` directory
- [ ] Create `src/content/companies/` directory
- [ ] Create sample data in WordPress
- [ ] Test `npm run content:pull`
- [ ] Verify markdown structure
- [ ] Test `npm run content:push`
- [ ] Commit content structure

### Phase 5: Context Filters

- [ ] Create `src/context/brokehq-user.php`
- [ ] Create `src/context/brokehq-projects.php`
- [ ] Create `src/context/brokehq-tasks.php`
- [ ] Create `src/context/brokehq-access.php`
- [ ] Test context data in templates
- [ ] Commit context filters

### Phase 6: Access Control

- [ ] Implement visibility filtering
- [ ] Test public projects
- [ ] Test company-only projects
- [ ] Test assigned-users-only projects
- [ ] Verify task visibility inheritance
- [ ] Create test user scenarios

### Phase 7: Comments Setup

- [ ] Enable comments for all CPTs
- [ ] Test WordPress native comments
- [ ] Document Tiptap integration requirements
- [ ] (Deferred) Implement Tiptap frontend

### Phase 8: Testing & Validation

- [ ] Create test scenarios documentation
- [ ] Test with multiple users and companies
- [ ] Validate markdown sync workflow
- [ ] Test access control edge cases
- [ ] Document known issues/limitations

### Phase 9: UI/UX (Deferred)

- [ ] Design direction provided
- [ ] Create dashboard templates
- [ ] Create project list/detail templates
- [ ] Create task board templates
- [ ] Integrate Tiptap editor
- [ ] Style components

---

## Technical Notes

### Auto-Detection

- **Post type auto-detected** from directory name in `src/content/`
- **Context filters auto-loaded** from `src/context/*.php`
- **ACF field casting automatic** based on field type

### Best Practices

1. **Use context filters** for ALL data fetching (MVC pattern)
2. **Avoid template helpers** (`fun.*`, `timber.*`) - emergency only
3. **Use Timber objects** - `{{ post.meta('field') }}` not `{{ fun.get_field() }}`
4. **Commit ACF JSON** to version control
5. **Sync bidirectionally** - WordPress ↔ markdown
6. **Test access control** with different users

### Limitations

- Native WordPress comment system (no real-time until Tiptap integration)
- Standard user roles only (no custom capabilities initially)
- Markdown sync is manual (not real-time)
- Visibility filtering happens in PHP (not database-level)

---

## Resources

- **ACF Documentation:** https://www.advancedcustomfields.com/resources/
- **Timber Documentation:** https://timber.github.io/docs/
- **Tiptap Documentation:** https://tiptap.dev/
- **WordPress REST API:** https://developer.wordpress.org/rest-api/

---

**Version:** 1.0.0
**Last Updated:** 2025-01-26
**Status:** In Development
