<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer('from');
            $table->integer('to');
            $table->string('grade');
            $table->timestamps();
        });

        $grades = [
            ['from' => 80, 'to' => 1000, 'grade' => 'A'],
            ['from' => 75, 'to' => 79, 'grade' => 'A-'],
            ['from' => 70, 'to' => 74, 'grade' => 'B+'],
            ['from' => 65, 'to' => 69, 'grade' => 'B'],
            ['from' => 60, 'to' => 64, 'grade' => 'B-'],
            ['from' => 55, 'to' => 59, 'grade' => 'C+'],
            ['from' => 50, 'to' => 54, 'grade' => 'C'],
            ['from' => 45, 'to' => 49, 'grade' => 'C-'],
            ['from' => 40, 'to' => 44, 'grade' => 'D+'],
            ['from' => 35, 'to' => 39, 'grade' => 'D'],
            ['from' => 30, 'to' => 34, 'grade' => 'D-'],
            ['from' => 0, 'to' => 29, 'grade' => 'E']
        ];

        DB::table('grades')->insert($grades);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
