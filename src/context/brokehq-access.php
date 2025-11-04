<?php
/**
 * BrokeHQ Access Control Filter
 *
 * Implements visibility filtering and access control for projects and tasks.
 *
 * Provides helper functions:
 * - can_view_project($project_id): Check if user can view a project
 * - can_edit_project($project_id): Check if user can edit a project
 * - can_view_task($task_id): Check if user can view a task
 *
 * @package BrokeHQ
 */

use Timber\Timber;

/**
 * Check if current user can view a project
 *
 * @param int $project_id Project post ID
 * @return bool
 */
function brokehq_can_view_project($project_id) {
    if (!$project_id) {
        return false;
    }

    $project = Timber::get_post($project_id);
    if (!$project) {
        return false;
    }

    $visibility = $project->meta('visibility');
    $user = wp_get_current_user();

    // Public projects are visible to everyone
    if ($visibility === 'public') {
        return true;
    }

    // Not logged in and not public
    if (!$user->ID) {
        return false;
    }

    // Company-only visibility
    if ($visibility === 'company') {
        $user_company = get_field('company', 'user_' . $user->ID);
        $project_company = $project->meta('company');
        return $user_company == $project_company;
    }

    // Assigned users only
    if ($visibility === 'assigned') {
        $assigned_users = $project->meta('assigned_users');
        $project_manager = $project->meta('project_manager');

        // Check if user is project manager
        if ($user->ID == $project_manager) {
            return true;
        }

        // Check if user is in assigned users
        if (is_array($assigned_users) && in_array($user->ID, $assigned_users)) {
            return true;
        }
    }

    // Admins and editors can view all projects
    if (current_user_can('edit_others_posts')) {
        return true;
    }

    return false;
}

/**
 * Check if current user can edit a project
 *
 * @param int $project_id Project post ID
 * @return bool
 */
function brokehq_can_edit_project($project_id) {
    if (!$project_id) {
        return false;
    }

    $user = wp_get_current_user();

    if (!$user->ID) {
        return false;
    }

    // Admins and editors can edit all projects
    if (current_user_can('edit_others_posts')) {
        return true;
    }

    $project = Timber::get_post($project_id);
    if (!$project) {
        return false;
    }

    // Project manager can edit
    $project_manager = $project->meta('project_manager');
    if ($user->ID == $project_manager) {
        return true;
    }

    return false;
}

/**
 * Check if current user can view a task
 *
 * Tasks inherit visibility from parent project.
 * Exception: Assigned user can always view their task.
 *
 * @param int $task_id Task post ID
 * @return bool
 */
function brokehq_can_view_task($task_id) {
    if (!$task_id) {
        return false;
    }

    $task = Timber::get_post($task_id);
    if (!$task) {
        return false;
    }

    $user = wp_get_current_user();

    // Assigned user can always view their task
    $assigned_to = $task->meta('assigned_to');
    if ($user->ID && $user->ID == $assigned_to) {
        return true;
    }

    // Admins and editors can view all tasks
    if (current_user_can('edit_others_posts')) {
        return true;
    }

    // Check parent project visibility
    $parent_project_id = $task->meta('parent_project');
    if ($parent_project_id) {
        return brokehq_can_view_project($parent_project_id);
    }

    return false;
}

/**
 * Filter accessible projects based on user permissions
 *
 * Adds to context: accessible_projects
 */
add_filter('timber/context', function ($context) {
    $user_id = get_current_user_id();

    // Only on project-related pages
    if (is_post_type_archive('project') || is_singular('project') || is_page('dashboard')) {
        // Get all projects
        $all_projects = Timber::get_posts([
            'post_type' => 'project',
            'posts_per_page' => -1
        ]);

        // Filter by access
        $accessible = [];
        foreach ($all_projects as $project) {
            if (brokehq_can_view_project($project->ID)) {
                $accessible[] = $project;
            }
        }

        $context['accessible_projects'] = $accessible;

        // Add helper functions to context for use in templates
        $context['can_view_project'] = 'brokehq_can_view_project';
        $context['can_edit_project'] = 'brokehq_can_edit_project';
        $context['can_view_task'] = 'brokehq_can_view_task';
    }

    return $context;
}, 20); // Run after other BrokeHQ filters
