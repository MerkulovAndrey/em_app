<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('status', ['new', 'inwork', 'done']);
        });

        /* Если нужен нативный SQL, можно так:
        $sql = <<<'EOT'
            CREATE TABLE `tasks` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `description` text COLLATE utf8mb4_unicode_ci,
                `status` enum('new','inwork','done') COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        EOT;
        DB::statement($sql, []);
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
