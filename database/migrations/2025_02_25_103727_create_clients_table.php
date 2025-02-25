<?php

use App\Models\User;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 200)->nullable();
            $table->text('slug', 50);
            $table->integer('age')->nullable();
            $table->integer('phone_number')->nullable();
            $table->integer('emergency_phone_number')->nullable();
            $table->string('town', 100)->nullable();
            $table->string('occupancy', 100)->nullable();
            $table->string('email')->nullable();
            
            $table->string('treatment')->nullable();

            $table->longText('sore', 1000)->nullable();
            $table->longText('medication', 1000)->nullable();
            $table->longText('allergies', 1000)->nullable();
            $table->longText('medicalBackground', 1000)->nullable();
            $table->longText('sports', 1000)->nullable();

            $table->string('currentDiet')->nullable();
            $table->string('sleepPatterns')->nullable();
            $table->string('waterIntake')->nullable();

            $table->longText('pregnancy', 1000)->nullable();
            $table->longText('menopause', 1000)->nullable();

            $table->boolean('signed')->default(false);

            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
