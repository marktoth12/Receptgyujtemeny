<?php
function render_difficulty_badge(string $difficulty): string {
    $d = mb_strtolower($difficulty);
    $icon = '•';
    $class = 'text-sm px-2 py-1 rounded-full';
    switch ($d) {
        case 'könnyű':
            $icon = '🌿';
            $bg = 'bg-green-100';
            $text = 'text-green-800';
            break;
        case 'közepes':
            $icon = '⚖️';
            $bg = 'bg-yellow-100';
            $text = 'text-yellow-800';
            break;
        case 'nehéz':
            $icon = '🔥';
            $bg = 'bg-red-100';
            $text = 'text-red-800';
            break;
        default:
            $bg = 'bg-gray-100';
            $text = 'text-gray-800';
    }
    return "<span class=\"$class $bg $text\">$icon " . htmlspecialchars($difficulty, ENT_QUOTES, 'UTF-8') . "</span>";
}

function format_cooking_time(int $minutes): string {
    if ($minutes < 60) return $minutes . ' perc';
    $h = intdiv($minutes, 60);
    $m = $minutes % 60;
    if ($m === 0) return $h . ' óra';
    return $h . ' óra ' . $m . ' perc';
}

function render_recipe_card(array $r): string {
    $time = format_cooking_time((int)$r['time']);
    $badge = render_difficulty_badge($r['difficulty']);
    $categoryClass = category_color_class($r['category']);
    return "<div class=\"p-4 bg-white rounded-lg shadow\">\n            <h3 class=\"text-lg font-semibold\">" . htmlspecialchars($r['name'], ENT_QUOTES, 'UTF-8') . "</h3>\n            <p class=\"text-sm mt-1 $categoryClass\">" . htmlspecialchars($r['category'], ENT_QUOTES, 'UTF-8') . "</p>\n            <div class=\"mt-2\">$badge <span class=\"ml-2 text-sm\">$time • Adag: " . intval($r['portion']) . "</span></div>\n        </div>";
}

function category_color_class(string $category): string {
    $c = mb_strtolower($category);
    switch ($c) {
        case 'előétel': return 'text-indigo-600';
        case 'leves': return 'text-blue-600';
        case 'főétel': return 'text-red-600';
        case 'köret': return 'text-pink-600';
        case 'saláta': return 'text-green-600';
        case 'desszert': return 'text-yellow-600';
        case 'sütemény': return 'text-purple-600';
        case 'ital': return 'text-teal-600';
        default: return 'text-gray-600';
    }
}
?>