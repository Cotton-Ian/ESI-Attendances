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
        Schema::create('student_presences', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('student_id') -> constrained('students') -> cascadeOnDelete();
            $table -> foreignId('lesson_id') -> constrained('lessons') -> cascadeOnDelete();
            $table -> boolean('is_present') -> default(false);
            $table -> unique(['student_id','lesson_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_presences');
    }
};
