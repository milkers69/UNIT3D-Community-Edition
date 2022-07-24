<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_rejects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('action_id')->constrained('moderation_actions');
            $table->integer('moderator_id');
            $table->foreign('moderator_id')->references('id')->on('users');
            $table->timestamp('reject_at');
            $table->boolean('complete')->default(false);
            $table->longText('delete_msg')->nullable();
        });
    }
};
