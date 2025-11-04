# BrokeHQ Setup Guide

**Branch:** `brokehq`
**Status:** Foundation Complete - Ready for WordPress Sync
**Date:** 2025-01-26

---

## What's Been Implemented

### ✅ Phase 1: Foundation
- [x] Created `brokehq` feature branch
- [x] Comprehensive project documentation (`src/docs/brokehq/project.md`)
- [x] Data model, ERD, and architecture specification

### ✅ Phase 2: ACF Post Types & Taxonomy
- [x] `post_type_project.json` - Project post type
- [x] `post_type_task.json` - Task post type
- [x] `post_type_company.json` - Company post type
- [x] `taxonomy_status.json` - Status taxonomy (shared)

### ✅ Phase 3: ACF Field Groups
- [x] `group_project_details.json` - Project fields
- [x] `group_task_details.json` - Task fields
- [x] `group_company_details.json` - Company fields
- [x] `group_user_company.json` - User company assignment

### ✅ Phase 4: Content Collections
- [x] `src/content/projects/` - Project markdown directory
- [x] `src/content/tasks/` - Task markdown directory
- [x] `src/content/companies/` - Company markdown directory

### ✅ Phase 5: Context Filters
- [x] `src/context/brokehq-user.php` - User context
- [x] `src/context/brokehq-projects.php` - Projects context
- [x] `src/context/brokehq-tasks.php` - Tasks context
- [x] `src/context/brokehq-access.php` - Access control

---

## Next Steps: Sync with WordPress

### 1. Sync ACF JSON Files

**In WordPress Admin:**

1. Navigate to **ACF → Tools**
2. Look for **"Sync Available"** section
3. You should see 8 items to sync:
   - 3 Post Types (project, task, company)
   - 1 Taxonomy (status)
   - 4 Field Groups (project details, task details, company details, user company)
4. Click **"Sync"** for each item or **"Sync All"**

**Expected Result:**
- Post types appear in WordPress admin menu
- Status taxonomy available
- Field groups show on appropriate edit screens

### 2. Create Default Status Terms

**For Projects:**

1. Navigate to **Projects → Statuses**
2. Create these terms:
   - Planning
   - In Progress
   - On Hold
   - Completed
   - Archived

**For Tasks:**

1. Same taxonomy, add these terms:
   - To Do
   - In Progress
   - Review
   - Done
   - Blocked

### 3. Create Sample Data

**Create a Company:**

1. Navigate to **Companies → Add New**
2. Title: "Acme Corporation"
3. Contact Email: "projects@acmecorp.com"
4. Website: "https://acmecorp.com"
5. Publish

**Create a Project:**

1. Navigate to **Projects → Add New**
2. Title: "Website Redesign"
3. Content: "Complete redesign of company website..."
4. Company: Select "Acme Corporation"
5. Project Manager: Select yourself
6. Assigned Users: Select yourself
7. Start Date: Today
8. Deadline: 2 months from now
9. Visibility: "Company Only"
10. Status: "In Progress"
11. Publish

**Create a Task:**

1. Navigate to **Tasks → Add New**
2. Title: "Create Design Mockups"
3. Content: "Create high-fidelity mockups..."
4. Parent Project: Select "Website Redesign"
5. Assigned To: Select yourself
6. Priority: "High"
7. Due Date: 2 weeks from now
8. Estimated Hours: 16
9. Status: "To Do"
10. Publish

### 4. Test Content Collections Sync

**Pull from WordPress:**

```bash
# From theme root
npm run content:pull

# Or via WP-CLI
wp content pull --post_type=project
wp content pull --post_type=task
wp content pull --post_type=company
```

**Check Results:**

```bash
# You should see files created
ls -la src/content/projects/
ls -la src/content/tasks/
ls -la src/content/companies/
```

**Expected Files:**
- `src/content/projects/website-redesign.md`
- `src/content/tasks/create-design-mockups.md`
- `src/content/companies/acme-corporation.md`

**Verify Markdown Structure:**

Open a file and check:
- YAML frontmatter contains all fields
- ACF fields under `custom_fields:`
- Field values properly cast (IDs as integers, arrays, etc.)
- Content is clean markdown

**Test Push Back:**

```bash
# Edit a markdown file
# Then push changes
npm run content:push
```

Verify changes appear in WordPress admin.

### 5. Assign Your User to Company

1. Navigate to **Users → Your Profile**
2. Scroll to **User Company Assignment** section
3. Company: Select "Acme Corporation"
4. Job Title: "Project Manager" (or your role)
5. Update Profile

### 6. Test Context Filters

Create a test template to verify context data:

**File:** `test-brokehq.php`

```php
<?php
/**
 * Template Name: BrokeHQ Test
 */

use Timber\Timber;

$context = Timber::context();

echo '<pre>';
echo "User Company: " . ($context['user_company'] ? $context['user_company']->title : 'None') . "\n";
echo "Is Company Member: " . ($context['is_company_member'] ? 'Yes' : 'No') . "\n";
echo "My Projects: " . count($context['my_projects'] ?? []) . "\n";
echo "Company Projects: " . count($context['company_projects'] ?? []) . "\n";
echo "My Tasks: " . count($context['my_tasks'] ?? []) . "\n";
echo "Overdue Tasks: " . count($context['overdue_tasks'] ?? []) . "\n";
echo '</pre>';
```

1. Create a page in WordPress
2. Select "BrokeHQ Test" template
3. View the page
4. You should see your context data

### 7. Test Access Control

**Create a Second User:**

1. Create user "Jane Doe" (jane@example.com)
2. Do NOT assign to company
3. Log in as Jane

**Test Visibility:**

- Jane should NOT see "Website Redesign" project (visibility: "Company Only")
- Create a public project - Jane should see it
- Create a company-only project - Jane should NOT see it

**Test with Company Member:**

1. Assign Jane to "Acme Corporation"
2. Refresh
3. Jane should NOW see company projects

---

## Testing Checklist

- [ ] ACF JSON files synced successfully
- [ ] Post types appear in admin menu (Projects, Tasks, Companies)
- [ ] Status taxonomy visible and shared
- [ ] Field groups show on edit screens
- [ ] Default status terms created
- [ ] Sample company created
- [ ] Sample project created with all fields
- [ ] Sample task created with all fields
- [ ] User profile shows company assignment
- [ ] Content pull creates markdown files
- [ ] Markdown files have proper structure
- [ ] Content push updates WordPress
- [ ] Context filters load data correctly
- [ ] `user_company` context works
- [ ] `my_projects` context works
- [ ] `my_tasks` context works
- [ ] Access control filters projects by visibility
- [ ] Public projects visible to all
- [ ] Company projects visible to company members only
- [ ] Assigned projects visible to assigned users only
- [ ] Task visibility inherits from project
- [ ] Assigned user can view their task

---

## File Structure Summary

```
broke-fse/
├── acf-json/
│   ├── post_type_project.json
│   ├── post_type_task.json
│   ├── post_type_company.json
│   ├── taxonomy_status.json
│   ├── group_project_details.json
│   ├── group_task_details.json
│   ├── group_company_details.json
│   └── group_user_company.json
├── src/
│   ├── content/
│   │   ├── projects/
│   │   ├── tasks/
│   │   └── companies/
│   ├── context/
│   │   ├── brokehq-user.php
│   │   ├── brokehq-projects.php
│   │   ├── brokehq-tasks.php
│   │   └── brokehq-access.php
│   └── docs/
│       └── brokehq/
│           ├── project.md
│           └── SETUP.md (this file)
```

---

## Available Context Variables

### User Context
- `user_company` - Timber Post object
- `user_company_id` - Integer
- `is_company_member` - Boolean
- `user_job_title` - String

### Projects Context
- `my_projects` - Array of Timber Posts
- `company_projects` - Array of Timber Posts
- `accessible_projects` - Array of Timber Posts (filtered)
- `active_projects` - Array of Timber Posts
- `project_statuses` - Array of Timber Terms

### Tasks Context
- `my_tasks` - Array of Timber Posts
- `my_tasks_by_priority` - Array grouped by priority
- `overdue_tasks` - Array of Timber Posts
- `upcoming_tasks` - Array of Timber Posts
- `task_statuses` - Array of Timber Terms

### Access Control Functions
- `brokehq_can_view_project($project_id)` - Boolean
- `brokehq_can_edit_project($project_id)` - Boolean
- `brokehq_can_view_task($task_id)` - Boolean

---

## Next Phase: UI Development

After completing setup and testing:

1. Design direction will be provided
2. Create dashboard templates
3. Create project list/detail templates
4. Create task board templates
5. Integrate Tiptap editor for comments
6. Style components with Tailwind CSS

---

## Support

- **Documentation:** `src/docs/brokehq/project.md`
- **Branch:** `brokehq`
- **Questions:** Review project.md for architecture details

---

**Version:** 1.0.0
**Status:** Foundation Complete
**Last Updated:** 2025-01-26
