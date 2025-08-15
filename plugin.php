<?php
/**
 * Plugin Name: Pixks - Questions Game Elements
 * Description: A set of Breakdance elements supporting the creation of an interactive game based on QR codes.
 * Author: Pixks
 * License: GPLv2
 * Version: 0.0.4
 * Requires Plugins: breakdance
 */

namespace PixksQuestionsGameElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

// ⬇️ PUC v5 (Plugin Update Checker) – przestrzenie nazw
require __DIR__ . '/includes/plugin-update-checker-5.6/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// is_plugin_active wymaga tego pliku:
if ( ! function_exists('\is_plugin_active') ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

add_action('breakdance_loaded', function () {
    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'PixksQuestionsGameElements',
        'element',
        'Pixks - Questions Game Elements',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'BreakdanceCustomElements',
        'macro',
        'Pixks - Questions Game Macros',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'PixksQuestionsGameElements',
        'preset',
        'Pixks - Questions Game Presets',
        false
    );
}, 9);

// Info o brakujących zależnościach
add_action('admin_notices', function () {
    if ( !\is_plugin_active('breakdance/plugin.php') ) {
        echo '<div class="notice notice-error"><p><strong>ZHP Starter Kit:</strong> Zainstaluj i aktywuj wymagane wtyczki: Breakdance i ZHP Custom Elements.</p></div>';
    }
});

/**
 * AUTO-AKTUALIZACJE z GitHuba (publiczne repo)
 * ────────────────────────────────────────────
 * UWAGA: trzeci argument MUSI być identyczny jak NAZWA FOLDERU wtyczki,
 * np. jeśli folder to `wp-content/plugins/pixks-questions-game-elements/`
 * to wpisz dokładnie 'pixks-questions-game-elements'.
 */
$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/Pixks/Questions-Game-Elements',
    __FILE__,
    'pixks_questions-game-elements' // ← PODMIEŃ na dokładny slug folderu wtyczki
);
$updateChecker->setBranch('main');
