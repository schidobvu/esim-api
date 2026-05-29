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
        Schema::create('simswaps', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('number_to_replace');
            $table->string('initiator_name');
            $table->string('initiator_number')->nullable();
            $table->string('contact_number');
            $table->string('sim_number');
            $table->string('id_number');
            $table->string('id_type')->nullable();

            $table->dateTime('iccid_acquired_at')->nullable();
            $table->string('iccid')->nullable();
            $table->dateTime('sub_uid_acquired_at')->nullable();
            $table->string('sub_uid')->nullable();
            $table->integer('iccid_retrieval_attempts')->default(0);

            $table->dateTime('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable();

            $table->dateTime('submitted_to_vx_at')->nullable();
            $table->boolean('submission_success')->nullable();
            $table->integer('submission_attempts')->default(0)->nullable();

            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simswaps');
    }
};
