<?php
/**
 * BrokeHQ Tasks Context Filter
 *
 * Provides task-specific data for BrokeHQ:
 * - my_tasks: Tasks assigned to current user
 * - my_tasks_by_priority: Tasks grouped by priority
 * - overdue_tasks: Tasks past due date
 * - upcoming_tasks: Tasks due within 7 days
 * - task_statuses: All status terms for tasks
 *
 * @package BrokeHQ
 */

use Timber\Timber;

add_filter('timber/context', function ($context) {
    $user_id = get_current_user_id();

    // Only load task data on relevant pages
    if (is_post_type_archive('task') || is_singular('task') || is_page('dashboard')) {
        // Get all status terms for tasks
        $context['task_statuses'] = Timber::get_terms([
            'taxonomy' => 'status',
            'hide_empty' => false
        ]);

        if ($user_id) {
            // Tasks assigned to current user
            $context['my_tasks'] = Timber::get_posts([
                'post_type' => 'task',
                'posts_per_page' => -1,
                'meta_key' => 'assigned_to',
                'meta_value' => $user_id,
                'orderby' => 'meta_value',
                'meta_key' => 'due_date',
                'order' => 'ASC'
            ]);

            // Tasks grouped by priority
            $priorities = ['urgent', 'high', 'medium', 'low'];
            $context['my_tasks_by_priority'] = [];

            foreach ($priorities as $priority) {
                $context['my_tasks_by_priority'][$priority] = Timber::get_posts([
                    'post_type' => 'task',
                    'posts_per_page' => -1,
                    'meta_query' => [
                        [
                            'key' => 'assigned_to',
                            'value' => $user_id,
                            'compare' => '='
                        ],
                        [
                            'key' => 'priority',
                            'value' => $priority,
                            'compare' => '='
                        ]
                    ]
                ]);
            }

            // Overdue tasks (past due date)
            $today = date('Y-m-d');
            $context['overdue_tasks'] = Timber::get_posts([
                'post_type' => 'task',
                'posts_per_page' => -1,
                'meta_query' => [
                    [
                        'key' => 'assigned_to',
                        'value' => $user_id,
                        'compare' => '='
                    ],
                    [
                        'key' => 'due_date',
                        'value' => $today,
                        'compare' => '<',
                        'type' => 'DATE'
                    ]
                ]
            ]);

            // Upcoming tasks (due within 7 days)
            $week_from_now = date('Y-m-d', strtotime('+7 days'));
            $context['upcoming_tasks'] = Timber::get_posts([
                'post_type' => 'task',
                'posts_per_page' => -1,
                'meta_query' => [
                    [
                        'key' => 'assigned_to',
                        'value' => $user_id,
                        'compare' => '='
                    ],
                    [
                        'key' => 'due_date',
                        'value' => [$today, $week_from_now],
                        'compare' => 'BETWEEN',
                        'type' => 'DATE'
                    ]
                ]
            ]);
        } else {
            // Guest user
            $context['my_tasks'] = [];
            $context['my_tasks_by_priority'] = [];
            $context['overdue_tasks'] = [];
            $context['upcoming_tasks'] = [];
        }
    }

    return $context;
});
