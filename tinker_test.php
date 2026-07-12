<?php
require __DIR__ . "/vendor/autoload.php";
$app = require_once __DIR__ . "/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$all = App\Models\Baju::with("aksesoris")->get();
echo "=== ALL BAJUS (including inactive) ===\n";
foreach ($all as $b) {
    $aktif = $b->aktif ? "true" : "false";
    echo "  ID={$b->id} nama={$b->nama} kategori={$b->kategori} aktif={$aktif} aksesoris={$b->aksesoris->count()}\n";
}

echo "\n=== COUNTS ===\n";
foreach (["tradisional","adat","tari","musik"] as $k) {
    $total = App\Models\Baju::where("kategori", $k)->count();
    $aktif = App\Models\Baju::where("kategori", $k)->where("aktif", true)->count();
    echo "{$k}: total={$total}, aktif={$aktif}\n";
}

echo "\n=== ADMINS ===\n";
$admins = App\Models\Admin::all();
foreach ($admins as $a) {
    echo "  ID={$a->id} name={$a->name} email={$a->email}\n";
}

