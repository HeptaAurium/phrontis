<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('begins');
            $table->string('ends');
            $table->string('year');
            $table->timestamps();
        });

        DB::table('terms')->insert([
            ['name' => 'Term I', 'begins' => '08', 'ends' => '12', 'year' => '2020'],
            ['name' => 'Term II', 'begins' => '01', 'ends' => '03', 'year' => '2021'],
            ['name' => 'Term III', 'begins' => '05', 'ends' => '07', 'year' => '2021'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
