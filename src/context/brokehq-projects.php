<?php
/**
 * BrokeHQ Projects Context Filter
 *
 * Provides project-specific data for BrokeHQ:
 * - my_projects: Projects assigned to current user
 * - company_projects: Projects from user's company
 * - accessible_projects: All projects user can view (filtered by visibility)
 * - active_projects: Projects with "In Progress" status
 * - project_statuses: All status terms for projects
 *
 * @package BrokeHQ
 */

use Timber\Timber;

add_filter('timber/context', function ($context) {
    $user_id = get_current_user_id();

    // Only load project data on relevant pages
    if (is_post_type_archive('project') || is_singular('project') || is_page('dashboard')) {
        // Get all status terms for projects
        $context['project_statuses'] = Timber::get_terms([
            'taxonomy' => 'status',
            'hide_empty' => false
        ]);

        if ($user_id) {
            // Projects assigned to current user
            $context['my_projects'] = Timber::get_posts([
                'post_type' => 'project',
                'posts_per_page' => -1,
                'meta_query' => [
                    'relation' => 'OR',
                    [
                        'key' => 'assigned_users',
                        'value' => serialize(strval($user_id)),
                        'compare' => 'LIKE'
                    ],
                    [
                        'key' => 'project_manager',
                        'value' => $user_id,
                        'compare' => '='
                    ]
                ]
            ]);

            // Projects from user's company
            $user_company_id = get_field('company', 'user_' . $user_id);
            if ($user_company_id) {
                $context['company_projects'] = Timber::get_posts([
                    'post_type' => 'project',
                    'posts_per_page' => -1,
                    'meta_key' => 'company',
                    'meta_value' => $user_company_id
                ]);
            } else {
                $context['company_projects'] = [];
            }

            // Active projects (In Progress status)
            $in_progress_term = get_term_by('slug', 'in-progress', 'status');
            if ($in_progress_term) {
                $context['active_projects'] = Timber::get_posts([
                    'post_type' => 'project',
                    'posts_per_page' => -1,
                    'tax_query' => [
                        [
                            'taxonomy' => 'status',
                            'field' => 'term_id',
                            'terms' => $in_progress_term->term_id
                        ]
                    ]
                ]);
            } else {
                $context['active_projects'] = [];
            }

            // Accessible projects (filtered by visibility)
            // This will be populated by the access control filter
            $context['accessible_projects'] = [];
        } else {
            // Guest user - only show public projects
            $context['my_projects'] = [];
            $context['company_projects'] = [];
            $context['active_projects'] = [];
            $context['accessible_projects'] = Timber::get_posts([
                'post_type' => 'project',
                'posts_per_page' => -1,
                'meta_key' => 'visibility',
                'meta_value' => 'public'
            ]);
        }
    }

    return $context;
});
