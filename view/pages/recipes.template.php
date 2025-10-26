<div class="mb-4 flex justify-between items-center">
    <h2 class="text-2xl font-semibold">Receptek</h2>
    <form method="get" class="flex space-x-2">
        <input type="hidden" name="page" value="recipes">
        <select name="difficulty" class="border p-1">
            <option value="">-- Nehézség --</option>
            <option value="könnyű">könnyű</option>
            <option value="közepes">közepes</option>
            <option value="nehéz">nehéz</option>
        </select>
        <select name="category" class="border p-1">
            <option value="">-- Kategória --</option>
            <?php foreach(get_allowed_categories() as $cat): ?>
                <option value="<?= $cat ?>"><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
        <button class="px-3 py-1 bg-blue-500 text-white rounded">Szűr</button>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php if (empty($recipes)): ?>
        <div class="col-span-full bg-white p-4 rounded shadow">Nincs megjeleníthető recept.</div>
    <?php else: ?>
        <?php foreach($recipes as $r): ?>
            <?= render_recipe_card($r) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>