{{-- database/migrations/2026_03_25_xxxxxx_add_pagu_setting_to_sumberdana_table.php --}}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sumberdana', function (Blueprint $table) {
            if (!Schema::hasColumn('sumberdana', 'pagu_percentage')) {
                $table->decimal('pagu_percentage', 5, 2)->nullable()->default(0)->after('pagu');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sumberdana', function (Blueprint $table) {
            if (Schema::hasColumn('sumberdana', 'pagu_percentage')) {
                $table->dropColumn('pagu_percentage');
            }
        });
    }
};
