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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->integer('age');
            $table->text('complaint')->nullable();

            $table->text('past_hx')->nullable();
            $table->string('ticket_no')->nullable();

            // Vitals
            $table->integer('bp_systolic')->nullable();   // BP upper
            $table->integer('bp_diastolic')->nullable();  // BP lower
            $table->integer('pulse')->nullable();
            $table->float('temp')->nullable();
            $table->integer('rr')->nullable();        // Respiratory rate
            $table->integer('o2_sat')->nullable();    // Oxygen saturation
            $table->integer('rbs')->nullable();       // Random blood sugar

            // Status
            $table->enum('status', ['critical','urgent', 'moderate', 'cold'])->nullable();

            // Relation
            $table->unsignedBigInteger('special_id')->nullable();
            $table->foreign('special_id')->references('id')->on('specialties')->onDelete('set null');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
