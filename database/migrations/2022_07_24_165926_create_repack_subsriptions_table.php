<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repack_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('action_id')->constrained('moderation_actions');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status', ['pending', 'filled', 'cancelled']);
            $table->foreignId('torrent_id')->nullable()->constrained('torrents');
            $table->longText('repack_note')->nullable();
            $table->longText('repack_msg')->nullable();
        });
    }
};
