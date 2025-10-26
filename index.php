<?php
require_once __DIR__ . '/app/data.php';
require_once __DIR__ . '/app/functions.php';
require_once __DIR__ . '/app/view_functions.php';

$page = $_GET['page'] ?? 'home';

$filterDifficulty = $_GET['difficulty'] ?? null;
$filterCategory = $_GET['category'] ?? null;

$submitted = null;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($page === 'submit')) {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $difficulty = trim($_POST['difficulty'] ?? '');
    $portion = trim($_POST['portion'] ?? '');

    $allowedCategories = get_allowed_categories();
    $allowedDifficulties = ['könnyű','közepes','nehéz'];

    if (strlen($name) < 3) $errors[] = 'A név kötelező, legalább 3 karakter.';
    if (!in_array($category, $allowedCategories, true)) $errors[] = 'Érvénytelen kategória.';
    if (!ctype_digit($time) || (int)$time <= 0 || (int)$time > 500) $errors[] = 'Az elkészítési idő legyen pozitív szám (max 500).';
    if (!in_array($difficulty, $allowedDifficulties, true)) $errors[] = 'Érvénytelen nehézségi szint.';
    if (!ctype_digit($portion) || (int)$portion < 1 || (int)$portion > 20) $errors[] = 'Az adag 1 és 20 között lehet.';

    if (empty($errors)) {
        $submitted = [
            'id' => uniqid('tmp_'),
            'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'category' => $category,
            'time' => (int)$time,
            'difficulty' => $difficulty,
            'portion' => (int)$portion,
        ];
    }
}

$recipes = get_all_recipes();

if ($filterDifficulty) {
    $recipes = filter_recipes_by_difficulty($filterDifficulty, $recipes);
}
if ($filterCategory) {
    $recipes = filter_recipes_by_category($filterCategory, $recipes);
}

$stats = [
    'total' => count(get_all_recipes()),
    'categories' => count(array_unique(array_map(function($r){return $r['category'];}, get_all_recipes()))),
    'avg_time' => get_average_cooking_time(),
    'hard_count' => count(filter_recipes_by_difficulty('nehéz', get_all_recipes())),
];

include __DIR__ . '/view/partials/header.template.php';
switch ($page) {
    case 'recipes':
        include __DIR__ . '/view/pages/recipes.template.php';
        break;
    case 'submit':
        include __DIR__ . '/view/pages/submit.template.php';
        break;
    case 'home':
    default:
        include __DIR__ . '/view/pages/home.template.php';
        break;
}
include __DIR__ . '/view/partials/footer.template.php';
?>