<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan; // <== ini untuk auto migrate

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->string('no_telp')->nullable();
            $table->string('status')->default('aktif');
            $table->text('alamat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Jalankan migrate otomatis setelah file dibuat (opsional)
        try {
            Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            info('Migration already executed or failed: ' . $e->getMessage());
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
