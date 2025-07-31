<?php
// /admin/plugins.php
require_once __DIR__ . '/functions.php';

$plugin_data = get_plugin_data();
$plugin_files = $plugin_data['plugin_files'];
$plugin_registry = $plugin_data['plugin_registry'];
$plugin_dir = $plugin_data['plugin_dir'];
$registry_file = $plugin_data['registry_file'];

// Handle enable/disable
if (isset($_GET['toggle'])) {
    $slug = basename($_GET['toggle']);
    if (isset($plugin_registry[$slug])) {
        $plugin_registry[$slug]['enabled'] = !$plugin_registry[$slug]['enabled'];
        save_plugin_registry($plugin_registry);
        header("Location: /admin/plugins");
        exit;
    }
}

// Handle install
if (isset($_GET['install'])) {
    $slug = basename($_GET['install']);
    if (!isset($plugin_registry[$slug])) {
        $plugin_registry[$slug] = ['installed' => true, 'enabled' => false];
        save_plugin_registry($plugin_registry);
        header("Location: /admin/plugins");
        exit;
    }
}

// Handle uninstall
if (isset($_GET['uninstall'])) {
    $slug = basename($_GET['uninstall']);
    if (isset($plugin_registry[$slug])) {
        unset($plugin_registry[$slug]);
        save_plugin_registry($plugin_registry);
        header("Location: /admin/plugins");
        exit;
    }
}

echo "<h2>Plugin Manager</h2>";
echo "<p>These tools extend or enhance your CMS.</p>";
echo "<p><a href='/admin'>&larr; Return to Site Admin</a></p>";

foreach ($plugin_files as $file) {
    $slug = basename(dirname($file));
    $meta = [
        'name' => 'Unknown Plugin',
        'version' => 'vN/A',
        'description' => 'No description provided.',
        'author' => 'Unknown',
        'license' => 'N/A'
    ];

    include_once $file;
    if (function_exists('plugin_metadata')) {
        $plugin_meta = plugin_metadata();
        $meta = array_merge($meta, $plugin_meta);
    }

    $installed = isset($plugin_registry[$slug]['installed']) && $plugin_registry[$slug]['installed'];
    $enabled = isset($plugin_registry[$slug]['enabled']) && $plugin_registry[$slug]['enabled'];

    $status = $installed ? ($enabled ? 'Enabled' : 'Disabled') : 'Not Installed';
    $action_links = [];

    if (!$installed) {
        $action_links[] = "<a href='/admin/plugins?install=$slug'>Install</a>";
    } else {
        $action_links[] = "<a href='/admin/plugins?toggle=$slug'>" . ($enabled ? 'Disable' : 'Enable') . "</a>";
        $action_links[] = "<a href='/admin/plugins?uninstall=$slug' onclick='return confirm(\"Are you sure you want to uninstall $slug?\")'>Uninstall</a>";
    }

    echo "<div style='margin-bottom: 2em;'>";
    echo "<strong>{$meta['name']} {$meta['version']}</strong><br>";
    echo "<em>{$meta['description']}</em><br>";
    echo "<small>By {$meta['author']} – {$meta['license']}</small><br>";
    echo "Status: <strong>$status</strong> – " . implode(' | ', $action_links);
    echo "</div>";
}