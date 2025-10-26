<?php

function get_all_recipes(): array {
    global $recipes;
    return $recipes ?? [];
}

function filter_recipes_by_difficulty(string $difficulty): array {
    global $recipes;
    $difficulty = strtolower(trim($difficulty));
    return array_filter($recipes, fn($r) => strtolower($r['difficulty']) === $difficulty);
}

function filter_recipes_by_category(string $category): array {
    global $recipes;
    $category = strtolower(trim($category));
    return array_filter($recipes, fn($r) => strtolower($r['category']) === $category);
}

function get_average_cooking_time(): float {
    global $recipes;
    if (empty($recipes)) return 0;
    $times = array_column($recipes, 'time');
    $avg = array_sum($times) / count($times);
    return round($avg, 1);
}

function get_hard_recipe_count(): int {
    global $recipes;
    $hard = array_filter($recipes, fn($r) => $r['difficulty'] === 'nehéz');
    return count($hard);
}

function validate_recipe(array $data): array {
    $errors = [];
    if (empty($data['name']) || strlen(trim($data['name'])) < 3) {
        $errors[] = "A recept neve legalább 3 karakter legyen.";
    }
    $valid_categories = ['előétel', 'leves', 'főétel', 'köret', 'saláta', 'desszert', 'sütemény', 'ital'];
    if (empty($data['category']) || !in_array($data['category'], $valid_categories)) {
        $errors[] = "Érvénytelen kategória.";
    }
    if (empty($data['time']) || !is_numeric($data['time']) || $data['time'] <= 0 || $data['time'] > 500) {
        $errors[] = "Az elkészítési idő 1 és 500 perc között legyen.";
    }
    $valid_difficulties = ['könnyű', 'közepes', 'nehéz'];
    if (empty($data['difficulty']) || !in_array($data['difficulty'], $valid_difficulties)) {
        $errors[] = "A nehézségi szint csak: könnyű, közepes vagy nehéz lehet.";
    }
    if (empty($data['portion']) || !is_numeric($data['portion']) || $data['portion'] < 1 || $data['portion'] > 20) {
        $errors[] = "Az adag értéke 1 és 20 között legyen.";
    }
    return $errors;
}
