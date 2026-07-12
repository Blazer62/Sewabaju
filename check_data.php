<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
foreach (['adat','tari','musik'] as $k) {
    $c = App\Models\Baju::aktif()->whereJsonContains('kategori',$k)->count();
    echo $k . ': ' . $c . PHP_EOL;
}
