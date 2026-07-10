<?php

// Boot Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$users = User::whereNotNull('face_descriptor')->get();

echo "Total users with biometric descriptor: " . count($users) . "\n\n";

foreach ($users as $user) {
    echo "User: " . $user->name . " (" . $user->email . ")\n";
    $desc = json_decode($user->face_descriptor, true);
    if (!is_array($desc)) {
        echo "  Descriptor is NOT a valid JSON array!\n";
        echo "  Raw value: " . substr($user->face_descriptor, 0, 100) . "...\n";
    } else {
        echo "  Descriptor count: " . count($desc) . "\n";
        echo "  First 5 values: " . implode(', ', array_slice($desc, 0, 5)) . "\n";
        echo "  Is all zeros? " . (array_sum($desc) === 0 ? "YES" : "NO") . "\n";
    }
    echo "----------------------------------------\n";
}
