<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        $subjects = [
            ['name' => 'English', 'code' => 'ENG', 'created_at'=>now(),'updated_at'=>now()],
            ['name' => 'Kiswahili', 'code' =>'SWA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mathematics', 'code' =>'MAT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Physics', 'code' =>'PHY', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biology', 'code' =>'BIO', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chemistry', 'code' =>'CHE', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Geography', 'code' =>'GEO', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Agriculture', 'code' =>'AGR', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('subjects')->insert($subjects);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
