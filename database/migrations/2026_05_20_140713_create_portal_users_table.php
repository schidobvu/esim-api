<?php

use App\Models\PortalUser;
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
        Schema::create('portal_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('msisdn')->nullable();
            $table->string('position')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('role_id')->nullable();
            $table->foreignId('line_manager_id')->nullable();
            $table->foreignIdFor(PortalUser::class, 'created_by')->nullable()->constrained('portal_users')->restrictOnDelete();
            $table->dateTime('blocked_at')->nullable();
            $table->dateTime('last_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_users');
    }
};
