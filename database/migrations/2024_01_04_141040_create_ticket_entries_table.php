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
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('sorting')->nullable();
            $table->unsignedBigInteger('ticket_category_id')->nullable();
            $table->timestamps();
        });

        Schema::table('ticket_categories', function (Blueprint $table) {
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories');
        });

        Schema::create('ticket_entries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('priority')->default('normal');
            $table->string('status')->default('new');
            $table->string('reported_via')->default('internal');
            $table->unsignedBigInteger('ticket_category_id')->nullable();
            $table->unsignedBigInteger('ticket_entry_id')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ticket_entries', function (Blueprint $table) {
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories');
            $table->foreign('ticket_entry_id')->references('id')->on('ticket_entries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_entries');
        Schema::dropIfExists('ticket_categories');
    }
};
