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
        Schema::create('ticket_entries_users', function (Blueprint $table) {
            $table->primary(['ticket_entry_id', 'user_id']);
            $table->unsignedBigInteger('ticket_entry_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean("is_headcoach")->default(0);
            $table->timestamps();
        });

        Schema::table('ticket_entries_users', function (Blueprint $table) {
            $table->foreign('ticket_entry_id')->references('id')->on('ticket_entries');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_entries_users');
    }
};
