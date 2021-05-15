<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->date('dob');
            $table->string('gender', 6);
            $table->string('parent_fname');
            $table->string('parent_mname')->nullable();
            $table->string('parent_lname');
            $table->string('parent_phone', 15);
            $table->string('parent_phone_alt', 15);
            $table->string('parent_email');
            $table->integer('parent_county');
            $table->string('parent_town');
            $table->string('parent_address');
            $table->integer('class');
            $table->integer('stream');
            $table->timestamps();
        });
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
