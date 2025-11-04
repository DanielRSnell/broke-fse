<?php
/**
 * BrokeHQ User Context Filter
 *
 * Provides user-specific data for BrokeHQ:
 * - user_company: Current user's company (Timber Post object)
 * - user_company_id: Current user's company ID
 * - is_company_member: Boolean if user belongs to a company
 * - user_job_title: User's job title
 *
 * @package BrokeHQ
 */

use Timber\Timber;

add_filter('timber/context', function ($context) {
    // Get current user
    $user = wp_get_current_user();

    if ($user->ID) {
        // Get user's company ID
        $company_id = get_field('company', 'user_' . $user->ID);

        if ($company_id) {
            // Add company data to context
            $context['user_company'] = Timber::get_post($company_id);
            $context['user_company_id'] = $company_id;
            $context['is_company_member'] = true;
        } else {
            $context['user_company'] = null;
            $context['user_company_id'] = null;
            $context['is_company_member'] = false;
        }

        // Get user's job title
        $context['user_job_title'] = get_field('job_title', 'user_' . $user->ID) ?: '';
    } else {
        // Guest user (not logged in)
        $context['user_company'] = null;
        $context['user_company_id'] = null;
        $context['is_company_member'] = false;
        $context['user_job_title'] = '';
    }

    return $context;
});
