<?php
/**
 * Register Pattern CLI Commands
 */

if (!defined('WP_CLI') || !WP_CLI) {
    return;
}

require_once __DIR__ . '/PatternExtractCommand.php';

WP_CLI::add_command('pattern extract', 'BlankTheme\CLI\PatternExtractCommand');
