<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // expense_defaults — column may already exist from a prior partial run
        if (Schema::hasColumn('expense_defaults', 'chart_of_account_id')) {
            // Ensure correct type (signed INT to match chart_of_accounts.id)
            DB::statement('ALTER TABLE expense_defaults MODIFY chart_of_account_id INT NULL');
        } else {
            Schema::table('expense_defaults', function (Blueprint $table) {
                $table->integer('chart_of_account_id')->nullable()->after('notes');
            });
        }
        DB::statement('ALTER TABLE expense_defaults ADD CONSTRAINT expense_defaults_coa_fk
            FOREIGN KEY (chart_of_account_id) REFERENCES chart_of_accounts(id) ON DELETE SET NULL');

        // expense_items
        if (!Schema::hasColumn('expense_items', 'chart_of_account_id')) {
            Schema::table('expense_items', function (Blueprint $table) {
                $table->integer('chart_of_account_id')->nullable()->after('notes');
            });
        }
        DB::statement('ALTER TABLE expense_items ADD CONSTRAINT expense_items_coa_fk
            FOREIGN KEY (chart_of_account_id) REFERENCES chart_of_accounts(id) ON DELETE SET NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE expense_defaults DROP FOREIGN KEY expense_defaults_coa_fk');
        Schema::table('expense_defaults', function (Blueprint $table) {
            $table->dropColumn('chart_of_account_id');
        });

        DB::statement('ALTER TABLE expense_items DROP FOREIGN KEY expense_items_coa_fk');
        Schema::table('expense_items', function (Blueprint $table) {
            $table->dropColumn('chart_of_account_id');
        });
    }
};
