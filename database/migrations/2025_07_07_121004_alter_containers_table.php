<?php

declare(strict_types=1);

use App\Enums\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('containers', function (Blueprint $table): void {
            $table->renameColumn('quantity', 'size');
            $table->enum('unit', Unit::values())
                ->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('containers', function (Blueprint $table): void {
            $table->renameColumn('size', 'quantity');
            $table->dropColumn('unit');
        });
    }
};
