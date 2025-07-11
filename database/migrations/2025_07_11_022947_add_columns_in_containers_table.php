<?php

declare(strict_types=1);

use App\Enums\Status;
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
            $table->decimal('limit')
                ->default(0.00)
                ->after('size');
            $table->enum('status', Status::values())
                ->after('unit')
                ->default(Status::INACTIVE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('containers', function (Blueprint $table): void {
            $table->dropColumn(['limit', 'status']);
        });
    }
};
