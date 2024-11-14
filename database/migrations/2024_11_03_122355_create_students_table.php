<?php

use App\Models\Section;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->unique('user');
            $table->foreignIdFor(Section::class, 'section_id')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->integer('pre_test_score')->default(0);
            $table->integer('post_test_score')->default(0);
            $table->integer('tera_mastery')->default(0);
            $table->integer('ecology_mastery')->default(0);
            $table->integer('momentum_mastery')->default(0);
            $table->integer('quantum_mastery')->default(0);
            $table->integer('aspiration')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
