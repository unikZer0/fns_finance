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
        Schema::create('salary_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('salary_plans')->cascadeOnDelete();
            $table->string('account_code', 20);
            $table->string('section_code', 10);
            $table->integer('sort_order')->default(0);
            $table->string('item_name', 255);
            $table->integer('num_persons')->default(0);
            $table->decimal('amount_atm', 15, 2)->default(0);
            $table->decimal('amount_cash', 15, 2)->default(0);
            $table->string('notes', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_plan_items');
    }
};
