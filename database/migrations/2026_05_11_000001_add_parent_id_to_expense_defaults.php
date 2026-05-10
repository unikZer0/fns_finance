<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expense_defaults', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('id')
                ->constrained('expense_defaults')->nullOnDelete();
            $table->string('reference', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('expense_defaults', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->string('reference', 10)->nullable()->change();
        });
    }
};
