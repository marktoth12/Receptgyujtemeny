<div class="bg-white p-4 rounded shadow">
    <h2 class="text-2xl font-semibold mb-2">Új recept beküldése (nem mentjük)</h2>

    <?php if (!empty($errors)): ?>
        <div class="mb-2 text-red-600">
            <ul>
                <?php foreach($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($submitted): ?>
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded">
            <h3 class="font-semibold">Beküldött recept (csak megjelenítés)</h3>
            <p>Név: <?= $submitted['name'] ?></p>
            <p>Kategória: <?= $submitted['category'] ?></p>
            <p>Idő: <?= $submitted['time'] ?> perc</p>
            <p>Nehézség: <?= $submitted['difficulty'] ?></p>
            <p>Adag: <?= $submitted['portion'] ?></p>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-2">
            <label class="block">Név</label>
            <input name="name" class="border p-1 w-full" required minlength="3">
        </div>
        <div class="mb-2">
            <label class="block">Kategória</label>
            <select name="category" class="border p-1 w-full" required>
                <?php foreach(get_allowed_categories() as $cat): ?>
                    <option value="<?= $cat ?>"><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-2">
            <label class="block">Elkészítési idő (perc)</label>
            <input name="time" class="border p-1 w-full" required pattern="\d+">
        </div>
        <div class="mb-2">
            <label class="block">Nehézség</label>
            <select name="difficulty" class="border p-1 w-full" required>
                <option value="könnyű">könnyű</option>
                <option value="közepes">közepes</option>
                <option value="nehéz">nehéz</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="block">Adag</label>
            <input name="portion" class="border p-1 w-full" required pattern="\d+">
        </div>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Beküldés</button>
    </form>
</div>
