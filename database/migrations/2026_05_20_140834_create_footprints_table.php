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
        Schema::create('footprints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portal_user_id')->nullable();
            $table->string('msisdn')->index()->nullable();
            $table->string('endpoint');
            $table->string('uri');
            $table->string('method');
            $table->json('request');
            $table->text('response')->nullable();
            $table->float('milliseconds');
            $table->integer('status')->nullable();
            $table->boolean('success');
            $table->string('client')->nullable();
            $table->string('app_version')->nullable();
            $table->string('trans_id')->nullable();
            $table->foreignId('token_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footprints');
    }
};
