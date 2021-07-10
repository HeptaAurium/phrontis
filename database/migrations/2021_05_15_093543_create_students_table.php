<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('adm_no')->nullable();
            $table->string('profile')->nullable();
            $table->string('fname')->nullable();
            $table->string('status')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->date('dob')->nullable();
            $table->date('doa')->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('parent_fname')->nullable();
            $table->string('parent_mname')->nullable();
            $table->string('parent_lname')->nullable();
            $table->string('parent_phone', 15)->nullable();
            $table->string('parent_phone_alt', 15)->nullable();
            $table->string('parent_email')->nullable();
            $table->integer('parent_county')->nullable();
            $table->string('parent_town')->nullable();
            $table->string('parent_address')->nullable();
            $table->integer('class')->nullable();
            $table->integer('stream')->nullable();
            $table->integer('branch')->nullable();
            $table->integer('subjects_taking')->nullable();
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE students MODIFY COLUMN status ENUM('active', 'suspended', 'inactive')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
