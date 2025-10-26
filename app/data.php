<?php
function get_data_file_path(): string {
    return __DIR__ . '/recipes.json';
}

function ensure_sample_data(): void {
    $path = get_data_file_path();
    if (!file_exists($path)) {
        $sample = [
            ['id'=>1,'name'=>'Gulyásleves','category'=>'leves','time'=>90,'difficulty'=>'közepes','portion'=>4],
            ['id'=>2,'name'=>'Tiramisu','category'=>'desszert','time'=>30,'difficulty'=>'könnyű','portion'=>6],
            ['id'=>3,'name'=>'Rakott krumpli','category'=>'főétel','time'=>80,'difficulty'=>'közepes','portion'=>6],
            ['id'=>4,'name'=>'Rántott csirke','category'=>'főétel','time'=>40,'difficulty'=>'közepes','portion'=>4],
            ['id'=>5,'name'=>'Sült alma','category'=>'desszert','time'=>25,'difficulty'=>'könnyű','portion'=>4],
            ['id'=>6,'name'=>'Csokoládés torta','category'=>'sütemény','time'=>120,'difficulty'=>'nehéz','portion'=>8],
        ];
        file_put_contents($path, json_encode($sample, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

function load_recipes_from_json(): array {
    ensure_sample_data();
    $path = get_data_file_path();
    $json = file_get_contents($path);
    $arr = json_decode($json, true);
    if (!is_array($arr)) return [];
    return $arr;
}
?>
