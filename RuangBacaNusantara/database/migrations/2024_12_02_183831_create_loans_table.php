<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->timestamp('loan_date')->useCurrent();
            $table->timestamp('due_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('return_date')->nullable();
            $table->enum('status', ['on loan', 'returned', 'overdue']);
            $table->decimal('fine', 8, 2)->nullable();
            $table->text('loan_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
