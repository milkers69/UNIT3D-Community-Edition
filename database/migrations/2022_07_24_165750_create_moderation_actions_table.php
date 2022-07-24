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
        Schema::create('moderation_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('torrent_id')->constrained('torrents');
            $table->integer('moderator_id');
            $table->foreign('moderator_id')->references('id')->on('users');
            $table->enum('status',['approved','postponed','rejected']);
            $table->longText('staff_note')->nullable();
            $table->longText('private_msg')->nullable();
            $table->longText('public_msg')->nullable();
            $table->boolean('auto');
            $table->json('torrent_state')->nullable();
            $table->timestamps();
        });
    }
};
