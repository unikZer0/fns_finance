<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense_defaults', function (Blueprint $table) {
            $table->id();
            $table->char('category_code', 3);
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->string('item_name');
            $table->string('reference', 10)->nullable();
            $table->decimal('amount_per_month', 15, 2)->default(0);
            $table->decimal('num_months', 5, 2)->default(12);
            $table->string('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_defaults');
    }
};
