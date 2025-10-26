<?php
require_once __DIR__ . '/data.php';


function get_allowed_categories(): array {
return ['előétel','leves','főétel','köret','saláta','desszert','sütemény','ital'];
}


function get_all_recipes(): array {
return load_recipes_from_json();
}


function filter_recipes_by_difficulty(string $difficulty, array $recipes = null): array {
if ($recipes === null) $recipes = get_all_recipes();
return array_values(array_filter($recipes, function($r) use ($difficulty){
return mb_strtolower($r['difficulty']) === mb_strtolower($difficulty);
}));
}


function filter_recipes_by_category(string $category, array $recipes = null): array {
if ($recipes === null) $recipes = get_all_recipes();
return array_values(array_filter($recipes, function($r) use ($category){
return mb_strtolower($r['category']) === mb_strtolower($category);
}));
}


function get_average_cooking_time(): float {
$recipes = get_all_recipes();
if (empty($recipes)) return 0.0;
$sum = array_sum(array_map(function($r){return (int)$r['time'];}, $recipes));
return round($sum / count($recipes), 2);
}


function filter_by_time_range(string $range, array $recipes = null): array {
if ($recipes === null) $recipes = get_all_recipes();
return array_values(array_filter($recipes, function($r) use ($range){
$t = (int)$r['time'];
if ($range === 'fast') return $t <= 30;
if ($range === 'medium') return $t >= 31 && $t <= 60;
if ($range === 'long') return $t > 60;
return true;
}));
}
?>