<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold">Statisztika</h2>
        <ul class="mt-2">
            <li>Összes recept: <strong><?= $stats['total'] ?></strong></li>
            <li>Kategóriák száma: <strong><?= $stats['categories'] ?></strong></li>
            <li>Átlagos elkészítési idő: <strong><?= $stats['avg_time'] ?> perc</strong></li>
            <li>Legnehezebb receptek száma: <strong><?= $stats['hard_count'] ?></strong></li>
        </ul>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold">Gyors szűrés</h2>
        <div class="mt-2 space-y-2">
            <a href="?page=recipes&difficulty=könnyű" class="block">Könnyű</a>
            <a href="?page=recipes&difficulty=közepes" class="block">Közepes</a>
            <a href="?page=recipes&difficulty=nehéz" class="block">Nehéz</a>
        </div>
    </div>
</div>